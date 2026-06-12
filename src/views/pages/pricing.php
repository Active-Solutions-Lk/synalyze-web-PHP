<div class="relative font-sans pt-28 md:pt-48 pb-0">
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(61,140,124,0.15)_0%,transparent_60%)] pointer-events-none"></div>

  <div class="container relative z-10 mx-auto px-6 max-w-[1550px]">
    <div class="text-center mb-16">
      <h1 class="page-hero-title mb-8">
        Pricing Plans
      </h1>
      
      <button id="btn-cloud" class="w-1/2 bg-accent text-white px-4 py-2 rounded-full font-bold text-sm sm:text-base transition-all duration-300 cursor-pointer">
        Cloud
      </button>
      <button id="btn-onprem" class="w-1/2 text-gray-400 hover:text-white px-4 py-2 rounded-full font-bold text-sm sm:text-base transition-all duration-300 cursor-pointer">
        On-Premises
      </button>
      
    </div>

    <?php 
      $cloudCount = count($cloudTiers);
      $cloudGridClass = $cloudCount === 2 ? 'md:grid-cols-2 max-w-4xl' : ($cloudCount === 1 ? 'md:grid-cols-1 max-w-md' : 'md:grid-cols-3 max-w-full');
    ?>
    <!-- Cloud Pricing Cards Grid -->
    <div id="cloud-pricing-container" class="grid grid-cols-1 <?= $cloudGridClass ?> gap-6 lg:gap-8 mb-32 mx-auto transition-opacity duration-300">
      <?php foreach ($cloudTiers as $tier): 
        $isHighlighted = $tier['highlighted'] ?? 0;
      ?>
        <div class="pricing-card bg-[#111d2a] rounded-2xl p-6 md:p-10 flex flex-col relative <?= $isHighlighted ? 'border border-accent shadow-[0_0_25px_rgba(var(--accent-rgb),0.15)]' : 'border border-white/[0.06]' ?>">
          <?php if ($isHighlighted): ?>
            <div class="mb-4">
              <span class="inline-block bg-accent text-black text-xs uppercase font-extrabold tracking-widest px-4 py-1.5 rounded-full shadow-lg">Recommended</span>
            </div>
          <?php endif; ?>

          <div class="flex flex-col mb-6 gap-2">
            <h3 class="card-title font-semibold"><?= e($tier['displayTitle']) ?></h3>
            <?php if (!empty($tier['idealForText'])): ?>
            <div class="text-left">
              <div class="text-white text-xs font-semibold"><?= e($tier['idealForTitle'] ?? 'Ideal for') ?></div>
              <div class="text-gray-400 text-[10px] sm:text-xs leading-tight whitespace-pre-line text-left"><?= e($tier['idealForText']) ?></div>
            </div>
            <?php endif; ?>
          </div>

          <h2 class="text-2xl md:text-3xl text-white font-bold leading-none mb-8">
            <?= e($tier['price']) ?>
          </h2>
          
          <ul class="space-y-3 mb-10 flex-1">
            <?php foreach ($tier['features'] as $f): ?>
              <li class="flex items-start gap-3 text-gray-300 text-sm md:text-base">
                <span class="text-accent font-bold">✓</span>
                <span><?= e($f['name']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <button class="w-full py-3 rounded-full border border-accent bg-accent text-black font-bold text-base md:text-lg transition-colors hover:opacity-90 cursor-pointer shadow-[0_0_15px_rgba(var(--accent-rgb),0.3)]">
            <?= e($tier['ctaText']) ?>
          </button>
        </div>
      <?php endforeach; ?>
    </div>

    <?php 
      $onPremCount = count($onPremTiers);
      $onPremGridClass = $onPremCount === 2 ? 'md:grid-cols-2 max-w-4xl' : ($onPremCount === 1 ? 'md:grid-cols-1 max-w-md' : 'md:grid-cols-3 max-w-full');
    ?>
    <!-- On-Premises Pricing Cards Grid -->
    <div id="onprem-pricing-container" class="hidden grid grid-cols-1 <?= $onPremGridClass ?> gap-6 lg:gap-8 mb-32 mx-auto transition-opacity duration-300">
      <?php foreach ($onPremTiers as $tier): 
        $isHighlighted = $tier['highlighted'] ?? 0;
      ?>
        <div class="pricing-card bg-[#111d2a] rounded-2xl p-6 md:p-10 flex flex-col relative <?= $isHighlighted ? 'border border-accent shadow-[0_0_25px_rgba(var(--accent-rgb),0.15)]' : 'border border-white/[0.06]' ?>">
          <?php if ($isHighlighted): ?>
            <div class="mb-4">
              <span class="inline-block bg-accent text-black text-xs uppercase font-extrabold tracking-widest px-4 py-1.5 rounded-full shadow-lg">Recommended</span>
            </div>
          <?php endif; ?>

          <div class="flex flex-col mb-6 gap-2">
            <h3 class="card-title font-semibold"><?= e($tier['displayTitle']) ?></h3>
            <?php if (!empty($tier['idealForText'])): ?>
            <div class="text-left">
              <div class="text-white text-xs font-semibold"><?= e($tier['idealForTitle'] ?? 'Ideal for') ?></div>
              <div class="text-gray-400 text-[10px] sm:text-xs leading-tight whitespace-pre-line text-left"><?= e($tier['idealForText']) ?></div>
            </div>
            <?php endif; ?>
          </div>

          <h2 class="text-2xl md:text-3xl text-white font-bold leading-none mb-8">
            <?= e($tier['price']) ?>
          </h2>
          
          <div class="text-white font-semibold text-base mb-4 min-h-[1.5rem]">
            <?php if ($tier['featuresSubtitle']): ?>
              <span><?= e($tier['featuresSubtitle']) ?></span>
            <?php else: ?>
              <span>&nbsp;</span>
            <?php endif; ?>
          </div>

          <ul class="space-y-3 mb-10 flex-1">
            <?php foreach ($tier['features'] as $f): ?>
              <li class="flex items-start gap-3 text-gray-300 text-sm md:text-base">
                <span class="text-accent font-bold">✓</span>
                <span><?= e($f['name']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <button class="w-full py-3 rounded-full border border-accent bg-accent text-black font-bold text-base md:text-lg transition-colors hover:opacity-90 cursor-pointer shadow-[0_0_15px_rgba(var(--accent-rgb),0.3)]">
            <?= e($tier['ctaText']) ?>
          </button>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Add-ons & Customizations -->
    <div class="mb-32 max-w-[1250px] mx-auto">
      <h2 class="text-center section-title mb-14">Add-ons & Customizations</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
        <?php foreach ($addons as $addon): ?>
          <div class="pro-card transition-all duration-300 flex flex-col items-center text-center justify-center min-h-[200px]">
            <h3 class="card-title font-semibold mb-3 tracking-tight leading-tight"><?= e($addon['name']) ?></h3>
            <p class="text-gray-300 text-sm md:text-base leading-relaxed whitespace-pre-line max-w-[95%]"><?= e($addon['description']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Deployment Options Explained -->
    <div class="max-w-[1200px] mx-auto pb-16">
      <h2 class="text-center section-title mb-16">Deployment Options Explained</h2>
      
      <div class="flex flex-col gap-14">
        <?php foreach ($deploymentOptions as $opt): ?>
          <div class="flex flex-col md:flex-row gap-8 md:gap-16 items-center">
             <div class="w-32 md:w-64 lg:w-[380px] shrink-0 mx-auto md:mx-0">
               <?php if ($opt['imageUrl']): ?>
                 <img src="<?= e(baseUrl($opt['imageUrl'])) ?>" alt="<?= e($opt['name']) ?>" width="500" height="500" class="w-full h-auto object-contain" />
               <?php endif; ?>
             </div>
             <div class="flex flex-col gap-3 text-center md:text-left">
                <h3 class="text-white text-xl md:text-2xl leading-tight font-bold">
                 <?= e($opt['name']) ?>
                 <?php if ($opt['subtitle']): ?>
                    <span class="text-gray-400 text-sm md:text-base font-medium block mt-1">(<?= e($opt['subtitle']) ?>)</span>
                 <?php endif; ?>
               </h3>
               <p class="text-gray-300 text-sm md:text-base leading-relaxed max-w-4xl"><?= e($opt['description']) ?></p>
             </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="h-[1px] w-full bg-white mt-20"></div>
    </div>
  </div>
  
  <div class="h-48 bg-gradient-to-b from-transparent to-[#16171B] relative z-10 w-full pointer-events-none"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const btnCloud = document.getElementById('btn-cloud');
  const btnOnprem = document.getElementById('btn-onprem');
  const cloudContainer = document.getElementById('cloud-pricing-container');
  const onpremContainer = document.getElementById('onprem-pricing-container');

  btnCloud.addEventListener('click', function() {
    // Buttons styling
    btnCloud.className = "w-1/2 bg-accent text-white px-4 py-2 rounded-full font-bold text-sm sm:text-base transition-all duration-300 cursor-pointer";
    btnOnprem.className = "w-1/2 text-gray-400 hover:text-white px-4 py-2 rounded-full font-bold text-sm sm:text-base transition-all duration-300 cursor-pointer";
    
    // Containers toggle
    cloudContainer.classList.remove('hidden');
    onpremContainer.classList.add('hidden');
  });

  btnOnprem.addEventListener('click', function() {
    // Buttons styling
    btnOnprem.className = "w-1/2 bg-accent text-white px-4 py-2 rounded-full font-bold text-sm sm:text-base transition-all duration-300 cursor-pointer";
    btnCloud.className = "w-1/2 text-gray-400 hover:text-white px-4 py-2 rounded-full font-bold text-sm sm:text-base transition-all duration-300 cursor-pointer";
    
    // Containers toggle
    onpremContainer.classList.remove('hidden');
    cloudContainer.classList.add('hidden');
  });
});
</script>
