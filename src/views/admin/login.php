<?php
$oldInput = $_SESSION['old_input'] ?? [];
?>

<div class="bg-[#121212] border border-gray-800 rounded-2xl p-8 shadow-2xl space-y-6">
  <!-- Header -->
  <div class="flex flex-col items-center justify-center space-y-3">
    <div class="w-12 h-12 rounded-xl bg-[#00CED1] flex items-center justify-center text-black font-extrabold text-2xl shadow-lg shadow-[#00CED1]/20">
      S
    </div>
    <div class="text-center">
      <h1 class="text-2xl font-bold text-white tracking-tight">Synalyze Admin</h1>
      <p class="text-gray-400 text-sm mt-1">Please sign in to access the control panel</p>
    </div>
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
  <form id="admin-login-form" class="space-y-4" method="POST" action="<?= e(baseUrl('/admin/login')) ?>" novalidate>
    <!-- Username -->
    <div class="space-y-1.5">
      <label for="admin-username" class="text-sm font-medium text-gray-300">Username</label>
      <input
        id="admin-username"
        type="text"
        name="username"
        class="w-full bg-[#1A1A1A] border border-gray-800 text-gray-100 rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#00CED1] focus:ring-1 focus:ring-[#00CED1]/30 transition-colors"
        required
        autocomplete="username"
        value="<?= e($oldInput['username'] ?? '') ?>"
      />
    </div>

    <!-- Password -->
    <div class="space-y-1.5">
      <label for="admin-password" class="text-sm font-medium text-gray-300">Password</label>
      <div class="relative">
        <input
          id="admin-password"
          type="password"
          name="password"
          class="w-full bg-[#1A1A1A] border border-gray-800 text-gray-100 rounded-lg px-4 py-2.5 pr-12 focus:outline-none focus:border-[#00CED1] focus:ring-1 focus:ring-[#00CED1]/30 transition-colors"
          required
          autocomplete="current-password"
        />
        <button type="button" class="signup-eye-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white" data-target="admin-password" aria-label="Toggle password visibility">
          <img src="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>" alt="Show" class="signup-eye-icon w-5 h-5 opacity-70 hover:opacity-100 transition-opacity" />
        </button>
      </div>
    </div>

    <!-- Submit -->
    <button type="submit" id="admin-login-submit" class="w-full bg-[#00CED1] hover:bg-[#00e5e8] active:scale-[0.98] text-black font-bold py-2.5 px-4 rounded-lg transition-all shadow-lg shadow-[#00CED1]/10 mt-6">
      Sign In
    </button>
  </form>
</div>
<?php unset($_SESSION['old_input']); ?>
