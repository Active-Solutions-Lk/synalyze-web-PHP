<div class="space-y-6 pb-10">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-white">About Page Content</h2>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-md bg-green-900/50 border border-green-500 text-green-300 mb-6">
      <?= e($_SESSION['success']) ?>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="space-y-6">
      <form method="POST" action="<?= e(baseUrl('/admin/about/hero/update')) ?>" class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6 space-y-4">
        <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Main Content</h3>
        <div><label class="block text-sm text-gray-400 mb-1">Hero Headline</label><input type="text" name="heroHeadline" value="<?= e($pageData['heroHeadline']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div><label class="block text-sm text-gray-400 mb-1">Hero Subheadline</label><textarea name="heroSubheadline" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"><?= e($pageData['heroSubheadline']) ?></textarea></div>
        <div><label class="block text-sm text-gray-400 mb-1">Hero Button Text</label><input type="text" name="heroButtonText" value="<?= e($pageData['heroButtonText']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        
        <div><label class="block text-sm text-gray-400 mb-1">Who We Are Title</label><input type="text" name="whoWeAreTitle" value="<?= e($pageData['whoWeAreTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div><label class="block text-sm text-gray-400 mb-1">Who We Are Description</label><textarea name="whoWeAreDescription" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white h-24 focus:outline-none focus:border-[#00CED1]"><?= e($pageData['whoWeAreDescription']) ?></textarea></div>
        
        <div><label class="block text-sm text-gray-400 mb-1">What We Do Title</label><input type="text" name="whatWeDoTitle" value="<?= e($pageData['whatWeDoTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div><label class="block text-sm text-gray-400 mb-1">What We Do Description</label><textarea name="whatWeDoDescription" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"><?= e($pageData['whatWeDoDescription']) ?></textarea></div>
        
        <div><label class="block text-sm text-gray-400 mb-1">Why Choose Us Title</label><input type="text" name="whyChooseUsTitle" value="<?= e($pageData['whyChooseUsTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        
        <div><label class="block text-sm text-gray-400 mb-1">Mission Title</label><input type="text" name="missionTitle" value="<?= e($pageData['missionTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div><label class="block text-sm text-gray-400 mb-1">Mission Description</label><textarea name="missionDescription" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white h-24 focus:outline-none focus:border-[#00CED1]"><?= e($pageData['missionDescription']) ?></textarea></div>
        
        <div><label class="block text-sm text-gray-400 mb-1">Vision Title</label><input type="text" name="visionTitle" value="<?= e($pageData['visionTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div><label class="block text-sm text-gray-400 mb-1">Vision Description</label><textarea name="visionDescription" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white h-24 focus:outline-none focus:border-[#00CED1]"><?= e($pageData['visionDescription']) ?></textarea></div>
        
        <div class="pt-2">
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-md transition-colors w-full">Save Main Content</button>
        </div>
      </form>
    </div>

    <div class="space-y-6">
      <!-- What We Do Cards -->
      <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
        <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-4">What We Do Cards</h3>
        <div class="space-y-4 mb-6">
          <?php foreach ($whatWeDoCards as $card): ?>
            <div class="bg-[#242424] p-4 rounded-md border border-gray-700 relative group" id="card-container-<?= $card['id'] ?>">
              <!-- View Mode -->
              <div id="view-card-<?= $card['id'] ?>" class="flex justify-between items-start gap-4">
                <div>
                  <div class="font-bold text-white mb-1"><?= e($card['title']) ?> <span class="text-xs text-[#00CED1] ml-2">(<?= e($card['iconName']) ?>)</span></div>
                  <div class="text-gray-400 text-sm leading-relaxed"><?= e($card['description']) ?></div>
                </div>
                <div class="flex gap-2">
                  <button onclick="toggleEdit('card', <?= $card['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Card">
                    <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                  </button>
                  <form method="POST" action="<?= e(baseUrl('/admin/about/card/delete')) ?>" onsubmit="return confirm('Delete?');" class="inline">
                    <input type="hidden" name="id" value="<?= $card['id'] ?>">
                    <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Card">
                      <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                    </button>
                  </form>
                </div>
              </div>

              <!-- Edit Mode -->
              <form method="POST" action="<?= e(baseUrl('/admin/about/card/update')) ?>" id="edit-card-<?= $card['id'] ?>" class="hidden space-y-3">
                <input type="hidden" name="id" value="<?= $card['id'] ?>">
                <div>
                  <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Title</label>
                  <input type="text" name="title" value="<?= e($card['title']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
                </div>
                <div>
                  <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Lucide Icon Name</label>
                  <input type="text" name="iconName" value="<?= e($card['iconName']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
                </div>
                <div>
                  <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Description</label>
                  <textarea name="description" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm h-20 focus:outline-none focus:border-[#00CED1]"><?= e($card['description']) ?></textarea>
                </div>
                <div class="flex gap-2 justify-end pt-1">
                  <button type="button" onclick="toggleEdit('card', <?= $card['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">Cancel</button>
                  <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-3 py-1 rounded text-xs">Save</button>
                </div>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
        <form method="POST" action="<?= e(baseUrl('/admin/about/card/create')) ?>" class="space-y-3 pt-4 border-t border-gray-700">
          <input type="text" name="title" placeholder="Title" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
          <input type="text" name="iconName" placeholder="Lucide Icon Name (e.g. Server)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
          <textarea name="description" placeholder="Description" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></textarea>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-md w-full">Add Card</button>
        </form>
      </div>

      <!-- Why Choose Us Items -->
      <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
        <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-4">Why Choose Us Items</h3>
        <div class="space-y-4 mb-6">
          <?php foreach ($whyChooseUsItems as $item): ?>
            <div class="bg-[#242424] p-4 rounded-md border border-gray-700 relative group" id="why-container-<?= $item['id'] ?>">
              <!-- View Mode -->
              <div id="view-why-<?= $item['id'] ?>" class="flex justify-between items-start gap-4">
                <div>
                  <div class="font-bold text-white mb-1"><?= e($item['title']) ?></div>
                  <div class="text-gray-400 text-sm leading-relaxed"><?= e($item['description']) ?></div>
                </div>
                <div class="flex gap-2">
                  <button onclick="toggleEdit('why', <?= $item['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Item">
                    <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                  </button>
                  <form method="POST" action="<?= e(baseUrl('/admin/about/why/delete')) ?>" onsubmit="return confirm('Delete?');" class="inline">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Item">
                      <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                    </button>
                  </form>
                </div>
              </div>

              <!-- Edit Mode -->
              <form method="POST" action="<?= e(baseUrl('/admin/about/why/update')) ?>" id="edit-why-<?= $item['id'] ?>" class="hidden space-y-3">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <div>
                  <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Title</label>
                  <input type="text" name="title" value="<?= e($item['title']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
                </div>
                <div>
                  <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Description</label>
                  <textarea name="description" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm h-20 focus:outline-none focus:border-[#00CED1]"><?= e($item['description']) ?></textarea>
                </div>
                <div class="flex gap-2 justify-end pt-1">
                  <button type="button" onclick="toggleEdit('why', <?= $item['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">Cancel</button>
                  <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-3 py-1 rounded text-xs">Save</button>
                </div>
              </form>
            </div>
          <?php endforeach; ?>
        </div>
        <form method="POST" action="<?= e(baseUrl('/admin/about/why/create')) ?>" class="space-y-3 pt-4 border-t border-gray-700">
          <input type="text" name="title" placeholder="Title" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
          <textarea name="description" placeholder="Description" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></textarea>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-md w-full">Add Item</button>
        </form>
      </div>
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
