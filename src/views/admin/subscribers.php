<style>
/* Premium Admin Subscribers Directory Styling */
.admin-card {
  background-color: #121212;
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 16px;
  padding: 24px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.admin-card:hover {
  border-color: rgba(20, 184, 166, 0.2);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.admin-input {
  width: 100%;
  background-color: #1a1a1a;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  padding: 12px 16px 12px 42px; /* Extra left padding for search icon */
  color: #ffffff;
  transition: all 0.2s ease;
}

.admin-input:focus {
  outline: none;
  border-color: #14b8a6;
  background-color: #222222;
  box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.15);
}

.admin-btn-primary {
  background-color: #14b8a6;
  color: #0b1320;
  font-weight: 700;
  padding: 10px 20px;
  border-radius: 8px;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  cursor: pointer;
}

.admin-btn-primary:hover {
  background-color: #0d9488;
  transform: translateY(-1px);
}

.admin-btn-secondary {
  background-color: rgba(255, 255, 255, 0.05);
  color: #ffffff;
  font-weight: 600;
  padding: 8px 16px;
  border-radius: 8px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  cursor: pointer;
}

.admin-btn-secondary:hover {
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.2);
}

.subscriber-row {
  transition: all 0.2s ease;
}

.subscriber-row:hover {
  background-color: rgba(255, 255, 255, 0.02);
}
</style>

