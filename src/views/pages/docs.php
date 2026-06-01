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
            SYNALYZE Knowledge Base
          </div>
          <h1 class="text-3xl sm:text-5xl md:text-6xl font-bold tracking-tight mb-6">
            Documentation
          </h1>
          <p class="text-lg text-gray-400 leading-relaxed max-w-2xl">
            Learn how to navigate and maximize the Synalyzer platform's monitoring capabilities for your global enterprise NAS fleet.
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
            <p>
              Welcome to the <strong class="text-white">SYNALYZE</strong> documentation workspace. SYNALYZE is a state-of-the-art Network Attached Storage (NAS) log management and security auditing software developed by <strong class="text-white">Active Solutions</strong>. 
            </p>
            <p>
              Our architecture captures, securely archives, and visualizes system actions, file modifications, access sessions, and configuration activities across your entire global enterprise NAS fleet.
            </p>
            
            <div class="bg-[#111216] rounded-2xl p-6 border border-white/5 mt-8">
              <h4 class="text-white font-bold mb-4 flex items-center gap-2 text-lg">
                <?= lucide_icon('Cpu', 'text-accent w-5 h-5') ?>
                4-Step Onboarding Flow
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-sm text-gray-400">
                <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                  <span class="text-xs uppercase font-extrabold text-accent">01</span>
                  <h5 class="text-white font-semibold">Log In</h5>
                  <p class="text-xs leading-normal">Access your secure portal using your provided credentials.</p>
                </div>
                <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                  <span class="text-xs uppercase font-extrabold text-accent">02</span>
                  <h5 class="text-white font-semibold">Register Devices</h5>
                  <p class="text-xs leading-normal">Connect your log sources in the Device Management module.</p>
                </div>
                <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                  <span class="text-xs uppercase font-extrabold text-accent">03</span>
                  <h5 class="text-white font-semibold">Set Up Alerts</h5>
                  <p class="text-xs leading-normal">Configure notifications for critical security events.</p>
                </div>
                <div class="space-y-2 bg-white/5 p-4 rounded-xl">
                  <span class="text-xs uppercase font-extrabold text-accent">04</span>
                  <h5 class="text-white font-semibold">Run a Search</h5>
                  <p class="text-xs leading-normal">Query millions of logs instantly in Universal Search.</p>
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
              To begin auditing your storage activity, configure your NAS hardware to stream syslogs to the SYNALYZE platform. Below is the setup guide for Synology devices.
            </p>

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
                        <td class="py-2.5 font-mono text-accent">[Your Unique Assigned Port]</td>
                        <td class="py-2.5 text-gray-400">Dynamically assigned to your device in the Dashboard for isolated log ingestion</td>
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

                <div class="mt-4 p-4 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-200 text-xs leading-relaxed">
                  <strong>Important Note on Ports:</strong> Unlike standard syslog servers that use a generic port (like 514), SYNALYZE generates a unique, isolated port for every customer and device (e.g. 2016, 2024). You must check the <strong>Device Management</strong> module in your dashboard to find the exact port assigned to your NAS before completing the setup.
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
              In-Depth Software Documentation detailing step-by-step instructions for every feature and module in the Synalyzer dashboard.
            </p>
          </div>

          <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            
            <!-- Module 1: Main Dashboard -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('LayoutDashboard', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Main Dashboard</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">The central command center providing a high-level overview of your entire network infrastructure.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Stats Overview:</strong> Check the high-level cards at the top of the dashboard. 'Total Logs' shows the entire ingestion count, while 'Active Devices' shows exactly how many collectors are online right now.</li>
                <li><strong class="text-white block mb-1">Activity Trends:</strong> Use the visual charts to spot anomalies quickly. If there's a huge surge in logs, it might indicate an ongoing attack or system failure.</li>
                <li><strong class="text-white block mb-1">Device Status:</strong> Scroll to the Device Status grid view. Here you can see every single collector, its IP address, and an active heartbeat signal. Red means the device has lost connection.</li>
                <li><strong class="text-white block mb-1">Deep-Dive Links:</strong> Click on any summary card to automatically navigate to the deep-dive analytics module for that specific log category.</li>
              </ul>
            </div>

            <!-- Module 2: Universal Search -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('Search', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Universal Search</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Engineered for forensic analysis, allowing you to query millions of logs in seconds.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Querying Logs:</strong> Enter your search terms into the main search input. You can type specific file names, usernames, or error codes (e.g., 'failed password').</li>
                <li><strong class="text-white block mb-1">Filtering by Date & Severity:</strong> Use the sidebar to pick a specific date range. Below that, check the boxes for severity thresholds like 'Error' or 'Critical' to only see major issues.</li>
                <li><strong class="text-white block mb-1">Applying Granular Filters:</strong> If you want logs from a specific server, type the device name or IP in the Device filter. You can also filter by specific users.</li>
                <li><strong class="text-white block mb-1">Exporting Results:</strong> Once you've narrowed down your search, click the 'Export' button on the top right. Select CSV or PDF to download the results for compliance or reporting.</li>
              </ul>
            </div>

            <!-- Module 3: Log Analytics -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('BarChart3', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Log Analytics</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Pre-summarized insights categorized by system behavior and user interactions.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">User Activity:</strong> Navigate to the 'User Activity' tab to see what users are doing on the NAS. This tracks regular logins and administrative settings changes.</li>
                <li><strong class="text-white block mb-1">Sign-ins Tracking:</strong> Go to the 'Sign-ins' section to see a list of authentication attempts. Pay special attention to 'Failed' login attempts which could signal a brute force attack.</li>
                <li><strong class="text-white block mb-1">File Operations:</strong> The 'File Operations' module details every file create, read, update, or delete action. Use this to track down exactly who modified a sensitive document.</li>
                <li><strong class="text-white block mb-1">Time-Based Trends:</strong> Use the time toggle at the top of the screen (24h, 7d, 30d) to expand the charts and see historical trends rather than just current data.</li>
              </ul>
            </div>

            <!-- Module 4: Alerts Management -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('BellRing', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Alerts Management</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Proactive notification system designed to highlight critical security incidents.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Reviewing Alerts:</strong> Go to the Alerts page to review real-time notifications. These are categorized by severity levels. Critical alerts are highlighted in red.</li>
                <li><strong class="text-white block mb-1">Investigating an Alert:</strong> Click on any alert in the table to open its detailed view. This will show you exactly which log triggered the alert and the device it originated from.</li>
                <li><strong class="text-white block mb-1">Marking as Read:</strong> Once you have addressed an alert, click the 'Mark as Read' button or the checkmark icon. This moves it off your active queue but keeps it in history.</li>
                <li><strong class="text-white block mb-1">Filtering Alerts:</strong> Use the status toggle to switch between 'Unread' (active issues) and 'All' (historical issues) to manage your daily workflow.</li>
              </ul>
            </div>

            <!-- Module 5: Reports & Summaries -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('FileText', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Reports & Summaries</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Official documentation for stakeholders, including user behavior and system health audits.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Selecting Report Type:</strong> Navigate to the Reports module. Choose either a 'User Activity Report' for detailed user logs, or an 'Activity Calendar' for a day-by-day heat map.</li>
                <li><strong class="text-white block mb-1">Defining Parameters:</strong> Use the date picker to choose the exact timeline for the report. Then select the specific user or device you want to run the report on.</li>
                <li><strong class="text-white block mb-1">Generating and Reviewing:</strong> Click 'Generate'. The system will compile the data and show you a preview of the report directly in the dashboard interface.</li>
                <li><strong class="text-white block mb-1">Export Options:</strong> Click 'Export PDF' or 'Export Excel' to download a beautifully formatted, official document that you can hand to stakeholders or auditors.</li>
              </ul>
            </div>

            <!-- Module 6: Secure Folders -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('FolderLock', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Secure Folders</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Hardened monitoring for sensitive directory paths such as HR, Finance, or intellectual property.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Configuration:</strong> First, in your machine's collector settings, define the exact directory paths (like 'C:/Finance' or '/var/www') that you want to monitor.</li>
                <li><strong class="text-white block mb-1">Monitoring Access:</strong> In the Synalyzer dashboard, go to the Secure Folders module. Here you'll see a dedicated feed of only the logs associated with your protected directories.</li>
                <li><strong class="text-white block mb-1">Intruder Detection:</strong> If an unauthorized user or IP interacts with a monitored folder, this module automatically flags the event as an 'Intruder' and triggers an alert.</li>
                <li><strong class="text-white block mb-1">Reviewing the Log Trail:</strong> Click on any file operation event to see the exact timestamp, the user account involved, and whether they read, modified, or deleted the file.</li>
              </ul>
            </div>

            <!-- Module 7: Honeypot Decoys -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('Shield', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Honeypot Decoys</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Deception-based detection strategy to trap internal or external threats silently.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Creating a Bait File:</strong> Create a fake, highly enticing file on your servers — for example, 'root_passwords.txt'. Put it somewhere an intruder would look, but regular employees wouldn't.</li>
                <li><strong class="text-white block mb-1">Setting up the Trap:</strong> In the Synalyzer collector configuration for that device, specify the path to your new bait file as a Honeypot trap.</li>
                <li><strong class="text-white block mb-1">Silent Monitoring:</strong> The Honeypot module monitors that file silently. Legitimate users have no reason to touch it, so any interaction is a guaranteed threat.</li>
                <li><strong class="text-white block mb-1">Immediate Escalation:</strong> If the file is opened or copied, an immediate Critical Alert is fired, and the Honeypot dashboard will show you the exact IP and user account of the intruder.</li>
              </ul>
            </div>

            <!-- Module 8: Device Management -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('Server', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Device Management</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Administration hub for all hardware and collectors reporting into the system.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Viewing Inventory:</strong> Go to Device Management to see your complete inventory of log collectors across the NAS. The grid shows their IP addresses, names, and assigned groups.</li>
                <li><strong class="text-white block mb-1">Checking Health Status:</strong> Look at the 'Last Heartbeat' column. A green indicator means the device is actively sending logs. Red means it has gone offline.</li>
                <li><strong class="text-white block mb-1">Registering a New Device:</strong> Click 'Add Device'. Fill in the details for the new server or collector. The system will generate a unique registration key for that collector to use.</li>
                <li><strong class="text-white block mb-1">Configuration Updates:</strong> Click on a device in the list to edit its settings, such as changing its IP, updating its name, or tweaking how often it polls for logs.</li>
              </ul>
            </div>

            <!-- Module 9: Administration (RBAC) -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('Users', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Administration (RBAC)</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">Security governance and user management for the Synalyzer platform itself.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Managing Users:</strong> Go to the Administration page to see all accounts that have access to the Synalyzer dashboard. You can create new accounts or disable old ones.</li>
                <li><strong class="text-white block mb-1">Role Assignment:</strong> When creating a user, assign them a specific Role (e.g., Viewer, Operator, Super Admin). This principle of least privilege ensures they only see what they need to.</li>
                <li><strong class="text-white block mb-1">Audit Logging:</strong> The System Audit Log shows what your administrators are doing inside the dashboard — such as if an admin edits another user's permissions or deletes an alert.</li>
                <li><strong class="text-white block mb-1">Revoking Access:</strong> If an employee leaves, simply click 'Deactivate' next to their name. Their access is revoked instantly, keeping the platform inherently secure.</li>
              </ul>
            </div>

            <!-- Module 10: Profile & Licensing -->
            <div class="bg-[#111216] border border-white/5 rounded-2xl p-6 flex flex-col h-full">
              <div class="flex items-center gap-3 mb-3">
                <?= lucide_icon('Key', 'text-accent w-6 h-6') ?>
                <h3 class="text-xl font-bold text-white">Profile & Licensing</h3>
              </div>
              <p class="text-sm text-gray-400 mb-6">System-wide metadata, activation details, and company branding settings.</p>
              <ul class="space-y-4 text-xs mt-auto">
                <li><strong class="text-white block mb-1">Verifying Your License:</strong> Navigate to the Profile page. Here you can see your current Activation Key, the date it started, and precisely how many days until it expires.</li>
                <li><strong class="text-white block mb-1">Checking Technical Settings:</strong> The profile view also displays the port number your analyzer engine is actively listening on.</li>
                <li><strong class="text-white block mb-1">Capacity Monitoring:</strong> Review your 'Device Usage' bar. It shows how many devices you currently have registered out of your maximum licensed capacity.</li>
                <li><strong class="text-white block mb-1">Company Details:</strong> View your registered company details to ensure your official branding and contact information match your deployment records.</li>
              </ul>
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
          
          <div class="space-y-8 text-gray-300 leading-relaxed text-base">
            <p>
              SYNALYZE is engineered for enterprise versatility, offering two primary hosting models alongside rigorous security architectures to match your company's data sovereignty, internal compliance, and IT policies.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <!-- Cloud Model -->
              <div class="rounded-2xl p-6 flex flex-col" style="border: 1px solid rgba(var(--accent-rgb), 0.3); background-color: rgba(var(--accent-rgb), 0.05);">
                <div class="flex items-center justify-between mb-4">
                  <span class="px-2.5 py-0.5 rounded text-[10px] uppercase font-bold text-white bg-accent">Recommended</span>
                  <?= lucide_icon('Cloud', 'text-accent w-7 h-7') ?>
                </div>
                <h4 class="text-white text-xl font-bold mb-3">Cloud Bases</h4>
                <p class="text-sm text-gray-400 leading-relaxed mb-4">
                  SYNALYZE hosts and coordinates your log aggregation framework via secure, geo-redundant distributed clusters on AWS and Azure. This model eliminates infrastructure overhead.
                </p>
                <ul class="text-xs text-gray-400 space-y-3 mt-auto">
                  <li class="flex items-start gap-2">
                    <span class="text-accent mt-0.5">✓</span>
                    <div>
                      <strong class="text-white">Auto-Scaling Infrastructure:</strong> 
                      Automatically scales storage buckets and processing queues during peak log ingestion bursts.
                    </div>
                  </li>
                  <li class="flex items-start gap-2">
                    <span class="text-accent mt-0.5">✓</span> 
                    <div>
                      <strong class="text-white">Zero Maintenance:</strong> 
                      Continuous automated backups and frictionless software updates without downtime.
                    </div>
                  </li>
                  <li class="flex items-start gap-2">
                    <span class="text-accent mt-0.5">✓</span> 
                    <div>
                      <strong class="text-white">High Availability:</strong> 
                      Multi-zone redundancy ensures your log auditing pipeline never drops a packet.
                    </div>
                  </li>
                </ul>
              </div>

              <!-- On-Premise Model -->
              <div class="border border-white/5 bg-[#1a1b22]/50 rounded-2xl p-6 flex flex-col">
                <div class="flex items-center justify-between mb-4">
                  <span class="px-2.5 py-0.5 rounded text-[10px] uppercase font-bold bg-white/5 text-gray-400">Enterprise</span>
                  <?= lucide_icon('HardDrive', 'text-accent w-7 h-7') ?>
                </div>
                <h4 class="text-white text-xl font-bold mb-3">On-Premises</h4>
                <p class="text-sm text-gray-400 leading-relaxed mb-4">
                  Install and run the SYNALYZE software directly on your company's own physical servers and machines within your localized network.
                </p>
                <ul class="text-xs text-gray-400 space-y-3 mt-auto">
                  <li class="flex items-start gap-2">
                    <span class="text-accent mt-0.5">✓</span> 
                    <div>
                      <strong class="text-white">Absolute Data Sovereignty:</strong> 
                      Log data never leaves your corporate perimeter, ensuring strict internal compliance.
                    </div>
                  </li>
                  <li class="flex items-start gap-2">
                    <span class="text-accent mt-0.5">✓</span> 
                    <div>
                      <strong class="text-white">Containerized Rollout:</strong> 
                      Ready-to-deploy Docker Compose and Kubernetes Helm chart templates.
                    </div>
                  </li>
                  <li class="flex items-start gap-2">
                    <span class="text-accent mt-0.5">✓</span> 
                    <div>
                      <strong class="text-white">Directory Integration:</strong> 
                      Natively integrates with local Active Directory and LDAP servers for seamless access control.
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Compliance & Security -->
            <div class="mt-8 bg-[#111216] border border-white/5 rounded-2xl p-6">
              <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <?= lucide_icon('ShieldCheck', 'text-accent w-5 h-5') ?>
                Standards & Compliance
              </h4>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                  <h5 class="text-white font-semibold text-sm mb-2">E2E Encryption</h5>
                  <p class="text-xs text-gray-400">Log data is encrypted in transit and at rest using industry-standard TLS protocols.</p>
                </div>
                <div>
                  <h5 class="text-white font-semibold text-sm mb-2">GDPR Compliant</h5>
                  <p class="text-xs text-gray-400">Architected with individual privacy and data sovereignty as a foundational requirement.</p>
                </div>
                <div>
                  <h5 class="text-white font-semibold text-sm mb-2">ISO 27001 Prepared</h5>
                  <p class="text-xs text-gray-400">Supports information security management system (ISMS) controls for enterprise audits.</p>
                </div>
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
              Need technical assistance or have inquiries? Our team is ready to help you configure custom router pipelines or troubleshoot syslog connections.
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
              
              <!-- Troubleshooting FAQs -->
              <div class="space-y-4">
                <h4 class="text-white font-bold text-lg mb-4">Troubleshooting</h4>
                <details class="bg-[#111216] border border-white/5 rounded-xl group p-4">
                  <summary class="flex items-center justify-between font-semibold text-white cursor-pointer select-none">
                    <span class="text-sm">NAS log sending shows success, but Dashboard is empty</span>
                    <span class="text-accent transition-transform duration-300 group-open:rotate-180">▼</span>
                  </summary>
                  <div class="text-xs text-gray-400 mt-3 pl-2 border-l leading-relaxed" style="border-left-color: rgba(var(--accent-rgb), 0.4);">
                    Verify that the active user registration email in the portal matches the configured device client tokens. If there is a system identity gap, log entries will filter to safe backup blocks rather than rendering on standard user screens.
                  </div>
                </details>

                <details class="bg-[#111216] border border-white/5 rounded-xl group p-4">
                  <summary class="flex items-center justify-between font-semibold text-white cursor-pointer select-none">
                    <span class="text-sm">Connection Timeouts on Custom Ports</span>
                    <span class="text-accent transition-transform duration-300 group-open:rotate-180">▼</span>
                  </summary>
                  <div class="text-xs text-gray-400 mt-3 pl-2 border-l leading-relaxed" style="border-left-color: rgba(var(--accent-rgb), 0.4);">
                    Verify that outbound internet traffic configurations on your localized office firewall allow outgoing UDP packets on your assigned collector port. Some enterprise corporate routers block outbound custom syslog pipelines by default.
                  </div>
                </details>
              </div>

              <!-- VIP Contact Info -->
              <div class="border rounded-2xl p-6" style="border-color: rgba(var(--accent-rgb), 0.3); background-image: linear-gradient(to right, rgba(var(--accent-rgb), 0.15), rgba(var(--accent-rgb), 0.05));">
                <h4 class="text-white font-bold mb-6 text-lg">Get in Touch</h4>
                
                <div class="space-y-6">
                  <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-black/40 flex items-center justify-center text-accent shrink-0">
                      <?= lucide_icon('Phone', 'w-5 h-5') ?>
                    </div>
                    <div>
                      <p class="text-sm text-gray-400 mb-1">Help Desk</p>
                      <a href="tel:+94117325200" class="text-lg font-bold text-white hover:text-accent transition-colors">011 732 5200</a>
                    </div>
                  </div>

                  <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-black/40 flex items-center justify-center text-accent shrink-0">
                      <?= lucide_icon('Mail', 'w-5 h-5') ?>
                    </div>
                    <div>
                      <p class="text-sm text-gray-400 mb-1">Support Email</p>
                      <a href="mailto:support@synalyze.net" class="text-lg font-bold text-white hover:text-accent transition-colors">support@synalyze.net</a>
                      <p class="text-xs text-gray-500 mt-1">Average response time is under 4 hours.</p>
                    </div>
                  </div>

                  <div class="pt-4 border-t border-white/10">
                    <p class="text-sm text-gray-400 mb-3 font-semibold">Support Hours</p>
                    <ul class="space-y-2 text-xs text-gray-400">
                      <li class="flex justify-between"><span>Weekdays:</span> <span class="text-white">09:00 AM - 06:00 PM</span></li>
                      <li class="flex justify-between"><span>Saturdays:</span> <span class="text-white">09:00 AM - 01:00 PM</span></li>
                      <li class="flex justify-between"><span>Sundays & Holidays:</span> <span class="text-red-400">Closed</span></li>
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
