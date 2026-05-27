CREATE TABLE IF NOT EXISTS globalsettings (
    id INTEGER PRIMARY KEY DEFAULT 1,
    siteName TEXT NOT NULL,
    logoUrl TEXT,
    themeAccentColor TEXT NOT NULL DEFAULT '#00CED1',
    primaryBackgroundColor TEXT NOT NULL DEFAULT '#0A0A0A'
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
    idealForText TEXT,
    featuresSubtitle TEXT,
    deploymentOptions TEXT,
    monthlyPrice REAL NOT NULL,
    annualPrice REAL NOT NULL,
    ctaText TEXT NOT NULL,
    highlighted INTEGER NOT NULL DEFAULT 0
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
    emailSalesValue TEXT NOT NULL DEFAULT 'sales@synalyze.com',
    emailSupportLabel TEXT NOT NULL DEFAULT 'Support',
    emailSupportValue TEXT NOT NULL DEFAULT 'support@synalyze.com',
    emailGeneralLabel TEXT NOT NULL DEFAULT 'General Inquiries',
    emailGeneralValue TEXT NOT NULL DEFAULT 'info@synalyze.com',
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

