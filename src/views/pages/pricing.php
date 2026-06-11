<div class="relative font-sans pt-28 md:pt-48 pb-0">
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(61,140,124,0.15)_0%,transparent_60%)] pointer-events-none"></div>

  <div class="container relative z-10 mx-auto px-6 max-w-[1550px]">
    <div class="text-center mb-16">
      <h1 class="text-3xl sm:text-4xl md:text-[5rem] text-white mb-8 tracking-tight">
        Pricing Plans
      </h1>
      <div>
        <button id="btn-cloud" class="w-1/2 bg-accent text-white px-6 py-2.5 rounded-full font-bold text-lg transition-all duration-300">
          Cloud
        </button>
        <button id="btn-onprem" class="w-1/2 text-gray-400 hover:text-white px-6 py-2.5 rounded-full font-bold text-lg transition-all duration-300">
          On-Premises
        </button>
      </div>
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
        <div class="pricing-card bg-[#1b222b] rounded-[1.5rem] p-6 sm:p-8 lg:p-14 flex flex-col relative <?= $isHighlighted ? 'border-2 border-accent shadow-[0_0_25px_rgba(0,206,209,0.15)]' : 'border border-white/5' ?>">
          <?php if ($isHighlighted): ?>
            <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-accent text-black text-sm uppercase font-extrabold tracking-widest px-4 py-1.5 rounded-full shadow-lg">Popular</span>
          <?php endif; ?>

          <div class="flex justify-between items-start mb-6">
            <h3 class="text-2xl text-white font-semibold"><?= e($tier['displayTitle']) ?></h3>
            <div class="text-right">
              <div class="text-white text-sm font-semibold">Ideal for</div>
              <div class="text-gray-400 text-[0.75rem] leading-tight whitespace-pre-line text-right"><?= e($tier['idealForText']) ?></div>
            </div>
          </div>

          <h2 class="text-3xl sm:text-1xl lg:text-[1.5rem] text-white font-bold leading-none mb-10">
            <?= e($tier['price']) ?>
          </h2>
          
          <div class="text-white font-medium text-[1.2rem] mb-6 min-h-[1.5rem]">
            <?php if ($tier['featuresSubtitle']): ?>
              <span><?= e($tier['featuresSubtitle']) ?></span>
            <?php else: ?>
              <span>&nbsp;</span>
            <?php endif; ?>
          </div>

          <ul class="space-y-3 mb-10 flex-1">
            <?php foreach ($tier['features'] as $f): ?>
              <li class="flex items-start gap-3 text-gray-300 text-[1.15rem]">
                <span class="text-accent font-bold">✓</span>
                <span><?= e($f['name']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <button class="w-full py-4 rounded-xl border border-accent bg-[#1b222b] text-white font-semibold text-2xl lg:text-4xl bg-accent-glow-hover transition-colors">
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
        <div class="pricing-card bg-[#1b222b] rounded-[1.5rem] p-6 sm:p-8 lg:p-14 flex flex-col relative <?= $isHighlighted ? 'border-2 border-accent shadow-[0_0_25px_rgba(0,206,209,0.15)]' : 'border border-white/5' ?>">
          <?php if ($isHighlighted): ?>
            <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-accent text-black text-sm uppercase font-extrabold tracking-widest px-4 py-1.5 rounded-full shadow-lg">Recommended</span>
          <?php endif; ?>

          <div class="flex justify-between items-start mb-6">
            <h3 class="text-2xl text-white font-semibold"><?= e($tier['displayTitle']) ?></h3>
            <div class="text-right">
              <div class="text-white text-sm font-semibold">Ideal for</div>
              <div class="text-gray-400 text-[0.75rem] leading-tight whitespace-pre-line text-right"><?= e($tier['idealForText']) ?></div>
            </div>
          </div>

          <h2 class="text-3xl sm:text-1xl lg:text-[1.5rem] text-white font-bold leading-none mb-10">
            <?= e($tier['price']) ?>
          </h2>
          
          <div class="text-white font-medium text-[1.2rem] mb-6 min-h-[1.5rem]">
            <?php if ($tier['featuresSubtitle']): ?>
              <span><?= e($tier['featuresSubtitle']) ?></span>
            <?php else: ?>
              <span>&nbsp;</span>
            <?php endif; ?>
          </div>

          <ul class="space-y-3 mb-10 flex-1">
            <?php foreach ($tier['features'] as $f): ?>
              <li class="flex items-start gap-3 text-gray-300 text-[1.15rem]">
                <span class="text-accent font-bold">✓</span>
                <span><?= e($f['name']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <button class="w-full py-4 rounded-xl border border-accent bg-[#1b222b] text-white font-semibold text-2xl lg:text-4xl bg-accent-glow-hover transition-colors">
            <?= e($tier['ctaText']) ?>
          </button>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Add-ons & Customizations -->
    <div class="mb-32 max-w-[1250px] mx-auto">
      <h1 class="text-center text-3xl sm:text-4xl md:text-[5rem] text-white mb-14 tracking-tight">Add-ons & Customizations</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
        <?php foreach ($addons as $addon): ?>
          <div style="border-color: rgba(var(--accent-rgb), 0.4);" onmouseover="this.style.borderColor='var(--accent-color)';" onmouseout="this.style.borderColor='rgba(var(--accent-rgb), 0.4)';" class="bg-[#12222c] rounded-2xl p-6 md:p-10 lg:p-14 border transition-all duration-300 flex flex-col items-center text-center justify-center min-h-[220px]">
            <h3 class="text-white text-3xl md:text-[3rem] font-semibold mb-4 tracking-tight leading-tight"><?= e($addon['name']) ?></h3>
            <p class="text-white/80 text-xl md:text-[1.5rem] leading-snug whitespace-pre-line max-w-[90%]"><?= e($addon['description']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Deployment Options Explained -->
    <div class="max-w-[1200px] mx-auto pb-16">
      <h3 class="text-center text-3xl sm:text-4xl md:text-[5rem] text-white mb-18 tracking-tight">Deployment Options Explained</h3>
      
      <div class="flex flex-col gap-14">
        <?php foreach ($deploymentOptions as $opt): ?>
          <div class="flex flex-col md:flex-row gap-8 md:gap-16 items-center">
             <div class="w-32 md:w-64 lg:w-[380px] shrink-0 mx-auto md:mx-0">
               <?php if ($opt['imageUrl']): ?>
                 <img src="<?= e(baseUrl($opt['imageUrl'])) ?>" alt="<?= e($opt['name']) ?>" width="500" height="500" class="w-full h-auto object-contain" />
               <?php endif; ?>
             </div>
             <div class="flex flex-col gap-3 text-center md:text-left">
                <h4 class="text-white text-3xl md:text-[3rem] leading-tight font-bold">
                 <?= e($opt['name']) ?>
                 <?php if ($opt['subtitle']): ?>
                    <br/><span class="text-xl md:text-[1.8rem] font-medium">(<?= e($opt['subtitle']) ?>)</span>
                 <?php endif; ?>
               </h4>
               <p class="text-[#a1a1aa] text-[1.3rem] leading-relaxed max-w-4xl"><?= e($opt['description']) ?></p>
             </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="h-[1px] w-full bg-white mt-20"></div>
    </div>
  </div>
  
  <div class="h-48 bg-gradient-to-b from-transparent to-[#111111] relative z-10 w-full pointer-events-none"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const btnCloud = document.getElementById('btn-cloud');
  const btnOnprem = document.getElementById('btn-onprem');
  const cloudContainer = document.getElementById('cloud-pricing-container');
  const onpremContainer = document.getElementById('onprem-pricing-container');

  btnCloud.addEventListener('click', function() {
    // Buttons styling
    btnCloud.className = "w-1/2 bg-accent text-white px-6 py-2.5 rounded-full font-bold text-lg transition-all duration-300";
    btnOnprem.className = "w-1/2 text-gray-400 hover:text-white px-6 py-2.5 rounded-full font-bold text-lg transition-all duration-300";
    
    // Containers toggle
    cloudContainer.classList.remove('hidden');
    onpremContainer.classList.add('hidden');
  });

  btnOnprem.addEventListener('click', function() {
    // Buttons styling
    btnOnprem.className = "w-1/2 bg-accent text-white px-6 py-2.5 rounded-full font-bold text-lg transition-all duration-300";
    btnCloud.className = "w-1/2 text-gray-400 hover:text-white px-6 py-2.5 rounded-full font-bold text-lg transition-all duration-300";
    
    // Containers toggle
    onpremContainer.classList.remove('hidden');
    cloudContainer.classList.add('hidden');
  });
});
</script>
