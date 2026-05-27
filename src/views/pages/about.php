<div class="relative font-sans overflow-x-hidden">
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.12)_0%,transparent_75%)] pointer-events-none z-0"></div>
  <div class="h-16 md:h-24 bg-black relative z-20 w-full"></div>

  <!-- Hero Section -->
  <section class="relative pt-10 md:pt-20 pb-20 min-h-[75vh] flex items-center overflow-hidden">
    <div
      class="absolute inset-0 z-0 bg-cover bg-right bg-no-repeat"
      style="background-image: url('<?= e(baseUrl('/assets/images/about/about.png')) ?>')"
    ></div>
    <div class="absolute inset-0 z-0 bg-gradient-to-b from-transparent via-[#16171B]/30 to-[#16171B]"></div>

    <div class="container relative z-10 mx-auto px-6 max-w-8xl">
      <div class="max-w-3xl text-left">
        <h1 class="text-2xl sm:text-3xl lg:text-[3rem] font-light text-white tracking-tight leading-[1.2] mb-6">
          <?= e($pageData['heroHeadline']) ?> <br />
          <span class="inline-flex items-center gap-4 mt-2">
            <span class="font-light text-white">with </span>
            <img
              src="<?= e(baseUrl('/assets/images/Logo.png')) ?>"
              alt="SYNALYZE"
              width="290"
              height="70"
              class="h-12 md:h-16 lg:h-18 w-auto object-contain brightness-0 invert"
            />
          </span>
        </h1>

        <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-xl leading-relaxed font-light">
          <?= e($pageData['heroSubheadline']) ?>
        </p>

        <a
          href="#who-we-are"
          class="inline-flex items-center gap-3 px-8 py-3.5 rounded-full bg-[#1b7569] hover:bg-[#238c7f] text-white text-2xl font-medium transition-all duration-300 shadow-lg shadow-[#1b7569]/20"
        >
          <?= e($pageData['heroButtonText']) ?>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
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
        <h2 class="text-2xl sm:text-3xl lg:text-[3.5rem] font-semibold text-white mb-8 tracking-tight">
          <?= e($pageData['whoWeAreTitle']) ?>
        </h2>
        <p class="text-lg md:text-xl text-gray-300 leading-relaxed font-light">
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
        <h2 class="text-2xl sm:text-3xl lg:text-[3.5rem] font-semibold text-white mb-6 tracking-tight">
          <?= e($pageData['whatWeDoTitle']) ?>
        </h2>
        <p class="text-lg md:text-xl text-gray-300 font-light">
          <?= e($pageData['whatWeDoDescription']) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <?php foreach ($whatWeDoCards as $card): ?>
          <div class="relative group p-10 rounded-[2rem] border border-[#2b716f]/30 bg-[#161d24]/40 backdrop-blur-sm flex flex-col justify-center items-center text-center shadow-2xl transition-all duration-300 hover:border-[#3d8c7c] hover:shadow-[#3d8c7c]/10 hover:-translate-y-1">
            <div class="flex justify-center mb-6">
              <?= lucide_icon($card['iconName'], 'w-20 h-20 text-white', '1.5') ?>
            </div>
            <h3 class="text-2xl md:text-4xl font-bold text-white mb-4">
              <?= e($card['title']) ?>
            </h3>
            <p class="text-gray-300/90 text-lg leading-relaxed font-light">
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
      <h2 class="text-3xl sm:text-5xl lg:text-7xl font-semibold text-white mb-16 tracking-tight text-center">
        <?= e($pageData['whyChooseUsTitle']) ?>
      </h2>

      <div class="space-y-12 max-w-4xl mx-auto">
        <?php foreach ($whyChooseUsItems as $item): ?>
          <div class="flex items-start gap-6 group">
            <div class="flex-shrink-0 mt-1">
              <svg class="w-8 h-8 text-white transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
              </svg>
            </div>
            <div>
              <h3 class="text-2xl md:text-4xl font-semibold text-white mb-2">
                <?= e($item['title']) ?>
              </h3>
              <p class="text-lg text-gray-300 font-light leading-relaxed">
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
          <h2 class="text-2xl sm:text-3xl lg:text-[3.5rem] font-semibold text-white tracking-tight">
            <?= e($pageData['missionTitle']) ?>
          </h2>
          <p class="text-lg md:text-xl text-gray-300 leading-relaxed font-light">
            <?= e($pageData['missionDescription']) ?>
          </p>
        </div>

        <div class="space-y-6">
          <h2 class="text-2xl sm:text-3xl lg:text-[3.5rem] font-semibold text-white tracking-tight">
            <?= e($pageData['visionTitle']) ?>
          </h2>
          <p class="text-lg md:text-xl text-gray-300 leading-relaxed font-light">
            <?= e($pageData['visionDescription']) ?>
          </p>
        </div>
      </div>

      <div class="max-w-5xl mx-auto mt-24 w-full">
        <hr class="border-t border-white" />
      </div>
    </div>
  </section>
</div>