<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
      <h2 class="text-3xl font-bold text-white tracking-tight flex items-center gap-3">
        Subscribers Manager
        <span class="text-xs px-2.5 py-1 bg-teal-950/80 border border-teal-500/30 text-teal-400 font-semibold rounded-full">
          <?= count($subscribers) ?> Total
        </span>
      </h2>
      <p class="text-sm text-gray-400 mt-1">Manage newsletter subscription list and email updates.</p>
    </div>
  </div>

  <!-- Session Flash Alerts -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-xl bg-teal-900/30 border border-teal-500/50 text-teal-300 mb-6 flex items-center gap-3">
      <?= lucide_icon('CheckCircle', 'w-5 h-5 text-teal-400') ?>
      <span class="font-medium"><?= e($_SESSION['success']) ?></span>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="p-4 rounded-xl bg-red-900/30 border border-red-500/50 text-red-300 mb-6 flex items-center gap-3">
      <?= lucide_icon('XCircle', 'w-5 h-5 text-red-400') ?>
      <span class="font-medium"><?= e($_SESSION['error']) ?></span>
      <?php unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <!-- Broadcast updates to all -->
  <div class="admin-card">
    <h3 class="text-xl font-bold text-white mb-2 flex items-center gap-2">
      <?= lucide_icon('Mail', 'w-5 h-5 text-[#14b8a6]') ?>
      Broadcast Update to All Subscribers
    </h3>
    <p class="text-sm text-gray-400 mb-6">This sends a custom-formatted HTML update email to all active newsletter subscribers.</p>
    
    <form method="POST" action="<?= e(baseUrl('/admin/subscribers/send')) ?>" class="space-y-4 max-w-2xl">
      <input type="hidden" name="to" value="all">
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Subject</label>
          <input 
            type="text" 
            name="subject" 
            required 
            placeholder="Enter announcement subject..." 
            class="w-full bg-[#1A1A1A] border border-gray-800 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-[#14b8a6] transition-colors"
          >
        </div>
        <div>
          <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Message Body</label>
          <textarea 
            name="message" 
            required 
            rows="5" 
            placeholder="Write your update details here..." 
            class="w-full bg-[#1A1A1A] border border-gray-800 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-[#14b8a6] transition-colors resize-none"
          ></textarea>
        </div>
      </div>
      <button type="submit" class="admin-btn-primary">
        <?= lucide_icon('Send', 'w-4 h-4') ?>
        <span>Send Broadcast Email</span>
      </button>
    </form>
  </div>

  <div class="space-y-6">
    <!-- Filters & Search Bar Card -->
    <div class="admin-card py-4 px-6 flex flex-col md:flex-row gap-4 items-center justify-between">
      <form method="GET" action="<?= e(baseUrl('/admin/subscribers')) ?>" class="relative w-full md:max-w-md flex gap-2">
        <div class="relative flex-grow">
          <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
            <?= lucide_icon('Search', 'w-5 h-5') ?>
          </span>
          <input 
            type="text" 
            name="search" 
            value="<?= e($search ?? '') ?>" 
            placeholder="Search by subscriber email..." 
            class="admin-input"
          >
        </div>
        <button type="submit" class="admin-btn-primary py-2 px-5 text-sm shrink-0">
          <span>Search</span>
        </button>
        <?php if (!empty($search)): ?>
          <a href="<?= e(baseUrl('/admin/subscribers')) ?>" class="admin-btn-secondary flex items-center justify-center text-sm px-4">
            Reset
          </a>
        <?php endif; ?>
      </form>
    </div>

    <!-- Subscribers Table Card -->
    <div class="admin-card overflow-hidden p-0">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs font-semibold uppercase tracking-wider bg-black/20">
              <th class="py-4 px-6">ID</th>
              <th class="py-4 px-6">Subscriber Email</th>
              <th class="py-4 px-6">Subscribed On</th>
              <th class="py-4 px-6">Status</th>
              <th class="py-4 px-6 text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800/60 text-sm">
            <?php foreach ($subscribers as $sub): ?>
              <!-- Main Subscriber Details Row -->
              <tr class="subscriber-row">
                <td class="py-4 px-6 font-mono text-gray-500 text-xs">
                  #<?= e($sub['id']) ?>
                </td>
                <td class="py-4 px-6">
                  <div class="flex items-center gap-2 text-white font-medium">
                    <?= lucide_icon('Mail', 'w-4 h-4 text-gray-500') ?>
                    <a href="mailto:<?= e($sub['email']) ?>" class="hover:text-[#14b8a6] transition-colors"><?= e($sub['email']) ?></a>
                  </div>
                </td>
                <td class="py-4 px-6 text-gray-400">
                  <div class="text-xs font-mono">
                    <?= e(date('M d, Y', strtotime($sub['subscribed_at']))) ?>
                  </div>
                  <div class="text-[10px] text-gray-500 font-mono mt-0.5">
                    <?= e(date('h:i A', strtotime($sub['subscribed_at']))) ?>
                  </div>
                </td>
                <td class="py-4 px-6">
                  <span class="inline-flex items-center gap-1 text-[11px] font-semibold tracking-wide uppercase px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <?= e($sub['status']) ?>
                  </span>
                </td>
                <td class="py-4 px-6 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <!-- Toggle email composer button -->
                    <button 
                      type="button" 
                      onclick="toggleEmailForm(<?= $sub['id'] ?>)" 
                      class="text-[#14b8a6] hover:text-[#0d9488] p-2 rounded-lg hover:bg-teal-950/20 transition-colors" 
                      title="Send Update Email"
                    >
                      <?= lucide_icon('Send', 'w-4 h-4') ?>
                    </button>

                    <!-- Delete button -->
                    <form method="POST" action="<?= e(baseUrl('/admin/subscribers/delete')) ?>" onsubmit="return confirm('Are you sure you want to remove \'<?= e(addslashes($sub['email'])) ?>\' from subscribers?');" class="inline">
                      <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                      <button type="submit" class="text-red-400 hover:text-red-300 p-2 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete Subscriber">
                        <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>

              <!-- Expandable Inline Email Composer Row -->
              <tr id="email-form-row-<?= $sub['id'] ?>" class="hidden bg-black/40 border-l-2 border-l-[#14b8a6]">
                <td colspan="5" class="py-6 px-8">
                  <form method="POST" action="<?= e(baseUrl('/admin/subscribers/send')) ?>" class="space-y-4 max-w-xl">
                    <input type="hidden" name="to" value="<?= e($sub['email']) ?>">
                    <div>
                      <h4 class="text-sm font-semibold text-white mb-1">Compose Email to: <span class="text-[#14b8a6]"><?= e($sub['email']) ?></span></h4>
                      <p class="text-xs text-gray-500">Send a direct newsletter or notification to this subscriber address.</p>
                    </div>
                    <div>
                      <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Subject</label>
                      <input 
                        type="text" 
                        name="subject" 
                        required 
                        class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#14b8a6] transition-colors" 
                        placeholder="Enter email subject..."
                      >
                    </div>
                    <div>
                      <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Message Body</label>
                      <textarea 
                        name="message" 
                        required 
                        rows="4" 
                        class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-sm text-white focus:outline-none focus:border-[#14b8a6] transition-colors resize-none" 
                        placeholder="Type update message here..."
                      ></textarea>
                    </div>
                    <div class="flex gap-3">
                      <button type="submit" class="admin-btn-primary text-xs py-1.5 px-4">
                        <span>Send Email</span>
                      </button>
                      <button type="button" onclick="toggleEmailForm(<?= $sub['id'] ?>)" class="admin-btn-secondary text-xs py-1.5 px-4">
                        <span>Cancel</span>
                      </button>
                    </div>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>

            <?php if (empty($subscribers)): ?>
              <tr>
                <td colspan="5" class="py-12 text-center">
                  <div class="flex flex-col items-center justify-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gray-800/50 flex items-center justify-center text-gray-500">
                      <?= lucide_icon('Mail', 'w-6 h-6') ?>
                    </div>
                    <h4 class="font-bold text-white text-base">No Subscribers Found</h4>
                    <p class="text-gray-500 text-sm max-w-xs">
                      <?php if (!empty($search)): ?>
                        No subscribers match your search criteria. Try a different search term.
                      <?php else: ?>
                        There are currently no active subscribers in the list.
                      <?php endif; ?>
                    </p>
                  </div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
function toggleEmailForm(subscriberId) {
  const formRow = document.getElementById('email-form-row-' + subscriberId);
  if (formRow) {
    formRow.classList.toggle('hidden');
  }
}
</script>
