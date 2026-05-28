<div class="relative font-sans">
  <!-- Hero Section -->
  <section class="relative pt-28 sm:pt-36 md:pt-48 pb-16 md:pb-32 flex flex-col items-center justify-center min-h-[90vh] overflow-hidden">
    <div
      class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat transition-transform duration-1000 hover:scale-105"
      style="background-image: url('<?= e(baseUrl('/assets/images/1.png')) ?>')"
    ></div>
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-black/60 via-black/20 to-[#16171B]"></div>

    <div class="container relative z-10 mx-auto px-6 text-center max-w-5xl">
      <!-- Success Alerts -->
      <?php if (isset($_SESSION['success'])): ?>
        <div class="signup-alert signup-alert--success max-w-3xl mx-auto mb-8 text-left">
          <div class="signup-alert__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="signup-alert-svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div class="signup-alert__content">
            <p class="signup-alert__msg"><?= e($_SESSION['success']) ?></p>
          </div>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-[5rem] font-bold text-white tracking-tight leading-[1.1] mb-6 uppercase">
        <?= e($hero['headline']) ?>
      </h1>
      <p class="text-lg md:text-xl text-gray-400 mb-14 max-w-3xl mx-auto leading-relaxed">
        <?= e($hero['subheadline']) ?>
      </p>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-6 md:gap-10 mt-8 md:mt-12">
        <a href="<?= e(baseUrl('/signup')) ?>" class="flex items-center justify-center gap-3 px-6 py-3.5 sm:px-8 md:px-12 md:py-5 rounded-[1.5rem] bg-[#3d8c7c] text-white text-base sm:text-lg md:text-[1.65rem] hover:bg-[#439283] transition-colors shadow-lg shadow-[#3d8c7c]/20 w-full sm:w-auto">
          Request Free Demo
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 ml-2">
            <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
          </svg>
        </a>        
      </div>

      <!-- <div class="relative max-w-2xl mx-auto">
        <div class="flex items-center w-full h-16 rounded-full bg-white shadow-2xl overflow-hidden px-3 sm:px-6">
          <?= lucide_icon('Search', 'text-gray-900 shrink-0 w-6 h-6 mr-4') ?>
          <input
            type="text"
            placeholder="<?= e($hero['searchPlaceholder']) ?>"
            class="w-full h-full bg-transparent text-gray-900 text-lg focus:outline-none font-medium placeholder:text-gray-900 placeholder:font-bold"
          />
        </div>
      </div> -->
    </div>
  </section>

  <!-- How It Works Section -->
  <?php if (!empty($howItWorks)): ?>
    <section id="how-it-works" class="relative z-10 py-16 md:py-32 bg-transparent overflow-hidden">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(30,58,138,0.25)_0%,transparent_70%)] pointer-events-none"></div>

      <div class="container relative z-10 mx-auto px-6 max-w-6xl">
        <h2 class="text-3xl sm:text-5xl md:text-6xl font-bold text-white text-center mb-12 md:mb-24 tracking-tight">
          How It Works
        </h2>

        <div class="flex flex-col items-center gap-16 md:gap-24">
          <!-- First Row: 1 & 2 -->
          <div class="flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-16 w-full">
            <?php if (isset($howItWorks[0])): ?>
              <div class="flex items-center">
                <span class="text-[12rem] lg:text-[18rem] font-bold text-white leading-none z-20 select-none tracking-tighter">
                  <?= e($howItWorks[0]['stepNumber']) ?>
                </span>
                <div class="relative -ml-12 lg:-ml-20 bg-gradient-to-r from-transparent via-[#1a2332] via-30% to-[#1a2332] rounded-[2.5rem] pt-8 pb-8 pr-10 pl-16 lg:pl-28 w-full max-w-[420px] shadow-2xl z-10">
                  <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">
                    <?= e($howItWorks[0]['title']) ?>
                  </h3>
                  <p class="text-gray-300 text-base lg:text-lg leading-relaxed">
                    <?= e($howItWorks[0]['description']) ?>
                  </p>
                </div>
              </div>
            <?php endif; ?>

            <?php if (isset($howItWorks[1])): ?>
              <div class="flex items-center">
                <span class="text-[12rem] lg:text-[18rem] font-bold text-white leading-none z-20 select-none tracking-tighter">
                  <?= e($howItWorks[1]['stepNumber']) ?>
                </span>
                <div class="relative -ml-12 lg:-ml-20 bg-gradient-to-r from-transparent via-[#1a2332] via-30% to-[#1a2332] rounded-[2.5rem] pt-8 pb-8 pr-10 pl-16 lg:pl-28 w-full max-w-[420px] shadow-2xl z-10">
                  <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">
                    <?= e($howItWorks[1]['title']) ?>
                  </h3>
                  <p class="text-gray-300 text-base lg:text-lg leading-relaxed">
                    <?= e($howItWorks[1]['description']) ?>
                  </p>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Second Row: 3 -->
          <?php if (isset($howItWorks[2])): ?>
            <div class="flex items-center justify-center w-full">
              <div class="flex items-center">
                <span class="text-[12rem] lg:text-[18rem] font-bold text-white leading-none z-20 select-none tracking-tighter">
                  <?= e($howItWorks[2]['stepNumber']) ?>
                </span>
                <div class="relative -ml-12 lg:-ml-20 bg-gradient-to-r from-transparent via-[#1a2332] via-30% to-[#1a2332] rounded-[2.5rem] pt-8 pb-8 pr-10 pl-16 lg:pl-28 w-full max-w-[420px] shadow-2xl z-10">
                  <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">
                    <?= e($howItWorks[2]['title']) ?>
                  </h3>
                  <p class="text-gray-300 text-base lg:text-lg leading-relaxed">
                    <?= e($howItWorks[2]['description']) ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Features Grid -->
  <section id="features" class="relative z-10 py-16 md:py-32 bg-transparent overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.3)_0%,transparent_70%)] pointer-events-none"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-7xl">
      <div class="text-center mb-24">
        <h2 class="text-3xl sm:text-5xl md:text-6xl font-bold text-white mb-8 tracking-tight">
          Powerful Log Analysis Features
        </h2>
        <p class="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
          Built specifically for global NAS brands, with a robust cloud infrastructure for comprehensive data collection and analysis.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($features as $feature): ?>
          <div class="flex flex-col rounded-[2.5rem] overflow-hidden border border-[#3d8c7c] shadow-2xl transition-transform hover:-translate-y-2 duration-300">
            <div class="p-6 md:p-10 flex-1">
              <h3 class="text-[1.6rem] font-bold text-white mb-4 leading-tight">
                <?= e($feature['title']) ?>
              </h3>
              <p class="text-gray-300 text-lg leading-relaxed">
                <?= e($feature['description']) ?>
              </p>
            </div>

            <div class="bg-[#3d8c7c] h-48 sm:h-52 md:h-60 flex items-center justify-center">
              <?= lucide_icon($feature['iconName'], 'text-white w-28 h-28', '1.5') ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Deployment Options -->
  <?php if (!empty($deploymentOptions)): ?>
    <section id="deployment" class="relative z-10 py-16 md:py-32 bg-transparent overflow-hidden">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.15)_0%,transparent_70%)] pointer-events-none"></div>

      <div class="container relative z-10 mx-auto px-6 max-w-7xl">
        <div class="text-center mb-20">
          <h2 class="text-3xl sm:text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight">
            Deployment Options
          </h2>
          <p class="text-lg md:text-xl text-gray-400 max-w-3xl mx-auto leading-relaxed font-medium">
            Choose the deployment model that fits your internal IT policies and compliance requirements.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
          <?php foreach ($deploymentOptions as $option): 
            $isCloud = stripos($option['name'], 'cloud') !== false;
            $bullets = json_decode($option['bulletPoints'], true) ?: [];
          ?>
            <div class="relative p-6 sm:p-8 md:p-12 rounded-[2rem] border border-white/5 bg-[#141c28] flex flex-col items-stretch justify-between h-full shadow-2xl transition-transform hover:-translate-y-1 duration-300">
              <div>
                <?php if ($isCloud): ?>
                  <div class="flex justify-end mb-4">
                    <div class="bg-[#1e8a79] text-white text-[10px] uppercase tracking-wider font-extrabold px-2.5 py-0.5 rounded-md">
                      Recommended
                    </div>
                  </div>
                <?php else: ?>
                  <div class="h-6 mb-4"></div>
                <?php endif; ?>

                <div class="flex items-center gap-3 mb-6 w-full">
                  <?php if ($isCloud): ?>
                    <?= lucide_icon('Cloud', 'text-white w-10 h-10 shrink-0', '1.8') ?>
                  <?php else: ?>
                    <?= lucide_icon('Server', 'text-white w-10 h-10 shrink-0', '1.8') ?>
                  <?php endif; ?>
                  <h3 class="text-2xl md:text-4xl font-bold text-white tracking-tight"><?= e($option['name']) ?></h3>
                </div>

                <p class="text-gray-300 text-[1.3rem] mb-10 leading-relaxed min-h-[50px]">
                  <?= e($option['description']) ?>
                </p>

                <?php if (!empty($bullets)): ?>
                  <div class="flex justify-center w-full mb-10">
                    <ul class="space-y-3.5 flex flex-col items-start w-fit text-gray-300 text-[1.2rem]">
                      <?php foreach ($bullets as $bullet): ?>
                        <li class="leading-normal">
                          <?= e($bullet) ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
              </div>

              <a href="<?= e(baseUrl('/docs#deployment')) ?>" class="w-full py-4 rounded-xl text-lg md:text-3xl font-semibold transition-all duration-300 text-center flex items-center justify-center <?= $isCloud ? 'bg-[#1e8a79] text-white hover:bg-[#239d89] shadow-lg shadow-[#1e8a79]/15' : 'bg-transparent text-white border-2 border-[#1e8a79] hover:bg-[#1e8a79]/10' ?>">
                Learn More
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Bottom CTA -->
  <section class="relative z-10 py-16 md:py-32 bg-gradient-to-b from-transparent to-[#1f2020] overflow-hidden flex flex-col items-center">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.25)_0%,transparent_60%)] pointer-events-none"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-5xl w-full flex flex-col items-center">
      <div class="h-[1px] w-full bg-white mb-20"></div>

      <div class="text-center mb-16 w-full">
        <h2 class="text-3xl sm:text-4xl md:text-6xl font-bold text-white mb-8 tracking-tight leading-tight">
          Ready to Take Control of Your<br class="hidden md:block" /> NAS Data?
        </h2>
        <p class="text-[1.35rem] md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
          We listen to our users. If you have an idea for a report, send us your idea<br class="hidden md:block" /> - if the data is available, we can probably make it.
        </p>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-8 w-full">
        <a href="<?= e(baseUrl('/signup')) ?>" class="flex items-center justify-center gap-3 px-6 py-3.5 sm:px-8 md:px-12 md:py-5 rounded-[1.5rem] bg-[#3d8c7c] text-white text-base sm:text-lg md:text-[1.65rem] hover:bg-[#439283] transition-colors shadow-lg shadow-[#3d8c7c]/20 w-full sm:w-auto">
          Free Demo
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 ml-2">
            <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
          </svg>
        </a>
        <a href="<?= e(baseUrl('/contact')) ?>" class="px-6 py-3.5 sm:px-8 md:px-12 md:py-5 rounded-[1.5rem] bg-white text-[#115e59] text-base sm:text-lg md:text-[1.65rem] hover:bg-gray-100 transition-colors shadow-lg w-full sm:w-auto flex items-center justify-center">
          Contact Us
        </a>
      </div>

      <div class="h-[1px] w-full bg-white mt-20"></div>
    </div>
  </section>
</div>
