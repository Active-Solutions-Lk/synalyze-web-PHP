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
$isSupport = ($currentPath === '/qa');

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
    <nav class="hidden lg:flex items-center gap-8 text-base font-large text-white" id="desktop-nav">
      <a href="<?= e(baseUrl('/')) ?>" class="nav-link <?= $isHome ? 'border border-[#06b6d4] rounded-full px-5 py-2 text-white' : 'hover:text-[#06b6d4] transition-colors' ?>" data-target="home">Home</a>
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="nav-link hover:text-[#06b6d4] transition-colors" data-target="how-it-works">How It Works</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="nav-link hover:text-[#06b6d4] transition-colors" data-target="features">Features</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="nav-link hover:text-[#06b6d4] transition-colors" data-target="deployment">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="nav-link <?= $isSupport ? 'border border-[#06b6d4] rounded-full px-5 py-2 text-white' : 'hover:text-[#06b6d4] transition-colors' ?>" data-target="qa">FAQs</a>
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
          href="<?= e(baseUrl('/pricing')) ?>" 
          class="text-sm font-semibold px-6 py-2.5 rounded-full text-white transition-opacity hover:opacity-90"
          style="background-color: <?= e($accentColor) ?>;"
        >
          Pricing
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
    <div class="container mx-auto px-6 py-4 flex flex-col gap-4" id="mobile-nav">
      <a href="<?= e(baseUrl('/')) ?>" class="nav-link-mobile <?= $isHome ? 'text-white font-semibold' : 'text-white hover:text-[#06b6d4]' ?> transition-colors py-2 border-b border-white/5" data-target="home">Home</a>
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="nav-link-mobile text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5" data-target="how-it-works">How It Works</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="nav-link-mobile text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5" data-target="features">Features</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="nav-link-mobile text-white hover:text-[#06b6d4] transition-colors py-2 border-b border-white/5" data-target="deployment">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="nav-link-mobile <?= $isSupport ? 'text-white font-semibold' : 'text-white hover:text-[#06b6d4]' ?> transition-colors py-2 border-b border-white/5" data-target="qa">FAQs</a>
      
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
            href="<?= e(baseUrl('/pricing')) ?>" 
            class="text-center text-white py-2.5 rounded-full font-semibold"
            style="background-color: <?= e($accentColor) ?>;"
          >
            Pricing
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const isHomePage = window.location.pathname === '/' || window.location.pathname === '/index.php' || window.location.pathname === '';
  if (!isHomePage) return;

  const sections = document.querySelectorAll('section[id]');
  const desktopLinks = document.querySelectorAll('#desktop-nav .nav-link');
  const mobileLinks = document.querySelectorAll('#mobile-nav .nav-link-mobile');

  const desktopActive = ['border', 'border-[#06b6d4]', 'rounded-full', 'px-5', 'py-2', 'text-white'];
  const desktopInactive = ['hover:text-[#06b6d4]', 'transition-colors'];
  const mobileActive = ['text-white', 'font-semibold'];
  const mobileInactive = ['text-white', 'hover:text-[#06b6d4]'];

  function setActiveNav(targetId) {
    desktopLinks.forEach(link => {
      if (link.dataset.target === targetId) {
        link.classList.remove(...desktopInactive);
        link.classList.add(...desktopActive);
      } else {
        link.classList.remove(...desktopActive);
        link.classList.add(...desktopInactive);
      }
    });

    mobileLinks.forEach(link => {
      if (link.dataset.target === targetId) {
        link.classList.remove(...mobileInactive);
        link.classList.add(...mobileActive);
      } else {
        link.classList.remove(...mobileActive);
        link.classList.add(...mobileInactive);
      }
    });
  }

  const observerOptions = {
    root: null,
    rootMargin: '-40% 0px -60% 0px',
    threshold: 0
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        setActiveNav(entry.target.id);
      }
    });
  }, observerOptions);

  sections.forEach(section => observer.observe(section));

  window.addEventListener('scroll', () => {
    if (window.scrollY < 200) {
      setActiveNav('home');
    }
  });
  
  // Set initial state based on hash
  if (window.location.hash) {
    const hashTarget = window.location.hash.substring(1);
    if (document.getElementById(hashTarget)) {
      setActiveNav(hashTarget);
    }
  }
});
</script>
