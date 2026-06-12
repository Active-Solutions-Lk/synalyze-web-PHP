<?php
$contactEmail = get_settings()['ownerEmail'] ?? 'support@synalyze.net';
?>
<style>
/* Robust responsive layout for legal pages */
.legal-layout {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

.legal-sidebar {
  display: none;
}

.legal-content {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 32px; /* Explicit gap between cards/sections */
}

.legal-mobile-nav {
  display: block;
}

@media (min-width: 1024px) {
  .legal-layout {
    display: grid;
    grid-template-columns: 250px 1fr; /* Fixed sidebar width, giving more space to cards */
    gap: 48px;
    align-items: start;
  }
  
  .legal-sidebar {
    display: block;
    position: sticky;
    top: 128px;
    max-height: calc(100vh - 10rem);
    overflow-y: auto;
    padding-right: 16px;
  }
  
  .legal-mobile-nav {
    display: none;
  }
}

/* Custom styling for legal page layout */
.legal-toc-link {
  display: block;
  padding: 6px 12px;
  font-size: 0.9rem;
  color: #94a3b8;
  border-left: 2px solid transparent;
  transition: all 0.2s ease-in-out;
}
.legal-toc-link:hover {
  color: #ffffff;
  border-left-color: rgba(var(--accent-rgb), 0.3);
}
.legal-toc-link.active {
  color: #00CED1;
  font-weight: 600;
  border-left-color: #00CED1;
  background-color: rgba(var(--accent-rgb), 0.03);
}

.legal-mobile-pill {
  display: inline-block;
  padding: 6px 14px;
  font-size: 0.85rem;
  border-radius: 9999px;
  background-color: #111d2a;
  border: 1px solid rgba(255, 255, 255, 0.05);
  color: #94a3b8;
  transition: all 0.2s ease-in-out;
  white-space: nowrap;
}
.legal-mobile-pill:hover {
  color: #ffffff;
  border-color: rgba(var(--accent-rgb), 0.3);
}
.legal-mobile-pill.active {
  background-color: rgba(var(--accent-rgb), 0.1);
  border-color: #00CED1;
  color: #00CED1;
  font-weight: 500;
}

.legal-card {
  background-color: #111d2a;
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 16px;
  padding: 32px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: border-color 0.3s ease;
}
.legal-card:hover {
  border-color: rgba(var(--accent-rgb), 0.15);
}

.legal-section-number {
  color: #00CED1;
  font-family: monospace;
  font-size: 0.95rem;
  font-weight: 600;
  display: block;
  margin-bottom: 8px;
}

/* Hide scrollbar utility */
.scrollbar-none::-webkit-scrollbar {
  display: none;
}
.scrollbar-none {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>

<div class="relative font-sans pt-28 md:pt-48 pb-0">

  <div class="container relative z-10 mx-auto px-6 max-w-7xl">
    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="page-hero-title mb-6">
        Privacy Policy
      </h1>
      <p class="text-base md:text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
        Your privacy is critically important to us. This Privacy Policy details how Synalyze collects, uses, protects, and discloses your information when you use our platform.
      </p>
    </div>

    <!-- Mobile Horizontal Pill Navigation -->
    <!-- <div class="legal-mobile-nav mb-8 overflow-x-auto whitespace-nowrap py-3 -mx-6 px-6 scrollbar-none border-y border-white/5 bg-[#111d2a]/30 sticky top-[80px] z-20 backdrop-blur-md">
      <div class="flex gap-2" id="mobile-toc-container">
        <a href="#collect" class="legal-mobile-pill active">1. Collection</a>
        <a href="#use" class="legal-mobile-pill">2. Usage</a>
        <a href="#storage" class="legal-mobile-pill">3. Security</a>
        <a href="#nas-logs" class="legal-mobile-pill">4. NAS Logs</a>
        <a href="#sharing" class="legal-mobile-pill">5. Sharing</a>
        <a href="#cookies" class="legal-mobile-pill">6. Cookies</a>
        <a href="#retention" class="legal-mobile-pill">7. Retention</a>
        <a href="#rights" class="legal-mobile-pill">8. Rights</a>
        <a href="#third-party" class="legal-mobile-pill">9. OAuth</a>
        <a href="#changes" class="legal-mobile-pill">10. Changes</a>
      </div>
    </div> -->

    <!-- Two-column docs-style layout -->
    <div class="legal-layout">
      
      <!-- Desktop Sidebar TOC (Sticky) -->
      <aside class="legal-sidebar space-y-1">
        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-3 px-3">On This Page</p>
        <a href="#collect" class="legal-toc-link active">1. Information We Collect</a>
        <a href="#use" class="legal-toc-link">2. How We Use Info</a>
        <a href="#storage" class="legal-toc-link">3. Data & Security</a>
        <a href="#nas-logs" class="legal-toc-link">4. NAS Log Data</a>
        <a href="#sharing" class="legal-toc-link">5. Sharing Your Info</a>
        <a href="#cookies" class="legal-toc-link">6. Cookies & Tracking</a>
        <a href="#retention" class="legal-toc-link">7. Data Retention</a>
        <a href="#rights" class="legal-toc-link">8. Your Rights</a>
        <a href="#third-party" class="legal-toc-link">9. Google OAuth</a>
        <a href="#changes" class="legal-toc-link">10. Changes to Policy</a>
      </aside>

      <!-- Content Column -->
      <div class="legal-content" id="legal-content-body">
        
        <!-- Section 1 -->
        <section id="collect" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 01</span>
            <h2 class="text-2xl font-bold text-white mb-4">Information We Collect</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We collect personal information that you voluntarily provide to us when you register on our platform, express interest in obtaining information about us or our products, or contact us.
              </p>
              <p>
                The personal information we collect may include:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li><strong>Account Credentials:</strong> Email addresses, passwords, names, and contact information.</li>
                <li><strong>OAuth Profile Data:</strong> If you authenticate using Google OAuth, we receive profile information (your email, name, profile image URL, and unique Google ID) from Google.</li>
                <li><strong>Device Log Files:</strong> Syslogs and analytics log data that you choose to upload from your NAS devices for parsing.</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Section 2 -->
        <section id="use" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 02</span>
            <h2 class="text-2xl font-bold text-white mb-4">How We Use Your Information</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We process your information for purposes based on legitimate business interests, the fulfillment of our contract with you, compliance with our legal obligations, and/or your consent. We use the information we collect or receive to:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li><strong>Facilitate Account Creation:</strong> Set up your dashboard, log analytical queries, and associate uploaded devices with your account.</li>
                <li><strong>Deliver Analysis:</strong> Process your uploaded NAS logs to identify authentication failures, access patterns, storage quotas, and security anomalies.</li>
                <li><strong>Send Security Alerts:</strong> Notify you via email of detected security concerns, such as log in attempts, user management changes, etc.</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Section 3 -->
        <section id="storage" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 03</span>
            <h2 class="text-2xl font-bold text-white mb-4">Data Storage & Security</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We implement appropriate technical and organizational security measures designed to protect the security of any personal information and raw log data we process. These include:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li>Encryption of all data in transit using TLS/HTTPS.</li>
                <li>Encryption of stored database fields and hashed user passwords using secure, modern algorithms (BCrypt).</li>
                <li>Strict firewalls and private network routing to restrict access to database nodes containing log records.</li>
              </ul>
              <p>
                However, please remember that no transmission over the Internet or electronic storage technology can be guaranteed 100% secure. Although we will do our best to protect your information, transmission of data and log files to and from our site is at your own risk.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 4 -->
        <section id="nas-logs" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 04</span>
            <h2 class="text-2xl font-bold text-white mb-4">NAS Log Data Handling</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                As a specialized log analysis platform, Synalyze handles complex structured and unstructured device logs. We treat your log files with strict privacy:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li><strong>Processing:</strong> Log files are parsed asynchronously. Once parsed into structured indexing metrics, raw text logs are either compressed in encrypted cold storage or deleted depending on your plan configuration.</li>
                <li><strong>Access Control:</strong> Our engineering personnel do not access the content of your logs unless explicitly requested by you to troubleshoot parsing syntax errors or log parser bugs.</li>
                <li><strong>No Sell Policy:</strong> We never sell, rent, or lease your log files, parsed IP address lists, username traces, or network graphs to third parties.</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Section 5 -->
        <section id="sharing" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 05</span>
            <h2 class="text-2xl font-bold text-white mb-4">Sharing Your Information</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We only share information with your consent, to comply with laws, to provide you with services, or to protect rights. We may share data under the following circumstances:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li><strong>Compliance with Laws:</strong> We may disclose your information where we are legally required to do so to comply with applicable law, governmental requests, judicial proceedings, or court orders.</li>
                <li><strong>Third-Party Service Providers:</strong> We use trusted third parties to handle hosting infrastructure (e.g. cloud hosting providers) and transactional emails (e.g. SMTP routing). These processors have no independent right to use your personal information.</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Section 6 -->
        <section id="cookies" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 06</span>
            <h2 class="text-2xl font-bold text-white mb-4">Cookies & Tracking</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We use cookies and similar tracking technologies to access or store session information. Cookies are small text files stored on your browser to facilitate authentication.
              </p>
              <p>
                We use essential session cookies to keep you logged in to your account. You can configure your browser to refuse all cookies or notify you when a cookie is set; however, disabling cookies will prevent you from logging into the Synalyze dashboard.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 7 -->
        <section id="retention" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 07</span>
            <h2 class="text-2xl font-bold text-white mb-4">Data Retention</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We will only keep your personal information for as long as it is necessary for the purposes set out in this Privacy Policy, unless a longer retention period is required or permitted by law (such as tax, accounting, or other legal requirements).
              </p>
              <p>
                When we have no ongoing legitimate business need to process your personal information, we will either delete or anonymize it, or, if this is not possible (for example, because your personal information has been stored in backup archives), then we will securely store your personal information and isolate it from any further processing until deletion is possible.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 8 -->
        <section id="rights" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 08</span>
            <h2 class="text-2xl font-bold text-white mb-4">Your Rights</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                Depending on your location, you may have certain rights regarding your personal information under local privacy laws (e.g. GDPR, CCPA, or the Personal Data Protection Act of Sri Lanka).
              </p>
              <p>
                These rights may include:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li>The right to request access to and obtain a copy of your personal data.</li>
                <li>The right to request rectification of inaccurate data or deletion of your profile.</li>
                <li>The right to restrict or object to the processing of your log analytics.</li>
                <li>The right to withdraw consent for third-party integrations (e.g. revoking Google OAuth access via your Google account settings).</li>
              </ul>
              <p>
                To exercise any of these rights, please contact us at <?= e($contactEmail) ?>. We will respond in accordance with applicable data protection laws.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 9 -->
        <section id="third-party" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 09</span>
            <h2 class="text-2xl font-bold text-white mb-4">Third-Party Services (Google OAuth)</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                Synalyze supports authentication via Google OAuth services.
              </p>
              <p>
                When you choose to register or log in using Google, we request access to basic scopes: `email`, `profile`, and `openid`. We use this data only to verify your identity, verify your email address, and pre-fill account registration fields (e.g. display name, profile image).
              </p>
              <p>
                We do not request permissions to access your Google Drive, Gmail, or other Google cloud storage services. You can revoke Synalyze's access to your Google account at any time via your Google security settings.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 10 -->
        <section id="changes" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 10</span>
            <h2 class="text-2xl font-bold text-white mb-4">Changes to This Policy</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We may update this privacy policy from time to time. The updated version will be indicated by an updated "Revised" date and the updated version will be effective as soon as it is accessible.
              </p>
              <p>
                If we make material changes to this privacy policy, we may notify you either by prominently posting a notice of such changes or by directly sending you an email notification. We encourage you to review this privacy policy frequently to be informed of how we are protecting your information.
              </p>
            </div>
          </div>
        </section>

      </div>
    </div>

    <div class="h-[1px] w-full bg-white/5 mt-20"></div>
  </div>

  <!-- Bottom transition gradient -->
  <div class="h-96 bg-gradient-to-b from-transparent via-[#16171B] via-40% to-[#111111] relative z-10 w-full pointer-events-none -mt-48"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const sections = document.querySelectorAll('#legal-content-body section');
  const tocLinks = document.querySelectorAll('.legal-toc-link');
  const mobilePills = document.querySelectorAll('.legal-mobile-pill');
  const mobileTocContainer = document.getElementById('mobile-toc-container');

  // Highlight active TOC link on scroll
  const observerOptions = {
    root: null,
    rootMargin: '-10% 0px -80% 0px',
    threshold: 0
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute('id');
        
        // Update desktop links
        tocLinks.forEach(link => {
          if (link.getAttribute('href') === '#' + id) {
            link.classList.add('active');
          } else {
            link.classList.remove('active');
          }
        });

        // Update mobile pills
        mobilePills.forEach(pill => {
          if (pill.getAttribute('href') === '#' + id) {
            pill.classList.add('active');
            
            // Scroll the active mobile pill into view horizontally
            const containerLeft = mobileTocContainer.getBoundingClientRect().left;
            const pillLeft = pill.getBoundingClientRect().left;
            mobileTocContainer.scrollBy({
              left: pillLeft - containerLeft - 16,
              behavior: 'smooth'
            });
          } else {
            pill.classList.remove('active');
          }
        });
      }
    });
  }, observerOptions);

  sections.forEach(section => observer.observe(section));

  // Smooth scroll logic for TOC links
  const allLinks = [...tocLinks, ...mobilePills];
  allLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetSection = document.querySelector(targetId);
      
      if (targetSection) {
        targetSection.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});
</script>
