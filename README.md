# ⚡ SYNALYZE - Premium NAS Log Analysis Solution

**SYNALYZE** is a comprehensive Network Attached Storage (NAS) machine data analytics platform and syslog logging solution. It enables businesses to audit NAS usage, proactively manage unchecked data growth, ensure strict regulatory compliance, and enhance data security by transforming complex, raw syslog entries into clean, actionable visual insights.

---

## ✨ Features

- 🖥️ **Sleek Front-End Views**: 
  - Interactive homepage, in-depth About Us, flexible Pricing packages, responsive Contact Forms, and a beautiful Q&A section with clean dark-mode visual accents.
  - **Dynamic Documentation Hub**: Comprehensive, structured product documentation page that is easy to navigate and fully responsive.
- 🔒 **Rich Dashboard Administration**:
  - Global site settings, Hero section content managers, Landing page features, pricing tiers, and contact request managers.
- 👤 **User Authentication & Profiles**:
  - Secure Signup, Login, and personalized user Dashboard functionalities for managing user accounts and access.
- 🚀 **High-Performance Architecture**:
  - Designed with an ultra-lightweight custom PHP MVC pattern.
  - Powered by standard SQLite database engine for instant setup and zero maintenance.
  - Robust, modular view partials and custom layouts.

---

## 📂 Project Structure

```bash
├── config/
│   └── app.php                  # Web and database configuration settings
├── database/
│   ├── schema.sql               # SQLite database schemas and tables
│   ├── seed.sql                 # Seed SQL for initial contents
│   ├── synalyze.sqlite          # SQLite active database
│   ├── setup_docs.php           # Database seeder for documentation content
│   ├── create_users_table.php   # Migrations for user authentication
│   └── seed_users.php           # Seed script for initial users
├── public/
│   ├── assets/
│   │   ├── css/                 # Compiled assets (app.css & responsive.css)
│   │   ├── images/              # Layout branding and deployment options illustrations
│   │   └── js/                  # App interaction hooks (theme switches, sliders, forms)
│   ├── index.php                # Front controller entrypoint
│   └── captcha.php              # CAPTCHA generation utility for contact requests
├── src/
│   ├── controllers/             # Frontend page controllers
│   │   └── admin/               # Administrator panel controllers
│   ├── core/                    # Core helpers, custom routing, and database wrappers
│   ├── models/                  # Database access models (FaqModel, UserModel, DocModel, etc.)
│   └── views/                   # HTML view templates
│       ├── admin/               # Control panel views
│       ├── layouts/             # Master pages (main and admin layout)
│       ├── pages/               # Main website static/dynamic pages (qa, contact, home, docs, login, signup, dashboard)
│       └── partials/            # Reusable header, footer, and navigation bars
├── setup.php                    # CLI SQLite setup utility script
└── .gitignore                   # Ignore SQLite builds, dependencies, and OS logs
```

---

## ⚙️ Getting Started

### 📋 Prerequisites

To run this project locally, make sure you have:
- **PHP 8.x** or higher installed.
- **PDO SQLite** extension enabled in your local PHP configuration (`php.ini`).

---

### 🚀 Running the Project

#### 1. Setup the Database
Run the CLI database initialization script to create tables and seed the database:
```bash
php setup.php
```
*Note: If a database file already exists, the installer will ask if you want to replace it. Enter `y` to overwrite and seed fresh data.*

For additional modular features like documentation and users, you can also run their respective setup scripts:
```bash
php database/setup_docs.php
php database/create_users_table.php
php database/seed_users.php
```

#### 2. Spin up the Built-in Server
Run the built-in development server in the repository root directory pointing to `public/`:
```bash
php -S localhost:8000 -t public
```

#### 3. Access the Application
Open your browser and navigate to:
- **Main Website**: [http://localhost:8000](http://localhost:8000)
- **Admin Dashboard**: [http://localhost:8000/admin](http://localhost:8000/admin)

---

## 📝 License
This project is proprietary software built for **Synalyze Web**. All rights reserved.
