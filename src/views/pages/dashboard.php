<?php
$accentColor = get_settings()['themeAccentColor'] ?? '#3d8c7c';
?>
<div class="container mx-auto px-6 py-12">
  
  <!-- Alert Messages -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="signup-alert signup-alert--success max-w-7xl mx-auto mb-8">
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

  <div class="max-w-7xl mx-auto space-y-8">
    
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-white/10 pb-6">
      <div>
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">
          Hello, <span style="color: <?= e($accentColor) ?>;"><?= e($user['full_name']) ?></span>!
        </h2>
        <p class="text-gray-400">Welcome to your personal Synalyzer platform account dashboard.</p>
      </div>
      <div class="flex items-center gap-3">
        <a href="<?= e(baseUrl('/logout')) ?>" class="dashboard-logout-btn">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
          </svg>
          Logout
        </a>
      </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
      
      <!-- Profile Card -->
      <div class="dashboard-card glassmorphism-panel flex flex-col items-center text-center p-8">
        <div class="w-24 h-24 rounded-full bg-cover flex items-center justify-center mb-6" style="background-image: linear-gradient(135deg, <?= e($accentColor) ?>, #06b6d4);">
          <span class="text-3xl font-extrabold text-white">
            <?= e(strtoupper(substr($user['full_name'], 0, 1))) ?><?= e(strtoupper(substr(strrchr($user['full_name'], ' '), 1, 1))) ?>
          </span>
        </div>
        <h3 class="text-2xl font-bold text-white mb-1"><?= e($user['full_name']) ?></h3>
        <p class="text-white font-medium text-sm mb-4">Verified Member</p>
        
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#10B981]/10 text-white text-xs font-semibold">
          <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
          Active Session
        </div>

        <div class="w-full border-t border-white/5 mt-6 pt-6 text-left space-y-3">
          <div class="flex justify-between text-xs">
            <span class="text-white">Registered on:</span>
            <span class="text-white font-medium"><?= e(date('F j, Y', strtotime($user['created_at'] ?? 'now'))) ?></span>
          </div>
          <div class="flex justify-between text-xs">
            <span class="text-white">Account Type:</span>
            <span class="text-white font-medium">Standard User</span>
          </div>
        </div>
      </div>

      <!-- Detail Card -->
      <div class="dashboard-card glassmorphism-panel lg:col-span-4 p-8 space-y-6">
        <h3 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/5 pb-4">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-6 text-[#06b6d4]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
          </svg>
          Account Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="space-y-1">
            <span class="text-xs text-gray-400 uppercase tracking-wider">Email Address</span>
            <p class="text-white font-medium text-lg truncate"><?= e($user['email']) ?></p>
          </div>
          
          <div class="space-y-1">
            <span class="text-xs text-gray-400 uppercase tracking-wider">Phone Number</span>
            <p class="text-white font-medium text-lg"><?= e($user['phone'] ?? 'Not Provided') ?></p>
          </div>

          <div class="space-y-1">
            <span class="text-xs text-gray-400 uppercase tracking-wider">Company</span>
            <p class="text-white font-medium text-lg"><?= e(!empty($user['company_name']) ? $user['company_name'] : 'Individual / Personal') ?></p>
          </div>

          <div class="space-y-1">
            <span class="text-xs text-gray-400 uppercase tracking-wider">Address</span>
            <p class="text-white font-medium text-lg leading-relaxed"><?= e($user['address'] ?? 'Not Provided') ?></p>
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom Actions Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      
      <a href="<?= e(baseUrl('/')) ?>" class="dashboard-action-card group flex items-start gap-4 p-5 rounded-xl border border-white/5 hover:border-[#06b6d4]/30 bg-[#1A1C23]/60 transition-all duration-300">
        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#06b6d4]/10 text-gray-400 group-hover:text-[#06b6d4] transition-colors shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
          </svg>
        </div>
        <div>
          <h4 class="font-bold text-white group-hover:text-[#06b6d4] transition-colors mb-1">Return Home</h4>
          <p class="text-xs text-gray-400">Explore the main features and services.</p>
        </div>
      </a>

      <a href="<?= e(baseUrl('/qa')) ?>" class="dashboard-action-card group flex items-start gap-4 p-5 rounded-xl border border-white/5 hover:border-[#06b6d4]/30 bg-[#1A1C23]/60 transition-all duration-300">
        <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center group-hover:bg-[#06b6d4]/10 text-gray-400 group-hover:text-[#06b6d4] transition-colors shrink-0">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
          </svg>
        </div>
        <div>
          <h4 class="font-bold text-white group-hover:text-[#06b6d4] transition-colors mb-1">Support &amp; FAQs</h4>
          <p class="text-xs text-gray-400">Need help? Read answers or contact us.</p>
        </div>
      </a>
      
    </div>

  </div>

</div>
