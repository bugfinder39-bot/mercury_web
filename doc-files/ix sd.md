Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
CRITICAL PROJECT REGRESSION
==========================================================

The project is now in an unstable state.

After the recent Dashboard Widgets and Exchange Rate Provider changes, the website has suffered a major regression.

Every public page and many CMS pages now return 404 errors.

No further features should be implemented until the project is fully repaired.

==========================================================
STOP FEATURE DEVELOPMENT
==========================================================

Do NOT implement any new features.

Do NOT refactor unrelated code.

Do NOT redesign anything.

Your only task is to audit and repair the existing project.

==========================================================
FULL PROJECT AUDIT
==========================================================

Perform a complete audit of the entire application.

Audit:

• routes/web.php

• routes/api.php

• bootstrap/app.php

• RouteServiceProvider

• Middleware

• Service Providers

• Controllers

• Inertia configuration

• Vue Pages

• Layouts

• Navigation

• Authentication

• CMS Modules

• Dashboard

• Exchange Rate module

• Announcement module

• Dashboard Widgets

• Page Management

• Layout Management

• Homepage section loader

• Dynamic component registry

• Global settings

Determine exactly what was modified that caused the routing failures.

==========================================================
VERIFY ROUTING
==========================================================

Verify that every expected route exists and resolves correctly.

Including but not limited to:

✓ Homepage (/)

✓ About

✓ Services

✓ Contact

✓ News

✓ Global Network

✓ Certifications

✓ Exchange Rates

✓ Dashboard

✓ Login

✓ Every CMS page

✓ Every CRUD page

✓ API routes

Verify that controllers and Inertia pages exist and are correctly linked.

==========================================================
RESTORE
==========================================================

Restore the routing architecture without removing existing features.

Keep:

✓ Announcement System

✓ Exchange Rates

✓ Multi-provider support

✓ Dashboard Widgets

✓ Existing CMS

✓ Existing database

Do not recreate these features.

Repair the project around them.

==========================================================
REGRESSION TEST
==========================================================

After the repair, test the entire application.

Verify:

✓ Homepage loads

✓ All public pages load

✓ Dashboard loads

✓ CMS loads

✓ Authentication works

✓ CRUD works

✓ Exchange Rates work

✓ Announcements work

✓ Dashboard Widgets work

✓ No 404 errors

✓ No SQL errors

✓ No Laravel exceptions

✓ No Vue errors

✓ No console errors

==========================================================
FINAL REQUIREMENT
==========================================================

Do not continue with any new feature until the application is completely stable.

Identify the exact root cause of the routing regression.

Repair only the necessary files.

Preserve all completed features.

At the end provide:

1. Root cause of the 404 errors.
2. Files modified.
3. What caused the regression.
4. Confirmation that every public page, CMS page, and Dashboard page is working correctly.