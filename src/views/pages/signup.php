<?php
$settings = get_settings();
$accentColor = $settings['themeAccentColor'] ?? '#3d8c7c';
$oldInput = $_SESSION['old_input'] ?? [];
?>

<div class="signup-page">

  <!-- Full-page background image -->
  <div class="signup-bg">
    <img
      src="<?= e(baseUrl('/assets/images/Sign up/Signup background.webp')) ?>"
      alt="Synalyze Platform"
      class="signup-bg__img"
    />
  </div>

  <!-- Form panel — floated on the right over the background -->
  <div class="signup-panel">
    <div class="signup-form-wrap">

      <!-- Heading -->
      <div class="signup-heading">
        <h1 class="signup-heading__title">Create your account</h1>
        <p class="signup-heading__sub">Join SYNALYZE and start managing your workflow smarter and faster</p>
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
      <form id="signup-form" class="signup-form" method="POST" action="<?= e(baseUrl('/signup')) ?>" novalidate>

        <!-- Full Name -->
        <div class="signup-field">
          <label for="signup-fullname" class="signup-label">Full Name <span class="signup-required">*</span></label>
          <input
            id="signup-fullname"
            type="text"
            name="full_name"
            class="signup-input"
            required
            autocomplete="name"
            value="<?= e($oldInput['full_name'] ?? '') ?>"
          />
        </div>

        <!-- Company Name -->
        <div class="signup-field">
          <label for="signup-company" class="signup-label">Company Name <span class="signup-optional">(optional)</span></label>
          <input
            id="signup-company"
            type="text"
            name="company_name"
            class="signup-input"
            autocomplete="organization"
            value="<?= e($oldInput['company_name'] ?? '') ?>"
          />
        </div>

        <!-- Address -->
        <div class="signup-field">
          <label for="signup-address" class="signup-label">Address <span class="signup-required">*</span></label>
          <input
            id="signup-address"
            type="text"
            name="address"
            class="signup-input"
            required
            autocomplete="street-address"
            value="<?= e($oldInput['address'] ?? '') ?>"
          />
        </div>

        <!-- Phone Number -->
        <div class="signup-field">
          <label for="signup-phone" class="signup-label">Phone Number <span class="signup-required">*</span></label>
          <div class="signup-phone-wrap">
            <button type="button" id="phone-country-btn" class="signup-phone-country" aria-label="Select country code">
              <span class="phone-flag-emoji" id="phone-flag-emoji">🇱🇰</span>
              <span id="phone-country-code">+94</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="phone-chevron">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
              </svg>
            </button>
            <!-- Country Dropdown -->
            <div id="phone-country-dropdown" class="phone-dropdown" hidden>
              <div class="phone-dropdown-search">
                <input type="text" id="phone-search" placeholder="Search country..." class="phone-search-input" />
              </div>
              <ul id="phone-country-list" class="phone-country-list">
                <li class="phone-country-item" data-code="+1"   data-flag="🇺🇸" data-name="United States">🇺🇸 United States (+1)</li>
                <li class="phone-country-item" data-code="+44"  data-flag="🇬🇧" data-name="United Kingdom">🇬🇧 United Kingdom (+44)</li>
                <li class="phone-country-item" data-code="+91"  data-flag="🇮🇳" data-name="India">🇮🇳 India (+91)</li>
                <li class="phone-country-item" data-code="+61"  data-flag="🇦🇺" data-name="Australia">🇦🇺 Australia (+61)</li>
                <li class="phone-country-item" data-code="+49"  data-flag="🇩🇪" data-name="Germany">🇩🇪 Germany (+49)</li>
                <li class="phone-country-item" data-code="+33"  data-flag="🇫🇷" data-name="France">🇫🇷 France (+33)</li>
                <li class="phone-country-item" data-code="+81"  data-flag="🇯🇵" data-name="Japan">🇯🇵 Japan (+81)</li>
                <li class="phone-country-item" data-code="+86"  data-flag="🇨🇳" data-name="China">🇨🇳 China (+86)</li>
                <li class="phone-country-item" data-code="+7"   data-flag="🇷🇺" data-name="Russia">🇷🇺 Russia (+7)</li>
                <li class="phone-country-item" data-code="+55"  data-flag="🇧🇷" data-name="Brazil">🇧🇷 Brazil (+55)</li>
                <li class="phone-country-item" data-code="+27"  data-flag="🇿🇦" data-name="South Africa">🇿🇦 South Africa (+27)</li>
                <li class="phone-country-item" data-code="+82"  data-flag="🇰🇷" data-name="South Korea">🇰🇷 South Korea (+82)</li>
                <li class="phone-country-item" data-code="+34"  data-flag="🇪🇸" data-name="Spain">🇪🇸 Spain (+34)</li>
                <li class="phone-country-item" data-code="+39"  data-flag="🇮🇹" data-name="Italy">🇮🇹 Italy (+39)</li>
                <li class="phone-country-item" data-code="+1"   data-flag="🇨🇦" data-name="Canada">🇨🇦 Canada (+1)</li>
                <li class="phone-country-item" data-code="+52"  data-flag="🇲🇽" data-name="Mexico">🇲🇽 Mexico (+52)</li>
                <li class="phone-country-item" data-code="+971" data-flag="🇦🇪" data-name="UAE">🇦🇪 UAE (+971)</li>
                <li class="phone-country-item" data-code="+966" data-flag="🇸🇦" data-name="Saudi Arabia">🇸🇦 Saudi Arabia (+966)</li>
                <li class="phone-country-item" data-code="+65"  data-flag="🇸🇬" data-name="Singapore">🇸🇬 Singapore (+65)</li>
                <li class="phone-country-item" data-code="+64"  data-flag="🇳🇿" data-name="New Zealand">🇳🇿 New Zealand (+64)</li>
                <li class="phone-country-item" data-code="+94"  data-flag="🇱🇰" data-name="Sri Lanka">🇱🇰 Sri Lanka (+94)</li>
              </ul>
            </div>
            <input
              id="signup-phone"
              type="tel"
              name="phone"
              class="signup-input signup-phone-input"
              required
              autocomplete="tel"
              value="<?= e($oldInput['phone'] ?? '') ?>"
            />
          </div>
        </div>

        <!-- Email -->
        <div class="signup-field">
          <label for="signup-email" class="signup-label">Email <span class="signup-required">*</span></label>
          <input
            id="signup-email"
            type="email"
            name="email"
            class="signup-input"
            required
            autocomplete="email"
            value="<?= e($oldInput['email'] ?? '') ?>"
          />
        </div>

        <!-- Password -->
        <div class="signup-field">
          <label for="signup-password" class="signup-label">Password <span class="signup-required">*</span></label>
          <div class="signup-input-wrap">
            <input
              id="signup-password"
              type="password"
              name="password"
              class="signup-input signup-input--pass"
              required
              autocomplete="new-password"
            />
            <button type="button" class="signup-eye-btn" data-target="signup-password" aria-label="Toggle password visibility">
              <img src="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>" alt="Show" class="signup-eye-icon" />
            </button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="signup-field">
          <label for="signup-confirm-password" class="signup-label">Confirm Password <span class="signup-required">*</span></label>
          <div class="signup-input-wrap">
            <input
              id="signup-confirm-password"
              type="password"
              name="confirm_password"
              class="signup-input signup-input--pass"
              required
              autocomplete="new-password"
            />
            <button type="button" class="signup-eye-btn" data-target="signup-confirm-password" aria-label="Toggle confirm password visibility">
              <img src="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>" alt="Show" class="signup-eye-icon" />
            </button>
          </div>
        </div>

        <!-- Terms Checkbox -->
        <div class="signup-terms">
          <input
            id="signup-terms"
            type="checkbox"
            name="terms"
            class="signup-checkbox"
            required
          />
          <label for="signup-terms" class="signup-terms-label">
            I Agree with Terms &amp; Conditions <span class="signup-required">*</span>
          </label>
        </div>

        <!-- Submit -->
        <button type="submit" id="signup-submit" class="signup-submit">
          Create Account
        </button>

        <!-- Already have account -->
        <p class="signup-signin-link">
          Already Have An Account?
          <a href="<?= e(baseUrl('/login')) ?>" class="signup-signin-anchor">Log In</a>
        </p>

        <!-- Divider -->
        <div class="signup-divider">
          <span class="signup-divider__line"></span>
          <span class="signup-divider__text">Or</span>
          <span class="signup-divider__line"></span>
        </div>

        <!-- Social Logins -->
        <div class="signup-social">
          <a href="#" id="signup-google" class="signup-social__btn" aria-label="Sign up with Google">
            <img src="<?= e(baseUrl('/assets/images/Sign up/google.webp')) ?>" alt="Google" class="signup-social__icon" />
            <span class="signup-social__text">Sign up with Google</span>
          </a>
        </div>

      </form>
    </div>
  </div>

</div>
<?php unset($_SESSION['old_input']); ?>

