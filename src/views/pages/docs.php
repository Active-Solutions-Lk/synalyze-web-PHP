<?php
$accentColor = get_settings()['themeAccentColor'] ?? '#3d8c7c';
?>
<div class="relative font-sans pt-12 pb-24 text-white">
  <!-- Glowing background elements -->
  <div class="absolute inset-0 pointer-events-none z-0" style="background-image: radial-gradient(circle at top, rgba(var(--accent-rgb), 0.12) 0%, transparent 50%);"></div>
  <div class="absolute top-[40%] left-[-10%] w-[500px] h-[500px] rounded-full blur-[120px] pointer-events-none" style="background-color: rgba(var(--accent-rgb), 0.05);"></div>
  <div class="absolute bottom-[20%] right-[-10%] w-[500px] h-[500px] rounded-full blur-[120px] pointer-events-none" style="background-color: rgba(var(--accent-rgb), 0.05);"></div>

<style>
/* Core Documentation Layout */
.docs-wrapper {
  max-width: 1550px;
  margin: 0 auto;
}

.docs-layout-grid {
  display: flex;
  flex-direction: column;
  gap: 32px;
  margin-top: 32px;
}

@media (min-width: 1024px) {
  .docs-layout-grid {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 48px;
  }
}

/* Sidebar styling */
.docs-aside-sidebar {
  background-color: rgba(24, 26, 32, 0.7);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 24px;
  padding: 16px;
  width: 100%;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  box-sizing: border-box;
}

@media (min-width: 1024px) {
  .docs-aside-sidebar {
    position: sticky;
    top: 120px;
    padding: 24px;
    height: fit-content;
  }
}

/* Scrollable nav list for mobile capsules, vertical for desktop */
.docs-nav-menu {
  display: flex;
  flex-direction: row;
  overflow-x: auto;
  gap: 8px;
  padding-bottom: 4px;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.docs-nav-menu::-webkit-scrollbar {
  display: none;
}

@media (min-width: 1024px) {
  .docs-nav-menu {
    flex-direction: column;
    overflow-x: visible;
    padding-bottom: 0;
    gap: 10px;
  }
}

/* Nav links styling */
.docs-menu-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  border-radius: 100px;
  font-size: 0.8rem;
  font-weight: 600;
  color: #94a3b8;
  background-color: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.05);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  text-decoration: none;
  white-space: nowrap;
  flex-shrink: 0;
}

.docs-menu-item:hover {
  color: #ffffff;
  background-color: rgba(255, 255, 255, 0.08);
  border-color: rgba(255, 255, 255, 0.1);
}

@media (min-width: 1024px) {
  .docs-menu-item {
    border-radius: 12px;
    font-size: 0.95rem;
    padding: 12px 20px;
    white-space: normal;
    flex-shrink: 1;
    background-color: transparent;
    border: none;
    border-left: 2px solid transparent;
    border-radius: 0;
  }
  
  .docs-menu-item:hover {
    background-color: rgba(255, 255, 255, 0.04);
    border-left-color: rgba(255, 255, 255, 0.2);
  }
}

.docs-menu-item.active {
  color: var(--accent-color) !important;
  background-color: rgba(var(--accent-rgb), 0.15) !important;
  border-color: rgba(var(--accent-rgb), 0.4) !important;
}

@media (min-width: 1024px) {
  .docs-menu-item.active {
    color: var(--accent-color) !important;
    background-color: rgba(var(--accent-rgb), 0.08) !important;
    border-left: 3px solid var(--accent-color) !important;
    border-top: none !important;
    border-right: none !important;
    border-bottom: none !important;
    border-radius: 0 12px 12px 0 !important;
  }
}

.docs-articles-wrapper {
  display: flex;
  flex-direction: column;
  gap: 60px;
}

