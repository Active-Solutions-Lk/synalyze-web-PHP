<?php if (!isset($noBackground) || !$noBackground): ?>
<div 
  class="absolute inset-0 -z-10 bg-[#16171B] bg-cover bg-top bg-no-repeat pointer-events-none"
  style="background-image: url('<?= e(baseUrl('/assets/images/bg.webp')) ?>')"
></div>
<?php endif; ?>
