<div class="space-y-8 pb-10">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-white">Pricing Manager</h2>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-md bg-green-900/50 border border-green-500 text-green-300 mb-6">
      <?= e($_SESSION['success']) ?>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <!-- Subscription Tiers -->
  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
    <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-6">Subscription Tiers</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
      <?php foreach ($tiers as $tier): ?>
        <div class="bg-[#242424] p-5 rounded-lg border border-gray-700 flex flex-col justify-between" id="tier-container-<?= $tier['id'] ?>">
          <!-- View Mode -->
          <div id="view-tier-<?= $tier['id'] ?>" class="space-y-4 h-full flex flex-col justify-between">
            <div class="space-y-2">
              <div class="flex justify-between items-start">
                <h4 class="font-bold text-white text-xl"><?= e($tier['displayTitle']) ?></h4>
                <div class="flex gap-2">
                  <button onclick="toggleEdit('tier', <?= $tier['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Plan">
                    <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                  </button>
                  <form method="POST" action="<?= e(baseUrl('/admin/pricing/tier/delete')) ?>" onsubmit="return confirm('Delete this tier and all its features?');" class="inline">
                    <input type="hidden" name="id" value="<?= $tier['id'] ?>">
                    <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Plan">
                      <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                    </button>
                  </form>
                </div>
              </div>
              <div class="text-2xl font-semibold text-white tracking-tight"><?= e($tier['name']) ?></div>
              <div class="text-gray-400 text-xs">Monthly: $<?= e($tier['monthlyPrice']) ?> | Annual: $<?= e($tier['annualPrice']) ?></div>
              <?php if ($tier['idealForText']): ?>
                <div class="text-xs text-gray-500 italic mt-1">Ideal for: <?= e($tier['idealForText']) ?></div>
              <?php endif; ?>
            </div>

            <!-- Features for this tier -->
            <div class="bg-[#1A1A1A] p-3 rounded-lg border border-gray-800 mt-4 space-y-2">
              <div class="text-xs text-[#00CED1] uppercase font-bold tracking-wider mb-2">Included Features</div>
              <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                <?php foreach ($tier['features'] as $f): ?>
                  <div class="flex justify-between items-center text-sm text-gray-300 border-b border-gray-800/50 pb-1" id="feature-row-<?= $f['id'] ?>">
                    <!-- View Feature -->
                    <div id="view-feature-<?= $f['id'] ?>" class="flex justify-between items-center w-full">
                      <span class="truncate pr-2"><?= e($f['name']) ?></span>
                      <div class="flex gap-1 shrink-0">
                        <button onclick="toggleEdit('feature', <?= $f['id'] ?>, true)" class="text-gray-400 hover:text-white p-0.5">
                          <?= lucide_icon('Edit2', 'w-3 h-3') ?>
                        </button>
                        <form method="POST" action="<?= e(baseUrl('/admin/pricing/feature/delete')) ?>" class="inline">
                          <input type="hidden" name="id" value="<?= $f['id'] ?>">
                          <button type="submit" class="text-red-400 hover:text-red-300 p-0.5"><?= lucide_icon('X', 'w-3 h-3') ?></button>
                        </form>
                      </div>
                    </div>
                    
                    <!-- Edit Feature Form -->
                    <form method="POST" action="<?= e(baseUrl('/admin/pricing/feature/update')) ?>" id="edit-feature-<?= $f['id'] ?>" class="hidden flex gap-2 w-full">
                      <input type="hidden" name="id" value="<?= $f['id'] ?>">
                      <input type="text" name="name" value="<?= e($f['name']) ?>" required class="flex-1 bg-[#242424] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
                      <button type="button" onclick="toggleEdit('feature', <?= $f['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-1.5 py-0.5 rounded text-[10px]">X</button>
                      <button type="submit" class="bg-[#00CED1] text-black hover:bg-[#00a3a6] px-1.5 py-0.5 rounded text-[10px] font-bold">✓</button>
                    </form>
                  </div>
                <?php endforeach; ?>
              </div>
              
              <form method="POST" action="<?= e(baseUrl('/admin/pricing/feature/create')) ?>" class="flex gap-2 pt-2 border-t border-gray-800 mt-2">
                <input type="hidden" name="pricingTierId" value="<?= $tier['id'] ?>">
                <input type="text" name="name" placeholder="Add feature..." required class="flex-1 bg-[#242424] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
                <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-2 py-1 rounded text-xs">+</button>
              </form>
            </div>
          </div>

          <!-- Edit Mode -->
          <form method="POST" action="<?= e(baseUrl('/admin/pricing/tier/update')) ?>" id="edit-tier-<?= $tier['id'] ?>" class="hidden space-y-3">
            <input type="hidden" name="id" value="<?= $tier['id'] ?>">
            <h4 class="text-white font-bold border-b border-gray-700 pb-1 mb-2 text-sm">Edit Plan Details</h4>
            
            <div class="grid grid-cols-2 gap-2 text-xs">
              <div>
                <label class="text-gray-400 block mb-0.5">Plan Name</label>
                <input type="text" name="name" value="<?= e($tier['name']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-gray-400 block mb-0.5">Display Title</label>
                <input type="text" name="displayTitle" value="<?= e($tier['displayTitle']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-gray-400 block mb-0.5">Monthly Price</label>
                <input type="number" step="0.01" name="monthlyPrice" value="<?= e($tier['monthlyPrice']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-gray-400 block mb-0.5">Annual Price</label>
                <input type="number" step="0.01" name="annualPrice" value="<?= e($tier['annualPrice']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
              <div class="col-span-2">
                <label class="text-gray-400 block mb-0.5">Ideal For Text</label>
                <textarea name="idealForText" class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs h-12 focus:outline-none focus:border-[#00CED1]"><?= e($tier['idealForText']) ?></textarea>
              </div>
              <div class="col-span-2">
                <label class="text-gray-400 block mb-0.5">Features Subtitle</label>
                <input type="text" name="featuresSubtitle" value="<?= e($tier['featuresSubtitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
              <div class="col-span-2">
                <label class="text-gray-400 block mb-0.5">Deployment Options (JSON Array)</label>
                <textarea name="deploymentOptions" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white font-mono text-[10px] h-12 focus:outline-none focus:border-[#00CED1]"><?= e($tier['deploymentOptions']) ?></textarea>
              </div>
              <div class="col-span-2">
                <label class="text-gray-400 block mb-0.5">CTA Text</label>
                <input type="text" name="ctaText" value="<?= e($tier['ctaText']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
            </div>
            
            <div class="flex gap-2 justify-end pt-2">
              <button type="button" onclick="toggleEdit('tier', <?= $tier['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">Cancel</button>
              <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-3 py-1 rounded text-xs">Save</button>
            </div>
          </form>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Create Tier Form -->
    <form method="POST" action="<?= e(baseUrl('/admin/pricing/tier/create')) ?>" class="space-y-3 pt-6 border-t border-gray-800">
      <h4 class="text-white font-bold mb-2">Add New Plan Tier</h4>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="text" name="displayTitle" placeholder="Display Title (e.g. Enterprise)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
        <input type="text" name="name" placeholder="Pricing Display (e.g. $99/mo)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
        <input type="number" step="0.01" name="monthlyPrice" placeholder="Monthly Price ($)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
        <input type="number" step="0.01" name="annualPrice" placeholder="Annual Price ($)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
        
        <textarea name="idealForText" placeholder="Ideal For Text (Subtext explaining target audience)" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm md:col-span-2 h-16 focus:outline-none focus:border-[#00CED1]"></textarea>
        <textarea name="deploymentOptions" placeholder='Deployment Options JSON array, e.g. ["On-Premise\nSelf-hosted server"]' required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white font-mono text-xs md:col-span-2 h-16 focus:outline-none focus:border-[#00CED1]"></textarea>
        
        <input type="text" name="featuresSubtitle" placeholder="Features Section Subtitle" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm md:col-span-2 focus:outline-none focus:border-[#00CED1]">
        <input type="text" name="ctaText" placeholder="CTA Button Text (e.g. Contact Sales)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm md:col-span-2 focus:outline-none focus:border-[#00CED1]">
      </div>
      <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-6 rounded-md transition-colors mt-2">Add Subscription Plan</button>
    </form>
  </div>

  <!-- Optional Add-ons & Customizations -->
  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
    <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-6">Optional Add-ons & Customizations</h3>
    
    <!-- 4-Column Responsive Grid Layout -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
      <?php foreach ($addons as $addon): ?>
        <div class="bg-[#242424] p-5 rounded-lg border border-gray-700 flex flex-col justify-between relative group min-h-[160px]" id="addon-container-<?= $addon['id'] ?>">
          <!-- View Mode -->
          <div id="view-addon-<?= $addon['id'] ?>" class="flex flex-col h-full justify-between space-y-4">
            <div>
              <div class="flex justify-between items-start mb-2 gap-2">
                <h4 class="font-bold text-white text-lg leading-snug"><?= e($addon['name']) ?></h4>
                <span class="text-[#00CED1] text-sm font-semibold shrink-0">+$<?= e($addon['price']) ?></span>
              </div>
              <p class="text-gray-400 text-xs leading-relaxed whitespace-pre-line line-clamp-4"><?= e($addon['description']) ?></p>
            </div>
            
            <div class="flex gap-2 absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity bg-[#242424] p-1 rounded border border-gray-700 shadow-lg">
              <button onclick="toggleEdit('addon', <?= $addon['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Addon">
                <?= lucide_icon('Edit2', 'w-4 h-4') ?>
              </button>
              <form method="POST" action="<?= e(baseUrl('/admin/pricing/addon/delete')) ?>" onsubmit="return confirm('Delete?');" class="inline">
                <input type="hidden" name="id" value="<?= $addon['id'] ?>">
                <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Addon">
                  <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                </button>
              </form>
            </div>
          </div>

          <!-- Edit Mode -->
          <form method="POST" action="<?= e(baseUrl('/admin/pricing/addon/update')) ?>" id="edit-addon-<?= $addon['id'] ?>" class="hidden space-y-3 h-full flex flex-col justify-between">
            <input type="hidden" name="id" value="<?= $addon['id'] ?>">
            <div class="space-y-2">
              <div>
                <label class="text-[10px] text-gray-400 uppercase tracking-wider block mb-0.5">Add-on Name</label>
                <input type="text" name="name" value="<?= e($addon['name']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-[10px] text-gray-400 uppercase tracking-wider block mb-0.5">Price ($)</label>
                <input type="number" step="0.01" name="price" value="<?= e($addon['price']) ?>" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs focus:outline-none focus:border-[#00CED1]">
              </div>
              <div>
                <label class="text-[10px] text-gray-400 uppercase tracking-wider block mb-0.5">Description</label>
                <textarea name="description" required class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-1 text-white text-xs h-16 focus:outline-none focus:border-[#00CED1]"><?= e($addon['description']) ?></textarea>
              </div>
            </div>
            <div class="flex gap-2 justify-end pt-2 border-t border-gray-800">
              <button type="button" onclick="toggleEdit('addon', <?= $addon['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-2.5 py-1 rounded text-xs">Cancel</button>
              <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-2.5 py-1 rounded text-xs">Save</button>
            </div>
          </form>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Create Add-on Form -->
    <form method="POST" action="<?= e(baseUrl('/admin/pricing/addon/create')) ?>" class="space-y-3 pt-6 border-t border-gray-800">
      <h4 class="text-white font-bold mb-2">Add New Optional Add-on</h4>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
          <input type="text" name="name" placeholder="Add-on Name (e.g. Priority Support)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
        </div>
        <div>
          <input type="number" step="0.01" name="price" placeholder="Price ($)" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
        </div>
        <div class="md:col-span-3">
          <textarea name="description" placeholder="Description of what this add-on provides..." required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white text-sm h-20 focus:outline-none focus:border-[#00CED1]"></textarea>
        </div>
      </div>
      <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-md transition-colors mt-2">Add Optional Add-on</button>
    </form>
  </div>
  </div>

  <!-- Deployment Options -->
  <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6">
    <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2 mb-4">Deployment Options Explained</h3>
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
              <?php if ($opt['imageUrl']): ?>
                <div class="text-[10px] text-gray-500 mt-2">Image: <code class="bg-[#1A1A1A] px-1 rounded text-white"><?= e($opt['imageUrl']) ?></code></div>
              <?php endif; ?>
            </div>
            <div class="flex gap-2 shrink-0">
              <button onclick="toggleEdit('option', <?= $opt['id'] ?>, true)" class="text-gray-400 hover:text-white p-1 transition-colors" title="Edit Option">
                <?= lucide_icon('Edit2', 'w-4 h-4') ?>
              </button>
              <form method="POST" action="<?= e(baseUrl('/admin/pricing/option/delete')) ?>" onsubmit="return confirm('Delete?');" class="inline">
                <input type="hidden" name="id" value="<?= $opt['id'] ?>">
                <button type="submit" class="text-red-400 hover:text-red-300 p-1 transition-colors" title="Delete Option">
                  <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                </button>
              </form>
            </div>
          </div>

          <!-- Edit Mode -->
          <form method="POST" action="<?= e(baseUrl('/admin/pricing/option/update')) ?>" id="edit-option-<?= $opt['id'] ?>" class="hidden space-y-3 w-full">
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
              <label class="text-xs text-gray-400 font-semibold uppercase block mb-1">Image URL</label>
              <input type="text" name="imageUrl" value="<?= e($opt['imageUrl']) ?>" class="w-full bg-[#1A1A1A] border border-gray-700 rounded p-2 text-white text-sm focus:outline-none focus:border-[#00CED1]">
            </div>
            <div class="flex gap-2 justify-end pt-1">
              <button type="button" onclick="toggleEdit('option', <?= $opt['id'] ?>, false)" class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-xs">Cancel</button>
              <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold px-3 py-1 rounded text-xs">Save</button>
            </div>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
    
    <form method="POST" action="<?= e(baseUrl('/admin/pricing/option/create')) ?>" class="space-y-3 border-t border-gray-700 pt-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <input type="text" name="name" placeholder="Name" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <input type="text" name="subtitle" placeholder="Subtitle (Optional)" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        <textarea name="description" placeholder="Description" required class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]"></textarea>
        <div class="md:col-span-2">
          <input type="text" name="imageUrl" placeholder="Image URL (e.g. /assets/images/1.png)" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white focus:outline-none focus:border-[#00CED1]">
        </div>
      </div>
      <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md w-full md:w-auto">Add Deployment Option</button>
    </form>
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
