<!DOCTYPE html>
<html lang="en" class="dark antialiased font-sans" style="--font-sans: 'Geist', sans-serif; --font-mono: 'Geist Mono', monospace;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Synalyze</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(baseUrl('/assets/css/app.css')) ?>">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#0A0A0A] text-gray-100 flex min-h-screen flex-col md:flex-row">

  <!-- Sidebar -->
  <aside class="w-full md:w-64 bg-[#121212] border-r border-gray-800 p-6 flex flex-col gap-6">
    <div>
      <h1 class="text-xl font-bold text-white flex items-center gap-2">
        <span class="w-6 h-6 rounded bg-[#00CED1] flex items-center justify-center text-black text-xs">S</span>
        Synalyze Admin
      </h1>
    </div>
    <nav class="flex flex-col gap-2">
      <?php
      $navItems = [
          ['name' => 'Dashboard', 'href' => '/admin', 'icon' => 'layout-dashboard'],
          ['name' => 'Global Settings', 'href' => '/admin/settings', 'icon' => 'settings'],
          ['name' => 'Landing Page', 'href' => '/admin/landing', 'icon' => 'file-text'],
          ['name' => 'About Page', 'href' => '/admin/about', 'icon' => 'info'],
          ['name' => 'Contact Page', 'href' => '/admin/contact', 'icon' => 'contact-round'],
          ['name' => 'Pricing', 'href' => '/admin/pricing', 'icon' => 'credit-card'],
          ['name' => 'FAQs', 'href' => '/admin/faqs', 'icon' => 'help-circle'],
          ['name' => 'Users', 'href' => '/admin/users', 'icon' => 'users'],
      ];

      $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      // Remove base path if needed, simplifying for now assuming domain root or similar
      foreach ($navItems as $item): 
          // Simple active check
          $isActive = (strpos($currentPath, $item['href']) !== false && ($item['href'] !== '/admin' || $currentPath === '/admin'));
      ?>
        <a
          href="<?= e(baseUrl($item['href'])) ?>"
          class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-800 hover:text-[#00CED1] transition-colors <?= $isActive ? 'bg-gray-800 text-[#00CED1]' : '' ?>"
        >
          <?= lucide_icon($item['icon'], 'w-[18px] h-[18px]') ?>
          <span><?= e($item['name']) ?></span>
        </a>
      <?php endforeach; ?>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6 md:p-10 overflow-auto">
    <div class="max-w-5xl mx-auto">
      <?= $content ?? '' ?>
    </div>
  </main>

  <script src="<?= e(baseUrl('/assets/js/app.js')) ?>"></script>
</body>
</html>
