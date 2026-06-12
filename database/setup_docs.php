<?php
/**
 * Setup and seeder script for Structured Docs Page tables.
 */

require_once dirname(__DIR__) . '/src/core/Database.php';

echo "Starting structured Docs database setup...\n";

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    
    // Enable foreign keys
    $pdo->exec('PRAGMA foreign_keys = ON;');
    
    // Begin transaction
    $pdo->beginTransaction();
    
    // 1. Drop existing tables to ensure clean schema creation
    $pdo->exec("DROP TABLE IF EXISTS DocsPage");
    $pdo->exec("DROP TABLE IF EXISTS DocsOnboardingStep");
    $pdo->exec("DROP TABLE IF EXISTS DocsIntegrationField");
    $pdo->exec("DROP TABLE IF EXISTS DocsModule");
    $pdo->exec("DROP TABLE IF EXISTS DocsDeploymentOption");
    $pdo->exec("DROP TABLE IF EXISTS DocsComplianceItem");
    $pdo->exec("DROP TABLE IF EXISTS DocsTroubleshootingFaq");

    // 2. Create Tables
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS DocsPage (
        id INTEGER PRIMARY KEY DEFAULT 1,
        eyebrowText TEXT NOT NULL,
        headline TEXT NOT NULL,
        subheadline TEXT NOT NULL,
        gettingStartedIntro TEXT NOT NULL,
        onboardingTitle TEXT NOT NULL,
        integrationIntro TEXT NOT NULL,
        integrationSetupTitle TEXT NOT NULL,
        integrationSetupSubtitle TEXT NOT NULL,
        integrationSetupPortNote TEXT NOT NULL,
        modulesIntro TEXT NOT NULL,
        deploymentIntro TEXT NOT NULL,
        complianceTitle TEXT NOT NULL,
        supportIntro TEXT NOT NULL,
        supportFaqTitle TEXT NOT NULL,
        supportContactTitle TEXT NOT NULL,
        supportPhone TEXT NOT NULL,
        supportEmail TEXT NOT NULL,
        supportEmailNote TEXT NOT NULL,
        supportHoursWeekdays TEXT NOT NULL,
        supportHoursSaturdays TEXT NOT NULL,
        supportHoursSundays TEXT NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS DocsOnboardingStep (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        stepNumber TEXT NOT NULL,
        title TEXT NOT NULL,
        description TEXT NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS DocsIntegrationField (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        fieldName TEXT NOT NULL,
        fieldValue TEXT NOT NULL,
        description TEXT NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS DocsModule (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        iconName TEXT NOT NULL,
        title TEXT NOT NULL,
        description TEXT NOT NULL,
        bulletPoints TEXT NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS DocsDeploymentOption (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        badge TEXT NOT NULL,
        iconName TEXT NOT NULL,
        title TEXT NOT NULL,
        description TEXT NOT NULL,
        bulletPoints TEXT NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS DocsComplianceItem (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT NOT NULL
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS DocsTroubleshootingFaq (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        question TEXT NOT NULL,
        answer TEXT NOT NULL
    )");

    // 2. Clear existing entries
    $pdo->exec("DELETE FROM DocsPage");
    $pdo->exec("DELETE FROM DocsOnboardingStep");
    $pdo->exec("DELETE FROM DocsIntegrationField");
    $pdo->exec("DELETE FROM DocsModule");
    $pdo->exec("DELETE FROM DocsDeploymentOption");
    $pdo->exec("DELETE FROM DocsComplianceItem");
    $pdo->exec("DELETE FROM DocsTroubleshootingFaq");
    
    // Reset sequences
    $pdo->exec("DELETE FROM sqlite_sequence WHERE name IN ('DocsOnboardingStep', 'DocsIntegrationField', 'DocsModule', 'DocsDeploymentOption', 'DocsComplianceItem', 'DocsTroubleshootingFaq')");

    // 3. Seed Tables
    
    // DocsPage
    $stmtPage = $pdo->prepare("INSERT INTO DocsPage (id, eyebrowText, headline, subheadline, gettingStartedIntro, onboardingTitle, integrationIntro, integrationSetupTitle, integrationSetupSubtitle, integrationSetupPortNote, modulesIntro, deploymentIntro, complianceTitle, supportIntro, supportFaqTitle, supportContactTitle, supportPhone, supportEmail, supportEmailNote, supportHoursWeekdays, supportHoursSaturdays, supportHoursSundays) VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtPage->execute([
        'SYNALYZE Knowledge Base',
        'Documentation',
        'Learn how to navigate and maximize the Synalyze platform\'s monitoring capabilities for your global enterprise NAS fleet.',
        "Welcome to the <strong class=\"text-white\">SYNALYZE</strong> documentation workspace. SYNALYZE is a state-of-the-art Network Attached Storage (NAS) log management and security auditing software developed by <strong class=\"text-white\">Active Solutions</strong>.\n\nOur architecture captures, securely archives, and visualizes system actions, file modifications, access sessions, and configuration activities across your entire global enterprise NAS fleet.",
        '4-Step Onboarding Flow',
        'To begin auditing your storage activity, configure your NAS hardware to stream syslogs to the SYNALYZE platform. Below is the setup guide for Synology devices.',
        'Synology NAS Setup Guide',
        'Syslog V2',
        '<strong>Important Note on Ports:</strong> Unlike standard syslog servers that use a generic port (like 514), SYNALYZE generates a unique, isolated port for every customer and device (e.g. 2016, 2024). You must check the <strong>Device Management</strong> module in your dashboard to find the exact port assigned to your NAS before completing the setup.',
        'In-Depth Software Documentation detailing step-by-step instructions for every feature and module in the Synalyze dashboard.',
        'SYNALYZE is engineered for enterprise versatility, offering two primary hosting models alongside rigorous security architectures to match your company\'s data sovereignty, internal compliance, and IT policies.',
        'Standards & Compliance',
        'Need technical assistance or have inquiries? Our team is ready to help you configure custom router pipelines or troubleshoot syslog connections.',
        'Troubleshooting',
        'Get in Touch',
        '+94764404456',
        'support@synalyze.net',
        'Average response time is under 4 hours.',
        '09:00 AM - 06:00 PM',
        '09:00 AM - 01:00 PM',
        'Closed'
    ]);

    // DocsOnboardingStep
    $stmtOnboarding = $pdo->prepare("INSERT INTO DocsOnboardingStep (stepNumber, title, description) VALUES (?, ?, ?)");
    $onboardingSteps = [
        ['01', 'Log In', 'Access your secure portal using your provided credentials.'],
        ['02', 'Register Devices', 'Connect your log sources in the Device Management module.'],
        ['03', 'Set Up Alerts', 'Configure notifications for critical security events.'],
        ['04', 'Run a Search', 'Query millions of logs instantly in Universal Search.']
    ];
    foreach ($onboardingSteps as $step) {
        $stmtOnboarding->execute($step);
    }

    // DocsIntegrationField
    $stmtIntegration = $pdo->prepare("INSERT INTO DocsIntegrationField (fieldName, fieldValue, description) VALUES (?, ?, ?)");
    $integrationFields = [
        ['Server address', 'sg-analyzer.synalyze.net', 'Destination hostname for the active cloud pipeline'],
        ['Port', '[Your Unique Assigned Port]', 'Dynamically assigned to your device in the Dashboard for isolated log ingestion'],
        ['Transfer protocol', 'UDP', 'Low-latency User Datagram Protocol connection'],
        ['Log format', 'IETF (RFC 5424)', 'Recommended standard syslog format structure']
    ];
    foreach ($integrationFields as $field) {
        $stmtIntegration->execute($field);
    }

    // DocsModule
    $stmtModule = $pdo->prepare("INSERT INTO DocsModule (iconName, title, description, bulletPoints) VALUES (?, ?, ?, ?)");
    $modules = [
        [
            'LayoutDashboard', 
            'Main Dashboard', 
            'The central command center providing a high-level overview of your entire network infrastructure.',
            "Stats Overview: Check the high-level cards at the top of the dashboard. 'Total Logs' shows the entire ingestion count, while 'Active Devices' shows exactly how many collectors are online right now.\nActivity Trends: Use the visual charts to spot anomalies quickly. If there's a huge surge in logs, it might indicate an ongoing attack or system failure.\nDevice Status: Scroll to the Device Status grid view. Here you can see every single collector, its IP address, and an active heartbeat signal. Red means the device has lost connection.\nDeep-Dive Links: Click on any summary card to automatically navigate to the deep-dive analytics module for that specific log category."
        ],
        [
            'Search', 
            'Universal Search', 
            'Engineered for forensic analysis, allowing you to query millions of logs in seconds.',
            "Querying Logs: Enter your search terms into the main search input. You can type specific file names, usernames, or error codes (e.g., 'failed password').\nFiltering by Date & Severity: Use the sidebar to pick a specific date range. Below that, check the boxes for severity thresholds like 'Error' or 'Critical' to only see major issues.\nApplying Granular Filters: If you want logs from a specific server, type the device name or IP in the Device filter. You can also filter by specific users.\nExporting Results: Once you've narrowed down your search, click the 'Export' button on the top right. Select CSV or PDF to download the results for compliance or reporting."
        ],
        [
            'BarChart3', 
            'Log Analytics', 
            'Pre-summarized insights categorized by system behavior and user interactions.',
            "User Activity: Navigate to the 'User Activity' tab to see what users are doing on the NAS. This tracks regular logins and administrative settings changes.\nSign-ins Tracking: Go to the 'Sign-ins' section to see a list of authentication attempts. Pay special attention to 'Failed' login attempts which could signal a brute force attack.\nFile Operations: The 'File Operations' module details every file create, read, update, or delete action. Use this to track down exactly who modified a sensitive document.\nTime-Based Trends: Use the time toggle at the top of the screen (24h, 7d, 30d) to expand the charts and see historical trends rather than just current data."
        ],
        [
            'BellRing', 
            'Alerts Management', 
            'Proactive notification system designed to highlight critical security incidents.',
            "Reviewing Alerts: Go to the Alerts page to review real-time notifications. These are categorized by severity levels. Critical alerts are highlighted in red.\nInvestigating an Alert: Click on any alert in the table to open its detailed view. This will show you exactly which log triggered the alert and the device it originated from.\nMarking as Read: Once you have addressed an alert, click the 'Mark as Read' button or the checkmark icon. This moves it off your active queue but keeps it in history.\nFiltering Alerts: Use the status toggle to switch between 'Unread' (active issues) and 'All' (historical issues) to manage your daily workflow."
        ],
        [
            'FileText', 
            'Reports & Summaries', 
            'Official documentation for stakeholders, including user behavior and system health audits.',
            "Selecting Report Type: Navigate to the Reports module. Choose either a 'User Activity Report' for detailed user logs, or an 'Activity Calendar' for a day-by-day heat map.\nDefining Parameters: Use the date picker to choose the exact timeline for the report. Then select the specific user or device you want to run the report on.\nGenerating and Reviewing: Click 'Generate'. The system will compile the data and show you a preview of the report directly in the dashboard interface.\nExport Options: Click 'Export PDF' or 'Export Excel' to download a beautifully formatted, official document that you can hand to stakeholders or auditors."
        ],
        [
            'FolderLock', 
            'Secure Folders', 
            'Hardened monitoring for sensitive directory paths such as HR, Finance, or intellectual property.',
            "Configuration: First, in your machine's collector settings, define the exact directory paths (like 'C:/Finance' or '/var/www') that you want to monitor.\nMonitoring Access: In the Synalyze dashboard, go to the Secure Folders module. Here you'll see a dedicated feed of only the logs associated with your protected directories.\nIntruder Detection: If an unauthorized user or IP interacts with a monitored folder, this module automatically flags the event as an 'Intruder' and triggers an alert.\nReviewing the Log Trail: Click on any file operation event to see the exact timestamp, the user account involved, and whether they read, modified, or deleted the file."
        ],
        [
            'Shield', 
            'Honeypot Decoys', 
            'Deception-based detection strategy to trap internal or external threats silently.',
            "Creating a Bait File: Create a fake, highly enticing file on your servers — for example, 'root_passwords.txt'. Put it somewhere an intruder would look, but regular employees wouldn't.\nSetting up the Trap: In the Synalyze collector configuration for that device, specify the path to your new bait file as a Honeypot trap.\nSilent Monitoring: The Honeypot module monitors that file silently. Legitimate users have no reason to touch it, so any interaction is a guaranteed threat.\nImmediate Escalation: If the file is opened or copied, an immediate Critical Alert is fired, and the Honeypot dashboard will show you the exact IP and user account of the intruder."
        ],
        [
            'Server', 
            'Device Management', 
            'Administration hub for all hardware and collectors reporting into the system.',
            "Viewing Inventory: Go to Device Management to see your complete inventory of log collectors across the NAS. The grid shows their IP addresses, names, and assigned groups.\nChecking Health Status: Look at the 'Last Heartbeat' column. A green indicator means the device is actively sending logs. Red means it has gone offline.\nRegistering a New Device: Click 'Add Device'. Fill in the details for the new server or collector. The system will generate a unique registration key for that collector to use.\nConfiguration Updates: Click on a device in the list to edit its settings, such as changing its IP, updating its name, or tweaking how often it polls for logs."
        ],
        [
            'Users', 
            'Administration (RBAC)', 
            'Security governance and user management for the Synalyze platform itself.',
            "Managing Users: Go to the Administration page to see all accounts that have access to the Synalyze dashboard. You can create new accounts or disable old ones.\nRole Assignment: When creating a user, assign them a specific Role (e.g., Viewer, Operator, Super Admin). This principle of least privilege ensures they only see what they need to.\nAudit Logging: The System Audit Log shows what your administrators are doing inside the dashboard — such as if an admin edits another user's permissions or deletes an alert.\nRevoking Access: If an employee leaves, simply click 'Deactivate' next to their name. Their access is revoked instantly, keeping the platform inherently secure."
        ],
        [
            'Key', 
            'Profile & Licensing', 
            'System-wide metadata, activation details, and company branding settings.',
            "Verifying Your License: Navigate to the Profile page. Here you can see your current Activation Key, the date it started, and precisely how many days until it expires.\nChecking Technical Settings: The profile view also displays the port number your analyzer engine is actively listening on.\nCapacity Monitoring: Review your 'Device Usage' bar. It shows how many devices you currently have registered out of your maximum licensed capacity.\nCompany Details: View your registered company details to ensure your official branding and contact information match your deployment records."
        ]
    ];
    foreach ($modules as $module) {
        $stmtModule->execute($module);
    }

    // DocsDeploymentOption
    $stmtDeployment = $pdo->prepare("INSERT INTO DocsDeploymentOption (badge, iconName, title, description, bulletPoints) VALUES (?, ?, ?, ?, ?)");
    $deployments = [
        [
            'Recommended',
            'Cloud',
            'Cloud Bases',
            'SYNALYZE hosts and coordinates your log aggregation framework via secure, geo-redundant distributed clusters on AWS and Azure. This model eliminates infrastructure overhead.',
            "Auto-Scaling Infrastructure: Automatically scales storage buckets and processing queues during peak log ingestion bursts.\nZero Maintenance: Continuous automated backups and frictionless software updates without downtime.\nHigh Availability: Multi-zone redundancy ensures your log auditing pipeline never drops a packet."
        ],
        [
            'Enterprise',
            'HardDrive',
            'On-Premises',
            'Install and run the SYNALYZE software directly on your company\'s own physical servers and machines within your localized network.',
            "Absolute Data Sovereignty: Log data never leaves your corporate perimeter, ensuring strict internal compliance.\nContainerized Rollout: Ready-to-deploy Docker Compose and Kubernetes Helm chart templates.\nDirectory Integration: Natively integrates with local Active Directory and LDAP servers for seamless access control."
        ]
    ];
    foreach ($deployments as $deploy) {
        $stmtDeployment->execute($deploy);
    }

    // DocsComplianceItem
    $stmtCompliance = $pdo->prepare("INSERT INTO DocsComplianceItem (title, description) VALUES (?, ?)");
    $compliances = [
        ['E2E Encryption', 'Log data is encrypted in transit and at rest using industry-standard TLS protocols.'],
        ['GDPR Compliant', 'Architected with individual privacy and data sovereignty as a foundational requirement.'],
        ['ISO 27001 Prepared', 'Supports information security management system (ISMS) controls for enterprise audits.']
    ];
    foreach ($compliances as $comp) {
        $stmtCompliance->execute($comp);
    }

    // DocsTroubleshootingFaq
    $stmtFaq = $pdo->prepare("INSERT INTO DocsTroubleshootingFaq (question, answer) VALUES (?, ?)");
    $faqs = [
        ['NAS log sending shows success, but Dashboard is empty', 'Verify that the active user registration email in the portal matches the configured device client tokens. If there is a system identity gap, log entries will filter to safe backup blocks rather than rendering on standard user screens.'],
        ['Connection Timeouts on Custom Ports', 'Verify that outbound internet traffic configurations on your localized office firewall allow outgoing UDP packets on your assigned collector port. Some enterprise corporate routers block outbound custom syslog pipelines by default.']
    ];
    foreach ($faqs as $faq) {
        $stmtFaq->execute($faq);
    }

    $pdo->commit();
    echo "Structured Docs database tables set up and seeded successfully!\n";
    
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Error setting up Docs database: " . $e->getMessage() . "\n";
    exit(1);
}
