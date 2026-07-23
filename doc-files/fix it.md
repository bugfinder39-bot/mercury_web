Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
CRITICAL REGRESSION
==========================================================

After implementing the multi-provider Exchange Rate system, the website homepage now returns a 404 error.

This feature should NEVER have affected the homepage.

This is a regression that must be fixed before any further development.

==========================================================
OBJECTIVE
==========================================================

Perform a complete audit to identify exactly why the homepage is returning a 404.

Do NOT create a workaround.

Do NOT recreate the homepage.

Do NOT modify unrelated functionality.

Find the exact root cause and restore the homepage.

==========================================================
AUDIT
==========================================================

Carefully audit:

• routes/web.php

• RouteServiceProvider

• bootstrap/app.php

• Middleware

• Public routes

• HomeController

• Landing Page Controller

• Inertia configuration

• Vue pages

• App Layout

• Navigation

• Exchange Rate Service

• Service Providers

• Dependency Injection

• Route model binding

• Fallback routes

• Named routes

• Homepage component

• Layout Management

Compare the current implementation with the project architecture and identify exactly what changed.

==========================================================
VERIFY
==========================================================

Verify that:

✓ Homepage route exists.

✓ Route points to the correct controller.

✓ Controller returns the correct Inertia page.

✓ Vue component exists.

✓ Component path is correct.

✓ No middleware is blocking the route.

✓ No service provider is failing during application boot.

✓ No Exchange Rate service is required to render the homepage.

✓ No route conflicts exist.

==========================================================
ISOLATION
==========================================================

The Exchange Rate module must be completely isolated.

If the exchange rate provider fails, the homepage must still load normally.

The homepage must never depend on a successful API request.

The Exchange Rate module should fail gracefully without affecting the rest of the website.

==========================================================
BACKWARD COMPATIBILITY
==========================================================

Restore all existing functionality.

Verify:

✓ Homepage

✓ About

✓ Services

✓ Contact

✓ CMS

✓ Dashboard

✓ Authentication

✓ Exchange Rates

✓ Announcements

✓ Global Network

✓ Existing dynamic sections

Nothing else should break.

==========================================================
TESTING
==========================================================

Verify:

✓ Homepage loads.

✓ No 404.

✓ No Laravel errors.

✓ No Vue errors.

✓ No console errors.

✓ Exchange Rates still function correctly.

✓ Provider switching still works.

✓ CMS still works.

==========================================================
FINAL REQUIREMENT
==========================================================

Do not implement a workaround.

Identify the exact root cause.

Restore the homepage.

Keep the Exchange Rate provider system intact.

Modify only the necessary files.

At the end provide:

1. Root cause.
2. Files modified.
3. Why the homepage returned 404.
4. Confirmation that all public pages and CMS modules are working correctly.