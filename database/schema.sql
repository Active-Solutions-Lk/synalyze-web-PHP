CREATE TABLE IF NOT EXISTS globalsettings (
    id INTEGER PRIMARY KEY DEFAULT 1,
    siteName TEXT NOT NULL,
    logoUrl TEXT,
    themeAccentColor TEXT NOT NULL DEFAULT '#00CED1',
    primaryBackgroundColor TEXT NOT NULL DEFAULT '#0A0A0A',
    ownerEmail TEXT NOT NULL DEFAULT 'support@synalyze.net'
);

CREATE TABLE IF NOT EXISTS herosection (
    id INTEGER PRIMARY KEY DEFAULT 1,
    eyebrowText TEXT NOT NULL,
    headline TEXT NOT NULL,
    subheadline TEXT NOT NULL,
    searchPlaceholder TEXT NOT NULL,
    ctaButtonText TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS feature (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    iconName TEXT NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS howitworksstep (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    stepNumber INTEGER NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS deploymentoption (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    subtitle TEXT,
    description TEXT NOT NULL,
    bulletPoints TEXT NOT NULL,
    imageUrl TEXT
);

CREATE TABLE IF NOT EXISTS pricingdeploymentoption (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    subtitle TEXT,
    description TEXT NOT NULL,
    imageUrl TEXT
);

CREATE TABLE IF NOT EXISTS faqcategory (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS faqitem (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    faqCategoryId INTEGER NOT NULL,
    FOREIGN KEY (faqCategoryId) REFERENCES faqcategory(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS pricingaddon (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT,
    price REAL NOT NULL
);

CREATE TABLE IF NOT EXISTS pricingtier (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    displayTitle TEXT,
    deploymentType TEXT NOT NULL DEFAULT 'cloud',
    idealForTitle TEXT DEFAULT 'Ideal for',
    idealForText TEXT,
    featuresSubtitle TEXT,
    price TEXT NOT NULL DEFAULT 'GET STARTED',
    ctaText TEXT NOT NULL DEFAULT 'GET STARTED',
    highlighted INTEGER NOT NULL DEFAULT 0,
    sortOrder INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS pricingfeature (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    pricingTierId INTEGER NOT NULL,
    FOREIGN KEY (pricingTierId) REFERENCES pricingtier(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS AboutPage (
    id INTEGER PRIMARY KEY DEFAULT 1,
    heroHeadline TEXT NOT NULL,
    heroSubheadline TEXT NOT NULL,
    heroButtonText TEXT NOT NULL,
    whoWeAreTitle TEXT NOT NULL,
    whoWeAreDescription TEXT NOT NULL,
    whatWeDoTitle TEXT NOT NULL,
    whatWeDoDescription TEXT NOT NULL,
    whyChooseUsTitle TEXT NOT NULL,
    missionTitle TEXT NOT NULL,
    missionDescription TEXT NOT NULL,
    visionTitle TEXT NOT NULL,
    visionDescription TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS AboutWhatWeDoCard (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    iconName TEXT NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS AboutWhyChooseUsItem (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS ContactPage (
    id INTEGER PRIMARY KEY DEFAULT 1,
    heroTitle TEXT NOT NULL DEFAULT 'Contact Us',
    heroDescription TEXT NOT NULL,
    phoneTitle TEXT NOT NULL DEFAULT 'Phone',
    phoneSalesLabel TEXT NOT NULL DEFAULT 'Sales & General Inquiries',
    phoneSalesValue TEXT NOT NULL DEFAULT '+1 (800) 123-4567',
    phoneSupportLabel TEXT NOT NULL DEFAULT 'Technical Support',
    phoneSupportValue TEXT NOT NULL DEFAULT '+1 (800) 987-6543',
    emailTitle TEXT NOT NULL DEFAULT 'E-mail',
    emailSalesLabel TEXT NOT NULL DEFAULT 'Sales',
    emailSalesValue TEXT NOT NULL DEFAULT 'support@synalyze.net',
    emailSupportLabel TEXT NOT NULL DEFAULT 'Support',
    emailSupportValue TEXT NOT NULL DEFAULT 'support@synalyze.net',
    emailGeneralLabel TEXT NOT NULL DEFAULT 'General Inquiries',
    emailGeneralValue TEXT NOT NULL DEFAULT 'support@synalyze.net',
    addressTitle TEXT NOT NULL DEFAULT 'Address',
    addressLine1 TEXT NOT NULL DEFAULT 'SYNALYZE Headquarters',
    addressLine2 TEXT NOT NULL DEFAULT '123 Data Drive',
    addressLine3 TEXT,
    addressLine4 TEXT NOT NULL DEFAULT 'Tech City, TC 90210',
    addressLine5 TEXT NOT NULL DEFAULT 'USA',
    formTitle TEXT NOT NULL DEFAULT 'Send Us a Message',
    formDescription TEXT NOT NULL,
    locationTitle TEXT NOT NULL DEFAULT 'Our Location',
    mapEmbedUrl TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    full_name TEXT NOT NULL,
    company_name TEXT,
    address TEXT NOT NULL,
    phone TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS DocsPage (
    id INTEGER PRIMARY KEY DEFAULT 1,
    eyebrowText TEXT NOT NULL DEFAULT 'SYNALYZE Knowledge Base',
    headline TEXT NOT NULL DEFAULT 'Documentation',
    subheadline TEXT NOT NULL DEFAULT 'Learn how to navigate and maximize the Synalyze platform''s monitoring capabilities for your global enterprise NAS fleet.',
    gettingStartedIntro TEXT NOT NULL,
    onboardingTitle TEXT NOT NULL DEFAULT '4-Step Onboarding Flow',
    integrationIntro TEXT NOT NULL,
    integrationSetupTitle TEXT NOT NULL DEFAULT 'Synology NAS Setup Guide',
    integrationSetupSubtitle TEXT NOT NULL DEFAULT 'Syslog V2',
    integrationSetupPortNote TEXT NOT NULL,
    modulesIntro TEXT NOT NULL,
    deploymentIntro TEXT NOT NULL,
    complianceTitle TEXT NOT NULL DEFAULT 'Standards & Compliance',
    supportIntro TEXT NOT NULL,
    supportFaqTitle TEXT NOT NULL DEFAULT 'Troubleshooting',
    supportContactTitle TEXT NOT NULL DEFAULT 'Get in Touch',
    supportPhone TEXT NOT NULL DEFAULT '011 732 5200',
    supportEmail TEXT NOT NULL DEFAULT 'support@synalyze.net',
    supportEmailNote TEXT NOT NULL,
    supportHoursWeekdays TEXT NOT NULL,
    supportHoursSaturdays TEXT NOT NULL,
    supportHoursSundays TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS DocsOnboardingStep (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    stepNumber TEXT NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS DocsIntegrationField (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fieldName TEXT NOT NULL,
    fieldValue TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS DocsModule (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    iconName TEXT NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    bulletPoints TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS DocsDeploymentOption (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    badge TEXT NOT NULL,
    iconName TEXT NOT NULL,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    bulletPoints TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS DocsComplianceItem (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS DocsTroubleshootingFaq (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS contact_submissions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    company TEXT,
    subject TEXT NOT NULL,
    message TEXT NOT NULL,
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS demo_requests (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL UNIQUE,
    full_name TEXT NOT NULL,
    company_name TEXT,
    email TEXT NOT NULL,
    phone TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT 'pending',
    requested_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    credential_sent_at DATETIME,
    activation_key TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
