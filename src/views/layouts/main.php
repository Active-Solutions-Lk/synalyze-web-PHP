<?php
$settings = get_settings();
$accentColor = $settings['themeAccentColor'] ?? '#3d8c7c';

// Hex to RGB helper for transparent accent colors
function hex2rgbString($hex) {
    $hex = str_replace("#", "", $hex);
    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    return "$r, $g, $b";
}
$accentRgb = hex2rgbString($accentColor);
?>
<!DOCTYPE html>
<html lang="en" class="antialiased font-sans" style="--font-sans: 'Geist', sans-serif; --font-mono: 'Geist Mono', monospace; --accent-color: <?= e($accentColor) ?>;">
<head>
  <script>
    (function() {
      const theme = localStorage.getItem('theme') || 'dark';
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    })();
  </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($pageTitle) ? e($pageTitle) : 'Synalyze' ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(baseUrl('/assets/css/app.css')) ?>">
  <link rel="stylesheet" href="<?= e(baseUrl('/assets/css/responsive.css')) ?>">
  
  <style>
  :root {
    --accent-color: <?= e($accentColor) ?>;
    --accent-rgb: <?= e($accentRgb) ?>;
    
    --color-background: #ffffff;
    --color-foreground: #000000;
    --color-card: #ffffff;
    --color-card-muted: #f8fafc;
    --color-border: #e2e8f0;
    --color-muted-foreground: #64748b;
    --nav-bg: rgba(255, 255, 255, 0.85);
    --hero-gradient-to: #ffffff;
    --sidebar-bg-rgb: 255, 255, 255;
    --divider-color: #e2e8f0;
    
    --auth-panel-bg: rgba(255, 255, 255, 0.85);
    --auth-panel-bg-mobile: rgba(255, 255, 255, 0.9);
    --eye-icon-filter: none;
    --panel-bg: rgba(255, 255, 255, 0.7);
    --panel-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.05);
  }
  
  /* Icon theme toggle display control */
  html.dark .theme-icon-sun {
    display: block !important;
  }
  html.dark .theme-icon-moon {
    display: none !important;
  }
  html:not(.dark) .theme-icon-sun {
    display: none !important;
  }
  html:not(.dark) .theme-icon-moon {
    display: block !important;
  }
  
  /* Logo filter for light theme (makes white logo black) */
  html:not(.dark) .theme-logo {
    filter: brightness(0) !important;
  }
  .dark {
    --color-background: #16171B;
    --color-foreground: #f8fafc;
    --color-card: #111d2a;
    --color-card-muted: #181a20;
    --color-border: rgba(255, 255, 255, 0.06);
    --color-muted-foreground: #94a3b8;
    --nav-bg: rgba(22, 23, 27, 0.85);
    --hero-gradient-to: #16171B;
    --sidebar-bg-rgb: 24, 26, 32;
    --divider-color: rgba(255, 255, 255, 0.08);
    
    --auth-panel-bg: rgba(13, 17, 23, 0.55);
    --auth-panel-bg-mobile: rgba(13, 17, 23, 0.82);
    --eye-icon-filter: brightness(0) invert(1);
    --panel-bg: rgba(30, 32, 48, 0.45);
    --panel-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
  }
  
  html {
    scroll-behavior: smooth;
  }
  body {
    background-color: var(--color-background) !important;
    color: var(--color-foreground) !important;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  
  /* Core Theme utility mapping */
  .bg-background {
    background-color: var(--color-background) !important;
  }
  .bg-card {
    background-color: var(--color-card) !important;
  }
  .bg-card-muted {
    background-color: var(--color-card-muted) !important;
  }
  .text-foreground {
    color: var(--color-foreground) !important;
  }
  .text-muted-foreground {
    color: var(--color-muted-foreground) !important;
  }
  .border-border {
    border-color: var(--color-border) !important;
  }
  .border-divider {
    border-color: var(--divider-color) !important;
  }
  .bg-divider {
    background-color: var(--divider-color) !important;
  }
  
  /* Dynamic gradient classes */
  .via-background {
    --tw-gradient-via: var(--color-background) !important;
    --tw-gradient-via-stops: var(--tw-gradient-position), var(--tw-gradient-from) var(--tw-gradient-from-position), var(--tw-gradient-via) var(--tw-gradient-via-position), var(--tw-gradient-to) var(--tw-gradient-to-position) !important;
    --tw-gradient-stops: var(--tw-gradient-via-stops) !important;
  }
  .to-background {
    --tw-gradient-to: var(--color-background) !important;
    --tw-gradient-stops: var(--tw-gradient-via-stops, var(--tw-gradient-position), var(--tw-gradient-from) var(--tw-gradient-from-position), var(--tw-gradient-to) var(--tw-gradient-to-position)) !important;
  }
  
  /* Dynamic contact subject pills classes */
  .active-pill {
    background-color: var(--color-foreground) !important;
    color: var(--color-background) !important;
    font-weight: 700 !important;
  }
  .inactive-pill {
    background-color: var(--color-card) !important;
    border: 1px solid var(--color-border) !important;
    color: var(--color-foreground) !important;
  }
  .inactive-pill:hover {
    background-color: var(--color-card-muted) !important;
  }
  
  /* Graphic assets adjustments for light theme */
  html:not(.dark) [data-theme-bg] {
    opacity: 0.06 !important;
    filter: invert(1) brightness(1.3) !important;
  }
  html:not(.dark) [data-theme-watermark] {
    opacity: 0.35 !important;
    filter: invert(1) brightness(1.3) !important;
  }

  .text-accent {
    color: var(--accent-color) !important;
  }
  .bg-accent {
    background-color: var(--accent-color) !important;
  }
  .border-accent {
    border-color: var(--accent-color) !important;
  }
  .bg-accent-glow {
    background-color: rgba(var(--accent-rgb), 0.1) !important;
    border: 1px solid rgba(var(--accent-rgb), 0.25) !important;
  }
  .bg-accent-glow-hover:hover {
    background-color: rgba(var(--accent-rgb), 0.15) !important;
    border-color: rgba(var(--accent-rgb), 0.4) !important;
  }
  .shadow-accent {
    box-shadow: 0 10px 30px rgba(var(--accent-rgb), 0.2) !important;
  }
  .hover\:text-accent:hover {
    color: var(--accent-color) !important;
  }
  .hover\:border-accent:hover {
    border-color: var(--accent-color) !important;
  }
  .button-accent {
    background-color: var(--accent-color) !important;
    color: #ffffff !important;
    transition: opacity 0.3s ease, transform 0.2s ease !important;
  }
  .button-accent:hover {
    opacity: 0.9 !important;
  }
  .button-accent:active {
    transform: scale(0.97) !important;
  }
  ::selection {
    background-color: var(--accent-color) !important;
    color: #ffffff !important;
  }
  
  /* Page top offset to clear the fixed navbar */
  .pt-navbar-offset {
    padding-top: 5rem !important;
  }
  @media (min-width: 768px) {
    .pt-navbar-offset {
      padding-top: 8rem !important;
    }
  }
  </style>

  <!-- Load Lucide icons -->
  <script src="https://unpkg.com/lucide@0.475.0/dist/umd/lucide.min.js" defer></script>
</head>
<body class="bg-background text-foreground overflow-x-hidden selection:bg-[#06b6d4] selection:text-white flex min-h-screen flex-col relative"
      data-eye-show="<?= e(baseUrl('/assets/images/Sign up/view (eye).webp')) ?>"
      data-eye-hide="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>">

  <?php require __DIR__ . '/../partials/navbar.php'; ?>

  <main class="flex-1 relative z-10<?= isset($noBackground) && $noBackground ? '' : ' pt-0' ?>">
    <!-- Page Background -->
    <?php require __DIR__ . '/../partials/background.php'; ?>

    <?= $content ?? '' ?>
  </main>

  <?php if (!isset($noFooter) || !$noFooter): ?>
    <?php require __DIR__ . '/../partials/footer.php'; ?>
  <?php endif; ?>

  <script src="<?= e(baseUrl('/assets/js/app.js')) ?>"></script>
</body>
</html>
