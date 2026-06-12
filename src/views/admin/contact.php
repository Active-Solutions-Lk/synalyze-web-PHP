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

  <?php if (isset($_SESSION['error'])): ?>
    <div class="p-4 rounded-xl bg-red-950/40 border border-red-500/30 text-red-300 flex items-center gap-3 shadow-xl">
      <?= lucide_icon('AlertCircle', 'text-red-400 shrink-0 w-5 h-5') ?>
      <span class="text-sm font-medium"><?= e($_SESSION['error']) ?></span>
      <?php unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <!-- Tabs Navigation -->
  <div class="flex border-b border-gray-800 bg-[#121212] p-1.5 rounded-xl gap-2 w-fit">
    <button onclick="switchTab('tab-general')" id="btn-tab-general" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-[#00CED1] bg-[#1a1a1a] transition-all flex items-center gap-2">
      <?= lucide_icon('Settings', 'w-4 h-4') ?>
      Page Content
    </button>
    <button onclick="switchTab('tab-inbox')" id="btn-tab-inbox" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-gray-400 hover:text-white transition-all flex items-center gap-2 relative">
      <?= lucide_icon('Inbox', 'w-4 h-4') ?>
      Contact Inbox
      <?php if ($unreadCount > 0): ?>
        <span id="inbox-badge" class="ml-1 px-1.5 py-0.5 text-[10px] font-extrabold bg-[#FF3366] text-white rounded-full leading-none min-w-[18px] text-center">
          <?= $unreadCount ?>
        </span>
      <?php endif; ?>
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
    <!-- Filter Pills -->
    <div class="flex flex-wrap items-center gap-2 bg-[#121212] p-2.5 rounded-xl border border-gray-800">
      <span class="text-xs font-bold text-gray-500 uppercase tracking-wider px-2 flex items-center gap-1.5">
        <?= lucide_icon('Filter', 'w-3.5 h-3.5 text-gray-500') ?>
        Filter:
      </span>
      <a href="?tab=inbox&filter=all" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all <?= $filter === 'all' ? 'bg-[#00CED1] text-black' : 'bg-[#1e1e1e] text-gray-400 hover:text-white hover:bg-gray-800' ?>">
        All
      </a>
      <a href="?tab=inbox&filter=unread" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5 <?= $filter === 'unread' ? 'bg-[#FF3366] text-white' : 'bg-[#1e1e1e] text-gray-400 hover:text-white hover:bg-gray-800' ?>">
        Unread
        <?php if ($unreadCount > 0): ?>
          <span class="px-1.5 py-0.5 text-[9px] bg-black/30 rounded-full font-black"><?= $unreadCount ?></span>
        <?php endif; ?>
      </a>
      <a href="?tab=inbox&filter=read" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all <?= $filter === 'read' ? 'bg-gray-700 text-white font-bold' : 'bg-[#1e1e1e] text-gray-400 hover:text-white hover:bg-gray-800' ?>">
        Read
      </a>
      <a href="?tab=inbox&filter=actioned" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all <?= $filter === 'actioned' ? 'bg-green-600 text-white' : 'bg-[#1e1e1e] text-gray-400 hover:text-white hover:bg-gray-800' ?>">
        Actioned
      </a>
    </div>

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
              <th class="py-4 px-6">Status</th>
              <th class="py-4 px-6 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800/60">
            <?php if (empty($submissions)): ?>
              <tr>
                <td colspan="7" class="py-12 text-center text-gray-500">
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
                  <td class="py-4 px-6 text-sm" id="status-cell-<?= $sub['id'] ?>">
                    <?php if ($sub['status'] === 'unread'): ?>
                      <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-[#FF3366]/10 text-[#FF3366] border border-[#FF3366]/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#FF3366]"></span>
                        Unread
                      </span>
                    <?php elseif ($sub['status'] === 'actioned'): ?>
                      <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-950/30 text-green-400 border border-green-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        Actioned
                      </span>
                    <?php else: ?>
                      <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-800 text-gray-400 border border-gray-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                        Read
                      </span>
                    <?php endif; ?>
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
                  <td colspan="7" class="px-6 py-6 border-b border-gray-800/80">
                    <div class="max-w-3xl space-y-6">
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                          <span class="text-[10px] uppercase font-bold text-gray-500 tracking-wider">Sender Info</span>
                          <div class="text-gray-300 text-sm mt-1">
                            <span class="font-bold text-white"><?= e($sub['name']) ?></span> 
                            <?php if ($sub['company']): ?>
                              at <span class="text-gray-400 font-medium"><?= e($sub['company']) ?></span>
                            <?php endif; ?>
                            <br>
                            Email: <a href="mailto:<?= e($sub['email']) ?>" class="text-[#00CED1] hover:underline"><?= e($sub['email']) ?></a>
                          </div>
                        </div>
                        <div>
                          <span class="text-[10px] uppercase font-bold text-gray-500 tracking-wider">Submitted At</span>
                          <div class="text-gray-300 text-sm mt-1">
                            <?= e(date('F d, Y \a\t H:i', strtotime($sub['submitted_at']))) ?>
                          </div>
                        </div>
                      </div>

                      <div>
                        <span class="text-[10px] uppercase font-bold text-[#00CED1] tracking-wider">Subject</span>
                        <h4 class="text-white font-semibold text-base mt-0.5"><?= e($sub['subject']) ?></h4>
                      </div>

                      <div>
                        <span class="text-[10px] uppercase font-bold text-[#00CED1] tracking-wider">Message Content</span>
                        <div class="mt-1 bg-[#1E1E1E] border border-gray-800 rounded-lg p-4 text-gray-300 text-sm leading-relaxed whitespace-pre-wrap font-sans"><?= e($sub['message']) ?></div>
                      </div>

                      <?php if ($sub['status'] === 'actioned'): ?>
                        <div class="bg-green-950/20 border border-green-500/20 rounded-lg p-4 space-y-1">
                          <div class="flex items-center gap-2 text-green-400 text-xs font-bold">
                            <?= lucide_icon('CheckCircle', 'w-4 h-4 text-green-400') ?>
                            ACTION RECORDED ON <?= e(date('M d, Y H:i', strtotime($sub['actioned_at']))) ?>
                          </div>
                          <p class="text-gray-300 text-sm italic">"<?= e($sub['action_note']) ?>"</p>
                        </div>
                      <?php endif; ?>

                      <!-- Action Note Form -->
                      <div class="pt-4 border-t border-gray-800 space-y-4">
                        <form method="POST" action="<?= e(baseUrl('/admin/contact/inbox/action')) ?>" class="space-y-3">
                          <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                          <div>
                            <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">Action Commit Note</label>
                            <textarea name="action_note" required class="w-full bg-[#1E1E1E] border border-gray-800 rounded-lg p-3 text-white text-sm focus:border-[#00CED1] focus:ring-1 focus:ring-[#00CED1] transition-all h-20" placeholder="Describe the action taken (e.g., 'Replied to user with standard pricing brochure', 'Called and scheduled a demo')..."><?= $sub['status'] === 'actioned' ? e($sub['action_note']) : '' ?></textarea>
                          </div>
                          <div class="flex items-center flex-wrap gap-3">
                            <button type="submit" class="inline-flex items-center gap-2 bg-[#00CED1] hover:bg-[#00a3a6] text-black text-xs font-bold px-4 py-2.5 rounded transition-colors shadow-lg">
                              <?= lucide_icon('CheckCircle', 'w-3.5 h-3.5 text-black') ?>
                              <?= $sub['status'] === 'actioned' ? 'Update Action Note' : 'Mark as Actioned' ?>
                            </button>
                            
                            <a href="mailto:<?= e($sub['email']) ?>?subject=Re: <?= e(rawurlencode($sub['subject'])) ?>" class="inline-flex items-center gap-2 bg-[#242424] hover:bg-gray-800 text-white border border-gray-750 text-xs font-bold px-4 py-2.5 rounded transition-colors">
                              <?= lucide_icon('reply', 'w-3.5 h-3.5') ?>
                              Reply by Email
                            </a>
                            
                            <button type="submit" form="delete-form-<?= $sub['id'] ?>" class="inline-flex items-center gap-2 bg-red-950/30 hover:bg-red-900/40 text-red-400 border border-red-900/30 text-xs font-bold px-4 py-2.5 rounded transition-colors md:ml-auto">
                              <?= lucide_icon('Trash2', 'w-3.5 h-3.5') ?>
                              Delete Message
                            </button>
                          </div>
                        </form>

                        <form id="delete-form-<?= $sub['id'] ?>" method="POST" action="<?= e(baseUrl('/admin/contact/inbox/delete')) ?>" onsubmit="return confirm('Are you sure you want to delete this message? This action cannot be undone.');">
                          <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                        </form>
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

function markMessageAsRead(id) {
  const cell = document.getElementById('status-cell-' + id);
  if (!cell || !cell.innerHTML.includes('Unread')) {
    return;
  }

  const formData = new FormData();
  formData.append('id', id);

  fetch('<?= baseUrl("/admin/contact/inbox/read") ?>', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Update status badge to Read
      cell.innerHTML = `
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-800 text-gray-400 border border-gray-750">
          <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
          Read
        </span>
      `;
      // Update unread count badge in tab
      const badge = document.getElementById('inbox-badge');
      if (badge) {
        if (data.unreadCount > 0) {
          badge.textContent = data.unreadCount;
        } else {
          badge.remove();
        }
      }
      // Update filter pill count if exists
      const pillUnread = document.querySelector('a[href="?tab=inbox&filter=unread"] span');
      if (pillUnread) {
        if (data.unreadCount > 0) {
          pillUnread.textContent = data.unreadCount;
        } else {
          pillUnread.remove();
        }
      }
    }
  })
  .catch(err => console.error("Error marking read:", err));
}

function toggleMessage(id) {
  const row = document.getElementById('message-row-' + id);
  if (row) {
    const isOpening = row.classList.contains('hidden');
    row.classList.toggle('hidden');
    // Rotate corresponding icon
    const tr = row.previousElementSibling;
    if (tr) {
      const icon = tr.querySelector('i[data-lucide="chevron-down"]');
      if (icon) {
        icon.classList.toggle('rotate-180');
      }
    }

    if (isOpening) {
      markMessageAsRead(id);
    }
  }
}

// On page load, switch to active tab based on query parameters
document.addEventListener("DOMContentLoaded", function() {
  const urlParams = new URLSearchParams(window.location.search);
  const tab = urlParams.get('tab');
  if (tab === 'inbox') {
    switchTab('tab-inbox');
  } else {
    switchTab('tab-general');
  }
});
</script>
