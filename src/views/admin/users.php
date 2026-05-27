<style>
/* Premium Admin Users Directory Styling */
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
</style>

<div class="space-y-6">
  <!-- Page Header -->
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
      <h2 class="text-3xl font-bold text-white tracking-tight flex items-center gap-3">
        Users Directory
        <span class="text-xs px-2.5 py-1 bg-teal-950/80 border border-teal-500/30 text-teal-400 font-semibold rounded-full">
          <?= count($users) ?> Total
        </span>
      </h2>
      <p class="text-sm text-gray-400 mt-1">View, search, and manage registered user accounts.</p>
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

  <div class="space-y-6">
    <!-- Filters & Search Bar Card -->
    <div class="admin-card py-4 px-6 flex flex-col md:flex-row gap-4 items-center justify-between">
      <form method="GET" action="<?= e(baseUrl('/admin/users')) ?>" class="relative w-full md:max-w-md flex gap-2">
        <div class="relative flex-grow">
          <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
            <?= lucide_icon('Search', 'w-5 h-5') ?>
          </span>
          <input 
            type="text" 
            name="search" 
            value="<?= e($search) ?>" 
            placeholder="Search by name, email, or company..." 
            class="admin-input"
          >
        </div>
        <button type="submit" class="admin-btn-primary py-2 px-5 text-sm shrink-0">
          <span>Search</span>
        </button>
        <?php if (!empty($search)): ?>
          <a href="<?= e(baseUrl('/admin/users')) ?>" class="admin-btn-secondary flex items-center justify-center text-sm px-4">
            Reset
          </a>
        <?php endif; ?>
      </form>
    </div>

    <!-- Users Table Card -->
    <div class="admin-card overflow-hidden p-0">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs font-semibold uppercase tracking-wider bg-black/20">
              <th class="py-4 px-6">ID</th>
              <th class="py-4 px-6">User Profile</th>
              <th class="py-4 px-6">Contact Info</th>
              <th class="py-4 px-6">Address</th>
              <th class="py-4 px-6">Registered Date</th>
              <th class="py-4 px-6 text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800/60 text-sm">
            <?php foreach ($users as $user): ?>
              <tr class="user-row">
                <!-- User ID -->
                <td class="py-4 px-6 font-mono text-gray-500 text-xs">
                  #<?= e($user['id']) ?>
                </td>
                
                <!-- User Profile (Name & Company) -->
                <td class="py-4 px-6">
                  <div class="font-bold text-white"><?= e($user['full_name']) ?></div>
                  <?php if (!empty($user['company_name'])): ?>
                    <div class="text-xs text-teal-400/80 font-medium mt-0.5"><?= e($user['company_name']) ?></div>
                  <?php else: ?>
                    <div class="text-xs text-gray-500 italic mt-0.5">Individual Account</div>
                  <?php endif; ?>
                </td>

                <!-- Contact Info (Email & Phone) -->
                <td class="py-4 px-6">
                  <div class="flex items-center gap-1.5 text-gray-300">
                    <?= lucide_icon('Mail', 'w-3.5 h-3.5 text-gray-500') ?>
                    <a href="mailto:<?= e($user['email']) ?>" class="hover:text-teal-400 transition-colors"><?= e($user['email']) ?></a>
                  </div>
                  <div class="flex items-center gap-1.5 text-gray-400 text-xs mt-1">
                    <?= lucide_icon('Phone', 'w-3.5 h-3.5 text-gray-500') ?>
                    <span><?= e($user['phone']) ?></span>
                  </div>
                </td>

                <!-- Address -->
                <td class="py-4 px-6 text-gray-400 text-xs max-w-xs truncate" title="<?= e($user['address']) ?>">
                  <?= e($user['address']) ?>
                </td>

                <!-- Registered Date -->
                <td class="py-4 px-6 text-gray-400">
                  <div class="text-xs font-mono">
                    <?= e(date('M d, Y', strtotime($user['created_at']))) ?>
                  </div>
                  <div class="text-[10px] text-gray-500 font-mono mt-0.5">
                    <?= e(date('h:i A', strtotime($user['created_at']))) ?>
                  </div>
                </td>

                <!-- Actions -->
                <td class="py-4 px-6 text-center">
                  <form method="POST" action="<?= e(baseUrl('/admin/users/delete')) ?>" onsubmit="return confirm('Are you sure you want to delete the user account for \'<?= e(addslashes($user['full_name'])) ?>\'? This action is permanent and cannot be undone.');" class="inline">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" class="text-red-400 hover:text-red-300 p-2 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete User">
                      <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>

            <?php if (empty($users)): ?>
              <tr>
                <td colspan="6" class="py-12 text-center">
                  <div class="flex flex-col items-center justify-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gray-800/50 flex items-center justify-center text-gray-500">
                      <?= lucide_icon('Users', 'w-6 h-6') ?>
                    </div>
                    <h4 class="font-bold text-white text-base">No Users Found</h4>
                    <p class="text-gray-500 text-sm max-w-xs">
                      <?php if (!empty($search)): ?>
                        No registered users match your search criteria. Try a different search term.
                      <?php else: ?>
                        There are currently no registered users in the database.
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
