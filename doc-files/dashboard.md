Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The Admin Dashboard page already exists at `/admin/dashboard`.

Do NOT rebuild the entire CMS.

Do NOT break the existing layout or authentication.

Extend and enhance the existing Admin Dashboard into a comprehensive, enterprise-grade CMS Control Panel.

Modify ONLY what is necessary.

==========================================================
OBJECTIVE
==========================================================

Transform the Admin Dashboard (`/admin/dashboard`) into a rich, modern, and production-ready Control Panel for Mercury Bangladesh CMS.

The dashboard should provide real-time overview statistics, quick action navigation cards, recent inbox submissions widget with quick toggle actions, system health/content status summary, and visual statistics cards following the Dark Navy & Orange brand identity.

==========================================================
BACKEND REQUIREMENTS (DashboardController)
==========================================================

Enhance `App\Http\Controllers\Admin\DashboardController`:

1. Key Statistics:
   - Total & active Pages count
   - Total & active Services count
   - Total & active Partners count
   - Total & unread Contact Messages count
   - Total & active Global Network locations count
   - Total & active Certifications count
   - CMS Users count

2. Recent Inbox Messages:
   - Fetch top 5 latest contact form submissions
   - Include ID, name, email, subject, service interest, created_at, and is_read status

3. Content Breakdown & Activity Summary:
   - Section counts across main pages
   - Overview of active vs inactive content status

==========================================================
FRONTEND REQUIREMENTS (Admin/Dashboard.vue)
==========================================================

Redesign `resources/js/Pages/Admin/Dashboard.vue`:

1. Hero Header Banner:
   - Personalized greeting with logged-in user name
   - Today's date and system status indicator ("CMS Operational")
   - Quick action shortcuts (e.g. View Public Site, Open Inbox)

2. Key Metric Stat Cards Grid:
   - Pages Management card (with Lucide icon, count, sub-label)
   - Active Services card (with Lucide icon, active count)
   - Global Network Locations card (with Lucide icon, active locations count)
   - Certifications card (with Lucide icon, active count)
   - Partners card (with Lucide icon, active count)
   - Unread Messages card (highlighted accent border, count, link to inbox)

3. Recent Messages Inbox Widget:
   - Table / list of recent contact form submissions
   - Sender name, email, subject, submission time (formatted / relative)
   - Read / Unread status badges
   - Quick toggle read status button via Inertia router call
   - "View All Messages" CTA button linking to `/admin/messages`

4. Quick Actions Management Grid:
   - Shortcuts to Page Management, Global Network, Certifications, Services, Partners, Inbox, Layout Settings, Global Settings

5. CMS Health & Content Status Summary Card:
   - Active content percentage breakdown
   - Quick status checks for system configuration (Company Settings, Logo, Social Links)

==========================================================
BRAND IDENTITY & UI GUIDELINES
==========================================================

- Primary Navy: #0B2540
- Secondary Navy: #123A5E
- Dark Navy Surface: #162A3A
- Primary Orange: #E8770C
- Background: #F8FAFC
- Elevated cards with soft low-opacity shadows and thin borders
- Orange icons with consistent sizing and wrapper styling
- Smooth micro-interactions and hover transitions

==========================================================
VERIFICATION
==========================================================

- Verify controller passes all stat parameters and recent messages to Vue.
- Verify toggle-read action works from the dashboard inbox widget.
- Verify responsive layout on mobile, tablet, and desktop viewports.
- Ensure no console or Laravel runtime errors.
