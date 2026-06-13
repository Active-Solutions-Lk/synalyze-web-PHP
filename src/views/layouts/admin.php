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
  <title>Admin - Synalyze</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(baseUrl('/assets/css/app.css')) ?>">
  <script src="https://unpkg.com/lucide@0.475.0/dist/umd/lucide.min.js" defer></script>
  <style>
  :root {
    --color-background: #ffffff;
    --color-foreground: #0f172a;
    --color-card: #f8fafc;
    --color-card-muted: #e2e8f0;
    --color-border: #cbd5e1;
    --color-muted-foreground: #475569;
  }
  .dark {
    --color-background: #0A0A0A;
    --color-foreground: #f3f4f6;
    --color-card: #121212;
    --color-card-muted: #1f2937;
    --color-border: #374151;
    --color-muted-foreground: #9ca3af;
  }
  body {
    background-color: var(--color-background) !important;
    color: var(--color-foreground) !important;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  aside {
    background-color: var(--color-card) !important;
    border-color: var(--color-border) !important;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }
  aside h1 {
    color: var(--color-foreground) !important;
  }
  aside a {
    color: var(--color-muted-foreground) !important;
  }
  aside a:hover, aside a.bg-gray-800 {
    background-color: var(--color-card-muted) !important;
    color: #00CED1 !important;
  }
  </style>
</head>
<body class="flex min-h-screen flex-col md:flex-row">

  <!-- Sidebar -->
  <aside class="w-full md:w-64 border-r p-6 flex flex-col gap-6">
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
          ['name' => 'Docs Page', 'href' => '/admin/docs', 'icon' => 'book-open'],
          ['name' => 'Users', 'href' => '/admin/users', 'icon' => 'users'],
          ['name' => 'Subscribers', 'href' => '/admin/subscribers', 'icon' => 'mail'],
          ['name' => 'Demo Requests', 'href' => '/admin/demo', 'icon' => 'play-circle'],
          ['name' => 'Logout', 'href' => '/admin/logout', 'icon' => 'log-out'],
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
