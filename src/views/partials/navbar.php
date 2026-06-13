<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$settings = get_settings();
$siteName = $settings['siteName'] ?? 'SYNALYZE';
$accentColor = $settings['themeAccentColor'] ?? '#00CED1';
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
$isDocs = ($currentPath === '/docs');
$isContact = ($currentPath === '/contact');

$isLoggedIn = isset($_SESSION['user']);
?>
<style>
.nav-link {
  transition: color 0.3s, border-color 0.3s, background-color 0.3s;
}
.nav-link.border-accent {
  color: var(--color-foreground) !important;
  border-color: var(--accent-color) !important;
  background-color: rgba(var(--accent-rgb), 0.1) !important;
}
.nav-link-mobile {
  transition: color 0.3s;
}
.nav-link-mobile.active-mobile {
  color: var(--accent-color) !important;
  font-weight: 600 !important;
}
</style>

<header class="top-0 z-50 w-full border-b border-divider" style="position: fixed; background-color: var(--nav-bg); backdrop-filter: blur(8px);">
  <div class="container mx-auto px-6 h-16 lg:h-24 flex items-center justify-between">
    <a href="<?= e(baseUrl('/')) ?>" class="flex items-center gap-2">
      <?php if ($logoUrl): ?>
        <img 
          src="<?= e($logoUrl) ?>" 
          alt="<?= e($siteName) ?>"
          width="100" 
          height="40" 
          class="theme-logo h-7 w-auto object-contain" 
        />
      <?php else: ?>
        <span class="text-2xl font-medium tracking-widest text-foreground"><?= e(strtoupper($siteName)) ?></span>
      <?php endif; ?>
    </a>
    
    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex items-center gap-8 text-base font-large text-foreground" id="desktop-nav">
      <a href="<?= e(baseUrl('/')) ?>" class="nav-link <?= $isHome ? 'border border-accent rounded-full px-5 py-2 text-foreground' : 'hover:text-accent transition-colors' ?>" data-target="home">Home</a>
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="nav-link hover:text-accent transition-colors" data-target="how-it-works">How It Works</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="nav-link hover:text-accent transition-colors" data-target="features">Features</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="nav-link hover:text-accent transition-colors" data-target="deployment">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="nav-link <?= $isSupport ? 'border border-accent rounded-full px-5 py-2 text-foreground' : 'hover:text-accent transition-colors' ?>" data-target="qa">FAQs</a>
      <a href="<?= e(baseUrl('/docs')) ?>" class="nav-link <?= $isDocs ? 'border border-accent rounded-full px-5 py-2 text-foreground' : 'hover:text-accent transition-colors' ?>" data-target="docs">Docs</a>
      <a href="<?= e(baseUrl('/contact')) ?>" class="nav-link <?= $isContact ? 'border border-accent rounded-full px-5 py-2 text-foreground' : 'hover:text-accent transition-colors' ?>" data-target="contact">Contact Us</a>
    </nav>

    <!-- Desktop Session Actions -->
    <div class="hidden lg:flex items-center gap-6">
      <?php if ($isLoggedIn): ?>
        <a 
          href="<?= e(baseUrl('/dashboard')) ?>" 
          class="text-sm font-semibold px-6 py-2.5 rounded-full text-white transition-opacity hover:opacity-90 <?= $isDashboard ? 'border border-accent' : '' ?>"
          style="background-color: <?= e($accentColor) ?>;"
        >
          Dashboard
        </a>
        <a 
          href="<?= e(baseUrl('/logout')) ?>" 
          class="text-sm font-semibold px-6 py-2.5 text-foreground transition-colors hover:text-accent border border-accent rounded-full"
        >
          Logout
        </a>
      <?php else: ?>
        <a 
          href="<?= e(baseUrl('/signup')) ?>" 
          class="text-sm font-semibold px-6 py-2.5 text-foreground transition-colors hover:text-accent border border-accent rounded-full"
        >
          Sign Up
        </a>
        <a 
          href="<?= e(baseUrl('/login')) ?>" 
          class="text-sm font-semibold px-6 py-2.5 rounded-full text-white transition-opacity hover:opacity-90"
          style="background-color: <?= e($accentColor) ?>;"
        >
          Log In
        </a>
      <?php endif; ?>
    </div>
    
    <!-- Mobile Theme & Hamburger Container -->
    <div class="flex items-center gap-2 lg:hidden">
      <!-- Mobile Theme Toggle -->
      <button class="theme-toggle-btn p-2 text-foreground hover:text-accent transition-colors flex items-center justify-center cursor-pointer rounded-full hover:bg-black/5 dark:hover:bg-white/5" aria-label="Toggle Theme">
        <i data-lucide="sun" class="w-6 h-6 theme-icon-sun"></i>
        <i data-lucide="moon" class="w-6 h-6 theme-icon-moon"></i>
      </button>
      
      <!-- Mobile Hamburger Button -->
      <button id="mobile-menu-btn" class="flex items-center justify-center p-2 text-foreground focus:outline-none" aria-label="Toggle Menu">
        <div class="menu-icon-open block">
          <?= lucide_icon('Menu', 'w-8 h-8') ?>
        </div>
        <div class="menu-icon-close hidden">
          <?= lucide_icon('X', 'w-8 h-8') ?>
        </div>
      </button>
    </div>
  </div>

  <!-- Mobile Menu Panel -->
  <div id="mobile-menu" class="lg:hidden bg-background border-t border-divider">
    <div class="container mx-auto px-6 py-4 flex flex-col gap-4" id="mobile-nav">
      <a href="<?= e(baseUrl('/')) ?>" class="nav-link-mobile <?= $isHome ? 'active-mobile' : 'text-foreground hover:text-accent' ?> transition-colors py-1 border-b border-divider" data-target="home">Home</a>
      <a href="<?= e(baseUrl('/#how-it-works')) ?>" class="nav-link-mobile text-foreground hover:text-accent transition-colors py-1 border-b border-divider" data-target="how-it-works">How It Works</a>
      <a href="<?= e(baseUrl('/#features')) ?>" class="nav-link-mobile text-foreground hover:text-accent transition-colors py-1 border-b border-divider" data-target="features">Features</a>
      <a href="<?= e(baseUrl('/#deployment')) ?>" class="nav-link-mobile text-foreground hover:text-accent transition-colors py-1 border-b border-divider" data-target="deployment">Deployment</a>
      <a href="<?= e(baseUrl('/qa')) ?>" class="nav-link-mobile <?= $isSupport ? 'active-mobile' : 'text-foreground hover:text-accent' ?> transition-colors py-1 border-b border-divider" data-target="qa">FAQs</a>
      <a href="<?= e(baseUrl('/docs')) ?>" class="nav-link-mobile <?= $isDocs ? 'active-mobile' : 'text-foreground hover:text-accent' ?> transition-colors py-1 border-b border-divider" data-target="docs">Docs</a>
      <a href="<?= e(baseUrl('/contact')) ?>" class="nav-link-mobile <?= $isContact ? 'active-mobile' : 'text-foreground hover:text-accent' ?> transition-colors py-1 border-b border-divider" data-target="contact">Contact Us</a>
      
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
            href="<?= e(baseUrl('/logout')) ?>" 
            class="text-center text-foreground py-2 border border-accent rounded-full hover:bg-black/5 dark:hover:bg-white/5"
          >
            Logout
          </a>
        <?php else: ?>
          <a 
            href="<?= e(baseUrl('/signup')) ?>" 
            class="text-center text-foreground py-2 border border-accent rounded-full hover:bg-black/5 dark:hover:bg-white/5"
          >
            Sign Up
          </a>
          <a 
            href="<?= e(baseUrl('/login')) ?>" 
            class="text-center text-white py-2.5 rounded-full font-semibold"
            style="background-color: <?= e($accentColor) ?>;"
          >
            Log In
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

  const desktopActive = ['border', 'border-accent', 'rounded-full', 'px-5', 'py-2', 'text-foreground'];
  const desktopInactive = ['hover:text-accent', 'transition-colors'];
  const mobileActive = ['active-mobile'];
  const mobileInactive = ['text-foreground', 'hover:text-accent'];

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
