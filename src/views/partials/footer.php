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
<footer 
  class="relative bg-[#111111] pt-14 sm:pt-18 md:pt-24 pb-12 overflow-hidden bg-cover bg-bottom bg-no-repeat"
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
        <p class="text-white font-medium text-[1rem] max-w-[22rem] leading-relaxed">
          Cloud-based log analysis software for NAS. Take back control of your data with comprehensive usage auditing and reporting.
        </p>
        <div class="flex flex-col gap-2 mt-4 text-white font-bold text-[1rem]">
          <a href="tel:+94764404456" class="hover:text-[#3d8c7c] transition-colors">076 440 4456</a>
          <a href="mailto:vipsupport@activelk.com" class="hover:text-[#3d8c7c] transition-colors">vipsupport@activelk.com</a>
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
              <li><a href="<?= e(baseUrl('/docs')) ?>" class="hover:text-white transition-colors">Documentation</a></li>
              <li><a href="<?= e(baseUrl('/qa')) ?>" class="hover:text-white transition-colors">FAQs</a></li>
            </ul>
          </div>
        </div>

        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 w-full pt-8 border-t border-gray-800">
          <div class="space-y-2">
            <span class="text-white font-bold text-2xl block">
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
                class="flex-1 bg-[#1A1A1A] border border-gray-800 text-white placeholder-gray-500 rounded-full py-3.5 px-6 focus:outline-none focus:border-[#3d8c7c] transition-colors text-lg"
              />
              <button 
                id="subscribe-btn"
                type="submit" 
                class="shrink-0 px-6 py-3.5 bg-[#00CED1] text-white font-semibold text-lg rounded-full flex items-center justify-center hover:bg-[#439283] hover:text-white transition-all duration-300 disabled:opacity-100"
              >
                <span>Subscribe</span>
              </button>
            </form>
            <div id="subscribe-message" class="text-lg mt-2 hidden transition-all"></div>
          </div>
        </div>
        <p class="text-lg text-gray-400 pt-4">Receive our latest updates directly in your email inbox.</p>

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
      btn.className = 'shrink-0 px-6 py-3.5 bg-[#00CED1] text-white font-semibold text-lg rounded-full flex items-center justify-center hover:bg-[#439283] transition-all duration-300 disabled:opacity-100';
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
      btn.className = 'shrink-0 px-6 py-3.5 bg-[#00CED1] text-white font-semibold text-lg rounded-full flex items-center justify-center hover:bg-[#439283] transition-all duration-300 disabled:opacity-100';
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
            msgDiv.className = 'text-lg mt-2 text-teal-400 font-medium block';
            setUnsubscribedState();
          } else {
            if (data.already_subscribed) {
              msgDiv.className = 'text-lg mt-2 text-teal-400 font-medium block';
            } else {
              msgDiv.className = 'text-lg mt-2 text-emerald-400 font-medium block';
            }
            setSubscribedState(targetEmail);
          }
        } else {
          msgDiv.textContent = data.message;
          msgDiv.className = 'text-lg mt-2 text-red-400 font-medium block';
          btn.disabled = false;
          btn.innerHTML = isSubscribed ? '<span>Unsubscribe</span>' : '<span>Subscribe</span>';
        }
      })
      .catch(error => {
        msgDiv.textContent = 'An error occurred. Please try again.';
        msgDiv.className = 'text-lg mt-2 text-red-400 font-medium block';
        btn.disabled = false;
        btn.innerHTML = isSubscribed ? '<span>Unsubscribe</span>' : '<span>Subscribe</span>';
      });
    });
  }
});
</script>
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
