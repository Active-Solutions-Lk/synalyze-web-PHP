<div class="relative font-sans pt-28 md:pt-48 pb-0">
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(61,140,124,0.15)_0%,transparent_60%)] pointer-events-none"></div>

  <div class="container relative z-10 mx-auto px-6 max-w-[1550px]">
    <div class="text-center mb-16">
      <h1 class="text-3xl sm:text-4xl md:text-[5rem] text-white mb-8 tracking-tight">
        Pricing Plans
      </h1>
      <div class="flex items-center justify-center gap-3">
        <button id="btn-monthly" class="bg-[#3d8c7c] text-white px-6 py-2 rounded-full font-bold text-lg">Monthly</button>
        <button id="btn-annual" class="border border-white/20 text-white px-6 py-2 rounded-full font-bold text-lg hover:bg-white/5 transition-colors">Annually</button>
      </div>
    </div>

    <!-- Pricing Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mb-32 max-w-full mx-auto">
      <?php foreach ($tiers as $tier): 
        $deploymentOpts = json_decode($tier['deploymentOptions'], true) ?: [];
      ?>
        <div class="pricing-card bg-[#1b222b] rounded-[1.5rem] p-6 sm:p-8 lg:p-14 flex flex-col relative">
          <div class="flex justify-between items-start mb-6">
            <h3 class="text-2xl text-white"><?= e($tier['displayTitle']) ?></h3>
            <div class="text-right">
              <div class="text-white text-sm font-semibold">Ideal for</div>
              <div class="text-gray-400 text-[0.75rem] leading-tight whitespace-pre-line text-right"><?= e($tier['idealForText']) ?></div>
            </div>
          </div>

          <h2 class="text-4xl sm:text-5xl lg:text-[3.5rem] text-white leading-none mb-10">
            <?= e($tier['name']) ?>
          </h2>
          
          <div class="text-white font-medium text-[1.2rem] mb-6 min-h-[1.5rem]">
            <?php if ($tier['featuresSubtitle']): ?>
              <span><?= e($tier['featuresSubtitle']) ?></span>
            <?php else: ?>
              <span>&nbsp;</span>
            <?php endif; ?>
          </div>

          <ul class="space-y-3 mb-8 flex-1">
            <?php foreach ($tier['features'] as $f): ?>
              <li class="flex items-start gap-3 text-gray-300 text-[1.15rem]">
                <span class="text-white font-bold">✓</span>
                <span><?= e($f['name']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="mb-10 text-gray-300 text-[1.3rem] flex flex-col gap-1">
            <div class="flex items-start gap-2">
              <span class="font-bold text-white whitespace-nowrap">Deployment Options :</span>
              <div class="flex flex-col leading-tight">
                <?php foreach ($deploymentOpts as $opt): 
                   $parts = explode("\n", $opt);
                ?>
                  <div class="mb-1">
                    <span class="text-gray-300"><?= e($parts[0]) ?></span>
                    <?php if (count($parts) > 1): ?>
                      <br/><span class="text-[0.9rem] text-gray-400"><?= e($parts[1]) ?></span>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <button class="w-full py-4 rounded-xl border border-[#3d8c7c] bg-[#1b222b] text-white font-semibold text-2xl lg:text-4xl hover:bg-[#3d8c7c]/10 transition-colors">
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
          <div class="bg-[#12222c] rounded-2xl p-6 md:p-10 lg:p-14 border border-[#3d8c7c]/40 hover:border-[#3d8c7c] transition-all duration-300 flex flex-col items-center text-center justify-center min-h-[220px]">
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