@media (min-width: 1024px) {
  .docs-articles-wrapper {
    gap: 80px;
  }
}
</style>

  <div class="container relative z-10 mx-auto px-6 max-w-[2600px]">

    <!-- Main Content Layout -->
    <div class="docs-wrapper">
      <div class="docs-layout-grid">
        
        <!-- Sticky Sidebar Index Navigation -->
        <aside class="docs-aside-sidebar">
          <h3 class="docs-sidebar-title mb-4 font-bold text-lg text-white">Table of Contents</h3>
          <nav class="docs-nav-menu" id="docs-sidebar-nav">
            <a href="#getting-started" class="docs-menu-item active">
              <?= lucide_icon('BookOpen', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Getting Started</span>
            </a>
            <a href="#integration" class="docs-menu-item">
              <?= lucide_icon('Terminal', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Syslog Integration</span>
            </a>
            <a href="#core-modules" class="docs-menu-item">
              <?= lucide_icon('Grid', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Core Modules</span>
            </a>
            <a href="#deployment" class="docs-menu-item">
              <?= lucide_icon('Server', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Deployment Details</span>
            </a>
            <a href="#support" class="docs-menu-item">
              <?= lucide_icon('HelpCircle', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Help & Support</span>
            </a>
          </nav>
        </aside>

        <!-- Main Articles Column -->
        <article class="docs-articles-wrapper" id="docs-content-container">
        
        <!-- Hero Header Section -->
        <div class="flex flex-col items-start text-left mb-4 max-w-4xl">
          <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-accent-glow text-accent text-sm font-semibold mb-6">
            <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
            <?= e($docsPage['eyebrowText'] ?? 'SYNALYZE Knowledge Base') ?>
          </div>
          <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight mb-6">
            <?= e($docsPage['headline'] ?? 'Documentation') ?>
          </h1>
          <p class="text-lg text-gray-400 leading-relaxed max-w-2xl">
            <?= e($docsPage['subheadline'] ?? '') ?>
          </p>
        </div>
        
        <!-- SECTION 1: Getting Started -->
        <section id="getting-started" class="docs-section scroll-mt-28 bg-[#181a20]/30 border border-white/5 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-white/10">
          <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl rounded-full pointer-events-none" style="background-image: linear-gradient(to bottom left, rgba(var(--accent-rgb), 0.05), transparent);"></div>
          <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color);">
              <?= lucide_icon('BookOpen', 'w-6 h-6') ?>
            </div>
            <h2 class="text-3xl font-bold tracking-tight">Getting Started</h2>
          </div>
          
          <div class="prose prose-invert max-w-none space-y-6 text-gray-300 leading-relaxed text-base">
            <div class="space-y-6">
              <?= $docsPage['gettingStartedIntro'] ?>
            </div>
            
            <?php if (!empty($onboardingSteps)): ?>
              <div class="bg-[#111216] rounded-2xl p-6 border border-white/5 mt-8">
                <h4 class="text-white font-bold mb-4 flex items-center gap-2 text-lg">
                  <?= lucide_icon('Cpu', 'text-accent w-5 h-5') ?>
                  <?= e($docsPage['onboardingTitle']) ?>
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-sm text-gray-400">
                  <?php foreach ($onboardingSteps as $step): ?>
                    <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                      <span class="text-xs uppercase font-extrabold text-accent"><?= e($step['stepNumber']) ?></span>
                      <h5 class="text-white font-semibold"><?= e($step['title']) ?></h5>
                      <p class="text-xs leading-normal"><?= e($step['description']) ?></p>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </section>

        <!-- SECTION 2: Syslog Integration -->
        <section id="integration" class="docs-section scroll-mt-28 bg-[#181a20]/30 border border-white/5 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-white/10">
          <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl rounded-full pointer-events-none" style="background-image: linear-gradient(to bottom left, rgba(var(--accent-rgb), 0.05), transparent);"></div>
          <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color);">
              <?= lucide_icon('Terminal', 'w-6 h-6') ?>
            </div>
            <h2 class="text-3xl font-bold tracking-tight">Syslog Integration</h2>
          </div>
          
          <div class="space-y-8 text-gray-300 leading-relaxed text-base">
            <p>
              <?= e($docsPage['integrationIntro']) ?>
            </p>

            <div class="border border-white/5 rounded-2xl bg-[#111216]/50 overflow-hidden">
              <div class="bg-[#111216] px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm" style="background-color: rgba(var(--accent-rgb), 0.2); color: var(--accent-color);">S</span>
                  <h3 class="text-white font-semibold text-lg"><?= e($docsPage['integrationSetupTitle']) ?></h3>
                </div>
                <span class="text-xs text-gray-400 font-mono bg-white/5 px-2 py-1 rounded"><?= e($docsPage['integrationSetupSubtitle']) ?></span>
              </div>
              <div class="p-6 space-y-4 text-sm">
                <ol class="list-decimal list-inside space-y-3">
                  <li>Log into your Synology DiskStation Manager (DSM) administrator panel.</li>
                  <li>Install and open the <strong class="text-white">Log Center</strong> package from the Package Center.</li>
                  <li>Navigate to <strong class="text-white">Log Sending</strong> in the left sidebar menu.</li>
                  <li>Check the box to <strong class="text-white">Enable sending logs to syslog server</strong>.</li>
                  <li>Enter the following configurations:</li>
                </ol>

                <?php if (!empty($integrationFields)): ?>
                  <div class="overflow-x-auto mt-4 mb-4">
                    <table class="w-full text-left text-xs border-collapse">
                      <thead>
                        <tr class="border-b border-white/10 text-gray-400">
                          <th class="pb-2 font-bold">Field Name</th>
                          <th class="pb-2 font-bold">Configuration Value</th>
                          <th class="pb-2 font-bold">Description</th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-white/5 text-gray-300">
                        <?php foreach ($integrationFields as $field): ?>
                          <tr>
                            <td class="py-2.5 font-semibold text-white"><?= e($field['fieldName']) ?></td>
                            <td class="py-2.5 font-mono text-accent"><?= e($field['fieldValue']) ?></td>
                            <td class="py-2.5 text-gray-400"><?= e($field['description']) ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>

                <div class="mt-4 p-4 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-200 text-xs leading-relaxed">
                  <?= $docsPage['integrationSetupPortNote'] ?>
                </div>
              </div>
            </div>

          </div>
        </section>

        <!-- SECTION 3: Core Modules Manual -->
        <section id="core-modules" class="docs-section scroll-mt-28 bg-[#181a20]/30 border border-white/5 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-white/10">
          <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl rounded-full pointer-events-none" style="background-image: linear-gradient(to bottom left, rgba(var(--accent-rgb), 0.05), transparent);"></div>
          <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color);">
              <?= lucide_icon('Grid', 'w-6 h-6') ?>
            </div>
            <h2 class="text-3xl font-bold tracking-tight">Core Modules</h2>
          </div>
          
          <div class="space-y-6 text-gray-300 leading-relaxed text-base mb-8">
            <p>
              <?= e($docsPage['modulesIntro']) ?>
            </p>
          </div>

          <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <?php foreach ($modules as $module): ?>
              <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
                <div class="flex items-center gap-3 mb-3">
                  <div class="text-accent"><?= lucide_icon($module['iconName'], 'w-6 h-6') ?></div>
                  <h3 class="text-xl font-bold text-white"><?= e($module['title']) ?></h3>
                </div>
                <p class="text-sm text-gray-400 mb-6"><?= e($module['description']) ?></p>
                <ul class="space-y-4 text-xs mt-auto">
                  <?php 
                  $lines = explode("\n", $module['bulletPoints']);
                  foreach ($lines as $line):
                      if (trim($line)):
                          $parts = explode(":", $line, 2);
                          if (count($parts) === 2):
                  ?>
                            <li><strong class="text-white block mb-1"><?= e(trim($parts[0])) ?>:</strong> <?= e(trim($parts[1])) ?></li>
                  <?php   else: ?>
                            <li><?= e(trim($line)) ?></li>
                  <?php   endif;
                      endif;
                  endforeach; ?>
                </ul>
              </div>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- SECTION 4: Deployment Details -->
        <section id="deployment" class="docs-section scroll-mt-28 bg-[#181a20]/30 border border-white/5 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-white/10">
          <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl rounded-full pointer-events-none" style="background-image: linear-gradient(to bottom left, rgba(var(--accent-rgb), 0.05), transparent);"></div>
          <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color);">
              <?= lucide_icon('Server', 'w-6 h-6') ?>
            </div>
            <h2 class="text-3xl font-bold tracking-tight">Deployment Details</h2>
          </div>
          
          <div class="space-y-8 text-gray-300 leading-relaxed text-base">
            <p>
              <?= e($docsPage['deploymentIntro']) ?>
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <?php foreach ($deploymentOptions as $deploy): ?>
                <div class="rounded-2xl p-6 flex flex-col <?= $deploy['badge'] === 'Recommended' ? 'bg-[#00CED1]/5 border border-[#00CED1]/30' : 'border border-white/5 bg-[#1a1b22]/50' ?>" style="<?= $deploy['badge'] === 'Recommended' ? 'border-color: rgba(var(--accent-rgb), 0.3); background-color: rgba(var(--accent-rgb), 0.05);' : '' ?>">
                  <div class="flex items-center justify-between mb-4">
                    <span class="px-2.5 py-0.5 rounded text-[10px] uppercase font-bold <?= $deploy['badge'] === 'Recommended' ? 'text-white bg-accent' : 'bg-white/5 text-gray-400' ?>"><?= e($deploy['badge']) ?></span>
                    <div class="text-accent"><?= lucide_icon($deploy['iconName'], 'w-7 h-7') ?></div>
                  </div>
                  <h4 class="text-white text-xl font-bold mb-3"><?= e($deploy['title']) ?></h4>
                  <p class="text-sm text-gray-400 leading-relaxed mb-4"><?= e($deploy['description']) ?></p>
                  <ul class="text-xs text-gray-400 space-y-3 mt-auto">
                    <?php 
                    $bullets = explode("\n", $deploy['bulletPoints']);
                    foreach ($bullets as $bullet):
                        if (trim($bullet)):
                            $parts = explode(":", $bullet, 2);
                            if (count($parts) === 2):
                    ?>
                              <li class="flex items-start gap-2">
                                <span class="text-accent mt-0.5">✓</span>
                                <div><strong class="text-white"><?= e(trim($parts[0])) ?>:</strong> <?= e(trim($parts[1])) ?></div>
                              </li>
                    <?php   else: ?>
                              <li class="flex items-start gap-2">
                                <span class="text-accent mt-0.5">✓</span>
                                <div><?= e(trim($bullet)) ?></div>
                              </li>
                    <?php   endif;
                        endif;
                    endforeach; ?>
                  </ul>
                </div>
              <?php endforeach; ?>
            </div>

            <!-- Compliance & Security -->
            <div class="mt-8 bg-[#111216] border border-white/5 rounded-2xl p-6">
              <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <?= lucide_icon('ShieldCheck', 'text-accent w-5 h-5') ?>
                <?= e($docsPage['complianceTitle']) ?>
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($complianceItems as $comp): ?>
                  <div>
                    <h5 class="text-white font-semibold text-sm mb-2"><?= e($comp['title']) ?></h5>
                    <p class="text-xs text-gray-400"><?= e($comp['description']) ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

          </div>
        </section>

        <!-- SECTION 5: Help & Support -->
        <section id="support" class="docs-section scroll-mt-28 bg-[#181a20]/30 border border-white/5 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-white/10">
          <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl rounded-full pointer-events-none" style="background-image: linear-gradient(to bottom left, rgba(var(--accent-rgb), 0.05), transparent);"></div>
          <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color);">
              <?= lucide_icon('HelpCircle', 'w-6 h-6') ?>
            </div>
            <h2 class="text-3xl font-bold tracking-tight">Help & Support</h2>
          </div>
          
          <div class="space-y-8 text-gray-300 leading-relaxed text-base">
            <p>
              <?= e($docsPage['supportIntro']) ?>
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
              
              <!-- Troubleshooting FAQs -->
              <div class="space-y-4">
                <h4 class="text-white font-bold text-lg mb-4"><?= e($docsPage['supportFaqTitle']) ?></h4>
                <?php foreach ($faqs as $faq): ?>
                  <details class="bg-[#111216] border border-white/5 rounded-xl group p-4">
                    <summary class="flex items-center justify-between font-semibold text-white cursor-pointer select-none">
                      <span class="text-sm"><?= e($faq['question']) ?></span>
                      <span class="text-accent transition-transform duration-300 group-open:rotate-180">▼</span>
                    </summary>
                    <div class="text-xs text-gray-400 mt-3 pl-2 border-l leading-relaxed" style="border-left-color: rgba(var(--accent-rgb), 0.4);">
                      <?= e($faq['answer']) ?>
                    </div>
                  </details>
                <?php endforeach; ?>
              </div>

              <!-- VIP Contact Info -->
              <div class="border rounded-2xl p-6" style="border-color: rgba(var(--accent-rgb), 0.3); background-image: linear-gradient(to right, rgba(var(--accent-rgb), 0.15), rgba(var(--accent-rgb), 0.05));">
                <h4 class="text-white font-bold mb-6 text-lg"><?= e($docsPage['supportContactTitle']) ?></h4>
                
                <div class="space-y-6">
                  <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-black/40 flex items-center justify-center text-accent shrink-0">
                      <?= lucide_icon('Phone', 'w-5 h-5') ?>
                    </div>
                    <div>
                      <p class="text-sm text-gray-400 mb-1">Help Desk</p>
                      <a href="tel:<?= preg_replace('/\s+/', '', get_settings()['ownerPhone'] ?? '+94764404456') ?>" class="text-lg font-bold text-white hover:text-accent transition-colors"><?= e(get_settings()['ownerPhone'] ?? '+94764404456') ?></a>
                    </div>
                  </div>

                  <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-black/40 flex items-center justify-center text-accent shrink-0">
                      <?= lucide_icon('Mail', 'w-5 h-5') ?>
                    </div>
                    <div>
                      <p class="text-sm text-gray-400 mb-1">Support Email</p>
                      <a href="mailto:<?= e(get_settings()['ownerEmail'] ?? 'support@synalyze.net') ?>" class="text-lg font-bold text-white hover:text-accent transition-colors"><?= e(get_settings()['ownerEmail'] ?? 'support@synalyze.net') ?></a>
                      <p class="text-xs text-gray-500 mt-1"><?= e($docsPage['supportEmailNote']) ?></p>
                    </div>
                  </div>

                  <div class="pt-4 border-t border-white/10">
                    <p class="text-sm text-gray-400 mb-3 font-semibold">Support Hours</p>
                    <ul class="space-y-2 text-xs text-gray-400">
                      <li class="flex justify-between"><span>Weekdays:</span> <span class="text-white"><?= e($docsPage['supportHoursWeekdays']) ?></span></li>
                      <li class="flex justify-between"><span>Saturdays:</span> <span class="text-white"><?= e($docsPage['supportHoursSaturdays']) ?></span></li>
                      <li class="flex justify-between"><span>Sundays & Holidays:</span> <span class="text-red-400"><?= e($docsPage['supportHoursSundays']) ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </article>
    </div> <!-- closes docs-layout-grid -->
  </div> <!-- closes docs-wrapper -->
