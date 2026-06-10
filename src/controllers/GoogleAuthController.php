<?php

class GoogleAuthController {
    private $config;

    public function __construct() {
        $this->config = require dirname(__DIR__, 2) . '/config/app.php';
    }

    /**
     * Redirects the user to Google's OAuth consent page for signup.
     */
    public function redirect() {
        $clientId = $this->config['google_client_id'] ?? '';
        $redirectUri = $this->config['google_redirect_uri'] ?? '';

        if (empty($clientId) || empty($redirectUri)) {
            $_SESSION['errors'] = ["Google OAuth is not configured properly."];
            header("Location: " . baseUrl('/signup'));
            exit;
        }

        // Generate dynamic state to prevent CSRF
        $nonce = bin2hex(random_bytes(16));
        $statePayload = base64_encode(json_encode(['nonce' => $nonce, 'intent' => 'signup']));
        $_SESSION['oauth_state'] = $nonce;

        $params = [
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'scope'         => 'openid email profile',
            'state'         => $statePayload,
            'prompt'        => 'select_account'
        ];

        $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
        header("Location: " . $authUrl);
        exit;
    }

    /**
     * Redirects the user to Google's OAuth consent page for login.
     */
    public function loginRedirect() {
        $clientId = $this->config['google_client_id'] ?? '';
        $redirectUri = $this->config['google_redirect_uri'] ?? '';

        if (empty($clientId) || empty($redirectUri)) {
            $_SESSION['errors'] = ["Google OAuth is not configured properly."];
            header("Location: " . baseUrl('/login'));
            exit;
        }

        // Generate dynamic state to prevent CSRF
        $nonce = bin2hex(random_bytes(16));
        $statePayload = base64_encode(json_encode(['nonce' => $nonce, 'intent' => 'login']));
        $_SESSION['oauth_state'] = $nonce;

        $params = [
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'scope'         => 'openid email profile',
            'state'         => $statePayload,
            'prompt'        => 'select_account'
        ];

        $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params);
        header("Location: " . $authUrl);
        exit;
    }

    /**
     * Callback handler for Google OAuth redirect.
     */
    public function callback() {
        $errors = [];
        
        // 1. Verify State Parameter (CSRF validation)
        $statePayload = $_GET['state'] ?? '';
        $sessionState = $_SESSION['oauth_state'] ?? '';
        unset($_SESSION['oauth_state']); // consumed immediately

        $decodedState = json_decode(base64_decode($statePayload), true);
        $nonce = $decodedState['nonce'] ?? '';
        $intent = $decodedState['intent'] ?? 'signup';

        // Default redirect location for errors based on intent
        $errorRedirect = $intent === 'login' ? baseUrl('/login') : baseUrl('/signup');

        if (empty($nonce) || empty($sessionState) || !hash_equals($sessionState, $nonce)) {
            $_SESSION['errors'] = ["Invalid state parameter. Possible CSRF attack."];
            header("Location: " . $errorRedirect);
            exit;
        }

        // 2. Check for Authorization Code
        $code = $_GET['code'] ?? '';
        if (empty($code)) {
            $_SESSION['errors'] = ["Authorization code not returned from Google."];
            header("Location: " . $errorRedirect);
            exit;
        }

        // 3. Exchange Authorization Code for Access Token
        $clientId = $this->config['google_client_id'] ?? '';
        $clientSecret = $this->config['google_client_secret'] ?? '';
        $redirectUri = $this->config['google_redirect_uri'] ?? '';

        $tokenUrl = 'https://oauth2.googleapis.com/token';
        $postFields = [
            'code'          => $code,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri'  => $redirectUri,
            'grant_type'    => 'authorization_code'
        ];

        $ch = curl_init($tokenUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            $_SESSION['errors'] = ["Failed to retrieve access token from Google."];
            header("Location: " . $errorRedirect);
            exit;
        }

        $tokenData = json_decode($response, true);
        $accessToken = $tokenData['access_token'] ?? '';

        if (empty($accessToken)) {
            $_SESSION['errors'] = ["Access token is empty."];
            header("Location: " . $errorRedirect);
            exit;
        }

        // 4. Fetch User Information from Google UserInfo API
        $userInfoUrl = 'https://www.googleapis.com/oauth2/v3/userinfo';
        $ch = curl_init($userInfoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken
        ]);
        
        $userResponse = curl_exec($ch);
        $userHttpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($userHttpCode !== 200) {
            $_SESSION['errors'] = ["Failed to retrieve user profile from Google."];
            header("Location: " . $errorRedirect);
            exit;
        }

        $googleUser = json_decode($userResponse, true);
        $googleId = $googleUser['sub'] ?? '';
        $email = $googleUser['email'] ?? '';
        $fullName = $googleUser['name'] ?? '';

        if (empty($googleId) || empty($email)) {
            $_SESSION['errors'] = ["Google account did not return a valid user ID or email."];
            header("Location: " . $errorRedirect);
            exit;
        }

        // 5. Look up User in Database
        require_once dirname(__DIR__) . '/models/UserModel.php';
        $userModel = new UserModel();

        try {
            // Case A: User already linked their Google account
            $user = $userModel->getUserByGoogleId($googleId);
            if ($user) {
                $this->loginUser($user);
                $_SESSION['success'] = "Welcome back, " . e($user['full_name']) . "!";
                header("Location: " . baseUrl('/'));
                exit;
            }

            // Case B: User already registered with this email address, link Google ID
            $userByEmail = $userModel->getUserByEmail($email);
            if ($userByEmail) {
                $userModel->linkGoogleAccount($userByEmail['id'], $googleId);
                // Fetch fresh user record
                $user = $userModel->getUserById($userByEmail['id']);
                $this->loginUser($user);
                $_SESSION['success'] = "Your Google account is now linked. Welcome back, " . e($user['full_name']) . "!";
                header("Location: " . baseUrl('/'));
                exit;
            }

            // Case C: New registration / Login without account
            if ($intent === 'login') {
                $_SESSION['errors'] = ["No SYNALYZE account found for this Google account. Please sign up first."];
                header("Location: " . baseUrl('/login'));
                exit;
            } else {
                // New registration, redirect to Complete Profile page
                $_SESSION['google_signup_data'] = [
                    'google_id' => $googleId,
                    'email'     => $email,
                    'full_name' => $fullName
                ];
                header("Location: " . baseUrl('/signup/google/complete'));
                exit;
            }

        } catch (Exception $e) {
            $_SESSION['errors'] = ["Database error: " . $e->getMessage()];
            header("Location: " . $errorRedirect);
            exit;
        }
    }

    /**
     * Displays the Complete Profile page for Google OAuth signups.
     */
    public function complete() {
        if (!isset($_SESSION['google_signup_data'])) {
            header("Location: " . baseUrl('/signup'));
            exit;
        }

        // Generate dynamic CSRF token to prevent CSRF attacks
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $pageTitle = 'Complete Your Profile - Synalyze';
        $noBackground = true;
        $noFooter = true;

        $googleData = $_SESSION['google_signup_data'];
        $oldInput = $_SESSION['old_input'] ?? [];

        ob_start();
        require dirname(__DIR__) . '/views/pages/signup_google_complete.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/views/layouts/main.php';
    }

    /**
     * Handles submission of the Google Complete Profile form.
     */
    public function completeSubmit() {
        if (!isset($_SESSION['google_signup_data'])) {
            header("Location: " . baseUrl('/signup'));
            exit;
        }

        // Validate CSRF token
        $csrfToken = $_POST['csrf_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';

        if (empty($csrfToken) || !hash_equals($sessionToken, $csrfToken)) {
            $_SESSION['errors'] = ["CSRF token verification failed. Please try again."];
            header("Location: " . baseUrl('/signup/google/complete'));
            exit;
        }

        $googleData = $_SESSION['google_signup_data'];
        $errors = [];

        // Get and sanitize inputs
        $fullName = trim($_POST['full_name'] ?? $googleData['full_name']);
        $companyName = trim($_POST['company_name'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $terms = isset($_POST['terms']);

        // Validation
        if (empty($fullName)) {
            $errors[] = "Full Name is required.";
        }
        if (empty($address)) {
            $errors[] = "Address is required.";
        }
        if (empty($phone)) {
            $errors[] = "Phone Number is required.";
        }
        if (empty($password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }
        if (!$terms) {
            $errors[] = "You must agree to the Terms & Conditions.";
        }

        $oldInput = [
            'full_name'    => $fullName,
            'company_name' => $companyName,
            'address'      => $address,
            'phone'        => $phone
        ];

        if (empty($errors)) {
            require_once dirname(__DIR__) . '/models/UserModel.php';
            $userModel = new UserModel();

            try {
                // Double check if email got registered in the meantime
                if ($userModel->emailExists($googleData['email'])) {
                    $errors[] = "The email address is already registered.";
                } else {
                    $userData = [
                        'full_name'    => $fullName,
                        'company_name' => $companyName,
                        'address'      => $address,
                        'phone'        => $phone,
                        'email'        => $googleData['email'],
                        'password'     => $password,
                        'google_id'    => $googleData['google_id']
                    ];

                    if ($userModel->createGoogleUser($userData)) {
                        unset($_SESSION['google_signup_data']);
                        unset($_SESSION['old_input']);
                        unset($_SESSION['errors']);

                        // Log the new user in
                        $user = $userModel->getUserByGoogleId($userData['google_id']);
                        $this->loginUser($user);

                        $_SESSION['success'] = "Welcome to SYNALYZE, " . e($fullName) . "! Your account is ready.";
                        header("Location: " . baseUrl('/'));
                        exit;
                    } else {
                        $errors[] = "Something went wrong during registration. Please try again.";
                    }
                }
            } catch (Exception $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }

        // Redirect back with validation errors
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $oldInput;
        header("Location: " . baseUrl('/signup/google/complete'));
        exit;
    }

    /**
     * Helper to establish the user session.
     */
    private function loginUser($user) {
        $_SESSION['user'] = [
            'id'           => $user['id'],
            'full_name'    => $user['full_name'],
            'email'        => $user['email'],
            'company_name' => $user['company_name'] ?? ''
        ];
    }
}
