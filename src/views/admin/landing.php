<div class="space-y-6 pb-10">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-white">Landing Page Manager</h2>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-md bg-green-900/50 border border-green-500 text-green-300 mb-6">
      <?= e($_SESSION['success']) ?>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <!-- Hero Section -->
  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
    <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-4">Hero Section</h3>
    <form method="POST" action="<?= e(baseUrl('/admin/landing/hero/update')) ?>" class="space-y-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block text-sm text-gray-400 mb-1">Eyebrow Text</label><input type="text" name="eyebrowText" value="<?= e($hero['eyebrowText']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div><label class="block text-sm text-gray-400 mb-1">Headline</label><input type="text" name="headline" value="<?= e($hero['headline']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div class="md:col-span-2"><label class="block text-sm text-gray-400 mb-1">Subheadline</label><textarea name="subheadline" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"><?= e($hero['subheadline']) ?></textarea></div>
        <div><label class="block text-sm text-gray-400 mb-1">Search Placeholder</label><input type="text" name="searchPlaceholder" value="<?= e($hero['searchPlaceholder']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
        <div><label class="block text-sm text-gray-400 mb-1">CTA Button Text</label><input type="text" name="ctaButtonText" value="<?= e($hero['ctaButtonText']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></div>
      </div>
      <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-md transition-colors">Save Hero</button>
    </form>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Features -->
    <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-4">Features</h3>
      <div class="space-y-4 mb-6">
        <?php foreach ($features as $f): ?>
          <div class="bg-[#242424] p-4 rounded-md border border-gray-700 relative group" id="feature-container-<?= $f['id'] ?>">
            <!-- View Mode -->
            <div id="view-feature-<?= $f['id'] ?>" class="flex justify-between items-start gap-4">
              <div>
                <div class="font-bold text-white mb-1"><?= e($f['title']) ?></div>
                <div class="text-gray-400 text-sm leading-relaxed"><?= e($f['description']) ?></div>
                <div class="text-xs text-gray-500 mt-1">Icon: <code class="bg-[#1A1A1A] px-1 rounded text-white"><?= e($f['iconName']) ?></code></div>
              </div>
              <div class="flex gap-2">
                <button onclick="toggleEdit('feature', <?= $f['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Feature">
                  <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                </button>
                <form method="POST" action="<?= e(baseUrl('/admin/landing/feature/delete')) ?>" onsubmit="return confirm('Delete?');" class="inline">
                  <input type="hidden" name="id" value="<?= $f['id'] ?>">
                  <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Feature">
                    <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                  </button>
                </form>
              </div>
            </div>

            <!-- Edit Mode -->
            <form method="POST" action="<?= e(baseUrl('/admin/landing/feature/update')) ?>" id="edit-feature-<?= $f['id'] ?>" class="hidden space-y-3">
              <input type="hidden" name="id" value="<?= $f['id'] ?>">
              <div>
                <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Title</label>
                <input type="text" name="title" value="<?= e($f['title']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Icon Name</label>
                <input type="text" name="iconName" value="<?= e($f['iconName']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Description</label>
                <textarea name="description" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm h-20 focus:outline-none focus:border-[#00CED1]"><?= e($f['description']) ?></textarea>
              </div>
              <div class="flex gap-2 justify-end pt-1">
                <button type="button" onclick="toggleEdit('feature', <?= $f['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">Cancel</button>
                <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-3 py-1 rounded text-xs">Save</button>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
      
      <form method="POST" action="<?= e(baseUrl('/admin/landing/feature/create')) ?>" class="space-y-3 border-t border-gray-700 pt-4">
        <input type="text" name="title" placeholder="Title" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <input type="text" name="iconName" placeholder="Icon Name" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <textarea name="description" placeholder="Description" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></textarea>
        <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-md w-full">Add Feature</button>
      </form>
    </div>

    <!-- How It Works -->
    <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-4">How It Works Steps</h3>
      <div class="space-y-4 mb-6">
        <?php foreach ($howItWorks as $step): ?>
          <div class="bg-[#242424] p-4 rounded-md border border-gray-700 relative group" id="step-container-<?= $step['id'] ?>">
            <!-- View Mode -->
            <div id="view-step-<?= $step['id'] ?>" class="flex justify-between items-start gap-4">
              <div>
                <div class="font-bold text-white mb-1"><span class="text-[#00CED1] mr-2">#<?= e($step['stepNumber']) ?></span> <?= e($step['title']) ?></div>
                <div class="text-gray-400 text-sm leading-relaxed"><?= e($step['description']) ?></div>
              </div>
              <div class="flex gap-2">
                <button onclick="toggleEdit('step', <?= $step['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Step">
                  <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                </button>
                <form method="POST" action="<?= e(baseUrl('/admin/landing/step/delete')) ?>" onsubmit="return confirm('Delete?');" class="inline">
                  <input type="hidden" name="id" value="<?= $step['id'] ?>">
                  <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Step">
                    <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                  </button>
                </form>
              </div>
            </div>

            <!-- Edit Mode -->
            <form method="POST" action="<?= e(baseUrl('/admin/landing/step/update')) ?>" id="edit-step-<?= $step['id'] ?>" class="hidden space-y-3">
              <input type="hidden" name="id" value="<?= $step['id'] ?>">
              <div>
                <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Step Number</label>
                <input type="number" name="stepNumber" value="<?= e($step['stepNumber']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Title</label>
                <input type="text" name="title" value="<?= e($step['title']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Description</label>
                <textarea name="description" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm h-20 focus:outline-none focus:border-[#00CED1]"><?= e($step['description']) ?></textarea>
              </div>
              <div class="flex gap-2 justify-end pt-1">
                <button type="button" onclick="toggleEdit('step', <?= $step['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">Cancel</button>
                <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-3 py-1 rounded text-xs">Save</button>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
      
      <form method="POST" action="<?= e(baseUrl('/admin/landing/step/create')) ?>" class="space-y-3 border-t border-gray-700 pt-4">
        <input type="number" name="stepNumber" placeholder="Step Number (e.g. 1)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <input type="text" name="title" placeholder="Title" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <textarea name="description" placeholder="Description" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></textarea>
        <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-md w-full">Add Step</button>
      </form>
    </div>
  </div>

  <!-- Deployment Options -->
  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
    <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-4">Deployment Options</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <?php foreach ($deploymentOptions as $opt): ?>
        <div class="bg-[#242424] p-4 rounded-md border border-gray-700 relative group" id="option-container-<?= $opt['id'] ?>">
          <!-- View Mode -->
          <div id="view-option-<?= $opt['id'] ?>" class="flex justify-between items-start gap-4">
            <div>
              <div class="font-bold text-white mb-1"><?= e($opt['name']) ?></div>
              <?php if ($opt['subtitle']): ?>
                <div class="text-xs text-[#00CED1] font-semibold mb-1"><?= e($opt['subtitle']) ?></div>
              <?php endif; ?>
              <div class="text-gray-400 text-sm mb-2 leading-relaxed"><?= e($opt['description']) ?></div>
              <div class="text-xs text-gray-500 font-mono bg-[#1A1A1A] p-2 rounded border border-gray-800">Bullets: <?= e($opt['bulletPoints']) ?></div>
              <?php if ($opt['imageUrl']): ?>
                <div class="text-[10px] text-gray-500 mt-2 flex flex-col gap-2">
                  <div>Image: <code class="bg-[#1A1A1A] px-1 rounded text-white"><?= e($opt['imageUrl']) ?></code></div>
                  <img src="<?= e(baseUrl($opt['imageUrl'])) ?>" alt="Preview" class="w-24 h-16 object-contain rounded border border-gray-700 bg-black/20 p-1" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
                  <span class="text-xs text-red-400 hidden">Error loading image</span>
                </div>
              <?php endif; ?>
            </div>
            <div class="flex gap-2 shrink-0">
              <button onclick="toggleEdit('option', <?= $opt['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Option">
                <?= lucide_icon('Edit2', 'w-4 h-4') ?>
              </button>
              <form method="POST" action="<?= e(baseUrl('/admin/landing/option/delete')) ?>" onsubmit="return confirm('Delete?');" class="inline">
                <input type="hidden" name="id" value="<?= $opt['id'] ?>">
                <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Option">
                  <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                </button>
              </form>
            </div>
          </div>

          <!-- Edit Mode -->
          <form method="POST" action="<?= e(baseUrl('/admin/landing/option/update')) ?>" id="edit-option-<?= $opt['id'] ?>" class="hidden space-y-3 w-full">
            <input type="hidden" name="id" value="<?= $opt['id'] ?>">
            <div>
              <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Name</label>
              <input type="text" name="name" value="<?= e($opt['name']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
            </div>
            <div>
              <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Subtitle</label>
              <input type="text" name="subtitle" value="<?= e($opt['subtitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
            </div>
            <div>
              <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Description</label>
              <textarea name="description" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm h-20 focus:outline-none focus:border-[#00CED1]"><?= e($opt['description']) ?></textarea>
            </div>
            <div>
              <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Bullet Points (JSON Array)</label>
              <textarea name="bulletPoints" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white font-mono text-xs h-16 focus:outline-none focus:border-[#00CED1]"><?= e($opt['bulletPoints']) ?></textarea>
            </div>
            <div>
              <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Image URL</label>
              <input type="text" name="imageUrl" id="edit-option-img-val-<?= $opt['id'] ?>" value="<?= e($opt['imageUrl']) ?>" oninput="updateLivePreview(<?= $opt['id'] ?>, this.value)" class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
              <div class="mt-2">
                <img id="edit-option-preview-<?= $opt['id'] ?>" src="<?= e(baseUrl($opt['imageUrl'])) ?>" alt="Preview" class="w-24 h-16 object-contain rounded border border-gray-700 bg-black/20 p-1" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" onload="this.style.display='block'; this.nextElementSibling.style.display='none';" />
                <span class="text-xs text-gray-500 hidden italic">No image / invalid URL</span>
              </div>
            </div>
            <div class="flex gap-2 justify-end pt-1">
              <button type="button" onclick="toggleEdit('option', <?= $opt['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">Cancel</button>
              <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-3 py-1 rounded text-xs">Save</button>
            </div>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
    
    <form method="POST" action="<?= e(baseUrl('/admin/landing/option/create')) ?>" class="space-y-3 border-t border-gray-700 pt-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <input type="text" name="name" placeholder="Name" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <input type="text" name="subtitle" placeholder="Subtitle (Optional)" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <textarea name="description" placeholder="Description" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></textarea>
        <textarea name="bulletPoints" placeholder='Bullet Points (JSON Array, e.g. ["Item 1", "Item 2"])' required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white font-mono focus:outline-none focus:border-[#00CED1]"></textarea>
        <div class="md:col-span-2">
          <input type="text" name="imageUrl" id="create-option-img-val" placeholder="Image URL (e.g. /assets/images/1.png)" oninput="updateCreatePreview(this.value)" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
          <div class="mt-2">
            <img id="create-option-preview" src="" alt="Preview" class="w-24 h-16 object-contain rounded border border-gray-700 bg-black/20 p-1 hidden" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" onload="this.style.display='block'; this.nextElementSibling.style.display='none';" />
            <span class="text-xs text-gray-500 hidden italic">No preview available</span>
          </div>
        </div>
      </div>
      <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-6 rounded-md transition-colors mt-2 w-full md:w-auto">Add Deployment Option</button>
    </form>
  </div>
</div>

<script>
const BASE_URL = <?= json_encode(baseUrl()) ?>;

function updateLivePreview(id, value) {
  const img = document.getElementById(`edit-option-preview-${id}`);
  const errSpan = img ? img.nextElementSibling : null;
  if (img) {
    if (!value.trim()) {
      img.style.display = 'none';
      if (errSpan) {
        errSpan.textContent = 'No image / invalid URL';
        errSpan.classList.remove('hidden');
      }
      return;
    }
    const resolvedUrl = value.startsWith('http') || value.startsWith('//') ? value : (BASE_URL.replace(/\/$/, '') + '/' + value.replace(/^\//, ''));
    img.src = resolvedUrl;
    img.style.display = 'block';
    if (errSpan) errSpan.classList.add('hidden');
  }
}

function updateCreatePreview(value) {
  const img = document.getElementById('create-option-preview');
  const errSpan = img ? img.nextElementSibling : null;
  if (img) {
    if (!value.trim()) {
      img.style.display = 'none';
      if (errSpan) errSpan.classList.add('hidden');
      return;
    }
    const resolvedUrl = value.startsWith('http') || value.startsWith('//') ? value : (BASE_URL.replace(/\/$/, '') + '/' + value.replace(/^\//, ''));
    img.src = resolvedUrl;
    img.style.display = 'block';
    if (errSpan) errSpan.classList.add('hidden');
  }
}

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
