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

  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
    <form method="POST" action="<?= e(baseUrl('/admin/settings/update')) ?>" class="space-y-6">
      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Site Name</label>
        <input type="text" name="siteName" value="<?= e($settings['siteName']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Contact Notification Email</label>
        <input type="email" name="ownerEmail" value="<?= e($settings['ownerEmail'] ?? 'heshanithennakoon118@gmail.com') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
        <p class="text-xs text-gray-500 mt-1">This is the email address that receives all message notifications sent through the contact form.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-2">SMTP Sender Email (Username)</label>
          <input type="email" name="smtpUsername" value="<?= e($settings['smtpUsername'] ?? '') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
          <p class="text-xs text-gray-500 mt-1">The email account used to send the notification (e.g. your Gmail address).</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-2">SMTP App Password</label>
          <input type="password" name="smtpPassword" value="<?= e($settings['smtpPassword'] ?? '') ?>" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-3 text-white focus:outline-none focus:border-[#00CED1]">
          <p class="text-xs text-gray-500 mt-1">The App Password generated from your email provider for SMTP.</p>
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
</div>
