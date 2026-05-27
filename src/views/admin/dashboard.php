<div class="space-y-6">
  <div class="flex justify-between items-center mb-8">
    <div>
      <h2 class="text-3xl font-bold text-white mb-2">Welcome to Admin Dashboard</h2>
      <p class="text-gray-400">Manage your website content and settings from here.</p>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php
    $cards = [
        ['title' => 'Global Settings', 'desc' => 'Manage site name, logo, colors', 'href' => '/admin/settings', 'icon' => 'settings'],
        ['title' => 'Landing Page', 'desc' => 'Hero, features, deployment', 'href' => '/admin/landing', 'icon' => 'file-text'],
        ['title' => 'Pricing', 'desc' => 'Plans, features, add-ons', 'href' => '/admin/pricing', 'icon' => 'credit-card'],
        ['title' => 'FAQs', 'desc' => 'Manage questions & answers', 'href' => '/admin/faqs', 'icon' => 'help-circle'],
        ['title' => 'Users', 'desc' => 'View & manage registered users', 'href' => '/admin/users', 'icon' => 'users'],
    ];

    foreach ($cards as $card):
    ?>
    <a href="<?= e(baseUrl($card['href'])) ?>" class="block p-6 rounded-xl bg-[#1A1A1A] border border-gray-800 hover:border-[#00CED1] transition-colors group">
      <div class="w-12 h-12 rounded-lg bg-gray-800 flex items-center justify-center mb-4 group-hover:bg-[#00CED1]/10 group-hover:text-[#00CED1] text-gray-400 transition-colors">
        <?= lucide_icon($card['icon'], 'w-6 h-6') ?>
      </div>
      <h3 class="text-xl font-bold text-white mb-2"><?= e($card['title']) ?></h3>
      <p class="text-gray-400 text-sm"><?= e($card['desc']) ?></p>
    </a>
    <?php endforeach; ?>
  </div>
</div>
