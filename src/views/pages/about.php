<div class="relative font-sans pt-navbar-offset overflow-x-hidden">
  <div class="absolute inset-0 pointer-events-none z-0" style="background-image: radial-gradient(circle at center, rgba(var(--accent-rgb), 0.12) 0%, transparent 75%);"></div>

  <!-- Hero Section -->
  <section class="relative pt-10 md:pt-20 pb-20 min-h-[75vh] flex items-center overflow-hidden">
    <div
      class="absolute inset-0 z-0 bg-cover bg-right bg-no-repeat"
      style="background-image: url('<?= e(baseUrl('/assets/images/about/about.webp')) ?>')"
    ></div>
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-transparent via-background/30 to-background"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-8xl">
      <div class="max-w-3xl text-left">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-foreground tracking-tight leading-[1.2] mb-6">
          <?= e($pageData['heroHeadline']) ?> <br />
          <span class="inline-flex items-center gap-3 mt-2">
            <span class="font-normal text-foreground text-xl md:text-2xl">with </span>
            <img
              src="<?= e(baseUrl('/assets/images/Logo.webp')) ?>"
              alt="SYNALYZE"
              width="290"
              height="70"
              class="h-8 md:h-10 w-auto object-contain dark:brightness-0 dark:invert"
            />
          </span>
        </h1>

        <p class="text-base md:text-lg text-muted-foreground mb-8 max-w-xl leading-relaxed">
          <?= e($pageData['heroSubheadline']) ?>
        </p>

        <a
          href="#who-we-are"
          style="background-color: var(--accent-color); box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.25);"
          class="inline-flex items-center gap-2.5 px-6 py-3 rounded-full text-white text-base md:text-lg font-semibold transition-all duration-300 hover:opacity-90"
        >
          <?= e($pageData['heroButtonText']) ?>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
            <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
          </svg>
        </a>
      </div>
    </div>
  </section>

  <!-- Who We Are Section -->
  <section id="who-we-are" class="relative z-10 py-24 bg-transparent overflow-hidden">
    <div class="container relative z-10 mx-auto px-6 max-w-7xl">
      <div class="text-center max-w-4xl mx-auto">
        <h2 class="section-title text-center mb-8">
          <?= e($pageData['whoWeAreTitle']) ?>
        </h2>
        <p class="text-base md:text-lg text-muted-foreground leading-relaxed max-w-4xl mx-auto">
          <?= e($pageData['whoWeAreDescription']) ?>
        </p>
      </div>
    </div>
  </section>

  <!-- What We Do Section -->
  <section id="what-we-do" class="relative z-10 py-24 bg-transparent overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.1)_0%,transparent_70%)] pointer-events-none"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-7xl">
      <div class="text-center max-w-4xl mx-auto mb-16">
        <h2 class="section-title mb-6">
          <?= e($pageData['whatWeDoTitle']) ?>
        </h2>
        <p class="text-base md:text-lg text-muted-foreground max-w-4xl mx-auto leading-relaxed">
          <?= e($pageData['whatWeDoDescription']) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <?php foreach ($whatWeDoCards as $card): ?>
          <div class="pro-card shadow-2xl flex flex-col justify-center items-center text-center transition-all duration-300 hover:shadow-accent hover:-translate-y-1">
            <div class="flex justify-center mb-6">
              <span class="text-accent"><?= lucide_icon($card['iconName'], 'w-12 h-12', '1.5') ?></span>
            </div>
            <h3 class="card-title font-bold mb-3">
              <?= e($card['title']) ?>
            </h3>
            <p class="text-muted-foreground text-sm md:text-base leading-relaxed">
              <?= e($card['description']) ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Why Choose SYNALYZE Section -->
  <section id="why-choose-us" class="relative z-10 py-24 bg-transparent overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.08)_0%,transparent_70%)] pointer-events-none"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-4xl">
      <h2 class="section-title text-center mb-14">
        <?= e($pageData['whyChooseUsTitle']) ?>
      </h2>

      <div class="space-y-12 max-w-4xl mx-auto">
        <?php foreach ($whyChooseUsItems as $item): ?>
          <div class="flex items-start gap-4 group">
            <div class="flex-shrink-0 mt-1.5">
              <svg class="w-5 h-5 text-accent transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
              </svg>
            </div>
            <div>
              <h3 class="card-title font-semibold mb-2">
                <?= e($item['title']) ?>
              </h3>
              <p class="text-base text-muted-foreground leading-relaxed">
                <?= e($item['description']) ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Our Mission & Our Vision Section -->
  <section id="mission-vision" class="relative z-10 py-24 bg-transparent overflow-hidden">
    <div class="container relative z-10 mx-auto px-6 max-w-5xl">
      <div class="flex flex-col gap-20 max-w-4xl mx-auto text-center">
        <div class="space-y-6">
          <h2 class="section-title">
            <?= e($pageData['missionTitle']) ?>
          </h2>
          <p class="text-base md:text-lg text-muted-foreground leading-relaxed">
            <?= e($pageData['missionDescription']) ?>
          </p>
        </div>

        <div class="space-y-6">
          <h2 class="section-title">
            <?= e($pageData['visionTitle']) ?>
          </h2>
          <p class="text-base md:text-lg text-muted-foreground leading-relaxed">
            <?= e($pageData['visionDescription']) ?>
          </p>
        </div>
      </div>

      <div class="max-w-5xl mx-auto mt-24 w-full">
        <hr class="border-t border-border" />
      </div>
    </div>
  </section>
</div>
