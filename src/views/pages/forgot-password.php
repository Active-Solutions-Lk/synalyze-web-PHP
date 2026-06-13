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
        <h1 class="login-heading__title">Forgot Password</h1>
        <p class="signup-heading__sub" style="margin-top: 0.5rem; margin-bottom: 1rem;">Enter your email address below to receive a secure link to reset your password.</p>
      </div>

      <!-- Alerts -->
      <?php if (isset($_SESSION['success'])): ?>
        <div class="signup-alert signup-alert--success" style="margin-bottom: 1.5rem;">
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
      <form id="forgot-password-form" class="login-form" method="POST" action="<?= e(baseUrl('/forgot-password')) ?>" novalidate>

        <!-- Email -->
        <div class="signup-field">
          <label for="forgot-email" class="signup-label">Email Address <span class="signup-required">*</span></label>
          <input
            id="forgot-email"
            type="email"
            name="email"
            class="signup-input"
            required
            autocomplete="email"
            value="<?= e($oldInput['email'] ?? '') ?>"
            placeholder="name@company.com"
          />
        </div>

        <!-- Submit -->
        <button type="submit" id="forgot-submit" class="signup-submit" style="margin-top: 1.5rem;">
          Send Reset Link
        </button>

        <!-- Redirect to Login -->
        <p class="login-signup-text" style="margin-top: 1.5rem;">
          Remembered your password?
          <a href="<?= e(baseUrl('/login')) ?>" class="login-signup-anchor">Back to Log In</a>
        </p>

      </form>
    </div>
  </div>

</div>
<?php unset($_SESSION['old_input']); ?>
