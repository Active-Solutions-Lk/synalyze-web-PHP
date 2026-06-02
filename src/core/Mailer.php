<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    /**
     * Send a beautifully formatted HTML email notification when a contact form is submitted.
     */
    public static function sendContactNotification(
        string $ownerEmail,
        string $senderName,
        string $senderEmail,
        string $company,
        string $subject,
        string $message
    ): bool {
        // Load configurations
        $config = require dirname(__DIR__, 2) . '/config/app.php';

        // Fetch SMTP credentials from global settings
        try {
            $pdo = \Core\Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT smtpUsername, smtpPassword FROM globalsettings WHERE id = 1");
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
            $smtpUser = !empty($settings['smtpUsername']) ? $settings['smtpUsername'] : $config['smtp_username'];
            $smtpPass = !empty($settings['smtpPassword']) ? $settings['smtpPassword'] : $config['smtp_password'];
        } catch (\Exception $e) {
            $smtpUser = $config['smtp_username'];
            $smtpPass = $config['smtp_password'];
        }

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            // Recipients
            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($ownerEmail);
            $mail->addReplyTo($senderEmail, $senderName);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Submission: ' . $subject;

            // Beautiful premium HTML email body
            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>New Contact Submission</title>
                <style>
                    body {
                        font-family: \'Inter\', \'Segoe UI\', Helvetica, Arial, sans-serif;
                        background-color: #0A0A0A;
                        color: #E2E8F0;
                        margin: 0;
                        padding: 40px 20px;
                        -webkit-font-smoothing: antialiased;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background: #121212;
                        border: 1px solid #2D3748;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                    }
                    .header {
                        background: linear-gradient(135deg, #00CED1 0%, #008B8B 100%);
                        padding: 30px 40px;
                        text-align: left;
                    }
                    .header h1 {
                        color: #000000;
                        font-size: 24px;
                        font-weight: 800;
                        margin: 0;
                        text-transform: uppercase;
                        letter-spacing: 1.5px;
                    }
                    .header p {
                        color: #1F2937;
                        font-size: 14px;
                        margin: 5px 0 0 0;
                        font-weight: 500;
                    }
                    .content {
                        padding: 40px;
                    }
                    .meta-grid {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 20px;
                        margin-bottom: 30px;
                        padding-bottom: 20px;
                        border-bottom: 1px solid #2D3748;
                    }
                    .meta-item {
                        margin-bottom: 15px;
                    }
                    .meta-label {
                        font-size: 11px;
                        text-transform: uppercase;
                        color: #00CED1;
                        font-weight: 700;
                        letter-spacing: 1px;
                        margin-bottom: 4px;
                    }
                    .meta-value {
                        font-size: 15px;
                        color: #FFFFFF;
                        font-weight: 500;
                    }
                    .message-box {
                        background: #1A1A1A;
                        border-left: 4px solid #00CED1;
                        border-radius: 4px;
                        padding: 20px;
                        margin-top: 25px;
                    }
                    .message-title {
                        font-size: 12px;
                        text-transform: uppercase;
                        color: #A0AEC0;
                        font-weight: 700;
                        letter-spacing: 1px;
                        margin-bottom: 8px;
                    }
                    .message-text {
                        font-size: 15px;
                        line-height: 1.6;
                        color: #E2E8F0;
                        white-space: pre-wrap;
                    }
                    .footer {
                        background: #0D0D0D;
                        padding: 20px 40px;
                        text-align: center;
                        border-top: 1px solid #1A1A1A;
                    }
                    .footer p {
                        font-size: 12px;
                        color: #718096;
                        margin: 0;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>Synalyze</h1>
                        <p>New Inquiry Received</p>
                    </div>
                    <div class="content">
                        <div class="meta-item">
                            <div class="meta-label">Subject</div>
                            <div class="meta-value" style="font-size: 18px; font-weight: 700; color: #FFFFFF;">' . e($subject) . '</div>
                        </div>
                        <div style="height: 20px;"></div>
                        
                        <table style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">From</div>
                                    <div class="meta-value">' . e($senderName) . '</div>
                                </td>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Email</div>
                                    <div class="meta-value"><a href="mailto:' . e($senderEmail) . '" style="color: #00CED1; text-decoration: none;">' . e($senderEmail) . '</a></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Company</div>
                                    <div class="meta-value">' . ($company ? e($company) : '<em style="color:#718096">None Provided</em>') . '</div>
                                </td>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Date/Time</div>
                                    <div class="meta-value">' . date('Y-m-d H:i:s') . '</div>
                                </td>
                            </tr>
                        </table>

                        <div class="message-box">
                            <div class="message-title">Message Message</div>
                            <div class="message-text">' . nl2br(e($message)) . '</div>
                        </div>
                    </div>
                    <div class="footer">
                        <p>This is an automated notification from your Synalyze contact form.</p>
                    </div>
                </div>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = "New Contact Submission Received:\n\nSubject: $subject\nName: $senderName\nEmail: $senderEmail\nCompany: $company\nMessage:\n$message";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send email: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Send a beautifully formatted HTML email notification to the owner when a demo is requested.
     */
    public static function sendDemoRequestNotification(
        string $ownerEmail,
        string $userName,
        string $userEmail,
        string $userPhone,
        string $company
    ): bool {
        $config = require dirname(__DIR__, 2) . '/config/app.php';

        try {
            $pdo = \Core\Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT smtpUsername, smtpPassword FROM globalsettings WHERE id = 1");
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
            $smtpUser = !empty($settings['smtpUsername']) ? $settings['smtpUsername'] : $config['smtp_username'];
            $smtpPass = !empty($settings['smtpPassword']) ? $settings['smtpPassword'] : $config['smtp_password'];
        } catch (\Exception $e) {
            $smtpUser = $config['smtp_username'];
            $smtpPass = $config['smtp_password'];
        }

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($ownerEmail);

            $mail->isHTML(true);
            $mail->Subject = 'New Demo Request: ' . $userName . ' (' . ($company ?: 'No Company') . ')';

            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>New Demo Request</title>
                <style>
                    body {
                        font-family: \'Inter\', \'Segoe UI\', Helvetica, Arial, sans-serif;
                        background-color: #0A0A0A;
                        color: #E2E8F0;
                        margin: 0;
                        padding: 40px 20px;
                        -webkit-font-smoothing: antialiased;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background: #121212;
                        border: 1px solid #2D3748;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                    }
                    .header {
                        background: linear-gradient(135deg, #00CED1 0%, #008B8B 100%);
                        padding: 30px 40px;
                        text-align: left;
                    }
                    .header h1 {
                        color: #000000;
                        font-size: 24px;
                        font-weight: 800;
                        margin: 0;
                        text-transform: uppercase;
                        letter-spacing: 1.5px;
                    }
                    .header p {
                        color: #1F2937;
                        font-size: 14px;
                        margin: 5px 0 0 0;
                        font-weight: 500;
                    }
                    .content {
                        padding: 40px;
                    }
                    .meta-label {
                        font-size: 11px;
                        text-transform: uppercase;
                        color: #00CED1;
                        font-weight: 700;
                        letter-spacing: 1px;
                        margin-bottom: 4px;
                    }
                    .meta-value {
                        font-size: 15px;
                        color: #FFFFFF;
                        font-weight: 500;
                    }
                    .footer {
                        background: #0D0D0D;
                        padding: 20px 40px;
                        text-align: center;
                        border-top: 1px solid #1A1A1A;
                    }
                    .footer p {
                        font-size: 12px;
                        color: #718096;
                        margin: 0;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>Synalyze</h1>
                        <p>New Demo Request Submitted</p>
                    </div>
                    <div class="content">
                        <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px; color: #E2E8F0;">
                            A user has requested access to the Synalyzer demo environment. Here are the details of the request:
                        </p>
                        
                        <table style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
                            <tr>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Full Name</div>
                                    <div class="meta-value">' . e($userName) . '</div>
                                </td>
                                <td style="width:50%; padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Company</div>
                                    <div class="meta-value">' . ($company ? e($company) : '<em style="color:#718096">None Provided</em>') . '</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Email</div>
                                    <div class="meta-value"><a href="mailto:' . e($userEmail) . '" style="color: #00CED1; text-decoration: none;">' . e($userEmail) . '</a></div>
                                </td>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Phone Number</div>
                                    <div class="meta-value">' . e($userPhone) . '</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Requested At</div>
                                    <div class="meta-value">' . date('Y-m-d H:i:s') . '</div>
                                </td>
                                <td style="padding-bottom: 15px; vertical-align: top;">
                                    <div class="meta-label">Status</div>
                                    <div class="meta-value" style="color: #FFD700; font-weight: 700;">🟡 PENDING</div>
                                </td>
                            </tr>
                        </table>

                        <p style="font-size: 14px; color: #A0AEC0; margin-top: 25px; line-height: 1.5; border-top: 1px solid #2D3748; padding-top: 20px;">
                            <strong>Action Required:</strong> Log in to your Synalyze admin dashboard to review this request and dispatch demo credentials to the user.
                        </p>
                    </div>
                    <div class="footer">
                        <p>This is an automated notification from your Synalyze platform.</p>
                    </div>
                </div>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = "New Demo Request Submitted:\n\nName: $userName\nEmail: $userEmail\nCompany: $company\nPhone: $userPhone\nPlease log in to the admin panel to send credentials.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send demo request notification: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Send a beautifully formatted HTML email to the user with their demo credentials.
     */
    public static function sendDemoCredentials(
        string $userEmail,
        string $userName,
        string $synalyzeUrl,
        string $activationKey
    ): bool {
        $config = require dirname(__DIR__, 2) . '/config/app.php';

        try {
            $pdo = \Core\Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT smtpUsername, smtpPassword FROM globalsettings WHERE id = 1");
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
            $smtpUser = !empty($settings['smtpUsername']) ? $settings['smtpUsername'] : $config['smtp_username'];
            $smtpPass = !empty($settings['smtpPassword']) ? $settings['smtpPassword'] : $config['smtp_password'];
        } catch (\Exception $e) {
            $smtpUser = $config['smtp_username'];
            $smtpPass = $config['smtp_password'];
        }

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $config['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUser;
            $mail->Password   = $smtpPass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $config['smtp_port'];

            $mail->setFrom($smtpUser, $config['smtp_from_name']);
            $mail->addAddress($userEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Your Synalyzer Demo Activation Key';

            $body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Your Synalyze Demo is Ready</title>
                <style>
                    body {
                        font-family: \'Inter\', \'Segoe UI\', Helvetica, Arial, sans-serif;
                        background-color: #0A0A0A;
                        color: #E2E8F0;
                        margin: 0;
                        padding: 40px 20px;
                        -webkit-font-smoothing: antialiased;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background: #121212;
                        border: 1px solid #2D3748;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                    }
                    .header {
                        background: linear-gradient(135deg, #00CED1 0%, #008B8B 100%);
                        padding: 30px 40px;
                        text-align: left;
                    }
                    .header h1 {
                        color: #000000;
                        font-size: 24px;
                        font-weight: 800;
                        margin: 0;
                        text-transform: uppercase;
                        letter-spacing: 1.5px;
                    }
                    .header p {
                        color: #1F2937;
                        font-size: 14px;
                        margin: 5px 0 0 0;
                        font-weight: 500;
                    }
                    .content {
                        padding: 40px;
                    }
                    .btn-action {
                        display: inline-block;
                        padding: 14px 28px;
                        background-color: #00CED1;
                        color: #000000 !important;
                        font-weight: 700;
                        font-size: 15px;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        text-decoration: none;
                        border-radius: 6px;
                        margin: 25px 0;
                        box-shadow: 0 4px 14px rgba(0, 206, 209, 0.4);
                        transition: transform 0.2s, box-shadow 0.2s;
                    }
                    .credentials-box {
                        background: #1A1A1A;
                        border: 1px solid #2D3748;
                        border-radius: 8px;
                        padding: 24px;
                        margin: 25px 0;
                    }
                    .credential-row {
                        margin-bottom: 12px;
                    }
                    .credential-row:last-child {
                        margin-bottom: 0;
                    }
                    .credential-label {
                        font-size: 11px;
                        text-transform: uppercase;
                        color: #00CED1;
                        font-weight: 700;
                        letter-spacing: 1px;
                        margin-bottom: 4px;
                    }
                    .credential-value {
                        font-size: 16px;
                        font-family: \'Courier New\', Courier, monospace;
                        color: #FFFFFF;
                        font-weight: bold;
                    }
                    .footer {
                        background: #0D0D0D;
                        padding: 20px 40px;
                        text-align: center;
                        border-top: 1px solid #1A1A1A;
                    }
                    .footer p {
                        font-size: 12px;
                        color: #718096;
                        margin: 0;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>Synalyze</h1>
                        <p>Your Demo Sandbox is Ready</p>
                    </div>
                    <div class="content">
                        <p style="font-size: 16px; line-height: 1.6; color: #FFFFFF; font-weight: 600;">
                            Hello ' . e($userName) . ',
                        </p>
                        <p style="font-size: 15px; line-height: 1.6; color: #E2E8F0;">
                            Thank you for requesting a demo of the Synalyzer platform. We are excited to grant you access to our enterprise-grade NAS fleet monitoring and syslog analytics environment.
                        </p>
                        <p style="font-size: 15px; line-height: 1.6; color: #E2E8F0;">
                            Your sandbox environment has been provisioned. Use the activation key below to activate and access your demo.
                        </p>
                        
                        <div class="credentials-box">
                            <div class="credential-row">
                                <div class="credential-label">Demo Platform URL</div>
                                <div class="credential-value" style="font-family: sans-serif; font-size: 15px;">
                                    <a href="' . e($synalyzeUrl) . '" style="color: #00CED1; text-decoration: none; font-weight: bold;">' . e($synalyzeUrl) . ' ↗</a>
                                </div>
                            </div>
                            <div style="height: 20px;"></div>
                            <div class="credential-row">
                                <div class="credential-label">Activation Key</div>
                                <div style="margin-top: 8px; display: inline-flex; align-items: center; background: #0D0D0D; border: 1px solid #333333; border-radius: 6px; padding: 12px 18px;">
                                    <span style="font-family: \'Courier New\', Courier, monospace; font-size: 18px; color: #FFFFFF; font-weight: bold; letter-spacing: 1.5px; -webkit-user-select: all; -moz-user-select: all; -ms-user-select: all; user-select: all;">' . e($activationKey) . '</span>
                                    <span style="margin-left: 12px; color: #00CED1; font-size: 16px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">📋</span>
                                </div>
                                <div style="font-size: 12px; color: #718096; margin-top: 6px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">(Double-click or click the key above to highlight and copy it instantly)</div>
                            </div>
                        </div>

                        <div style="text-align: center;">
                            <a href="' . e($synalyzeUrl) . '" class="btn-action" target="_blank">Access Your Demo Sandbox</a>
                        </div>

                        <p style="font-size: 14px; color: #A0AEC0; margin-top: 30px; line-height: 1.5; border-top: 1px solid #2D3748; padding-top: 20px;">
                            <strong>Security Note:</strong> Please keep this activation key confidential and do not share it with unauthorized personnel.
                        </p>
                    </div>
                    <div class="footer">
                        <p>This email was sent to ' . e($userEmail) . '. Please do not reply to this automated message.</p>
                        <p style="margin-top: 5px;">&copy; ' . date('Y') . ' Synalyze. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
            ';

            $mail->Body = $body;
            $mail->AltBody = "Your Synalyzer Demo Sandbox is Ready!\n\nAccess Link: $synalyzeUrl\nActivation Key: $activationKey\n\nPlease use the link and key above to activate and explore the sandbox.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("PHPMailer failed to send demo credentials to user: " . $mail->ErrorInfo);
            return false;
        }
    }
}
