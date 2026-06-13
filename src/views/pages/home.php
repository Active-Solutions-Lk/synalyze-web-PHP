<div class="relative font-sans">
  <!-- Hero Section -->
  <section class="relative pt-navbar-offset pb-16 md:pb-32 flex flex-col items-center justify-center min-h-[90vh] overflow-hidden">
    <div
      class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat transition-transform duration-1000 hover:scale-105"
      style="background-image: url('<?= e(baseUrl('/assets/images/1.webp')) ?>')"
    ></div>
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-black/60 via-black/20 to-background"></div>

    <div class="container relative z-10 mx-auto px-6 text-center max-w-5xl">
      <!-- Success/Demo Alerts -->
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

      <?php if (isset($_SESSION['demo_success'])): ?>
        <div class="signup-alert signup-alert--success max-w-3xl mx-auto mb-8 text-left">
          <div class="signup-alert__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="signup-alert-svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <div class="signup-alert__content">
            <p class="signup-alert__msg"><?= e($_SESSION['demo_success']) ?></p>
          </div>
        </div>
        <?php unset($_SESSION['demo_success']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['demo_info'])): ?>
        <div class="signup-alert signup-alert--success max-w-3xl mx-auto mb-8 text-left" style="border-color: var(--accent-color); background-color: rgba(var(--accent-rgb), 0.1);">
          <div class="signup-alert__icon">
            <?= lucide_icon('Info', 'w-6 h-6 text-accent') ?>
          </div>
          <div class="signup-alert__content">
            <p class="signup-alert__msg" style="color: #ffffff;"><?= e($_SESSION['demo_info']) ?></p>
          </div>
        </div>
        <?php unset($_SESSION['demo_info']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['demo_error'])): ?>
        <div class="signup-alert signup-alert--error max-w-3xl mx-auto mb-8 text-left">
          <div class="signup-alert__icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="signup-alert-svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="signup-alert__content">
            <p class="signup-alert__msg"><?= e($_SESSION['demo_error']) ?></p>
          </div>
        </div>
        <?php unset($_SESSION['demo_error']); ?>
      <?php endif; ?>

      <h1 class="page-hero-title mb-6 uppercase text-foreground">
        <?= e($hero['headline']) ?>
      </h1>
      <p class="text-base md:text-lg text-muted-foreground mb-10 max-w-3xl mx-auto leading-relaxed">
        <?= e($hero['subheadline']) ?>
      </p>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-6 md:gap-10 mt-8 md:mt-12">
        <?php if (!isset($_SESSION['user'])): ?>
          <a href="<?= e(baseUrl('/signup')) ?>" style="background-color: var(--accent-color); box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.25);" class="flex items-center justify-center gap-3 px-8 py-3.5 rounded-full text-white text-base md:text-lg hover:opacity-90 transition-all w-full sm:w-auto">
            Request Free Demo
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-1">
              <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
            </svg>
          </a>
        <?php elseif ($hasDemoRequested): ?>
          <div class="flex flex-col items-center w-full sm:w-auto">
            <button disabled style="background-color: #2D3748; cursor: not-allowed;" class="flex items-center justify-center gap-3 px-8 py-3.5 rounded-full text-gray-400 text-base md:text-lg w-full sm:w-auto opacity-75" title="Demo already requested">
              Demo Already Requested
              <?= lucide_icon('CheckCircle', 'w-5 h-5 ml-1 text-green-500') ?>
            </button>
            <div class="mt-2 text-center">
              <a href="<?= e(baseUrl('/dashboard')) ?>"
                 style="color: #00CED1; font-size: 1.05rem; font-weight: 600;
                        text-decoration: underline; text-underline-offset: 3px;">
                See More
              </a>
            </div>
          </div>
        <?php else: ?>
          <form action="<?= e(baseUrl('/demo/request')) ?>" method="POST" class="w-full sm:w-auto">
            <button type="submit" style="background-color: var(--accent-color); box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.25);" class="flex items-center justify-center gap-3 px-8 py-3.5 rounded-full text-white text-base md:text-lg hover:opacity-90 transition-all w-full">
              Request Free Demo
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-1">
                <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
              </svg>
            </button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <?php if (!empty($howItWorks)): ?>
    <section id="how-it-works" class="relative z-10 py-16 md:py-32 bg-transparent overflow-hidden">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(30,58,138,0.25)_0%,transparent_70%)] pointer-events-none"></div>

      <div class="container relative z-10 mx-auto px-6 max-w-6xl">
        <h2 class="section-title text-center mb-12 md:mb-24">
          How It Works
        </h2>

        <div class="flex flex-col items-center gap-10 md:gap-14">
          <!-- First Row: 1 & 2 -->
          <div class="flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-16 w-full">
            <?php if (isset($howItWorks[0])): ?>
              <div class="flex items-center">
                <span class="text-[12rem] font-bold text-accent leading-none z-20 select-none tracking-tighter">
                  <?= e($howItWorks[0]['stepNumber']) ?>
                </span>
                <div class="relative -ml-12 lg:-ml-20 works-card rounded-2xl pt-6 pb-6 pr-8 w-full shadow-2xl z-10">
                  <h3 class="card-title mb-2">
                    <?= e($howItWorks[0]['title']) ?>
                  </h3>
                  <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
                    <?= e($howItWorks[0]['description']) ?>
                  </p>
                </div>
              </div>
            <?php endif; ?>

            <?php if (isset($howItWorks[1])): ?>
              <div class="flex items-center">
                <span class="text-[12rem] font-bold text-accent leading-none z-20 select-none tracking-tighter">
                  <?= e($howItWorks[1]['stepNumber']) ?>
                </span>
                <div class="relative -ml-12 lg:-ml-20 works-card rounded-2xl pt-6 pb-6 pr-8 w-full shadow-2xl z-10">
                  <h3 class="card-title mb-2">
                    <?= e($howItWorks[1]['title']) ?>
                  </h3>
                  <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
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
                <span class="text-[12rem] font-bold text-accent leading-none z-20 select-none tracking-tighter">
                  <?= e($howItWorks[2]['stepNumber']) ?>
                </span>
                <div class="relative -ml-12 lg:-ml-20 works-card rounded-2xl pt-6 pb-6 pr-8 w-full shadow-2xl z-10">
                  <h3 class="card-title mb-2">
                    <?= e($howItWorks[2]['title']) ?>
                  </h3>
                  <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
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
      <div class="text-center mb-16">
        <h2 class="section-title mb-6">
          Powerful Log Analysis Features
        </h2>
        <p class="text-base md:text-lg text-muted-foreground max-w-4xl mx-auto leading-relaxed">
          Built specifically for global NAS brands, with a robust cloud infrastructure for comprehensive data collection and analysis.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($features as $feature): ?>
          <div class="flex flex-col rounded-2xl overflow-hidden border border-border bg-card shadow-2xl transition-transform hover:-translate-y-2 duration-300">
            <div class="p-6 md:p-8 flex-1">
              <h3 class="card-title mb-3 leading-tight">
                <?= e($feature['title']) ?>
              </h3>
              <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
                <?= e($feature['description']) ?>
              </p>
            </div>

            <div style="background-color: var(--accent-color);" class="h-36 md:h-44 flex items-center justify-center opacity-90">
              <?= lucide_icon($feature['iconName'], 'text-white w-24 h-24', '1.5') ?>
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
        <div class="text-center mb-16">
          <h2 class="section-title mb-6">
            Deployment Options
          </h2>
          <p class="text-base md:text-lg text-muted-foreground max-w-3xl mx-auto leading-relaxed font-medium">
            Choose the deployment model that fits your internal IT policies and compliance requirements.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
          <?php foreach ($deploymentOptions as $option): 
            $isCloud = stripos($option['name'], 'cloud') !== false;
            $bullets = json_decode($option['bulletPoints'], true) ?: [];
          ?>
            <div class="pro-card flex flex-col items-stretch justify-between h-full shadow-2xl transition-transform hover:-translate-y-1 duration-300">
              <div>
                <?php if ($isCloud): ?>
                  <div class="flex justify-end mb-4">
                    <div style="background-color: var(--accent-color);" class="text-white text-[10px] uppercase tracking-wider font-extrabold px-2.5 py-0.5 rounded-md">
                      Recommended
                    </div>
                  </div>
                <?php else: ?>
                  <div class="h-6 mb-4"></div>
                <?php endif; ?>

                <div class="flex items-center gap-3 mb-6 w-full">
                  <?php if ($isCloud): ?>
                    <span class="text-accent"><?= lucide_icon('Cloud', 'w-8 h-8 shrink-0', '1.8') ?></span>
                  <?php else: ?>
                    <span class="text-accent"><?= lucide_icon('Server', 'w-8 h-8 shrink-0', '1.8') ?></span>
                  <?php endif; ?>
                  <h3 class="card-title font-bold"><?= e($option['name']) ?></h3>
                </div>

                <p class="text-muted-foreground text-base mb-8 leading-relaxed min-h-[50px]">
                  <?= e($option['description']) ?>
                </p>

                <?php if (!empty($bullets)): ?>
                  <div class="flex justify-start w-full mb-8">
                    <ul class="space-y-3 flex flex-col items-start w-fit text-muted-foreground text-sm md:text-base">
                      <?php foreach ($bullets as $bullet): ?>
                        <li class="leading-normal flex items-start gap-2">
                          <span class="text-accent">✓</span>
                          <span><?= e($bullet) ?></span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
              </div>

              <a href="<?= e(baseUrl('/docs#deployment')) ?>" style="<?= $isCloud ? 'background-color: var(--accent-color); box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.2);' : 'border-color: var(--accent-color); color: var(--color-foreground);' ?>" class="w-full py-3 rounded-full text-base md:text-lg font-semibold transition-all duration-300 text-center flex items-center justify-center <?= $isCloud ? 'text-white hover:opacity-90' : 'border border-border bg-transparent hover:bg-black/5 dark:hover:bg-white/5' ?>">
                Learn More
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Bottom CTA -->
  <section class="relative z-10 py-16 md:py-32 bg-gradient-to-b from-transparent to-background overflow-hidden flex flex-col items-center">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.25)_0%,transparent_60%)] pointer-events-none"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-5xl w-full flex flex-col items-center">
      <div class="h-[1px] w-full bg-divider mb-20"></div>

      <div class="text-center mb-16 w-full">
        <h2 class="section-title mb-6">
          Ready to Take Control of Your<br class="hidden md:block" /> NAS Data?
        </h2>
        <p class="text-base md:text-lg text-muted-foreground max-w-4xl mx-auto leading-relaxed">
          We listen to our users. If you have an idea for a report, send us your idea<br class="hidden md:block" /> - if the data is available, we can probably make it.
        </p>
      </div>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-6 md:gap-8 w-full">
        <?php if (!isset($_SESSION['user'])): ?>
          <a href="<?= e(baseUrl('/signup')) ?>" style="background-color: var(--accent-color); box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.25);" class="flex items-center justify-center gap-3 px-8 py-3.5 rounded-full text-white text-base md:text-lg hover:opacity-90 transition-all w-full sm:w-auto">
            Free Demo
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-1">
              <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
            </svg>
          </a>
        <?php elseif ($hasDemoRequested): ?>
          <div class="flex flex-col items-center w-full sm:w-auto">
            <button disabled style="background-color: #2D3748; cursor: not-allowed;" class="flex items-center justify-center gap-3 px-8 py-3.5 rounded-full text-gray-400 text-base md:text-lg w-full sm:w-auto opacity-75 animate-pulse" title="Demo already requested">
              Demo Already Requested
              <?= lucide_icon('CheckCircle', 'w-5 h-5 ml-1 text-green-500') ?>
            </button>
            <div class="mt-2 text-center">
              <a href="<?= e(baseUrl('/dashboard')) ?>"
                 style="color: var(--accent-color); font-size: 0.85rem; font-weight: 600;
                        text-decoration: underline; text-underline-offset: 3px;">
                See More
              </a>
            </div>
          </div>
        <?php else: ?>
          <form action="<?= e(baseUrl('/demo/request')) ?>" method="POST" class="w-full sm:w-auto">
            <button type="submit" style="background-color: var(--accent-color); box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.25);" class="flex items-center justify-center gap-3 px-8 py-3.5 rounded-full text-white text-base md:text-lg hover:opacity-90 transition-all w-full">
              Free Demo
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 ml-1">
                <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
              </svg>
            </button>
          </form>
        <?php endif; ?>
        <a href="<?= e(baseUrl('/contact')) ?>" class="px-8 py-3.5 rounded-full bg-card border border-border text-accent text-base md:text-lg hover:bg-card-muted transition-colors shadow-lg w-full sm:w-auto flex items-center justify-center">
          Contact Us
        </a>
      </div>

      <div class="h-[1px] w-full bg-divider mt-20"></div>
    </div>
  </section>
</div>
