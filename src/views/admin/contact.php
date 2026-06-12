<?php
$globalSettings = get_settings();
$globalEmail = $globalSettings['ownerEmail'] ?? 'support@synalyze.net';
$globalPhone = $globalSettings['ownerPhone'] ?? '+94 76 440 4456';
?>
<div class="space-y-8 pb-10">
  <div class="flex justify-between items-center pb-4 border-b border-gray-800">
    <div>
      <h2 class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
        <?= lucide_icon('ContactRound', 'text-[#00CED1] w-8 h-8') ?>
        Contact Control Panel
      </h2>
      <p class="text-gray-400 text-sm mt-1">Manage contact page content and view incoming submissions.</p>
    </div>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-xl bg-green-950/40 border border-green-500/30 text-green-300 flex items-center gap-3 shadow-xl">
      <?= lucide_icon('CheckCircle', 'text-green-400 shrink-0 w-5 h-5') ?>
      <span class="text-sm font-medium"><?= e($_SESSION['success']) ?></span>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <!-- Tabs Navigation -->
  <div class="flex border-b border-gray-800 bg-[#121212] p-1.5 rounded-xl gap-2 w-fit">
    <button onclick="switchTab('tab-general')" id="btn-tab-general" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-[#00CED1] bg-[#1a1a1a] transition-all flex items-center gap-2">
      <?= lucide_icon('Settings', 'w-4 h-4') ?>
      Page Content
    </button>
    <button onclick="switchTab('tab-inbox')" id="btn-tab-inbox" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-gray-400 hover:text-white transition-all flex items-center gap-2">
      <?= lucide_icon('Inbox', 'w-4 h-4') ?>
      Contact Inbox
    </button>
  </div>

  <!-- TAB 1: General Settings (Page Content) -->
  <div id="tab-general" class="tab-content space-y-6">
    <form method="POST" action="<?= e(baseUrl('/admin/contact/update')) ?>" class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6 space-y-8">
    
    <!-- Hero -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Hero Section</h3>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Title</label>
          <input type="text" name="heroTitle" value="<?= e($pageData['heroTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Description</label>
          <textarea name="heroDescription" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white h-20"><?= e($pageData['heroDescription']) ?></textarea>
        </div>
      </div>
    </div>

    <!-- Phone -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Phone Details</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Section Title</label>
          <input type="text" name="phoneTitle" value="<?= e($pageData['phoneTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div></div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Label</label>
          <input type="text" name="phoneSalesLabel" value="<?= e($pageData['phoneSalesLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Number</label>
          <input type="text" name="phoneSalesValue" value="<?= e($pageData['phoneSalesValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Label</label>
          <input type="text" name="phoneSupportLabel" value="<?= e($pageData['phoneSupportLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Number</label>
          <input type="text" name="phoneSupportValue" value="<?= e($pageData['phoneSupportValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
      </div>
    </div>

    <!-- Email -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Email Details</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-400 mb-1">Section Title</label>
          <input type="text" name="emailTitle" value="<?= e($pageData['emailTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Label</label>
          <input type="text" name="emailSalesLabel" value="<?= e($pageData['emailSalesLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Email</label>
          <input type="text" name="emailSalesValue" value="<?= e($pageData['emailSalesValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Label</label>
          <input type="text" name="emailSupportLabel" value="<?= e($pageData['emailSupportLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Email</label>
          <input type="text" name="emailSupportValue" value="<?= e($pageData['emailSupportValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">General Label</label>
          <input type="text" name="emailGeneralLabel" value="<?= e($pageData['emailGeneralLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">General Email</label>
          <input type="text" name="emailGeneralValue" value="<?= e($pageData['emailGeneralValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
      </div>
    </div>

    <!-- Address -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Address Details</h3>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Section Title</label>
          <input type="text" name="addressTitle" value="<?= e($pageData['addressTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div><input type="text" name="addressLine1" value="<?= e($pageData['addressLine1']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 1"></div>
        <div><input type="text" name="addressLine2" value="<?= e($pageData['addressLine2']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 2"></div>
        <div><input type="text" name="addressLine3" value="<?= e($pageData['addressLine3']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 3"></div>
        <div><input type="text" name="addressLine4" value="<?= e($pageData['addressLine4']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 4"></div>
        <div><input type="text" name="addressLine5" value="<?= e($pageData['addressLine5']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 5"></div>
      </div>
    </div>

    <!-- Form & Map -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Other</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Form Title</label>
          <input type="text" name="formTitle" value="<?= e($pageData['formTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Form Description</label>
          <input type="text" name="formDescription" value="<?= e($pageData['formDescription']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Location Title</label>
          <input type="text" name="locationTitle" value="<?= e($pageData['locationTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-400 mb-1">Map Embed URL (src)</label>
          <textarea name="mapEmbedUrl" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white h-20"><?= e($pageData['mapEmbedUrl']) ?></textarea>
        </div>
      </div>
    </div>

    <div class="pt-4 border-t border-gray-800">
      <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-3 px-8 rounded-md transition-colors text-lg">
        Save Contact Page
      </button>
    </div>
  </form>
  </div>

  <!-- TAB 2: Contact Inbox -->
  <div id="tab-inbox" class="tab-content space-y-8 hidden">
    <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-800 bg-[#121212]/50 text-gray-400 text-xs font-bold uppercase tracking-wider">
              <th class="py-4 px-6">Date</th>
              <th class="py-4 px-6">Name</th>
              <th class="py-4 px-6">Email</th>
              <th class="py-4 px-6">Company</th>
              <th class="py-4 px-6">Subject</th>
              <th class="py-4 px-6 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800/60">
            <?php if (empty($submissions)): ?>
              <tr>
                <td colspan="6" class="py-12 text-center text-gray-500">
                  <div class="flex flex-col items-center justify-center gap-3 py-6">
                    <?= lucide_icon('mail-open', 'w-12 h-12 text-gray-600') ?>
                    <span class="text-lg font-semibold text-gray-400">No submissions yet</span>
                    <span class="text-sm text-gray-600">When visitors fill out the contact form, their messages will appear here.</span>
                  </div>
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($submissions as $sub): ?>
                <tr class="hover:bg-gray-800/20 transition-colors group cursor-pointer" onclick="toggleMessage(<?= $sub['id'] ?>)">
                  <td class="py-4 px-6 text-sm text-gray-400">
                    <?= e(date('M d, Y H:i', strtotime($sub['submitted_at']))) ?>
                  </td>
                  <td class="py-4 px-6 text-sm font-semibold text-white">
                    <?= e($sub['name']) ?>
                  </td>
                  <td class="py-4 px-6 text-sm text-gray-400">
                    <a href="mailto:<?= e($sub['email']) ?>" onclick="event.stopPropagation();" class="text-[#00CED1] hover:underline font-medium">
                      <?= e($sub['email']) ?>
                    </a>
                  </td>
                  <td class="py-4 px-6 text-sm text-gray-400">
                    <?= $sub['company'] ? e($sub['company']) : '<span class="text-gray-700 italic">None</span>' ?>
                  </td>
                  <td class="py-4 px-6 text-sm text-gray-300 font-medium">
                    <?= e($sub['subject']) ?>
                  </td>
                  <td class="py-4 px-6 text-sm text-right">
                    <button class="text-gray-400 group-hover:text-[#00CED1] transition-colors text-xs font-semibold uppercase tracking-wider flex items-center gap-1 ml-auto">
                      View
                      <?= lucide_icon('chevron-down', 'w-4 h-4 transition-transform duration-200', 2) ?>
                    </button>
                  </td>
                </tr>
                <!-- Expandable message row -->
                <tr id="message-row-<?= $sub['id'] ?>" class="hidden bg-[#151515] border-t-0">
                  <td colspan="6" class="px-6 py-6 border-b border-gray-800/80">
                    <div class="max-w-3xl space-y-4">
                      <div>
                        <span class="text-[10px] uppercase font-bold text-[#00CED1] tracking-wider">Subject</span>
                        <h4 class="text-white font-semibold text-base mt-0.5"><?= e($sub['subject']) ?></h4>
                      </div>
                      <div>
                        <span class="text-[10px] uppercase font-bold text-[#00CED1] tracking-wider">Message Content</span>
                        <div class="mt-1 bg-[#1E1E1E] border border-gray-800 rounded-lg p-4 text-gray-300 text-sm leading-relaxed whitespace-pre-wrap font-sans"><?= e($sub['message']) ?></div>
                      </div>
                      <div class="flex gap-3">
                        <a href="mailto:<?= e($sub['email']) ?>?subject=Re: <?= e(rawurlencode($sub['subject'])) ?>" class="inline-flex items-center gap-2 bg-[#00CED1] hover:bg-[#00a3a6] text-black text-xs font-bold px-4 py-2 rounded transition-colors">
                          <?= lucide_icon('reply', 'w-3.5 h-3.5') ?>
                          Reply by Email
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<script>
function switchTab(tabId) {
  // Hide all tab contents
  document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
  // Reset all tab buttons
  document.querySelectorAll('.tab-btn').forEach(el => {
    el.classList.remove('text-[#00CED1]', 'bg-[#1a1a1a]');
    el.classList.add('text-gray-400', 'hover:text-white');
  });

  // Show active tab content
  const target = document.getElementById(tabId);
  if (target) target.classList.remove('hidden');
  
  // Style active tab button
  const btn = document.getElementById('btn-' + tabId);
  if (btn) {
    btn.classList.remove('text-gray-400', 'hover:text-white');
    btn.classList.add('text-[#00CED1]', 'bg-[#1a1a1a]');
  }
}

function toggleMessage(id) {
  const row = document.getElementById('message-row-' + id);
  if (row) {
    row.classList.toggle('hidden');
    // Rotate corresponding icon
    const tr = row.previousElementSibling;
    if (tr) {
      const icon = tr.querySelector('i[data-lucide="chevron-down"]');
      if (icon) {
        icon.classList.toggle('rotate-180');
      }
    }
  }
}
</script>
