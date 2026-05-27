# Synalyze Website Implementation Plan

Based on the analysis of the provided UI design PDFs (`D2 (1).pdf` / Landing, `Pricing.pdf`, and `q&a.pdf`), here is the comprehensive plan to convert the exact designs into a modular, pixel-perfect website driven by a MySQL database and Prisma, featuring a fully-fledged Admin Dashboard.

## 1. Technical Stack
- **Framework:** Next.js (App Router) - Already set up in `apps/web`
- **Styling:** Tailwind CSS (already configured) for pixel-perfect, responsive design matching the dark/teal SaaS theme.
- **Database:** MySQL
- **ORM:** Prisma
- **Icons:** `lucide-react` (matching the stroke-based teal icons in the designs)
- **UI Components:** Customized `@workspace/ui` components (Radix UI + Tailwind)

## 2. Design System & Theming
The design features a dark SaaS aesthetic:
- **Backgrounds:** Deep black/charcoal (`#0A0A0A` to `#121212`)
- **Accent Color:** Teal/Cyan (approx. `#00CED1`) for buttons, active states, and icons
- **Typography:** Modern Sans-serif (e.g., Inter or Plus Jakarta Sans) with bold white headings and light gray (`#A0A0A0`) body text.
- **Design Elements:** Soft gradients, subtle data-themed background patterns, rounded corners on cards and accordions.

*All these values will be stored in the database so the admin can change them dynamically.*

## 3. Database Schema (Prisma & MySQL)
To make **everything** modular and editable by admins, we will structure the database into the following core models:

### Global & Theming
- **`GlobalSettings`**: Stores site name, logo URL, theme accent color (hex), and primary background color.

### Landing Page Content
- **`HeroSection`**: Eyebrow text ("TAKE CONTROL OF..."), headline, subheadline, search placeholder, and CTA button text.
- **`Feature`**: Icon name, title, and description for the feature grid.
- **`HowItWorksStep`**: Step number, title, and description.
- **`DeploymentOption`**: Name (Cloud/On-Premises), description, and list of bullet points.

### Pricing Page Content
- **`PricingTier`**: Name (Basic, Standard, Enterprise), monthly price, annual price, CTA text, and a boolean for "highlighted/popular".
- **`PricingFeature`**: Linked to a tier, representing the checkmark list.
- **`PricingAddon`**: Modular extra services and their prices.

### Q&A Page Content
- **`FAQCategory`**: General, Technical, Billing, Support.
- **`FAQItem`**: Question, Answer, linked to a category.

## 4. Admin Dashboard (`/admin`)
We will create a protected `/admin` route group containing:
- **Theme Settings:** Color pickers and logo upload/URL inputs.
- **Content Managers:** Intuitive data tables and forms to Create, Read, Update, and Delete (CRUD) features, steps, deployment options, pricing tiers, and FAQs.
- **Live Preview (Optional but recommended):** A split view to see changes before applying them.

## 5. Public Website (`/(main)`)
The public-facing website will use **React Server Components** to fetch the latest data from the MySQL database on request or at build time (with revalidation).
- **Navbar/Footer:** Globally fetched navigation and branding.
- **`page.tsx` (Home):** Assembles the Hero, Features, How It Works, and Deployment components.
- **`/pricing`:** Renders the pricing toggle, tiers, and add-ons dynamically.
- **`/qa`:** Renders the categorized accordions for the FAQ section.
*(Note: The "Contact Us" page is excluded per your instructions).*

## 6. Execution Phases

### **Phase 1: Database Setup**
1. Initialize Prisma in the workspace.
2. Define the exact Prisma schema based on the plan above.
3. Generate and run the initial migration to the MySQL database.
4. Create a seed script to populate the database with the exact text and default colors from the PDF designs.

### **Phase 2: Admin Dashboard Construction**
1. Build the `/admin` layout and navigation side-nav.
2. Create server actions (`app/actions/...`) for securely updating database records.
3. Build the UI forms to edit Themes, Landing Page sections, Pricing, and FAQs.

### **Phase 3: Frontend Implementation**
1. Update `tailwind.config` / `globals.css` to accept dynamic CSS variables injected from the `GlobalSettings` database fetch.
2. Build the Landing Page components (Hero, Features Grid, Steps).
3. Build the Pricing page (Toggle, Cards, Addons).
4. Build the Q&A page (Categorized Accordions).
5. Ensure pixel-perfect alignment, spacing, and styling to match the PDFs.

### **Phase 4: Review & Polish**
1. Cross-reference the live site with the PDFs.
2. Ensure responsive design (mobile/tablet/desktop).
3. Finalize any interactive micro-animations (hover states, accordion transitions).

---
**Please review this plan. If you approve, I will immediately begin Phase 1: Setting up Prisma, defining the MySQL schema, and seeding the initial data.**
