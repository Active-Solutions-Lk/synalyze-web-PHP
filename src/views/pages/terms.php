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
  <!-- Top glow backdrop -->
  <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle at top, rgba(var(--accent-rgb), 0.1) 0%, transparent 50%);"></div>

  <div class="container relative z-10 mx-auto px-6 max-w-7xl">
    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6 tracking-tight">
        Terms of Use
      </h1>
      <p class="text-base md:text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
        Please read these Terms of Use carefully before using the Synalyze NAS log analysis platform. By accessing or using our services, you agree to be bound by these terms.
      </p>
    </div>

    <!-- Two-column docs-style layout -->
    <div class="legal-layout">
      
      <!-- Desktop Sidebar TOC (Sticky) -->
      <aside class="legal-sidebar space-y-1">
        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-3 px-3">On This Page</p>
        <a href="#acceptance" class="legal-toc-link active">1. Acceptance of Terms</a>
        <a href="#use-services" class="legal-toc-link">2. Use of Services</a>
        <a href="#registration" class="legal-toc-link">3. Account & Security</a>
        <a href="#ip-rights" class="legal-toc-link">4. Intellectual Property</a>
        <a href="#data-storage" class="legal-toc-link">5. Data & Log Analysis</a>
        <a href="#prohibited" class="legal-toc-link">6. Prohibited Uses</a>
        <a href="#availability" class="legal-toc-link">7. Service Disclaimers</a>
        <a href="#liability" class="legal-toc-link">8. Limitation of Liability</a>
        <a href="#termination" class="legal-toc-link">9. Termination</a>
        <a href="#changes" class="legal-toc-link">10. Changes to Terms</a>
      </aside>

      <!-- Content Column -->
      <div class="legal-content" id="legal-content-body">
        
        <!-- Section 1 -->
        <section id="acceptance" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 01</span>
            <h2 class="text-2xl font-bold text-white mb-4">Acceptance of Terms</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                These Terms of Use constitute a legally binding agreement made between you and <strong>Active Solutions (Pvt) Ltd</strong> ("Synalyze"), concerning your access to and use of the Synalyze website (https://synalyze.net) and the Synalyze cloud software service.
              </p>
              <p>
                By accessing, registering for, or using the Synalyze application and services, you agree that you have read, understood, and agree to be bound by all of these Terms of Use. If you do not agree with all of these terms, you are explicitly prohibited from using the services, and you must discontinue use immediately.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 2 -->
        <section id="use-services" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 02</span>
            <h2 class="text-2xl font-bold text-white mb-4">Use of Services</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                Synalyze grants you a limited, non-exclusive, non-transferable, revocable license to access and use the SaaS application for the analysis of NAS (Network Attached Storage) log data in accordance with these Terms.
              </p>
              <p>
                You represent and warrant that:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li>You possess the legal authority to enter into these Terms.</li>
                <li>Your use of our service does not violate any applicable law, corporate policy, or agreement.</li>
                <li>You will use the platform only for legitimate network management, monitoring, and audit log analysis purposes.</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Section 3 -->
        <section id="registration" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 03</span>
            <h2 class="text-2xl font-bold text-white mb-4">Account Registration & Security</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                To access the log analysis dashboard, you are required to register an account. You agree to provide accurate, current, and complete registration information and to update such information as necessary.
              </p>
              <p>
                You can register using standard credentials or authenticate via Google OAuth. You are responsible for maintaining the confidentiality of your account credentials (including OAuth tokens and session cookies) and for all activities that occur under your account. You agree to notify us immediately at support@synalyze.net of any unauthorized use or security breach.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 4 -->
        <section id="ip-rights" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 04</span>
            <h2 class="text-2xl font-bold text-white mb-4">Intellectual Property Rights</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                Unless otherwise indicated, the Synalyze service, including all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics, and the trademarks and logos contained therein, are owned or controlled by Active Solutions (Pvt) Ltd or licensed to us, and are protected by copyright, trademark, and other intellectual property laws.
              </p>
              <p>
                Your right to use our software is strictly limited to the license granted herein. You may not copy, decompile, modify, or redistribute any part of our platform without prior written authorization from Active Solutions (Pvt) Ltd.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 5 -->
        <section id="data-storage" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 05</span>
            <h2 class="text-2xl font-bold text-white mb-4">Data Storage & Log Analysis</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                Synalyze processes network and device log files (e.g. upload logs, authentication logs, activity logs) uploaded from your NAS systems. You retain ownership of all original data and log files uploaded to the service.
              </p>
              <p>
                By uploading logs, you grant Synalyze the right to process, parse, store, and display visualizations of the logs for the sole purpose of providing analysis, generating dashboards, and alerting you to potential configuration anomalies or security threats.
              </p>
              <p>
                You represent that you have obtained all necessary consents and authorizations under relevant privacy laws to upload and process logs that may contain system IP addresses, filenames, and usernames.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 6 -->
        <section id="prohibited" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 06</span>
            <h2 class="text-2xl font-bold text-white mb-4">Prohibited Uses</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                You may not access or use the platform for any purpose other than that for which we make it available. Prohibited activities include:
              </p>
              <ul class="list-disc pl-6 space-y-2 text-gray-300">
                <li>Systematic retrieval of data or content to create or compile a database or directory without written permission.</li>
                <li>Attempting to bypass security controls, rate-limiters, or authentication mechanisms.</li>
                <li>Uploading malicious payloads, viruses, corrupted files, or logs containing intentionally malformed scripts designed to exploit parse engines.</li>
              </ul>
            </div>
          </div>
        </section>

        <!-- Section 7 -->
        <section id="availability" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 07</span>
            <h2 class="text-2xl font-bold text-white mb-4">Service Availability & Disclaimers</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                The Synalyze platform is provided on an "AS-IS" and "AS-AVAILABLE" basis. Active Solutions (Pvt) Ltd makes no warranties or representations about the accuracy or completeness of the log analysis, parsed outputs, threat detection alerts, or system uptime.
              </p>
              <p>
                We do not guarantee that log analysis will capture every security anomaly, file access violation, or hardware failure. You agree that log analysis is one part of a comprehensive security model, and you should maintain independent backup systems and primary audit protocols.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 8 -->
        <section id="liability" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 08</span>
            <h2 class="text-2xl font-bold text-white mb-4">Limitation of Liability</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                In no event will Active Solutions (Pvt) Ltd,our employees be liable to you or any third party for any direct, indirect, consequential, exemplary, incidental, special damages, including loss of log data, or other damages arising from your use of the platform, even if we have been advised of the possibility of such damages.
              </p>
              <p>
                Our liability to you for any cause whatsoever, and regardless of the form of action, will at all times be limited to the amount paid, if any, by you to us during the six (6) month period prior to any cause of action arising.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 9 -->
        <section id="termination" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 09</span>
            <h2 class="text-2xl font-bold text-white mb-4">Termination</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                These Terms of Use shall remain in full force and effect while you use the platform. We reserve the right, in our sole discretion and without notice or liability, to deny access to and use of the platform (including blocking certain IP addresses) to any person for any reason or for no reason, including without limitation for breach of any representation, warranty, or covenant contained in these terms.
              </p>
              <p>
                Upon termination of your account, your right to use our services will cause immediately, and all associated analytics data will be scheduled for deletion, subject to our compliance and retention obligations.
              </p>
            </div>
          </div>
        </section>

        <!-- Section 10 -->
        <section id="changes" class="scroll-mt-32">
          <div class="legal-card">
            <span class="legal-section-number">SECTION 10</span>
            <h2 class="text-2xl font-bold text-white mb-4">Changes to These Terms</h2>
            <div class="text-gray-300 leading-relaxed space-y-4">
              <p>
                We reserve the right, in our sole discretion, to modify or replace these Terms of Use at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect by posting a notification on the dashboard or sending an email to our registered users.
              </p>
              <p>
                By continuing to access or use our services after those revisions become effective, you agree to be bound by the revised terms.
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
