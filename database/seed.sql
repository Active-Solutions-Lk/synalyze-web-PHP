INSERT INTO globalsettings (id, siteName, logoUrl, themeAccentColor, primaryBackgroundColor) VALUES 
(1, 'Synalyze', '/assets/images/Logo.webp', '#00CED1', '#0A0A0A');

INSERT INTO herosection (id, eyebrowText, headline, subheadline, searchPlaceholder, ctaButtonText) VALUES 
(1, 'TAKE CONTROL OF YOUR DATA', 'Take Control of Your Data', 'Be informed about your NAS. With SYANALYZE, you get an easy-to-use file activity logging solution to audit your NAS usage and manage unchecked data growth.', 'Search...', 'Start Free Trial');

INSERT INTO feature (iconName, title, description) VALUES 
('Users', 'User Bahavior Reports', 'Understand which users store what type of file on the network storage. Track access times and file types being stored.'),
('FolderLock', 'Critical Folder Reports', 'Identify specific folders as critical, and all file accesses to these folders will be displayed for easy permission auditing.'),
('FileExclamationPoint', 'File Copy & Access Behavior', 'Identify bulk file downloads and changes that may indicate potential malware or malicious user behavior.'),
('BarChart3', 'User Analytics', 'Comprehensive dashboards showing storage trends, user activity patterns, and capacity forecasting.'),
('Clock', 'Historical Data', 'Store and access historical logs for compliance, auditing, and long-term analysis of your NAS usage patterns.'),
('Shield', 'Security Monitoring', 'Spot unusual activity and potential security threats before they become serious issues.');

INSERT INTO howitworksstep (stepNumber, title, description) VALUES 
(1, 'Connect Your NAS', 'Configure your Synology or QNAP NAS to send Syslog entries to Synalyze.'),
(2, 'Cloud Collection', 'Logs are securely transmitted to our Synalyze Cloud or your on-premises server.'),
(3, 'Analyze & Report', 'Access comprehensive reports and insights through our intuitive web dashboard.');

INSERT INTO deploymentoption (name, subtitle, description, bulletPoints, imageUrl) VALUES 
('Cloud Based', '', 'Let us handle the infrastructure. Quick setup with zero maintenance.', '["No server management required","Automatic updates & scaling","99.9% uptime SLA","Global data centers","Instant provisioning"]', '/assets/images/Deployment Options/Deployment Options-02.webp'),
('On-Premises', '', 'Deploy on your own infrastructure for complete control and compliance.', '["Full data sovereignty","Custom security policies","Air-gapped environments","Integration with existing tools","Dedicated support"]', '/assets/images/Deployment Options/Deployment Options-01.webp');

INSERT INTO pricingtier (name, displayTitle, idealForText, featuresSubtitle, deploymentOptions, monthlyPrice, annualPrice, ctaText, highlighted) VALUES 
('$49/mo', 'Basic', 'Small businesses\nand startups', '', '["Cloud-Based"]', 49, 490, 'Get Started', 0),
('$149/mo', 'Standard', 'Growing businesses', 'All basic features and:', '["Cloud-Based", "On Premises\n(Self-Managed)"]', 149, 1490, 'Get Started', 0),
('Custom quote', 'Enterprise', 'Large organizations', 'All standard features and:', '["Cloud-Based", "On Premises\n(Managed Service)"]', -1, -1, 'Get Started', 0);

INSERT INTO pricingfeature (name, pricingTierId) VALUES 
('Dashboard Overview', 1), ('Basic User Activity Reports', 1), ('System Logs', 1), ('File Operations Monitoring', 1), ('Up to 1 NAS Device', 1), ('7-Day Data Retention', 1),
('Universal Search', 2), ('Advanced User Behavior Reports', 2), ('Critical Folder Reports', 2), ('File Copy & Access Behavior', 2), ('Alerts & Notifications', 2), ('Up to 5 NAS Devices', 2), ('30-Day Data Retention', 2),
('Raw Log Access', 3), ('Honeypot Detection', 3), ('Secure Folder Management', 3), ('Device Management', 3), ('Unlimited NAS Devices', 3), ('Unlimited Data Retention', 3), ('Dedicated Support', 3);

