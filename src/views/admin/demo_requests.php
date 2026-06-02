<style>
/* Premium Admin Demo Requests Styling */
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
  padding: 12px 16px 12px 42px;
  color: #ffffff;
  transition: all 0.2s ease;
}

.admin-input:focus {
  outline: none;
  border-color: #14b8a6;
  background-color: #222222;
  box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.15);
}

.admin-input-small {
  background-color: #1a1a1a;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 6px;
  padding: 8px 12px;
  color: #ffffff;
  font-size: 13px;
  transition: all 0.2s ease;
}

.admin-input-small:focus {
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
  cursor: pointer;
}

.admin-btn-secondary:hover {
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.2);
}

.user-row {
  transition: all 0.2s ease;
}

.user-row:hover {
  background-color: rgba(255, 255, 255, 0.02);
}

.badge-pending {
  background-color: rgba(217, 119, 6, 0.15);
  color: #f59e0b;
  border: 1px solid rgba(217, 119, 6, 0.3);
}

.badge-sent {
  background-color: rgba(16, 185, 129, 0.15);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.3);
}
</style>

<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
      <h2 class="text-3xl font-bold text-white tracking-tight flex items-center gap-3">
        Demo Requests
        <span class="text-xs px-2.5 py-1 bg-teal-950/80 border border-teal-500/30 text-teal-400 font-semibold rounded-full">
          <?= count($requests) ?> Total
        </span>
      </h2>
      <p class="text-sm text-gray-400 mt-1">Review demo environments requests and issue client access credentials.</p>
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
    <div class="p-4 rounded-xl bg-red-950/30 border border-red-500/50 text-red-300 mb-6 flex items-center gap-3">
      <?= lucide_icon('AlertTriangle', 'w-5 h-5 text-red-400') ?>
      <span class="font-medium"><?= e($_SESSION['error']) ?></span>
      <?php unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <div class="space-y-6">
    <!-- Filters & Search Bar Card -->
    <div class="admin-card py-4 px-6 flex flex-col md:flex-row gap-4 items-center justify-between">
      <form method="GET" action="<?= e(baseUrl('/admin/demo')) ?>" class="relative w-full md:max-w-md flex gap-2">
        <div class="relative flex-grow">
          <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
            <?= lucide_icon('Search', 'w-5 h-5') ?>
          </span>
          <input 
            type="text" 
            name="search" 
            value="<?= e($search) ?>" 
            placeholder="Search by name, email, company, phone..." 
            class="admin-input"
          >
        </div>
        <button type="submit" class="admin-btn-primary py-2 px-5 text-sm shrink-0">
          <span>Search</span>
        </button>
        <?php if (!empty($search)): ?>
          <a href="<?= e(baseUrl('/admin/demo')) ?>" class="admin-btn-secondary flex items-center justify-center text-sm px-4">
            Reset
          </a>
        <?php endif; ?>
      </form>
    </div>

    <!-- Demo Requests Table Card -->
    <div class="admin-card overflow-hidden p-0">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs font-semibold uppercase tracking-wider bg-black/20">
              <th class="py-4 px-6">ID</th>
              <th class="py-4 px-6">User Profile</th>
              <th class="py-4 px-6">Contact Info</th>
              <th class="py-4 px-6">Requested At</th>
              <th class="py-4 px-6">Status</th>
              <th class="py-4 px-6 text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800/60 text-sm">
            <?php foreach ($requests as $request): ?>
              <!-- Main Row -->
              <tr class="user-row">
                <!-- Request ID -->
                <td class="py-4 px-6 font-mono text-gray-500 text-xs">
                  #<?= e($request['id']) ?>
                </td>
                
                <!-- User Profile (Name & Company) -->
                <td class="py-4 px-6">
                  <div class="font-bold text-white"><?= e($request['full_name']) ?></div>
                  <?php if (!empty($request['company_name'])): ?>
                    <div class="text-xs text-teal-400/80 font-medium mt-0.5"><?= e($request['company_name']) ?></div>
                  <?php else: ?>
                    <div class="text-xs text-gray-500 italic mt-0.5">Individual Account</div>
                  <?php endif; ?>
                </td>

                <!-- Contact Info (Email & Phone) -->
                <td class="py-4 px-6">
                  <div class="flex items-center gap-1.5 text-gray-300">
                    <?= lucide_icon('Mail', 'w-3.5 h-3.5 text-gray-500') ?>
                    <a href="mailto:<?= e($request['email']) ?>" class="hover:text-teal-400 transition-colors"><?= e($request['email']) ?></a>
                  </div>
                  <div class="flex items-center gap-1.5 text-gray-400 text-xs mt-1">
                    <?= lucide_icon('Phone', 'w-3.5 h-3.5 text-gray-500') ?>
                    <span><?= e($request['phone']) ?></span>
                  </div>
                </td>

                <!-- Requested Date -->
                <td class="py-4 px-6 text-gray-400">
                  <div class="text-xs font-mono">
                    <?= e(date('M d, Y', strtotime($request['requested_at']))) ?>
                  </div>
                  <div class="text-[10px] text-gray-500 font-mono mt-0.5">
                    <?= e(date('h:i A', strtotime($request['requested_at']))) ?>
                  </div>
                </td>

                <!-- Status -->
                <td class="py-4 px-6">
                  <?php if ($request['status'] === 'pending'): ?>
                    <span class="text-xs px-2.5 py-1 rounded-full font-semibold badge-pending">
                      🟡 Pending
                    </span>
                  <?php else: ?>
                    <span class="text-xs px-2.5 py-1 rounded-full font-semibold badge-sent" title="Sent at: <?= e($request['credential_sent_at']) ?>">
                      🟢 Credentials Sent
                    </span>
                  <?php endif; ?>
                </td>

                <!-- Actions -->
                <td class="py-4 px-6 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <!-- Collapsible Trigger -->
                    <button type="button" onclick="toggleCredForm(<?= $request['id'] ?>)" class="text-teal-400 hover:text-teal-300 p-2 rounded-lg hover:bg-teal-950/30 transition-colors" title="Send Credentials">
                      <?= lucide_icon('Key', 'w-4 h-4') ?>
                    </button>
                    
                    <!-- Delete Request -->
                    <form method="POST" action="<?= e(baseUrl('/admin/demo/delete')) ?>" onsubmit="return confirm('Are you sure you want to delete this demo request?');" class="inline">
                      <input type="hidden" name="id" value="<?= $request['id'] ?>">
                      <button type="submit" class="text-red-400 hover:text-red-300 p-2 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete Request">
                        <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>

              <!-- Collapsible Form Row -->
              <tr id="form-row-<?= $request['id'] ?>" class="bg-black/30" style="display: <?= (isset($_SESSION['active_row_id']) && $_SESSION['active_row_id'] == $request['id']) ? 'table-row' : 'none' ?>;">
                <td colspan="6" class="p-6 border-b border-gray-800">
                  <div class="max-w-2xl mx-auto bg-[#181818] border border-gray-800/80 rounded-xl p-6 shadow-inner space-y-4">
                    <div class="flex items-center gap-2 border-b border-gray-800 pb-3 mb-2">
                      <?= lucide_icon('Send', 'w-4 h-4 text-teal-400') ?>
                      <h4 class="font-bold text-white text-sm">Send Sandbox Credentials to <?= e($request['full_name']) ?></h4>
                    </div>

                    <form method="POST" action="<?= e(baseUrl('/admin/demo/send')) ?>" class="space-y-4">
                      <input type="hidden" name="id" value="<?= $request['id'] ?>">
                      
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                          <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Synalyze Sandbox URL</label>
                          <input type="text" name="synalyze_url" value="http://sg-analyzer.synalyze.net:3000" class="admin-input-small" required>
                        </div>
                        <div class="flex flex-col gap-1">
                          <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Sandbox Username / Email</label>
                          <input type="text" name="username" value="<?= e($request['email']) ?>" class="admin-input-small" required>
                        </div>
                      </div>
                      
                      <div class="flex flex-col gap-1">
                        <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Temporary Password</label>
                        <div class="flex gap-2">
                          <input type="text" name="password" id="pass-<?= $request['id'] ?>" value="Synalyze@<?= rand(1000, 9999) ?>" class="admin-input-small flex-grow" required>
                          <button type="button" onclick="generatePass(<?= $request['id'] ?>)" class="admin-btn-secondary py-2 px-3 text-xs shrink-0 flex items-center justify-center gap-1.5">
                            <?= lucide_icon('RefreshCw', 'w-3.5 h-3.5') ?>
                            Regenerate
                          </button>
                        </div>
                      </div>
                      
                      <div class="flex justify-end gap-3 pt-2">
                        <button type="button" onclick="toggleCredForm(<?= $request['id'] ?>)" class="admin-btn-secondary py-2 px-4 text-xs">
                          Cancel
                        </button>
                        <button type="submit" class="admin-btn-primary py-2 px-5 text-xs">
                          Send Credentials Email
                        </button>
                      </div>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

            <?php if (empty($requests)): ?>
              <tr>
                <td colspan="6" class="py-12 text-center">
                  <div class="flex flex-col items-center justify-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gray-800/50 flex items-center justify-center text-gray-500">
                      <?= lucide_icon('HelpCircle', 'w-6 h-6') ?>
                    </div>
                    <h4 class="font-bold text-white text-base">No Demo Requests Found</h4>
                    <p class="text-gray-500 text-sm max-w-xs">
                      <?php if (!empty($search)): ?>
                        No demo requests match your search criteria. Try a different term.
                      <?php else: ?>
                        There are currently no active demo requests in the database.
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

<?php unset($_SESSION['active_row_id']); ?>

<script>
function toggleCredForm(id) {
  const row = document.getElementById('form-row-' + id);
  if (row.style.display === 'none') {
    // Hide all other forms first to keep layout clean
    document.querySelectorAll('[id^="form-row-"]').forEach(el => el.style.display = 'none');
    row.style.display = 'table-row';
  } else {
    row.style.display = 'none';
  }
}

function generatePass(id) {
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%&*';
  let pass = 'Synalyze@';
  for (let i = 0; i < 4; i++) {
    pass += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  document.getElementById('pass-' + id).value = pass;
}
</script>
