# Software Requirements Analysis
## Mercury Bangladesh (Pvt.) Ltd. — Corporate Website with CMS

| | |
|---|---|
| **Client** | Mercury Bangladesh (Pvt.) Ltd. |
| **Tagline** | "Mercury is your better choice for any shipping need" |
| **Document Type** | Requirements Analysis (SRS-lite) |
| **Version** | 1.0 |
| **Date** | July 2026 |

---

## 1. Project Overview

### 1.1 Purpose
Mercury Bangladesh needs a corporate marketing website (4 public pages) backed by a **fully dynamic CMS admin panel**, so non-technical staff can update every piece of content — banners, tiles, images, text, stats, partner logos, services — without touching code.

### 1.2 Objectives
- Present Mercury Bangladesh as a premium, trustworthy logistics/freight/shipping company.
- Give the marketing/admin team full self-service control over page content.
- Ship a fast, SEO-friendly, single-theme (light only) website.
- Build on a maintainable, modern monolith stack (Laravel + Inertia + Vue) rather than a decoupled API/SPA, to keep the CMS and frontend tightly coupled and simple to manage.

### 1.3 Out of Scope (unless later confirmed)
- Multi-language / i18n support (assume English-only unless client confirms Bangla is needed).
- Online payments, shipment tracking/booking engine, customer portal/login for end customers.
- Blog/news module (not mentioned — flag as an open question).
- Mobile native apps.

---

## 2. Tech Stack

| Layer | Technology |
|---|---|
| Backend Framework | Laravel 13 |
| Starter Kit | Laravel Starter Kit (Breeze/Jetstream-style, Inertia + Vue variant) |
| Frontend Bridge | Inertia.js |
| Frontend Framework | Vue 3 (Composition API recommended) |
| Styling | Tailwind CSS + DaisyUI |
| Database | MySQL |
| Theme | Light theme only — dark mode disabled/removed |
| Image Handling | Laravel filesystem (public/S3) + Intervention Image or Spatie Media Library |
| Rich Text | TipTap / Quill (for CMS text fields with formatting) |
| Maps | Google Maps or Leaflet/OpenStreetMap embed for Contact/Home "Get in Touch" |

**Recommendation:** Use **Spatie Media Library** for all image/logo uploads (banners, partner logos, tile icons) — it gives you conversions (thumbnails, responsive sizes), collections per component, and clean CMS-to-frontend mapping.

---

## 3. User Roles & Permissions

| Role | Access |
|---|---|
| **Super Admin** | Full access: manage all pages, components, media, settings, other admin users |
| **Content Editor** | Can edit/publish content on assigned pages only (no user management, no settings) |
| *(Optional)* **Viewer** | Read-only access to admin dashboard for stakeholders/reports |

> **Open question:** Does the client need multiple admin roles at launch, or is a single Admin login sufficient for v1?

Authentication: Laravel starter kit's built-in auth (login, password reset, email verification) for the `/admin` panel only. Public site has **no login**.

---

## 4. CMS Design Philosophy (Core Requirement)

Every visual block on every public page must be **admin-manageable**. The recommended approach:

### 4.1 Data Model Strategy
Use a **hybrid model**:
1. **Pages** table — one row per page (Home, About, Services, Contact).
2. **Sections** table — one row per section within a page (Hero, About-Us, Vision/Mission, Why Choose Us, Stats, Partners, Get in Touch, etc.), linked to `page_id`, with a `type` (enum/slug) and `order` (for drag-and-drop reordering).
3. **Section Items / Blocks** table (polymorphic) — repeatable items inside a section (e.g., each partner logo, each tile in Vision/Mission, each stat counter, each service card, each history/timeline point).
4. **Media** — via Spatie Media Library, attached polymorphically to Sections/Items.
5. **Settings** table (key-value) — global content: company name, tagline, phone, email, address, social links, footer text, map coordinates.

This structure means adding a 5th "tile" to Why Choose Us, or a 6th partner logo, is an admin action — **not a code change**.

### 4.2 Admin Panel Capabilities (per section)
- Edit heading, subheading, body text (rich text where relevant).
- Upload/replace/delete images (with recommended-size hints & preview).
- Add/remove/reorder repeatable items (tiles, stats, partners, services, history points) via drag-and-drop.
- Toggle a section/item **active/inactive** (show/hide without deleting).
- Live/preview mode before publishing (nice-to-have for v1, recommended for v2).
- Form validation (required fields, image size/type limits) with inline error messages.

