<?php
$settings = get_settings();
$siteName = $settings['siteName'] ?? 'SYNALYZE';
$accentColor = $settings['themeAccentColor'] ?? '#3d8c7c';
$logoUrl = $settings['logoUrl'] ?? '';
?>
<header class="top-0 z-50 w-full" style="position: fixed; background-color: #16171ba3; backdrop-filter: blur(8px);">
  <div class="container mx-auto px-6 h-16 lg:h-24 flex items-center justify-between">
    <a href="<?= e(baseUrl('/')) ?>" class="flex items-center gap-2">
      <?php if ($logoUrl): ?>
        <img 
          src="<?= e($logoUrl) ?>" 
          alt="<?= e($siteName) ?>"
          width="100" 
          height="40" 
          class="h-7 w-auto object-contain brightness-0 invert" 
        />
      <?php else: ?>
        <span class="text-2xl font-medium tracking-widest text-white"><?= e(strtoupper($siteName)) ?></span>
      <?php endif; ?>
    </a>
    
    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex items-center gap-8 text-base font-large text-white">
      <a href="<?= e(baseUrl('/')) ?>" class="border border-[#06b6d4] rounded-full px-5 py-2 text-white">Home</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="hover:text-[#06b6d4] transition-colors">Features</a>
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="hover:text-[#06b6d4] transition-colors">How It Works</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="hover:text-[#06b6d4] transition-colors">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="hover:text-[#06b6d4] transition-colors">Support</a>
    </nav>
    <div class="hidden lg:flex items-center gap-6">
      <a href="<?= e(baseUrl('/login')) ?>" class="text-base font-medium text-white hover:text-[#06b6d4] transition-colors">Sign In</a>
      <a 
        href="<?= e(baseUrl('/signup')) ?>" 
        class="text-sm font-semibold px-6 py-2.5 rounded-full text-white transition-opacity hover:opacity-90"
        style="background-color: <?= e($accentColor) ?>;"
      >
        Free Demo
      </a>
    </div>
    
    <!-- Mobile Hamburger Button -->
    <button id="mobile-menu-btn" class="lg:hidden flex items-center justify-center p-2 text-white focus:outline-none" aria-label="Toggle Menu">
      <div class="menu-icon-open block">
        <?= lucide_icon('Menu', 'w-8 h-8') ?>
      </div>
      <div class="menu-icon-close hidden">
        <?= lucide_icon('X', 'w-8 h-8') ?>
      </div>
    </button>
  </div>

  <!-- Mobile Menu Panel -->
  <div id="mobile-menu" class="lg:hidden bg-[#16171B] border-t border-white/10">
    <div class="container mx-auto px-6 py-4 flex flex-col gap-4">
      <a href="<?= e(baseUrl('/')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">Home</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">Features</a>
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">How It Works</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">Support</a>
      
      <div class="flex flex-col gap-4 mt-2">
        <a href="<?= e(baseUrl('/login')) ?>" class="text-center text-white py-2 border border-white/20 rounded-lg hover:bg-white/5">Sign In</a>
        <a 
          href="<?= e(baseUrl('/signup')) ?>" 
          class="text-center text-white py-2 rounded-lg font-semibold"
          style="background-color: <?= e($accentColor) ?>;"
        >
          Free Demo
        </a>
      </div>
    </div>
  </div>
</header>
