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
  </style>

  <!-- Load Lucide icons -->
  <script src="https://unpkg.com/lucide@0.475.0/dist/umd/lucide.min.js" defer></script>
</head>
<body class="bg-background text-foreground bg-[#16171B] overflow-x-hidden selection:bg-[#06b6d4] selection:text-white flex min-h-screen flex-col relative"
      data-eye-show="<?= e(baseUrl('/assets/images/Sign up/view (eye).webp')) ?>"
      data-eye-hide="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>">

  <?php require __DIR__ . '/../partials/navbar.php'; ?>

  <main class="flex-1 relative z-10<?= isset($noBackground) && $noBackground ? '' : ' pt-24' ?>">
    <!-- Page Background -->
    <?php if (!isset($noBackground) || !$noBackground): ?>
    <div 
      class="absolute inset-0 -z-10 bg-[#16171B] bg-cover bg-top bg-no-repeat pointer-events-none"
      style="background-image: url('<?= e(baseUrl('/assets/images/bg.webp')) ?>')"
    ></div>
    <?php endif; ?>

    <?= $content ?? '' ?>
  </main>

  <?php if (!isset($noFooter) || !$noFooter): ?>
    <?php require __DIR__ . '/../partials/footer.php'; ?>
  <?php endif; ?>

  <script src="<?= e(baseUrl('/assets/js/app.js')) ?>"></script>
</body>
</html>
