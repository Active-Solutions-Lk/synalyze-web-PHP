<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$settings = get_settings();
$siteName = $settings['siteName'] ?? 'SYNALYZE';
$accentColor = $settings['themeAccentColor'] ?? '#3d8c7c';
$logoUrl = $settings['logoUrl'] ?? '';

// Determine active state dynamics
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($basePath === '/') $basePath = '';
if ($basePath && strpos($currentPath, $basePath) === 0) {
    $currentPath = substr($currentPath, strlen($basePath));
}
if (empty($currentPath)) $currentPath = '/';

$isHome = ($currentPath === '/');
$isLogin = ($currentPath === '/login');
$isSignup = ($currentPath === '/signup');
$isDashboard = ($currentPath === '/dashboard');
$isSupport = ($currentPath === '/qa' || $currentPath === '/support');

$isLoggedIn = isset($_SESSION['user']);
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
      <a href="<?= e(baseUrl('/')) ?>" class="<?= $isHome ? 'border border-[#06b6d4] rounded-full px-5 py-2 text-white' : 'hover:text-[#06b6d4] transition-colors' ?>">Home</a>
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="hover:text-[#06b6d4] transition-colors">How It Works</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="hover:text-[#06b6d4] transition-colors">Features</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="hover:text-[#06b6d4] transition-colors">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="<?= $isSupport ? 'border border-[#06b6d4] rounded-full px-5 py-2 text-white' : 'hover:text-[#06b6d4] transition-colors' ?>">Support</a>
    </nav>

    <!-- Desktop Session Actions -->
    <div class="hidden lg:flex items-center gap-6">
      <?php if ($isLoggedIn): ?>
        <a 
          href="<?= e(baseUrl('/dashboard')) ?>" 
          class="text-sm font-semibold px-6 py-2.5 rounded-full text-white transition-opacity hover:opacity-90 <?= $isDashboard ? 'border border-[#06b6d4]' : '' ?>"
          style="background-color: <?= e($accentColor) ?>;"
        >
          Dashboard
        </a>
        <a 
          href="http://sg-analyzer.synalyze.net:3000/auth/login" 
          target="_blank" 
          rel="noopener noreferrer" 
          class="text-sm font-semibold px-6 py-2.5 text-white transition-colors hover:text-[#06b6d4] border border-[#06b6d4] rounded-full"
        >
          Access Portal
        </a>
      <?php else: ?>
        <a 
          href="<?= e(baseUrl('/signup')) ?>" 
          class="text-sm font-semibold px-6 py-2.5 rounded-full text-white transition-opacity hover:opacity-90 <?= $isSignup ? 'border border-[#06b6d4]' : '' ?>"
          style="background-color: <?= e($accentColor) ?>;"
        >
          Free Demo
        </a>
      <?php endif; ?>
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
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">How It Works</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">Features</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5">FAQs</a>
      
      <div class="flex flex-col gap-4 mt-2">
        <?php if ($isLoggedIn): ?>
          <a 
            href="<?= e(baseUrl('/dashboard')) ?>" 
            class="text-center text-white py-2.5 rounded-full font-semibold"
            style="background-color: <?= e($accentColor) ?>;"
          >
            Dashboard
          </a>
          <a 
            href="http://sg-analyzer.synalyze.net:3000/auth/login" 
            target="_blank" 
            rel="noopener noreferrer" 
            class="text-center text-white py-2 border border-[#06b6d4] rounded-full hover:bg-white/5"
          >
            Access Portal
          </a>
        <?php else: ?>
          <a 
            href="<?= e(baseUrl('/signup')) ?>" 
            class="text-center text-white py-2.5 rounded-full font-semibold"
            style="background-color: <?= e($accentColor) ?>;"
          >
            Free Demo
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>
