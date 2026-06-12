<div class="space-y-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-white">Global Settings</h2>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-md bg-green-900/50 border border-green-500 text-green-300 mb-6">
      <?= e($_SESSION['success']) ?>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="p-4 rounded-md bg-red-900/50 border border-red-500 text-red-300 mb-6">
      <?= e($_SESSION['error']) ?>
      <?php unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
    <form method="POST" action="<?= e(baseUrl('/admin/settings/update')) ?>" class="space-y-6">
      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Site Name</label>
        <input type="text" name="siteName" value="<?= e($settings['siteName']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Contact Notification Email</label>
        <input type="email" name="ownerEmail" value="<?= e($settings['ownerEmail'] ?? 'support@synalyze.net') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
        <p class="text-xs text-gray-500 mt-1">This is the email address used globally across the site for all contact details, support information, and message notifications.</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Site Contact Phone</label>
        <input type="tel" name="ownerPhone" value="<?= e($settings['ownerPhone'] ?? '+94764404456') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
        <p class="text-xs text-gray-500 mt-1">This phone number is used globally across the site in the footer, contact page, and support documentation.</p>
      </div>

      <div class="border-t border-gray-800 pt-6">
        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
          <svg class="w-5 h-5 text-[#00CED1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
          SMTP / Mail Server Settings
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
          <div>
            <label class="block text-sm font-medium text-gray-400 mb-2">SMTP Host</label>
            <input type="text" name="smtpHost" value="<?= e($settings['smtpHost'] ?? 'mail.synalyze.net') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
            <p class="text-xs text-gray-500 mt-1">Outgoing server host (e.g. mail.synalyze.net).</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-400 mb-2">SMTP Port</label>
            <input type="number" name="smtpPort" value="<?= e($settings['smtpPort'] ?? 465) ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
            <p class="text-xs text-gray-500 mt-1">SMTP port (e.g. 465 for SSL, 587 for TLS).</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-400 mb-2">From Name</label>
            <input type="text" name="smtpFromName" value="<?= e($settings['smtpFromName'] ?? 'Synalyze') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
            <p class="text-xs text-gray-500 mt-1">Name displayed as the sender (e.g. Synalyze).</p>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-400 mb-2">SMTP Sender Email (Username)</label>
            <input type="email" name="smtpUsername" value="<?= e($settings['smtpUsername'] ?? '') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
            <p class="text-xs text-gray-500 mt-1">The email account used to authenticate with SMTP (must match From address).</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-400 mb-2">SMTP App Password</label>
            <input type="password" name="smtpPassword" value="<?= e($settings['smtpPassword'] ?? '') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
            <p class="text-xs text-gray-500 mt-1">The SMTP authentication password or App Password.</p>
          </div>
        </div>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Theme Accent Color</label>
        <div class="flex items-center gap-4">
          <input type="color" name="themeAccentColor" value="<?= e($settings['themeAccentColor']) ?>" class="w-12 h-12 rounded bg-transparent border-0 cursor-pointer">
          <input type="text" value="<?= e($settings['themeAccentColor']) ?>" class="bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none flex-1" readonly>
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Primary Background Color</label>
        <div class="flex items-center gap-4">
          <input type="color" name="primaryBackgroundColor" value="<?= e($settings['primaryBackgroundColor']) ?>" class="w-12 h-12 rounded bg-transparent border-0 cursor-pointer">
          <input type="text" value="<?= e($settings['primaryBackgroundColor']) ?>" class="bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none flex-1" readonly>
        </div>
      </div>

      <div class="pt-4">
        <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-6 rounded-md transition-colors">
          Save Settings
        </button>
      </div>
    </form>
  </div>

  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6 mt-8">
    <h3 class="text-xl font-bold text-white mb-6">Change Admin Credentials</h3>
    <form method="POST" action="<?= e(baseUrl('/admin/settings/credentials')) ?>" class="space-y-6">
      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">New Username</label>
        <input type="text" name="username" value="<?= e($adminUsername) ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-2">New Password</label>
          <input type="password" name="new_password" placeholder="Leave blank to keep current password" class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-2">Confirm New Password</label>
          <input type="password" name="confirm_password" placeholder="Confirm new password" class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
        </div>
      </div>

      <div class="border-t border-gray-800 pt-6">
        <label class="block text-sm font-medium text-gray-400 mb-2">Current Password <span class="text-red-500">*</span></label>
        <input type="password" name="current_password" required placeholder="Enter current password to verify identity" class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
      </div>

      <div class="pt-4">
        <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-6 rounded-md transition-colors">
          Update Credentials
        </button>
      </div>
    </form>
  </div>

  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6 mt-8">
    <h3 class="text-xl font-bold text-white mb-2 flex items-center gap-2">
      <svg class="w-6 h-6 text-[#00CED1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5"></path></svg>
      Test SMTP Settings
    </h3>
    <p class="text-xs text-gray-500 mb-6">Send a test email to the configured Contact Notification Email (<?= e($settings['ownerEmail'] ?? '') ?>) to check if your SMTP configurations are correct.</p>
    
    <div id="test-email-status" class="hidden p-4 rounded-md mb-6 border"></div>

    <button id="btn-test-email" type="button" class="bg-transparent hover:bg-gray-800 text-[#00CED1] border border-[#00CED1] hover:text-white font-bold py-2 px-6 rounded-md transition-colors inline-flex items-center gap-2">
      <svg id="test-email-spinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      Send Test Email
    </button>
  </div>

  <script>
  document.getElementById('btn-test-email').addEventListener('click', function() {
      const btn = this;
      const spinner = document.getElementById('test-email-spinner');
      const statusDiv = document.getElementById('test-email-status');
      
      btn.disabled = true;
      spinner.classList.remove('hidden');
      statusDiv.classList.add('hidden');
      
      fetch('<?= baseUrl("/admin/settings/test-email") ?>', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          }
      })
      .then(response => response.json())
      .then(data => {
          btn.disabled = false;
          spinner.classList.add('hidden');
          statusDiv.classList.remove('hidden');
          
          if (data.success) {
              statusDiv.className = 'p-4 rounded-md mb-6 bg-green-900/50 border border-green-500 text-green-300';
              statusDiv.innerHTML = '<strong>Success!</strong> ' + (data.message || 'Test email sent successfully. Please check your inbox.');
          } else {
              statusDiv.className = 'p-4 rounded-md mb-6 bg-red-900/50 border border-red-500 text-red-300';
              statusDiv.innerHTML = '<strong>Error:</strong> ' + (data.message || 'Failed to send test email.');
          }
      })
      .catch(error => {
          btn.disabled = false;
          spinner.classList.add('hidden');
          statusDiv.classList.remove('hidden');
          statusDiv.className = 'p-4 rounded-md mb-6 bg-red-900/50 border border-red-500 text-red-300';
          statusDiv.innerHTML = '<strong>Error:</strong> An unexpected network error occurred while testing SMTP settings.';
          console.error(error);
      });
  });
  </script>
</div>
