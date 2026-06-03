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

        <?php if (!empty($demoRequest) && $demoRequest['status'] === 'credentials_sent'): ?>
          <!-- Demo Credentials Card -->
          <div class="mt-6 pt-6 border-t border-white/5">
            <div class="flex items-center gap-2 mb-4">
              <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#10B981] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#10B981]"></span>
              </span>
              <h4 class="text-sm font-bold text-white uppercase tracking-widest">Synalyzer Demo Access</h4>
              <p class="text-xs text-[#00CED1]">We've sent the activation key and demo url to your email inbox.</p>
            </div>

            <div class="rounded-xl border border-[#00CED1]/20 bg-[#00CED1]/5 p-5 space-y-4" style="box-shadow: 0 0 24px rgba(0,206,209,0.06);">

              <!-- Portal URL -->
              <div class="space-y-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#00CED1]">Demo Platform URL</span>
                <div class="flex flex-wrap items-center gap-3">
                  <a href="<?= e($demoRequest['synalyze_url']) ?>" target="_blank"
                     class="text-white font-medium text-sm hover:text-[#00CED1] transition-colors"
                     style="border-bottom: 1px dashed rgba(0,206,209,0.4);">
                    <?= e($demoRequest['synalyze_url']) ?>
                  </a>
                  <a href="<?= e($demoRequest['synalyze_url']) ?>" target="_blank"
                     class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 hover:opacity-90"
                     style="background: linear-gradient(135deg, #00CED1, #008B8B); color: #000;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    Access Portal
                  </a>
                </div>
              </div>

              <!-- Activation Key -->
              <div class="space-y-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-[#00CED1]">Activation Key</span>
                <div class="flex items-center gap-3">
                  <div class="flex items-center bg-black/40 border border-white/10 rounded-lg px-4 py-2.5 flex-1 min-w-0">
                    <span id="dash-activation-key" class="font-mono text-white font-bold tracking-widest text-base select-all truncate">
                      <?= e($demoRequest['activation_key']) ?>
                    </span>
                  </div>
                  <button type="button"
                    onclick="copyDashboardKey('<?= e($demoRequest['activation_key']) ?>', this)"
                    id="copy-key-btn"
                    class="shrink-0 flex items-center gap-1.5 px-3 py-2.5 rounded-lg border border-white/10 bg-white/5 text-xs font-semibold text-gray-300 hover:border-[#00CED1]/40 hover:text-[#00CED1] hover:bg-[#00CED1]/5 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/></svg>
                    Copy
                  </button>
                </div>
                <p class="text-xs text-gray-500">Click the key to select all, or use the Copy button.</p>
              </div>

              <!-- Dispatch Date -->
              <div class="pt-2 border-t border-white/5 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-xs text-gray-500">Credentials dispatched on <strong class="text-gray-400"><?= e(date('F j, Y', strtotime($demoRequest['credential_sent_at']))) ?></strong></span>
              </div>

            </div>
          </div>
        <?php endif; ?>

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

<script>
function copyDashboardKey(text, btn) {
  const originalHTML = btn.innerHTML;
  if (navigator.clipboard && window.isSecureContext) {
    navigator.clipboard.writeText(text).then(() => {
      btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg> Copied!';
      btn.style.color = '#00CED1';
      btn.style.borderColor = 'rgba(0,206,209,0.4)';
      setTimeout(() => { btn.innerHTML = originalHTML; btn.style.color = ''; btn.style.borderColor = ''; }, 2200);
    });
  } else {
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed'; ta.style.top = '0'; ta.style.left = '0'; ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.focus(); ta.select();
    try { document.execCommand('copy'); } catch(e) {}
    document.body.removeChild(ta);
    btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg> Copied!';
    btn.style.color = '#00CED1';
    setTimeout(() => { btn.innerHTML = originalHTML; btn.style.color = ''; }, 2200);
  }
}
</script>
