<?php
$settings = get_settings();
$siteName = $settings['siteName'] ?? 'SYNALYZE';
$logoUrl = $settings['logoUrl'] ?? '';
?>
<footer 
  class="relative bg-[#111111] pt-14 sm:pt-18 md:pt-24 pb-12 overflow-hidden bg-cover bg-bottom bg-no-repeat"
  style="background-image: url('<?= e(baseUrl('/assets/images/Watermark.png')) ?>')"
>
  <div class="container relative z-10 mx-auto px-6 max-w-7xl">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">

      <div class="lg:col-span-5 flex flex-col gap-6">
        <a href="<?= e(baseUrl('/')) ?>" class="flex items-center gap-2">
          <?php if ($logoUrl): ?>
            <img
              src="<?= e($logoUrl) ?>"
              alt="<?= e($siteName) ?>"
              width="150"
              height="40"
              class="h-7 w-auto object-contain brightness-0 invert"
            />
          <?php else: ?>
            <h2 class="text-4xl font-bold text-white tracking-[0.15em] mb-2">
              <?= e(strtoupper($siteName)) ?>
            </h2>
          <?php endif; ?>
        </a>
        <p class="text-white font-medium text-[1rem] max-w-[22rem] leading-relaxed">
          Cloud-based log analysis software for NAS. Take back control of your data with comprehensive usage auditing and reporting.
        </p>
        <div class="flex flex-col gap-2 mt-4 text-white font-bold text-[1rem]">
          <a href="tel:+94764404456" class="hover:text-[#3d8c7c] transition-colors">076 440 4456</a>
          <a href="mailto:vipsupport@activelk.com" class="hover:text-[#3d8c7c] transition-colors">vipsupport@activelk.com</a>
          <!-- <a href="http://sg-analyzer.synalyze.net:3000/" target="_blank" rel="noopener noreferrer" class="hover:text-[#3d8c7c] transition-colors break-all">http://sg-analyzer.synalyze.net:3000/</a> -->
        </div>
      </div>

      <div class="lg:col-span-7 flex flex-col justify-between">
        <div class="grid grid-cols-3 sm:grid-cols-3 gap-4 sm:gap-8 mb-10">
          <div>
            <h4 class="text-white font-bold mb-5 text-lg">Product</h4>
            <ul class="space-y-3 text-gray-300 font-medium">
              <li><a href="<?= e(baseUrl('/#features')) ?>" class="hover:text-white transition-colors">Features</a></li>
              <!-- <li><a href="<?= e(baseUrl('/#how-it-works')) ?>" class="hover:text-white transition-colors">How It Works</a></li>
              <li><a href="<?= e(baseUrl('/#deployment')) ?>" class="hover:text-white transition-colors">Deployment</a></li> -->
              <li><a href="<?= e(baseUrl('/pricing')) ?>" class="hover:text-white transition-colors">Pricing</a></li>
            </ul>
          </div>
          <div>
            <h4 class="text-white font-bold mb-5 text-lg">Company</h4>
            <ul class="space-y-3 text-gray-300 font-medium">
              <li><a href="<?= e(baseUrl('/about')) ?>" class="hover:text-white transition-colors">About Us</a></li>
              <!-- <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Careers</a></li> -->
              <li><a href="<?= e(baseUrl('/contact')) ?>" class="hover:text-white transition-colors">Contact</a></li>
            </ul>
          </div>
          <div>
            <h4 class="text-white font-bold mb-5 text-lg">Support</h4>
            <ul class="space-y-3 text-gray-300 font-medium">
              <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
              <li><a href="<?= e(baseUrl('/qa')) ?>" class="hover:text-white transition-colors">FAQs</a></li>
              <!-- <li><a href="#" class="hover:text-white transition-colors">Support Center</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Status</a></li> -->
            </ul>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
          <span class="text-white font-bold text-lg whitespace-nowrap">
            Sign up for our newsletter
          </span>
          <div class="relative flex-1 w-full max-w-[22rem]">
            <input
              type="email"
              placeholder="Your Email"
              class="w-full bg-[#2a2d34] border border-[#3d8c7c]/40 text-white placeholder-gray-400 rounded-full py-3.5 px-6 pr-14 focus:outline-none focus:border-[#3d8c7c] transition-colors"
            />
            <button class="absolute right-1.5 top-1.5 bottom-1.5 aspect-square bg-[#3d8c7c] rounded-full flex items-center justify-center hover:bg-[#439283] transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-white ml-0.5">
                <path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z" />
              </svg>
            </button>
          </div>
        </div>
      </div>

    </div>

    <div class="mt-18 pt-8 flex flex-col md:flex-row justify-between items-center gap-2 text-gray-300 font-medium">
      <p>© <?= date('Y') ?> <?= e($siteName) ?>. All Rights Reserved by Active Solutions.</p>
      <div>
        <a href="#" class="hover:text-white transition-colors underline decoration-transparent hover:decoration-white underline-offset-4">Terms of Use</a>
        <span class="mx-3">|</span>
        <a href="#" class="hover:text-white transition-colors underline decoration-transparent hover:decoration-white underline-offset-4">Privacy Policy</a>
      </div>
    </div>
  </div>
</footer>
