<?php
$settings = get_settings();
$accentColor = $settings['themeAccentColor'] ?? '#3d8c7c';
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
        <h1 class="login-heading__title">Reset Password</h1>
        <p class="signup-heading__sub" style="margin-top: 0.5rem; margin-bottom: 1rem;">Please enter your new secure password below.</p>
      </div>

      <!-- Alerts -->
      <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
        <div class="signup-alert signup-alert--error" style="margin-bottom: 1.5rem;">
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
      <form id="reset-password-form" class="login-form" method="POST" action="<?= e(baseUrl('/reset-password')) ?>" novalidate>
        <input type="hidden" name="token" value="<?= e($token) ?>" />

        <!-- New Password -->
        <div class="signup-field">
          <label for="reset-password" class="signup-label">New Password <span class="signup-required">*</span></label>
          <div class="signup-input-wrap">
            <input
              id="reset-password"
              type="password"
              name="password"
              class="signup-input signup-input--pass"
              required
              autocomplete="new-password"
            />
            <button type="button" class="signup-eye-btn" data-target="reset-password" aria-label="Toggle password visibility">
              <img src="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>" alt="Show" class="signup-eye-icon" />
            </button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="signup-field" style="margin-top: 1rem;">
          <label for="reset-confirm-password" class="signup-label">Confirm Password <span class="signup-required">*</span></label>
          <div class="signup-input-wrap">
            <input
              id="reset-confirm-password"
              type="password"
              name="confirm_password"
              class="signup-input signup-input--pass"
              required
              autocomplete="new-password"
            />
            <button type="button" class="signup-eye-btn" data-target="reset-confirm-password" aria-label="Toggle confirm password visibility">
              <img src="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>" alt="Show" class="signup-eye-icon" />
            </button>
          </div>
        </div>

        <!-- Submit -->
        <button type="submit" id="reset-submit" class="signup-submit" style="margin-top: 2rem;">
          Update Password
        </button>

        <!-- Redirect to Login -->
        <p class="login-signup-text" style="margin-top: 1.5rem;">
          Back to
          <a href="<?= e(baseUrl('/login')) ?>" class="login-signup-anchor">Log In</a>
        </p>

      </form>
    </div>
  </div>

</div>
