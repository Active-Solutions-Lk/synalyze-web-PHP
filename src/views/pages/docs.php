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
    
    <!-- Hero Header & Search Section -->
    <div class="flex flex-col items-center text-center mb-16 max-w-4xl mx-auto">
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-accent-glow text-accent text-sm font-semibold mb-6">
        <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
        SYNALYZE Knowledge Base
      </div>
      <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight mb-6">
        Documentation
      </h1>
      <p class="text-lg text-gray-400 mb-10 max-w-2xl leading-relaxed">
        Everything you need to configure log forwarding, manage user audits, and monitor your NAS infrastructure in real-time.
      </p>

      <!-- Live Search Box -->
      <!-- <div class="relative w-full max-w-2xl group">
        <div class="absolute -inset-1 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-300" style="background-image: linear-gradient(to right, var(--accent-color), rgba(var(--accent-rgb), 0.5));"></div>
        <div class="relative flex items-center bg-[#181a20] border border-white/10 rounded-2xl overflow-hidden px-5 py-4">
          <?= lucide_icon('Search', 'text-gray-400 shrink-0 w-6 h-6 mr-4') ?>
          <input
            type="text"
            id="docs-search-input"
            placeholder="Search documentation (e.g. syslog, Synology, port, cloud)..."
            class="w-full bg-transparent text-white text-lg focus:outline-none placeholder:text-gray-500"
          />
          <button id="clear-search-btn" class="hidden text-gray-400 hover:text-white transition-colors ml-2">
            <?= lucide_icon('X', 'w-5 h-5') ?>
          </button>
        </div>
      </div> -->
    </div>

    <!-- Main Content Layout (Sidebar + Articles Grid) in docs-wrapper -->
    <div class="docs-wrapper">
      <div class="docs-layout-grid">
        
        <!-- Sticky Sidebar Index Navigation -->
        <aside class="docs-aside-sidebar">
          <h3 class="docs-sidebar-title">Table of Contents</h3>
          <nav class="docs-nav-menu" id="docs-sidebar-nav">
            <a href="#getting-started" class="docs-menu-item active">
              <?= lucide_icon('BookOpen', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Getting Started</span>
            </a>
            <a href="#integration" class="docs-menu-item">
              <?= lucide_icon('Terminal', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Syslog Integration</span>
            </a>
            <a href="#features" class="docs-menu-item">
              <?= lucide_icon('Shield', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Core Features</span>
            </a>
            <a href="#deployment" class="docs-menu-item">
              <?= lucide_icon('Server', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Deployment Details</span>
            </a>
            <a href="#troubleshooting" class="docs-menu-item">
              <?= lucide_icon('HelpCircle', 'w-4 h-4 lg:w-5 h-5 shrink-0') ?>
              <span>Troubleshooting</span>
            </a>
          </nav>
        </aside>

        <!-- Main Articles Column -->
        <article class="docs-articles-wrapper" id="docs-content-container">
        
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
            <p>
              Welcome to the <strong class="text-white">SYNALYZE</strong> documentation workspace. SYNALYZE is a state-of-the-art Network Attached Storage (NAS) log management and security auditing software developed by <strong class="text-white">Active Solutions</strong>. 
            </p>
            <p>
              Our cloud-based architecture captures, securely archives, and visualizes system actions, file modifications, access sessions, and configuration activities across your entire global enterprise NAS fleet.
            </p>
            
            <div class="bg-[#111216] rounded-2xl p-6 border border-white/5 mt-8">
              <h4 class="text-white font-bold mb-4 flex items-center gap-2 text-lg">
                <?= lucide_icon('Cpu', 'text-accent w-5 h-5') ?>
                How SYNALYZE Works
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-gray-400">
                <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                  <span class="text-xs uppercase font-extrabold text-accent">Step 1</span>
                  <h5 class="text-white font-semibold">NAS Forwarding</h5>
                  <p class="text-xs leading-normal">Your NAS device streams syslogs securely via standard UDP/TCP protocol pipelines.</p>
                </div>
                <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                  <span class="text-xs uppercase font-extrabold text-accent">Step 2</span>
                  <h5 class="text-white font-semibold">Cloud Processing</h5>
                  <p class="text-xs leading-normal">SYNALYZE ingestion pipelines filter, parse, and structure nested syslog payloads instantly.</p>
                </div>
                <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                  <span class="text-xs uppercase font-extrabold text-accent">Step 3</span>
                  <h5 class="text-white font-semibold">Interactive Audit</h5>
                  <p class="text-xs leading-normal">Interactive tables, timelines, and downloadable reports reflect the logs immediately.</p>
                </div>
              </div>
            </div>
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
              To begin auditing your storage activity, configure your NAS hardware to stream syslogs to the SYNALYZE Collector. Below are step-by-step instructions for the industry's leading global NAS brands.
            </p>

            <!-- Synology Tab/Accordion -->
            <div class="border border-white/5 rounded-2xl bg-[#111216]/50 overflow-hidden">
              <div class="bg-[#111216] px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm" style="background-color: rgba(var(--accent-rgb), 0.2); color: var(--accent-color);">S</span>
                  <h3 class="text-white font-semibold text-lg">Synology NAS Setup Guide</h3>
                </div>
                <span class="text-xs text-gray-400 font-mono bg-white/5 px-2 py-1 rounded">Syslog V2</span>
              </div>
              <div class="p-6 space-y-4 text-sm">
                <ol class="list-decimal list-inside space-y-3">
                  <li>Log into your Synology DiskStation Manager (DSM) administrator panel.</li>
                  <li>Install and open the <strong class="text-white">Log Center</strong> package from the Package Center.</li>
                  <li>Navigate to <strong class="text-white">Log Sending</strong> in the left sidebar menu.</li>
                  <li>Check the box to <strong class="text-white">Enable sending logs to syslog server</strong>.</li>
                  <li>Enter the following configurations:</li>
                </ol>

                <!-- Configuration Table -->
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
                      <tr>
                        <td class="py-2.5 font-semibold text-white">Server address</td>
                        <td class="py-2.5 font-mono text-accent">sg-analyzer.synalyze.net</td>
                        <td class="py-2.5 text-gray-400">Destination hostname for the active cloud pipeline</td>
                      </tr>
                      <tr>
                        <td class="py-2.5 font-semibold text-white">Port</td>
                        <td class="py-2.5 font-mono text-accent">514</td>
                        <td class="py-2.5 text-gray-400">Standard secure port for log streaming</td>
                      </tr>
                      <tr>
                        <td class="py-2.5 font-semibold text-white">Transfer protocol</td>
                        <td class="py-2.5 font-mono text-accent">UDP</td>
                        <td class="py-2.5 text-gray-400">Low-latency User Datagram Protocol connection</td>
                      </tr>
                      <tr>
                        <td class="py-2.5 font-semibold text-white">Log format</td>
                        <td class="py-2.5 font-mono text-accent">IETF (RFC 5424)</td>
                        <td class="py-2.5 text-gray-400">Recommended standard syslog format structure</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="pt-2">
                  <p class="mb-2 text-xs text-gray-400 font-semibold">Example Syslog Destination Connection String:</p>
                  <div class="bg-[#111216] border border-white/5 rounded-xl p-3 flex items-center justify-between font-mono text-xs">
                    <span id="conn-synology" class="text-gray-300">udp://sg-analyzer.synalyze.net:514</span>
                    <button onclick="copyToClipboard('conn-synology', this)" class="text-xs text-accent hover:underline flex items-center gap-1">
                      <?= lucide_icon('Copy', 'w-4 h-4') ?>
                      <span>Copy</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- QNAP Tab/Accordion -->
            <div class="border border-white/5 rounded-2xl bg-[#111216]/50 overflow-hidden mt-6">
              <div class="bg-[#111216] px-6 py-4 border-b border-white/5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <span class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm" style="background-color: rgba(var(--accent-rgb), 0.2); color: var(--accent-color);">Q</span>
                  <h3 class="text-white font-semibold text-lg">QNAP NAS Setup Guide</h3>
                </div>
                <span class="text-xs text-gray-400 font-mono bg-white/5 px-2 py-1 rounded">QuLog</span>
              </div>
              <div class="p-6 space-y-4 text-sm">
                <ol class="list-decimal list-inside space-y-3">
                  <li>Access your QNAP QTS administrative dashboard.</li>
                  <li>Launch the <strong class="text-white">QuLog Center</strong> application workspace.</li>
                  <li>Navigate to <strong class="text-white">Log Sender</strong> under the side menu.</li>
                  <li>Click <strong class="text-white">Add Connection</strong> or create a new destination record.</li>
                  <li>Specify the host parameters:</li>
                </ol>

                <div class="bg-[#111216] p-4 rounded-xl border border-white/5 font-mono text-xs text-gray-400 space-y-1.5 mt-2">
                  <p><span class="text-gray-500"># Hostname:</span> <span class="text-white">sg-analyzer.synalyze.net</span></p>
                  <p><span class="text-gray-500"># Port:</span> <span class="text-white">514</span></p>
                  <p><span class="text-gray-500"># Protocol:</span> <span class="text-white">UDP</span></p>
                  <p><span class="text-gray-500"># Log Type:</span> <span class="text-white">System Events & Access Logs</span></p>
                </div>

                <div class="pt-2">
                  <p class="mb-2 text-xs text-gray-400 font-semibold">Test Payload Connection Host:</p>
                  <div class="bg-[#111216] border border-white/5 rounded-xl p-3 flex items-center justify-between font-mono text-xs">
                    <span id="conn-qnap" class="text-gray-300">sg-analyzer.synalyze.net</span>
                    <button onclick="copyToClipboard('conn-qnap', this)" class="text-xs text-accent hover:underline flex items-center gap-1">
                      <?= lucide_icon('Copy', 'w-4 h-4') ?>
                      <span>Copy</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>

        <!-- SECTION 3: Core Features -->
        <section id="features" class="docs-section scroll-mt-28 bg-[#181a20]/30 border border-white/5 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-white/10">
          <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl rounded-full pointer-events-none" style="background-image: linear-gradient(to bottom left, rgba(var(--accent-rgb), 0.05), transparent);"></div>
          <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color);">
              <?= lucide_icon('Shield', 'w-6 h-6') ?>
            </div>
            <h2 class="text-3xl font-bold tracking-tight">Core Features</h2>
          </div>
          
          <div class="space-y-6 text-gray-300 leading-relaxed text-base">
            <p>
              Once syslogs are configured, the SYNALYZE suite enables critical cybersecurity monitoring and analytics capabilities across your system:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
              <div class="bg-[#111216] border border-white/5 p-6 rounded-2xl space-y-3">
                <div class="text-accent"><?= lucide_icon('Search', 'w-8 h-8') ?></div>
                <h4 class="text-white font-bold text-lg">Real-Time Access Auditing</h4>
                <p class="text-sm text-gray-400 leading-normal">
                  Record exact file access history, creation details, and directory changes. Trace user IP details, connection types, and modification events immediately.
                </p>
              </div>

              <div class="bg-[#111216] border border-white/5 p-6 rounded-2xl space-y-3">
                <div class="text-accent"><?= lucide_icon('BarChart3', 'w-8 h-8') ?></div>
                <h4 class="text-white font-bold text-lg">Beautiful Data Visualization</h4>
                <p class="text-sm text-gray-400 leading-normal">
                  Convert complex syslog strings into interactive chart interfaces, activity flow maps, traffic density indicators, and system capacity graphs.
                </p>
              </div>

              <div class="bg-[#111216] border border-white/5 p-6 rounded-2xl space-y-3">
                <div class="text-accent"><?= lucide_icon('BellRing', 'w-8 h-8') ?></div>
                <h4 class="text-white font-bold text-lg">Intelligent Alerts & Triggers</h4>
                <p class="text-sm text-gray-400 leading-normal">
                  Establish threshold alarms for anomalous activities like recursive file moves, off-hours administrative access, or consecutive brute force login failures.
                </p>
              </div>

              <div class="bg-[#111216] border border-white/5 p-6 rounded-2xl space-y-3">
                <div class="text-accent"><?= lucide_icon('FileText', 'w-8 h-8') ?></div>
                <h4 class="text-white font-bold text-lg">Structured Report Exports</h4>
                <p class="text-sm text-gray-400 leading-normal">
                  Create compliance reports for ISO 27001, HIPAA, or internal audits. Securely download and compile filtered audit histories in XLSX, CSV, or PDF formats.
                </p>
              </div>
            </div>
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
          
          <div class="space-y-6 text-gray-300 leading-relaxed text-base">
            <p>
              SYNALYZE is engineered for versatility, offering two primary hosting models to match your company's data sovereignty, internal compliance, and IT policies.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
              <!-- Cloud Model -->
              <div class="rounded-2xl p-6 flex flex-col justify-between" style="border: 1px solid rgba(var(--accent-rgb), 0.3); background-color: rgba(var(--accent-rgb), 0.05);">
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <span class="px-2.5 py-0.5 rounded text-[10px] uppercase font-bold text-white bg-accent">Recommended</span>
                    <?= lucide_icon('Cloud', 'text-accent w-7 h-7') ?>
                  </div>
                  <h4 class="text-white text-xl font-bold">Cloud Hosted SaaS</h4>
                  <p class="text-sm text-gray-400 leading-relaxed">
                    SYNALYZE hosts and coordinates your log aggregation framework via secure AWS/Azure distributed clusters. Continuous backups, software updates, and high availability metrics are fully automated.
                  </p>
                  <ul class="text-xs text-gray-400 space-y-2 pt-2">
                    <li class="flex items-center gap-2">
                      <span class="text-accent">✓</span> Zero server maintenance requirements
                    </li>
                    <li class="flex items-center gap-2">
                      <span class="text-accent">✓</span> Secure remote TLS token access
                    </li>
                    <li class="flex items-center gap-2">
                      <span class="text-accent">✓</span> Automatic scaling of storage buckets
                    </li>
                  </ul>
                </div>
              </div>

              <!-- On-Premise Model -->
              <div class="border border-white/5 bg-[#1a1b22]/50 rounded-2xl p-6 flex flex-col justify-between">
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <span class="px-2.5 py-0.5 rounded text-[10px] uppercase font-bold bg-white/5 text-gray-400">Enterprise</span>
                    <?= lucide_icon('HardDrive', 'text-accent w-7 h-7') ?>
                  </div>
                  <h4 class="text-white text-xl font-bold">On-Premise (Private Cloud)</h4>
                  <p class="text-sm text-gray-400 leading-relaxed">
                    Deploy the SYNALYZE stack directly as a containerized virtual engine (Docker Compose or Kubernetes helm chart) inside your localized corporate data network or private cloud environment.
                  </p>
                  <ul class="text-xs text-gray-400 space-y-2 pt-2">
                    <li class="flex items-center gap-2">
                      <span class="text-accent">✓</span> Absolute data sovereignty and control
                    </li>
                    <li class="flex items-center gap-2">
                      <span class="text-accent">✓</span> Zero outbound traffic to external systems
                    </li>
                    <li class="flex items-center gap-2">
                      <span class="text-accent">✓</span> Integrates with local AD / LDAP directory servers
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- SECTION 5: Troubleshooting -->
        <section id="troubleshooting" class="docs-section scroll-mt-28 bg-[#181a20]/30 border border-white/5 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-white/10">
          <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl rounded-full pointer-events-none" style="background-image: linear-gradient(to bottom left, rgba(var(--accent-rgb), 0.05), transparent);"></div>
          <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: rgba(var(--accent-rgb), 0.1); color: var(--accent-color);">
              <?= lucide_icon('HelpCircle', 'w-6 h-6') ?>
            </div>
            <h2 class="text-3xl font-bold tracking-tight">Troubleshooting</h2>
          </div>
          
          <div class="space-y-6 text-gray-300 leading-relaxed text-base">
            <p>
              If your dashboard is not displaying log activities or sync indicators are failing, cross-reference the following system checks.
            </p>

            <div class="space-y-4">
              <details class="bg-[#111216] border border-white/5 rounded-xl group p-4">
                <summary class="flex items-center justify-between font-semibold text-white cursor-pointer select-none">
                  <span>1. NAS log sending shows success, but Dashboard is empty</span>
                  <span class="text-accent transition-transform duration-300 group-open:rotate-180">▼</span>
                </summary>
                <div class="text-xs text-gray-400 mt-3 pl-2 border-l leading-relaxed" style="border-left-color: rgba(var(--accent-rgb), 0.4);">
                  Verify that the active user registration email in the portal matches the configured Synology/QNAP device client tokens, and that the storage account matches. If there is a system identity gap, log entries will filter to safe backup blocks rather than rendering on standard user screens.
                </div>
              </details>

              <details class="bg-[#111216] border border-white/5 rounded-xl group p-4">
                <summary class="flex items-center justify-between font-semibold text-white cursor-pointer select-none">
                  <span>2. Port 514 Connection Timeouts</span>
                  <span class="text-accent transition-transform duration-300 group-open:rotate-180">▼</span>
                </summary>
                <div class="text-xs text-gray-400 mt-3 pl-2 border-l leading-relaxed" style="border-left-color: rgba(var(--accent-rgb), 0.4);">
                  Verify that outbound internet traffic configurations on your localized office firewall allow outgoing UDP packets on Port 514. Some enterprise corporate routers block outbound standard syslog pipelines by default.
                </div>
              </details>

              <details class="bg-[#111216] border border-white/5 rounded-xl group p-4">
                <summary class="flex items-center justify-between font-semibold text-white cursor-pointer select-none">
                  <span>3. High Volume Log Sync Throttle</span>
                  <span class="text-accent transition-transform duration-300 group-open:rotate-180">▼</span>
                </summary>
                <div class="text-xs text-gray-400 mt-3 pl-2 border-l leading-relaxed" style="border-left-color: rgba(var(--accent-rgb), 0.4);">
                  For devices with heavy system logging (above 100 entries per second), we recommend using QNAP/Synology local caching buffers or upgrading your active subscription to the Business tier to scale sync execution queues.
                </div>
              </details>
            </div>

            <!-- Support Box -->
            <div class="border rounded-2xl p-6 mt-8" style="border-color: rgba(var(--accent-rgb), 0.3); background-image: linear-gradient(to right, rgba(var(--accent-rgb), 0.15), rgba(var(--accent-rgb), 0.05));">
              <h4 class="text-white font-bold mb-2 text-lg">Still Need Assistance?</h4>
              <p class="text-sm text-gray-300 leading-normal mb-4">
                Our active VIP engineering support is online 24/7 to help you configure custom router pipelines or troubleshoot syslog connections.
              </p>
              <div class="flex flex-wrap gap-4 text-xs">
                <a href="<?= e(baseUrl('/contact')) ?>" class="button-accent text-white px-4 py-2 rounded-lg font-semibold transition-all flex items-center gap-1.5">
                  <?= lucide_icon('Mail', 'w-4 h-4') ?> Contact VIP Support
                </a>
                <a href="tel:+94764404456" class="border text-white px-4 py-2 rounded-lg font-semibold transition-colors flex items-center gap-1.5" style="border-color: rgba(var(--accent-rgb), 0.4);">
                  <?= lucide_icon('Phone', 'w-4 h-4') ?> 076 440 4456
                </a>
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
    const scrollPos = window.scrollY + 150; // offset for sticky header
    
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
  
  // 2. Search Box Live Filtering Logic
  const searchInput = document.getElementById('docs-search-input');
  const clearBtn = document.getElementById('clear-search-btn');
  const contentSections = document.querySelectorAll('.docs-section');
  
  searchInput.addEventListener('input', (e) => {
    const query = e.target.value.toLowerCase().trim();
    
    if (query.length > 0) {
      clearBtn.classList.remove('hidden');
    } else {
      clearBtn.classList.add('hidden');
    }
    
    contentSections.forEach(section => {
      const textContent = section.textContent.toLowerCase();
      const match = textContent.includes(query);
      
      if (match) {
        section.style.display = 'block';
        // Add subtle highlight marker if matching
        section.classList.remove('opacity-30');
      } else {
        section.style.display = 'none';
        section.classList.add('opacity-30');
      }
    });
    
    // If all hidden, show a dynamic message (optional helper)
    const activeSections = Array.from(contentSections).filter(s => s.style.display !== 'none');
    let noResultsMsg = document.getElementById('docs-no-results');
    
    if (activeSections.length === 0) {
      if (!noResultsMsg) {
        noResultsMsg = document.createElement('div');
        noResultsMsg.id = 'docs-no-results';
        noResultsMsg.className = 'text-center py-12 text-gray-500 text-lg border border-white/5 rounded-3xl bg-[#181a20]/20';
        noResultsMsg.innerHTML = `
          <i data-lucide="info" class="w-12 h-12 mx-auto text-gray-600 mb-3"></i>
          <p>No matching documentation articles found for "${e.target.value}"</p>
        `;
        document.getElementById('docs-content-container').appendChild(noResultsMsg);
        lucide.createIcons();
      }
    } else {
      if (noResultsMsg) {
        noResultsMsg.remove();
      }
    }
  });
  
  clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    clearBtn.classList.add('hidden');
    contentSections.forEach(section => {
      section.style.display = 'block';
      section.classList.remove('opacity-30');
    });
    const noResultsMsg = document.getElementById('docs-no-results');
    if (noResultsMsg) noResultsMsg.remove();
  });
  
  // 3. Smooth sidebar scroll offsets
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = link.getAttribute('href').substring(1);
      const targetSec = document.getElementById(targetId);
      
      if (targetSec) {
        // Clear query filters when clicking sidebar links to avoid navigation blocks
        searchInput.value = '';
        clearBtn.classList.add('hidden');
        contentSections.forEach(s => s.style.display = 'block');
        const noResultsMsg = document.getElementById('docs-no-results');
        if (noResultsMsg) noResultsMsg.remove();

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

// 4. Global Clipboard Utility Function
function copyToClipboard(elementId, btn) {
  const copyText = document.getElementById(elementId).innerText;
  
  navigator.clipboard.writeText(copyText).then(() => {
    // Show temporary success feedback
    const originalContent = btn.innerHTML;
    btn.innerHTML = `
      <i data-lucide="check" class="w-4 h-4 text-emerald-400"></i>
      <span class="text-emerald-400 font-semibold">Copied!</span>
    `;
    lucide.createIcons();
    
    setTimeout(() => {
      btn.innerHTML = originalContent;
      lucide.createIcons();
    }, 2000);
  }).catch(err => {
    console.error('Could not copy text: ', err);
  });
}
</script>
