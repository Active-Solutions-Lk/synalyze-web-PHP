<?php
$settings = get_settings();
$siteName = $settings['siteName'] ?? 'SYNALYZE';
$logoUrl = $settings['logoUrl'] ?? '';

// Check subscriber status if logged in
$isLoggedIn = isset($_SESSION['user']);
$userEmail = $isLoggedIn ? $_SESSION['user']['email'] : '';
$isSubscribed = false;

if ($isLoggedIn && !empty($userEmail)) {
    require_once dirname(dirname(__DIR__)) . '/models/SubscriberModel.php';
    $subModel = new SubscriberModel();
    $isSubscribed = $subModel->isSubscribed($userEmail);
}
?>
<style>
.custom-footer {
  margin-top: 4rem !important;
  padding-top: 3.5rem !important;
  padding-bottom: 3rem !important;
}
@media (min-width: 640px) {
  .custom-footer {
    padding-top: 4.5rem !important;
  }
}
@media (min-width: 768px) {
  .custom-footer {
    margin-top: 6rem !important;
    padding-top: 6rem !important;
  }
}
</style>
<footer 
  class="custom-footer relative bg-[#16171B] overflow-hidden bg-cover bg-bottom bg-no-repeat"
  style="background-image: url('<?= e(baseUrl('/assets/images/Watermark.webp')) ?>')"
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
        <p class="text-gray-300 font-medium text-sm max-w-[22rem] leading-relaxed">
          Cloud-based log analysis software for NAS. Take back control of your data with comprehensive usage auditing and reporting.
        </p>
        <div class="flex flex-col gap-2 mt-4 text-gray-400 font-semibold text-sm">
          <a href="tel:<?= e(preg_replace('/\s+/', '', $settings['ownerPhone'] ?? '+94764404456')) ?>" class="hover:text-accent transition-colors"><?= e($settings['ownerPhone'] ?? '+94764404456') ?></a>
          <a href="mailto:<?= e($settings['ownerEmail'] ?? 'support@synalyze.net') ?>" class="hover:text-accent transition-colors"><?= e($settings['ownerEmail'] ?? 'support@synalyze.net') ?></a>
        </div>
      </div>

      <div class="lg:col-span-7 flex flex-col justify-between">
        <div class="grid grid-cols-3 sm:grid-cols-3 gap-4 sm:gap-8 mb-10">
          <div>
            <h4 class="text-sm font-semibold uppercase tracking-widest text-gray-400 mb-5">Product</h4>
            <ul class="space-y-3 text-gray-400 font-medium text-sm">
              <li><a href="<?= e(baseUrl('/#features')) ?>" class="hover:text-white transition-colors">Features</a></li>
              <li><a href="<?= e(baseUrl('/pricing')) ?>" class="hover:text-white transition-colors">Pricing</a></li>
            </ul>
          </div>
          <div>
            <h4 class="text-sm font-semibold uppercase tracking-widest text-gray-400 mb-5">Company</h4>
            <ul class="space-y-3 text-gray-400 font-medium text-sm">
              <li><a href="<?= e(baseUrl('/about')) ?>" class="hover:text-white transition-colors">About Us</a></li>
              <li><a href="<?= e(baseUrl('/contact')) ?>" class="hover:text-white transition-colors">Contact</a></li>
            </ul>
          </div>
          <div>
            <h4 class="text-sm font-semibold uppercase tracking-widest text-gray-400 mb-5">Support</h4>
            <ul class="space-y-3 text-gray-400 font-medium text-sm">
              <li><a href="<?= e(baseUrl('/docs')) ?>" class="hover:text-white transition-colors">Documentation</a></li>
              <li><a href="<?= e(baseUrl('/qa')) ?>" class="hover:text-white transition-colors">FAQs</a></li>
            </ul>
          </div>
        </div>

        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 w-full pt-8 border-t border-gray-800">
          <div class="space-y-2">
            <span class="text-white font-bold text-lg block">
              Get in touch with us!
            </span>
          </div>
          <div class="w-full max-w-[32rem]">
            <form id="subscribe-form" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full">
              <input
                id="subscribe-email"
                type="email"
                required
                value="<?= e($userEmail) ?>"
                placeholder="Your Email Address"
                class="flex-1 bg-[#1A1A1A] border border-gray-800 text-white placeholder-gray-500 rounded-full py-2.5 px-5 focus:outline-none focus:border-accent transition-colors text-sm"
              />
              <button 
                id="subscribe-btn"
                type="submit" 
                class="shrink-0 px-6 py-2.5 bg-[#00CED1] text-white font-semibold text-sm rounded-full flex items-center justify-center hover:bg-[#439283] hover:text-white transition-all duration-300 disabled:opacity-100 cursor-pointer"
              >
                <span>Subscribe</span>
              </button>
            </form>
            <div id="subscribe-message" class="text-sm mt-2 hidden transition-all"></div>
          </div>
        </div>
        <p class="text-sm text-gray-400 pt-4">Receive our latest updates directly in your email inbox.</p>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('subscribe-form');
  const emailInput = document.getElementById('subscribe-email');
  const btn = document.getElementById('subscribe-btn');
  const msgDiv = document.getElementById('subscribe-message');

  if (form && emailInput && btn && msgDiv) {
    let isSubscribed = <?= json_encode($isSubscribed) ?>;
    let subscribedEmail = <?= json_encode($userEmail) ?>;

    // Fallback to localStorage if not logged in or not verified by PHP
    if (!isSubscribed) {
      isSubscribed = localStorage.getItem('synalyze_subscribed') === 'true';
      subscribedEmail = localStorage.getItem('synalyze_subscribed_email') || '';
    }

    const setSubscribedState = (email) => {
      isSubscribed = true;
      subscribedEmail = email;
      btn.innerHTML = '<span>Unsubscribe</span>';
      btn.className = 'shrink-0 px-6 py-2.5 bg-[#00CED1] text-white font-semibold text-sm rounded-full flex items-center justify-center hover:bg-[#439283] transition-all duration-300 disabled:opacity-100 cursor-pointer';
      btn.disabled = false;
      
      // Hide the email input field completely
      emailInput.classList.add('hidden');
      if (email) {
        emailInput.value = email;
      }
      
      localStorage.setItem('synalyze_subscribed', 'true');
      if (email) localStorage.setItem('synalyze_subscribed_email', email);
    };

    const setUnsubscribedState = () => {
      isSubscribed = false;
      subscribedEmail = '';
      btn.innerHTML = '<span>Subscribe</span>';
      btn.className = 'shrink-0 px-6 py-2.5 bg-[#00CED1] text-white font-semibold text-sm rounded-full flex items-center justify-center hover:bg-[#439283] transition-all duration-300 disabled:opacity-100 cursor-pointer';
      btn.disabled = false;
      
      // Show the email input field again
      emailInput.classList.remove('hidden');
      emailInput.disabled = false;
      emailInput.value = <?= json_encode($userEmail) ?> || '';
      emailInput.placeholder = 'Your Email Address';
      
      localStorage.removeItem('synalyze_subscribed');
      localStorage.removeItem('synalyze_subscribed_email');
    };

    if (isSubscribed) {
      setSubscribedState(subscribedEmail);
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const inputEmail = emailInput.value.trim();
      // When unsubscribing: use localStorage email first, fall back to input field value
      // When subscribing: use input field value
      const targetEmail = isSubscribed ? (subscribedEmail || inputEmail) : inputEmail;
      
      if (!targetEmail) return;

      btn.disabled = true;
      btn.innerHTML = isSubscribed ? '<span>Unsubscribing...</span>' : '<span>Subscribing...</span>';
      msgDiv.className = 'text-lg mt-2 hidden';

      const endpoint = isSubscribed ? '<?= e(baseUrl('/unsubscribe')) ?>' : '<?= e(baseUrl('/subscribe')) ?>';

      fetch(endpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: targetEmail })
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          msgDiv.textContent = data.message;
          
          if (isSubscribed) {
            msgDiv.className = 'text-sm mt-2 text-teal-400 font-medium block';
            setUnsubscribedState();
          } else {
            if (data.already_subscribed) {
              msgDiv.className = 'text-sm mt-2 text-teal-400 font-medium block';
            } else {
              msgDiv.className = 'text-sm mt-2 text-emerald-400 font-medium block';
            }
            setSubscribedState(targetEmail);
          }
        } else {
          msgDiv.textContent = data.message;
          msgDiv.className = 'text-sm mt-2 text-red-400 font-medium block';
          btn.disabled = false;
          btn.innerHTML = isSubscribed ? '<span>Unsubscribe</span>' : '<span>Subscribe</span>';
        }
      })
      .catch(error => {
        msgDiv.textContent = 'An error occurred. Please try again.';
        msgDiv.className = 'text-sm mt-2 text-red-400 font-medium block';
        btn.disabled = false;
        btn.innerHTML = isSubscribed ? '<span>Unsubscribe</span>' : '<span>Subscribe</span>';
      });
    });
  }
});
</script>
      </div>

    </div>

    <div class="mt-18 pt-8 flex flex-col md:flex-row justify-between items-center gap-2 text-gray-400 text-xs font-medium border-t border-gray-800/60">
      <p>© <?= date('Y') ?> <?= e($siteName) ?>. All Rights Reserved by Active Solutions.</p>
      <div>
        <a href="<?= e(baseUrl('/terms')) ?>" class="hover:text-white transition-colors underline decoration-transparent hover:decoration-white underline-offset-4">Terms of Use</a>
        <span class="mx-3">|</span>
        <a href="<?= e(baseUrl('/privacy')) ?>" class="hover:text-white transition-colors underline decoration-transparent hover:decoration-white underline-offset-4">Privacy Policy</a>
      </div>
    </div>
  </div>
</footer>
