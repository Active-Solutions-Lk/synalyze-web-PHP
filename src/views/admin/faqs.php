<style>
/* Premium Admin FAQ Manager Styling */
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
  padding: 12px 16px;
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

.faq-item-box {
  background-color: #1a1a1a;
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  padding: 20px;
  transition: all 0.2s ease;
}

.faq-item-box:hover {
  border-color: rgba(255, 255, 255, 0.1);
  background-color: #202020;
}

.category-header {
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  padding-bottom: 16px;
  margin-bottom: 20px;
}
</style>

<div class="space-y-6">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-3xl font-bold text-white tracking-tight">FAQs Manager</h2>
      <p class="text-sm text-gray-400 mt-1">Configure and manage all the frequently asked questions displayed on the Q&A page.</p>
    </div>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-xl bg-teal-900/30 border border-teal-500/50 text-teal-300 mb-6 flex items-center gap-3">
      <?= lucide_icon('CheckCircle', 'w-5 h-5 text-teal-400') ?>
      <span class="font-medium"><?= e($_SESSION['success']) ?></span>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Add Category -->
    <div class="lg:col-span-1">
      <div class="admin-card h-fit">
        <h3 class="text-xl font-bold text-white mb-2 flex items-center gap-2">
          <?= lucide_icon('PlusCircle', 'w-5 h-5 text-teal-400') ?>
          Add Category
        </h3>
        <p class="text-xs text-gray-400 mb-4">Create a new FAQ category block to group related questions together.</p>
        
        <form method="POST" action="<?= e(baseUrl('/admin/faqs/category/create')) ?>" class="space-y-4">
          <div>
            <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Category Name</label>
            <input type="text" name="name" placeholder="e.g., General Questions" required class="admin-input">
          </div>
          <button type="submit" class="w-full admin-btn-primary">
            <?= lucide_icon('Plus', 'w-4 h-4') ?>
            Add Category
          </button>
        </form>
      </div>
    </div>

    <!-- Right Column: Categories list & FAQ items -->
    <div class="lg:col-span-2 space-y-8">
      <?php foreach ($categories as $cat): ?>
        <div class="admin-card">
          <!-- Category Header -->
          <div class="category-header" id="category-header-<?= $cat['id'] ?>">
            <!-- View Mode -->
            <div id="view-category-<?= $cat['id'] ?>" class="flex justify-between items-center w-full">
              <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-teal-400"></span>
                <?= e($cat['name']) ?>
              </h3>
              <div class="flex gap-2">
                <button onclick="toggleEdit('category', <?= $cat['id'] ?>, true)" class="text-gray-400 hover:text-white p-1.5 rounded-lg hover:bg-gray-800 transition-colors" title="Edit Category Name">
                  <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                </button>
                <form method="POST" action="<?= e(baseUrl('/admin/faqs/category/delete')) ?>" onsubmit="return confirm('Delete this category and all its FAQs?');" class="inline">
                  <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                  <button type="submit" class="text-red-400 hover:text-red-300 p-1.5 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete Category">
                    <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                  </button>
                </form>
              </div>
            </div>

            <!-- Edit Mode -->
            <form method="POST" action="<?= e(baseUrl('/admin/faqs/category/update')) ?>" id="edit-category-<?= $cat['id'] ?>" class="hidden flex gap-2 w-full">
              <input type="hidden" name="id" value="<?= $cat['id'] ?>">
              <input type="text" name="name" value="<?= e($cat['name']) ?>" required class="flex-1 admin-input py-2">
              <button type="button" onclick="toggleEdit('category', <?= $cat['id'] ?>, false)" class="admin-btn-secondary py-2 text-xs">Cancel</button>
              <button type="submit" class="admin-btn-primary py-2 px-4 text-xs">Save</button>
            </form>
          </div>
          
          <!-- FAQs inside Category -->
          <div class="space-y-4 mb-6">
            <?php foreach ($cat['items'] as $item): ?>
              <div class="faq-item-box relative group" id="item-container-<?= $item['id'] ?>">
                <!-- View Mode -->
                <div id="view-item-<?= $item['id'] ?>" class="flex justify-between items-start w-full gap-4">
                  <div class="space-y-2 flex-1">
                    <div class="font-bold text-white text-base leading-snug flex items-center gap-2">
                      <span class="w-1.5 h-1.5 rounded-full bg-teal-400/40"></span>
                      <?= e($item['question']) ?>
                    </div>
                    <div class="text-gray-400 text-sm leading-relaxed pl-3.5 border-l border-gray-800">
                      <?= e($item['answer']) ?>
                    </div>
                  </div>
                  <div class="flex gap-1 shrink-0">
                    <button onclick="toggleEdit('item', <?= $item['id'] ?>, true)" class="text-gray-400 hover:text-white p-2 rounded-lg hover:bg-gray-800 transition-colors" title="Edit FAQ">
                      <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                    </button>
                    <form method="POST" action="<?= e(baseUrl('/admin/faqs/item/delete')) ?>" onsubmit="return confirm('Delete this FAQ?');" class="inline">
                      <input type="hidden" name="id" value="<?= $item['id'] ?>">
                      <button type="submit" class="text-red-400 hover:text-red-300 p-2 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete FAQ">
                        <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                      </button>
                    </form>
                  </div>
                </div>

                <!-- Edit Mode -->
                <form method="POST" action="<?= e(baseUrl('/admin/faqs/item/update')) ?>" id="edit-item-<?= $item['id'] ?>" class="hidden space-y-4 w-full">
                  <input type="hidden" name="id" value="<?= $item['id'] ?>">
                  <input type="hidden" name="categoryId" value="<?= $cat['id'] ?>">
                  <div>
                    <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Question</label>
                    <input type="text" name="question" value="<?= e($item['question']) ?>" required class="admin-input">
                  </div>
                  <div>
                    <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Answer</label>
                    <textarea name="answer" required class="admin-input h-28 resize-none"><?= e($item['answer']) ?></textarea>
                  </div>
                  <div class="flex gap-2 justify-end pt-1">
                    <button type="button" onclick="toggleEdit('item', <?= $item['id'] ?>, false)" class="admin-btn-secondary text-xs">Cancel</button>
                    <button type="submit" class="admin-btn-primary text-xs">Save Changes</button>
                  </div>
                </form>
              </div>
            <?php endforeach; ?>
            
            <?php if (empty($cat['items'])): ?>
              <div class="p-6 bg-[#1a1a1a]/50 border border-dashed border-gray-800 rounded-xl text-center">
                <p class="text-gray-500 text-sm">No FAQs listed under this category yet.</p>
              </div>
            <?php endif; ?>
          </div>

          <!-- Add FAQ to Category Form -->
          <div class="mt-8 pt-6 border-t border-gray-800/60">
            <form method="POST" action="<?= e(baseUrl('/admin/faqs/item/create')) ?>" class="bg-[#1a1a1a]/40 p-5 rounded-xl border border-gray-800/40 space-y-4">
              <h4 class="font-bold text-white text-sm flex items-center gap-2">
                <?= lucide_icon('PlusCircle', 'w-4 h-4 text-teal-400/80') ?>
                Add New FAQ to <?= e($cat['name']) ?>
              </h4>
              <input type="hidden" name="categoryId" value="<?= $cat['id'] ?>">
              
              <div class="space-y-3">
                <input type="text" name="question" placeholder="Question" required class="admin-input">
                <textarea name="answer" placeholder="Answer" required class="admin-input h-20 resize-none"></textarea>
              </div>
              <button type="submit" class="admin-btn-primary py-2 text-xs">
                <?= lucide_icon('Plus', 'w-3.5 h-3.5') ?>
                Add FAQ
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
function toggleEdit(type, id, show) {
  const viewEl = document.getElementById(`view-${type}-${id}`);
  const editEl = document.getElementById(`edit-${type}-${id}`);
  if (viewEl && editEl) {
    if (show) {
      viewEl.classList.add('hidden');
      editEl.classList.remove('hidden');
    } else {
      viewEl.classList.remove('hidden');
      editEl.classList.add('hidden');
    }
  }
}
</script>
