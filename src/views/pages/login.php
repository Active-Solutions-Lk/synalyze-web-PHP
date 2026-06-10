<?php
$settings = get_settings();
$accentColor = $settings['themeAccentColor'] ?? '#3d8c7c';
$oldInput = $_SESSION['old_input'] ?? [];
?>

<div class="login-page">

  <!-- Left-page/Full-page background image -->
  <div class="login-bg">
    <img
      src="<?= e(baseUrl('/assets/images/Sign up/Signin background.webp')) ?>"
      alt="Synalyze Platform"
      class="login-bg__img"
    />
  </div>

  <!-- Form panel — floated on the right over the background -->
  <div class="login-panel">
    <div class="login-form-wrap">

      <!-- Heading -->
      <div class="login-heading">
        <h1 class="login-heading__title">Sign Into your account</h1>
      </div>

      <!-- Alerts -->
      <?php if (isset($_SESSION['success'])): ?>
        <div class="signup-alert signup-alert--success">
          <div class="signup-alert__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="signup-alert-svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div class="signup-alert__content">
            <p class="signup-alert__msg"><?= e($_SESSION['success']) ?></p>
          </div>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
        <div class="signup-alert signup-alert--error">
          <div class="signup-alert__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="signup-alert-svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="signup-alert__content">
            <ul class="signup-alert__list">
              <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= e($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <?php unset($_SESSION['errors']); ?>
      <?php endif; ?>

      <!-- Form -->
      <form id="login-form" class="login-form" method="POST" action="<?= e(baseUrl('/login')) ?>" novalidate>

        <!-- Email -->
        <div class="login-field">
          <label for="login-email" class="login-label">Email</label>
          <input
            id="login-email"
            type="email"
            name="email"
            class="login-input"
            required
            autocomplete="email"
            value="<?= e($oldInput['email'] ?? '') ?>"
          />
        </div>

        <!-- Password -->
        <div class="login-field">
          <div class="login-label-row">
            <label for="login-password" class="login-label">Password</label>
            <a href="#" class="login-forgot-link">Forgot your password ?</a>
          </div>
          <div class="login-input-wrap">
            <input
              id="login-password"
              type="password"
              name="password"
              class="login-input login-input--pass"
              required
              autocomplete="current-password"
            />
            <button type="button" class="signup-eye-btn" data-target="login-password" aria-label="Toggle password visibility">
              <img src="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>" alt="Show" class="signup-eye-icon" />
            </button>
          </div>
        </div>

        <!-- Submit -->
        <button type="submit" id="login-submit" class="login-submit">
          Sign In
        </button>

        <!-- Redirect to Sign up -->
        <p class="login-signup-text">
          Are you new to Synalyzer?
          <a href="<?= e(baseUrl('/signup')) ?>" class="login-signup-anchor">Click here</a>
          to Sign up
        </p>

        <!-- Divider -->
        <!-- <div class="signup-divider">
          <span class="signup-divider__line"></span>
          <span class="signup-divider__text">Or</span>
          <span class="signup-divider__line"></span>
        </div> -->

        <!-- Social Logins -->
        <!-- <div class="signup-social">
          <a href="<?= e(baseUrl('/auth/google/login')) ?>" id="login-google" class="signup-social__btn" aria-label="Sign in with Google">
            <img src="<?= e(baseUrl('/assets/images/Sign up/google.webp')) ?>" alt="Google" class="signup-social__icon" />
            <span class="signup-social__text">Sign in with Google</span>
          </a>
        </div> -->

      </form>
    </div>
  </div>

</div>
<?php unset($_SESSION['old_input']); ?>