</div> <!-- closes container relative -->
</div> <!-- closes outer relative font-sans -->

<!-- Inline Interactive Script for Search Filter & Copy utility -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1. Sidebar Active State Tracking on Scroll (ScrollSpy)
  const sections = document.querySelectorAll('.docs-section');
  const navLinks = document.querySelectorAll('#docs-sidebar-nav .docs-menu-item');

  function updateActiveLink() {
    let currentId = '';
    const scrollPos = window.scrollY + 150; 
    
    sections.forEach(section => {
      if (scrollPos >= section.offsetTop) {
        currentId = section.getAttribute('id');
      }
    });
    
    if (currentId) {
      navLinks.forEach(link => {
        const targetHash = link.getAttribute('href');
        if (targetHash === '#' + currentId) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      });
    }
  }
  
  window.addEventListener('scroll', updateActiveLink);
  updateActiveLink(); // run initially
  
  // 2. Smooth sidebar scroll offsets
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = link.getAttribute('href').substring(1);
      const targetSec = document.getElementById(targetId);
      
      if (targetSec) {
        const offset = 100; // sticky header padding
        const targetPos = targetSec.offsetTop - offset;
        
        window.scrollTo({
          top: targetPos,
          behavior: 'smooth'
        });
        
        // Push state manually
        history.pushState(null, null, '#' + targetId);
      }
    });
  });

  // Handle direct links with hash on page load
  if (window.location.hash) {
    const targetHash = window.location.hash;
    const targetSec = document.querySelector(targetHash);
    if (targetSec) {
      setTimeout(() => {
        const offset = 100;
        window.scrollTo({
          top: targetSec.offsetTop - offset,
          behavior: 'smooth'
        });
      }, 300);
    }
  }
});
</script>
