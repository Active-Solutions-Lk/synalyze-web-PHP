<?php
$globalSettings = get_settings();
$contactEmail = $globalSettings['ownerEmail'] ?? 'support@synalyze.net';
?>
<div class="relative font-sans pb-24 overflow-x-hidden">
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(61,140,124,0.12)_0%,transparent_75%)] pointer-events-none z-0"></div>
  <div class="h-16 md:h-24 bg-black relative z-20 w-full"></div>

  <!-- Hero Section -->
  <section class="relative z-10 pt-0 pb-12 max-w-7xl mx-auto px-6 text-center">
    <h1 class="page-hero-title mb-6">
      <?= e($pageData['heroTitle']) ?>
    </h1>
    <p class="text-base md:text-lg text-gray-300 max-w-3xl mx-auto leading-relaxed">
      <?= e($pageData['heroDescription']) ?>
    </p>
  </section>

  <!-- Get in Touch section -->
  <section class="relative z-10 py-8 max-w-7xl mx-auto px-6">
    <h2 class="text-center section-title mb-16">
      Get in Touch
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Phone Card -->
      <div class="pro-card shadow-2xl flex flex-col items-center text-center transition-all duration-300 hover:shadow-accent hover:-translate-y-1">
        <div class="flex items-center justify-center gap-3.5 mb-8">
          <?= lucide_icon('Phone', 'w-8 h-8 text-accent') ?>
          <h3 class="card-title tracking-tight leading-none font-medium"><?= e($pageData['phoneTitle']) ?></h3>
        </div>

        <div class="space-y-6 flex-1 flex flex-col justify-center">
          <div>
            <p class="caption-text mb-1"><?= e($pageData['phoneSalesLabel']) ?></p>
            <p class="text-white text-sm md:text-base tracking-wide font-medium"><?= e($pageData['phoneSalesValue']) ?></p>
          </div>
          <div>
            <p class="caption-text mb-1"><?= e($pageData['phoneSupportLabel']) ?></p>
            <p class="text-white text-sm md:text-base tracking-wide font-medium"><?= e($pageData['phoneSupportValue']) ?></p>
          </div>
        </div>
      </div>

      <!-- Email Card -->
      <div class="pro-card shadow-2xl flex flex-col items-center text-center transition-all duration-300 hover:shadow-accent hover:-translate-y-1">
        <div class="flex items-center justify-center gap-3.5 mb-8">
          <?= lucide_icon('Mail', 'w-8 h-8 text-accent') ?>
          <h3 class="card-title tracking-tight leading-none font-medium"><?= e($pageData['emailTitle']) ?></h3>
        </div>

        <div class="space-y-6 flex-1 flex flex-col justify-center w-full">
          <div>
            <p class="caption-text mb-1"><?= e($pageData['emailSalesLabel']) ?></p>
            <p class="text-white text-sm md:text-base tracking-wide break-all font-medium"><?= e($contactEmail) ?></p>
          </div>
          <div>
            <p class="caption-text mb-1"><?= e($pageData['emailSupportLabel']) ?></p>
            <p class="text-white text-sm md:text-base tracking-wide break-all font-medium"><?= e($contactEmail) ?></p>
          </div>
          <div>
            <p class="caption-text mb-1"><?= e($pageData['emailGeneralLabel']) ?></p>
            <p class="text-white text-sm md:text-base tracking-wide break-all font-medium"><?= e($contactEmail) ?></p>
          </div>
        </div>
      </div>

      <!-- Address Card -->
      <div class="pro-card shadow-2xl flex flex-col items-center text-center transition-all duration-300 hover:shadow-accent hover:-translate-y-1">
        <div class="flex items-center justify-center gap-3.5 mb-8">
          <?= lucide_icon('MapPin', 'w-8 h-8 text-accent') ?>
          <h3 class="card-title tracking-tight leading-none font-medium"><?= e($pageData['addressTitle']) ?></h3>
        </div>

        <div class="space-y-1.5 flex-1 flex flex-col justify-center">
          <p class="text-white text-sm md:text-base tracking-wide leading-relaxed font-medium"><?= e($pageData['addressLine1']) ?></p>
          <p class="text-white text-sm md:text-base tracking-wide leading-relaxed font-medium"><?= e($pageData['addressLine2']) ?></p>
          <?php if ($pageData['addressLine3']): ?>
            <p class="text-white text-sm md:text-base tracking-wide leading-relaxed font-medium"><?= e($pageData['addressLine3']) ?></p>
          <?php endif; ?>
          <p class="text-white text-sm md:text-base tracking-wide leading-relaxed font-medium"><?= e($pageData['addressLine4']) ?></p>
          <p class="text-white text-sm md:text-base tracking-wide leading-relaxed font-medium"><?= e($pageData['addressLine5']) ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Send Us a Message Section -->
  <section class="relative z-10 py-16 max-w-6xl mx-auto px-6">
    <div class="text-center mb-10">
      <h2 class="section-title mb-4">
        <?= e($pageData['formTitle']) ?>
      </h2>
      <p class="text-gray-300 max-w-3xl mx-auto text-base md:text-lg leading-relaxed">
        <?= e($pageData['formDescription']) ?>
      </p>
    </div>

    <div class="pro-card p-6 md:p-10 shadow-2xl">
      <?php if (isset($_SESSION['success'])): ?>
        <div class="mb-6 p-4 rounded-xl bg-emerald-950/40 border border-emerald-800 text-emerald-400 flex items-start gap-3 animate-fade-in">
          <?= lucide_icon('CheckCircle2', 'w-6 h-6 flex-shrink-0 mt-0.5') ?>
          <div>
            <h4 class="font-semibold text-white">Message Sent Successfully!</h4>
            <p class="text-sm text-gray-300 mt-1"><?= e($_SESSION['success']) ?></p>
          </div>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="mb-6 p-4 rounded-xl bg-red-950/40 border border-red-800 text-red-400 flex items-start gap-3 animate-fade-in">
          <?= lucide_icon('AlertCircle', 'w-6 h-6 flex-shrink-0 mt-0.5') ?>
          <div>
            <h4 class="font-semibold text-white">Error</h4>
            <p class="text-sm text-gray-300 mt-1"><?= e($_SESSION['error']) ?></p>
          </div>
        </div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <form method="POST" action="<?= e(baseUrl('/contact')) ?>" class="space-y-6">
        <div class="space-y-2">
          <label class="text-sm font-medium text-white block">Name *</label>
          <input type="text" name="name" required class="w-full bg-[#1e293b] text-white rounded-lg p-3 focus:outline-none transition-colors border border-white/[0.06] focus:border-accent text-base" />
        </div>

        <div class="space-y-2">
          <label class="text-sm font-medium text-white block">Email Address *</label>
          <input type="email" name="email" required class="w-full bg-[#1e293b] text-white rounded-lg p-3 focus:outline-none transition-colors border border-white/[0.06] focus:border-accent text-base" />
        </div>

        <div class="space-y-2">
          <label class="text-sm font-medium text-white block">Company Name <span class="text-gray-400 font-normal text-xs ml-1.5">(optional)</span></label>
          <input type="text" name="company" class="w-full bg-[#1e293b] text-white rounded-lg p-3 focus:outline-none transition-colors border border-white/[0.06] focus:border-accent text-base" />
        </div>

        <div class="space-y-3">
          <label class="text-sm font-medium text-white block">Subject</label>
          <input type="hidden" name="subject" id="subject-input" value="General Inquiry">
          <div class="flex flex-wrap gap-3">
            <?php 
            $subjects = ["Sales Inquiry", "Technical Support", "Partnership", "General Inquiry", "Other"];
            foreach ($subjects as $sub):
              $isActive = $sub === 'General Inquiry';
            ?>
              <button
                type="button"
                data-value="<?= e($sub) ?>"
                class="subject-pill px-6 py-3 rounded-md text-base font-medium transition-all cursor-pointer <?= $isActive ? 'bg-white text-black font-bold shadow-md' : 'bg-[#627387] text-white hover:bg-[#6e8096]' ?>"
              >
                <?= e($sub) ?>
              </button>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="space-y-2">
          <label class="text-sm font-medium text-white block">Message *</label>
          <textarea name="message" required rows="5" class="w-full bg-[#1e293b] text-white rounded-lg p-3 focus:outline-none transition-colors border border-white/[0.06] focus:border-accent text-base"></textarea>
        </div>

        <div class="space-y-4">
          <label class="text-sm font-medium text-white block">CAPTCHA</label>
          <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="flex items-center gap-3 shrink-0">
              <img src="<?= e(baseUrl('/captcha.php')) ?>" id="captcha-img" alt="CAPTCHA" class="rounded-lg shadow-inner border border-white/[0.06] h-[60px] w-[200px]" />
              <div class="flex flex-col gap-2">
                <button type="button" onclick="document.getElementById('captcha-img').src='<?= e(baseUrl('/captcha.php')) ?>?'+Math.random();" class="p-1.5 rounded-md hover:bg-white/5 text-white transition-colors cursor-pointer" title="Reload CAPTCHA">
                  <?= lucide_icon('RotateCw', 'w-5 h-5') ?>
                </button>
              </div>
            </div>
            <input type="text" name="captcha" required class="w-full sm:flex-1 bg-[#1e293b] text-white rounded-lg p-3 focus:outline-none text-center font-bold tracking-wider text-base h-[60px] border border-white/[0.06] focus:border-accent" placeholder="Enter CAPTCHA" />
          </div>
        </div>

        <div class="pt-4 text-center">
          <button type="submit" style="background-color: var(--accent-color); box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.25);" class="flex items-center justify-center gap-3 px-8 py-3 rounded-full text-white text-base md:text-lg hover:opacity-90 transform active:scale-95 cursor-pointer font-medium w-full sm:w-[220px] mx-auto transition-all">
            Submit
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Map Location Section -->
  <section class="relative z-10 py-12 max-w-7xl mx-auto px-6 text-center">
    <h2 class="section-title mb-8">
      <?= e($pageData['locationTitle']) ?>
    </h2>
    <div class="w-full max-w-5xl max-h-8xl mx-auto rounded-3xl border border-white/[0.04] overflow-hidden bg-[#17202c]/60 backdrop-blur-sm shadow-2xl h-[450px] sm:h-[550px] md:h-[650px] transition-all duration-500 hover:border-white/[0.1]">
      <iframe
        src="<?= e($pageData['mapEmbedUrl']) ?>"
        width="100%"
        height="100%"
        style="border: 0; filter: invert(90%) hue-rotate(180deg) brightness(95%) contrast(90%);"
        allowfullscreen="true"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        class="w-full h-full"
      ></iframe>
    </div>
    <div class="max-w-5xl mx-auto mt-24 w-full">
      <hr class="border-t border-white" />
    </div>
  </section>
</div>