---

## 5. Public Site — Page-by-Page Requirements

### 5.1 Home Page

| # | Section | Description | CMS Fields |
|---|---|---|---|
| 1 | **Hero Carousel** | Auto-rotating carousel, each slide has background image + heading + subtext + optional CTA button | Per slide: image, heading, subheading, CTA text/link, order, active toggle |
| 2 | **About Us** | Flex layout: image on one side, text on the other | Image, heading, body text, optional CTA |
| 3 | **Vision & Mission Tiles** | 2 tiles (or more) in a grid | Per tile: icon/image, title, description |
| 4 | **Why Choose Us** | Text-based value proposition section (may include supporting icons) | Heading, body text, repeatable list of points (icon + short text) |
| 5 | **Our Feature Services** | Grid/cards of core services (Sea Freight, Air Freight, Land/Inland, Warehousing, Customs Clearance, etc.) | Per card: icon, title, short description, link to Service page/anchor |
| 6 | **Stats/Experience Bar** | Animated counters: Years of Experience, Shipments Delivered, Countries Covered, SLA Compliance % | Per stat: label, numeric value, suffix (e.g. "+", "%"), icon (optional) |
| 7 | **Our Partners** | Logo grid/carousel of partner/client companies | Repeatable: logo image, name, optional link |
| 8 | **Get in Touch** | Embedded map + contact info (address, phone, email) + short CTA | Map coordinates/embed code, address, phone, email, optional mini-form or "Contact Us" button |

### 5.2 About Page

| # | Section | Description | CMS Fields |
|---|---|---|---|
| 1 | **Hero Banner** | Full-width banner, heading + subtext | Background image, heading, subheading |
| 2 | **Our Story** | Flex layout with image | Image, heading, body text |
| 3 | **Mission & Vision** | Same as/similar to Home's tiles, but content may differ (page-specific, not shared) | Per tile: icon/image, title, description |
| 4 | **Our Foundation** | Founding principles/values | Heading, body text, optional repeatable value cards |
| 5 | **Our History (Timeline)** | Point-to-point / timeline design (year-by-year milestones) | Repeatable: year, title, description, optional icon/image, order |
| 6 | **Premium Corporate Logistics Operation** | Feature/highlight block | Heading, body text, image, optional supporting points |
| 7 | **Stats Bar** | Same 4 stats as Home (Experience, Shipments, Countries, SLA) — should reuse the **same CMS data source** as Home so it stays in sync, or be independently editable per client preference | Reused/linked from Settings, or separate override fields |
| 8 | **Closing Image + CTA Text** | Full-width image with overlay text + button/link | Image, heading, text, CTA button (text + link) |

> **Design note:** Recommend the Stats block be a **shared/global component** (edited once, appears on both Home & About) rather than duplicated — reduces content drift. Confirm with client.

### 5.3 Service Page