INSERT INTO pricingaddon (name, description, price) VALUES 
('On-Premises Deployment', 'For Enterprise clients seeking full data sovereignty\nwith SYNALYZE managing the infrastructure.', 0),
('Extended Data Retention', 'Available for Basic and Standard plans.', 0),
('Custom Integrations', 'Tailored solutions for specific business intelligence or\nsecurity platforms.', 0),
('Dedicated Account Management', 'Faster response times and dedicated account\nmanagement.', 0);

INSERT INTO faqcategory (name) VALUES ('General'), ('Technical');

INSERT INTO faqitem (question, answer, faqCategoryId) VALUES 
('What is Synalyze?', 'Synalyze is a comprehensive machine data analytics platform.', 1),
('How do I install the agent?', 'You can install the agent via our quick-start scripts provided in the documentation.', 2);

INSERT INTO AboutPage (id, heroHeadline, heroSubheadline, heroButtonText, whoWeAreTitle, whoWeAreDescription, whatWeDoTitle, whatWeDoDescription, whyChooseUsTitle, missionTitle, missionDescription, visionTitle, visionDescription) VALUES 
(1, 'Smarter NAS Log Analysis', 'Turn complex NAS syslog data into clear insights for better security, compliance, and storage decisions.', 'Explore More', 'Who We Are', 'SYNALYZE is a product of Active Solutions, a company dedicated to developing innovative software solutions that address critical business challenges. With a deep understanding of IT infrastructure and data security, our team is committed to delivering reliable, scalable, and user-friendly tools.', 'What We Do', 'We specialize in NAS log analysis, offering a comprehensive platform that helps organizations.', 'Why Choose SYNALYZE?', 'Our Mission', 'At SYNALYZE, our mission is to empower businesses to take complete control of their Network Attached Storage (NAS) data. We provide an intuitive and powerful solution that transforms complex syslog entries into actionable insights, enabling efficient data management, enhanced security, and compliance.', 'Our Vision', 'We envision a future where businesses can effortlessly manage their NAS environments, proactively identify security threats, and make informed decisions based on clear, comprehensive data insights. SYNALYZE is continuously evolving, driven by user feedback and the latest advancements in data analytics and security.');

INSERT INTO AboutWhatWeDoCard (iconName, title, description) VALUES 
('Server', 'Audit NAS Usage', 'Gain visibility into who is accessing what data, when and from where'),
('ChartNoAxesCombined', 'Manage Data Growth', 'Understand storage trends and user activity patterns to optimize storage resources'),
('ShieldAlert', 'Enhanced Security', 'Detect unusual activity, potential malware, and malicious user behavior through continuous monitoring and alerts'),
('ClipboardCheck', 'Ensure Compliance', 'Maintain historical logs for auditing purposes and meet regulatory requirements');

INSERT INTO AboutWhyChooseUsItem (title, description) VALUES 
('Built for NAS', 'Specifically designed for global NAS brands like Synology and QNAP'),
('Robust Cloud Infrastructure', 'Specifically designed for global NAS brands like Synology and QNAP'),
('Flexible Deployment', 'Choose between cloud-based or on-premises solutions to fit your IT policies'),
('Dedicated Support', 'Our team is here to ensure your success with SYNALYZE');

INSERT INTO ContactPage (id, heroTitle, heroDescription, phoneTitle, phoneSalesLabel, phoneSalesValue, phoneSupportLabel, phoneSupportValue, emailTitle, emailSalesLabel, emailSalesValue, emailSupportLabel, emailSupportValue, emailGeneralLabel, emailGeneralValue, addressTitle, addressLine1, addressLine2, addressLine3, addressLine4, addressLine5, formTitle, formDescription, locationTitle, mapEmbedUrl) VALUES 
(1, 'Contact Us', 'We''re here to help! Whether you have questions about SYNALYZE, need technical support, or want to discuss a custom solution, our team is ready to assist you.', 'Phone', 'Sales & General Inquiries', '+1 (800) 123-4567', 'Technical Support', '+1 (800) 987-6543', 'E-mail', 'Sales', 'sales@synalyze.com', 'Support', 'support@synalyze.com', 'General Inquiries', 'info@synalyze.com', 'Address', 'SYNALYZE Headquarters', '123 Data Drive', 'Suite 400', 'Tech City, TC 90210', 'USA', 'Send Us a Message', 'For your convenience, please use the contact form below. We aim to respond to all inquiries within 24-48 business hours.', 'Our Location', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9758442220468!2d79.8594964!3d6.8934371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2596022e69bb3%3A0xe1043229b46e3f42!2sAR%20Fabric!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk');
