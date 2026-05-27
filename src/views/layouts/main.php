<!DOCTYPE html>
<html lang="en" class="antialiased font-sans" style="--font-sans: 'Geist', sans-serif; --font-mono: 'Geist Mono', monospace;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($pageTitle) ? e($pageTitle) : 'Synalyze' ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(baseUrl('/assets/css/app.css')) ?>">
  <link rel="stylesheet" href="<?= e(baseUrl('/assets/css/responsive.css')) ?>">
  <!-- Load Lucide icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-background text-foreground bg-[#16171B] overflow-x-hidden selection:bg-[#06b6d4] selection:text-white flex min-h-screen flex-col relative">

  <?php require __DIR__ . '/../partials/navbar.php'; ?>

  <main class="flex-1 relative z-10 pt-24">
    <!-- Page Background -->
    <div 
      class="absolute inset-0 -z-10 bg-[#16171B] bg-cover bg-top bg-no-repeat pointer-events-none"
      style="background-image: url('<?= e(baseUrl('/assets/images/bg.png')) ?>')"
    ></div>

    <?= $content ?? '' ?>
  </main>

  <?php require __DIR__ . '/../partials/footer.php'; ?>

  <script src="<?= e(baseUrl('/assets/js/app.js')) ?>"></script>
</body>
</html>