| # | Section | Description | CMS Fields |
|---|---|---|---|
| 1 | **Hero Banner** | Heading + subtext, background image | Background image, heading, subheading |
| 2 | **All Services** | Full listing of services (more detailed than Home's teaser cards) — likely each service has its own icon, title, description, and possibly its own detail modal/accordion or anchor section | Repeatable "Service" entity: name, icon/image, short description, long description, order, active toggle |
| 3 | **Our Freight Moves** | Highlight of freight modes (Sea, Air, Road, Rail, etc.) — could be a tabbed or grid section with icon + description | Repeatable: mode name, icon/image, description |

> Consider a dedicated **Services** resource (CRUD) rather than a generic "section item," since Services may later need individual detail pages (`/services/{slug}`). Recommend building it that way from the start for scalability, even if v1 only needs a listing.

### 5.4 Contact Page

| # | Section | Description | CMS Fields |
|---|---|---|---|
| 1 | **Hero Banner** | Heading + subtext | Background image, heading, subheading |
| 2 | **Intro Text + Images** | Supporting content before the form | Heading, body text, image(s) |
| 3 | **Contact Form** | Public-facing form: Name, Email, Phone, Subject, Message (fields configurable) | Form submissions stored in DB, emailed to admin, with success/error UI feedback |
| 4 | **Contact Info / Map** | Address, phone, email, office hours, embedded map | Reuse global Settings (address/phone/email) + map embed |

**Contact Form Requirements:**
- Server-side validation (required fields, email format, honeypot or Google reCAPTCHA v3 for spam protection).
- Store submissions in a `contact_messages` table, viewable/manageable (mark as read, reply via mailto, delete) in the admin panel.
- Auto-email notification to admin(s) on new submission.
- Optional: auto-reply confirmation email to the user.
- Rate limiting to prevent abuse.

---

## 6. Global / Shared Components

| Component | Notes |
|---|---|
| **Header/Navbar** | Logo, nav links (Home, About, Services, Contact), CTA button (e.g., "Get a Quote" / "Contact Us"). Logo image manageable via CMS/Settings. |
| **Footer** | Company info, quick links, social media icons/links, newsletter (optional), copyright text — all editable via Settings. |
| **Stats Bar** | Shared between Home & About (see note above). |
| **SEO Meta** | Each page should have editable meta title, meta description, and OG image via CMS. |
| **Site Settings** | Company name, tagline, logo, favicon, primary contact info, social links, Google Maps embed/API key. |

---

## 7. Admin Panel — Functional Requirements

### 7.1 Dashboard
- Overview stats (e.g., number of contact form submissions, last updated pages).

### 7.2 Page Management
- List of 4 pages (Home, About, Services, Contact).
- Click into a page → see all its sections in order → edit inline or via dedicated forms.
- Drag-and-drop reordering of sections/items where applicable.
- Image upload with preview, crop/recommended-dimension guidance, and delete/replace.
- Rich text editor for long-form content fields.
- Active/Inactive toggle per section and per repeatable item.

### 7.3 Services Management (CRUD)
- Add/Edit/Delete services with icon, title, short & long description, order, status.

### 7.4 Partners Management (CRUD)
- Add/Edit/Delete partner logos with name, image, optional link, order, status.

### 7.5 Contact Submissions
- List/search/filter contact form entries.
- View detail, mark read/unread, delete, export (CSV — optional).

### 7.6 Settings
- Global company info, social links, SEO defaults, map settings.

### 7.7 User Management (Super Admin only)
- Manage admin accounts, roles, password resets.

### 7.8 Media Library (optional but recommended)
- Central place to view/reuse previously uploaded images across sections.

---

## 8. Non-Functional Requirements

| Category | Requirement |
|---|---|
| **Theme** | Light theme only. DaisyUI dark mode must be explicitly disabled (no `data-theme` toggle, force a single light DaisyUI theme e.g. `"corporate"`, `"light"`, or a custom brand theme). |
| **Responsiveness** | Fully responsive: mobile, tablet, desktop breakpoints for all pages and admin panel. |
| **Performance** | Optimized images (WebP where possible, lazy loading), Vite asset bundling, page load target < 2.5s on 4G. |
| **SEO** | Semantic HTML, editable meta tags per page, sitemap.xml, robots.txt, Open Graph tags. |
| **Accessibility** | WCAG 2.1 AA-minded: alt text fields for all CMS images, proper heading hierarchy, keyboard-navigable nav/carousel. |
| **Security** | CSRF protection (built into Laravel/Inertia), input validation & sanitization, image upload MIME/type checks, admin route middleware protection, reCAPTCHA on public form. |
| **Browser Support** | Latest 2 versions of Chrome, Firefox, Safari, Edge. |
| **Hosting/Env** | Standard LEMP/LAMP-compatible hosting (or cloud, e.g., AWS/DigitalOcean) supporting PHP 8.3+, MySQL 8+, Node build step for Vite. |
| **Backups** | Regular DB + media backup strategy (recommend documenting even if out of dev scope). |

---

## 9. Suggested Database Schema (High-Level)

```
pages
  id, name, slug, meta_title, meta_description, og_image, created_at, updated_at

sections
  id, page_id (FK), type (hero, about, vision_mission, why_choose_us,
      feature_services, stats, partners, get_in_touch, our_story,
      foundation, history, premium_ops, closing_cta, hero_banner,
      all_services, freight_moves, intro, contact_form, ...),
  heading, subheading, body, order, is_active, created_at, updated_at

section_items   (repeatable content inside a section — tiles, stats, points, history entries)
  id, section_id (FK), title, subtitle, description, value, icon,
  link, order, is_active, created_at, updated_at

services
  id, name, slug, icon, short_description, long_description,
  order, is_active, created_at, updated_at

partners
  id, name, logo, link, order, is_active, created_at, updated_at

media  (via Spatie Media Library — polymorphic: model_type, model_id)

settings
  id, key, value, group (general, social, seo, map), created_at, updated_at

contact_messages
  id, name, email, phone, subject, message, is_read, created_at, updated_at

users  (admin users)
  id, name, email, password, role, created_at, updated_at
```

---

## 10. Component/Page Map (Frontend — Vue + Inertia)

```
resources/js/
├── Pages/
│   ├── Home.vue
│   ├── About.vue
│   ├── Services.vue
│   ├── Contact.vue
│   └── Admin/
│       ├── Dashboard.vue
│       ├── Pages/Edit.vue        (dynamic section editor)
│       ├── Services/Index.vue, Edit.vue
│       ├── Partners/Index.vue, Edit.vue
│       ├── Messages/Index.vue
│       ├── Settings/Edit.vue
│       └── Users/Index.vue, Edit.vue
├── Components/
│   ├── HeroCarousel.vue
│   ├── AboutFlex.vue
│   ├── TileGrid.vue              (used for Vision/Mission, Foundation)
│   ├── StatsCounter.vue
│   ├── ServiceCard.vue
│   ├── PartnerLogos.vue
│   ├── TimelineHistory.vue       (About "Our History")
│   ├── ContactForm.vue
│   ├── MapEmbed.vue
│   ├── Navbar.vue
│   └── Footer.vue
└── Layouts/
    ├── PublicLayout.vue
    └── AdminLayout.vue
```

---

## 11. Assumptions & Open Questions for Client

1. **Language:** Is Bangla language support needed (bilingual toggle), or English-only for v1?
2. **Services detail pages:** Should each service have its own dedicated page (`/services/sea-freight`), or is a single listing on the Service page sufficient?
3. **Stats block:** Should "Experience / Shipments / Countries / SLA" be one shared global block (edited once) shown on both Home & About, or independently editable per page?
4. **Contact form recipient(s):** Single admin email, or multiple department emails based on subject?
5. **Blog/News/Careers:** Not mentioned in the brief — confirm these are out of scope for v1.
6. **Quote request:** Is "Get in Touch" purely informational, or should it include a lead-capture form (name/email/shipment details) similar to Contact page?
7. **Branding assets:** Do you have an existing logo, brand color palette, and font guidelines to encode into the Tailwind/DaisyUI theme, or should this be designed fresh?
8. **Analytics:** Should Google Analytics / Meta Pixel / GTM be integrated?
9. **Hosting environment:** Confirm target hosting so PHP/MySQL/Node versions are aligned.
10. **Number of admin users at launch** and whether role-based permissions (Editor vs Super Admin) are required in v1.

---

## 12. Suggested Development Phases

| Phase | Scope |
|---|---|
| **Phase 1 — Foundation** | Laravel 13 + starter kit setup, Inertia + Vue 3 + Tailwind + DaisyUI config (light theme only), DB schema & migrations, auth for admin. |
| **Phase 2 — CMS Core** | Pages/Sections/Section Items architecture, media library integration, dynamic section editor UI. |
| **Phase 3 — Public Pages** | Build Home, About, Services, Contact frontend components, wire to CMS data via Inertia props. |
| **Phase 4 — Admin Modules** | Services CRUD, Partners CRUD, Settings, Contact Messages inbox, User management. |
| **Phase 5 — Polish** | Responsiveness pass, SEO meta, animations (carousel, counters), accessibility audit, performance optimization. |
| **Phase 6 — QA & Launch** | Cross-browser/device testing, content population by client, UAT, deployment, backups/monitoring setup. |

---

## 13. Deliverables

- Fully functional public website (4 pages) — light theme, responsive.
- Admin panel (CMS) with role-based access covering every section/tile/image/text described above.
- Database schema & seeders (with placeholder demo content).
- Basic technical documentation (how to add a new service/partner/section item).
- Deployment-ready build (Vite production build + Laravel deployment guide).

---

*Prepared as an initial requirements analysis based on the provided project brief. Recommend a short discovery/kickoff call to resolve the open questions in Section 11 before development begins, as they materially affect the data model (especially Services and the shared Stats block).*
