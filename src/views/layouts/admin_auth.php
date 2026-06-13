<!DOCTYPE html>
<html lang="en" class="antialiased font-sans" style="--font-sans: 'Geist', sans-serif; --font-mono: 'Geist Mono', monospace;">
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
  <title><?= isset($pageTitle) ? e($pageTitle) : 'Admin Login - Synalyze' ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(baseUrl('/assets/css/app.css')) ?>">
  <script src="https://unpkg.com/lucide@0.475.0/dist/umd/lucide.min.js" defer></script>
  <style>
  :root {
    --color-background: #ffffff;
    --color-foreground: #0f172a;
  }
  .dark {
    --color-background: #0A0A0A;
    --color-foreground: #f3f4f6;
  }
  body {
    background-color: var(--color-background) !important;
    color: var(--color-foreground) !important;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  </style>
</head>
<body class="flex min-h-screen items-center justify-center p-4"
      data-eye-show="<?= e(baseUrl('/assets/images/Sign up/view (eye).webp')) ?>"
      data-eye-hide="<?= e(baseUrl('/assets/images/Sign up/no view (eye).webp')) ?>">

  <main class="w-full max-w-md">
    <?= $content ?? '' ?>
  </main>

  <script src="<?= e(baseUrl('/assets/js/app.js')) ?>"></script>
</body>
</html>
