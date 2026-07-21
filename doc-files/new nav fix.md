Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT rebuild the Layout Management module.

Do NOT create duplicate routes.

Do NOT create duplicate controllers.

Do NOT create duplicate Vue pages.

The Layout Management feature has already been implemented.

However, clicking the menu inside the CMS results in a 404 page.

Your task is to perform a complete architectural audit and fix the existing implementation.

==========================================================
CURRENT ISSUE
==========================================================

Inside the CMS,

clicking:

Admin

↓

Layout Management

results in a 404 Not Found page.

The menu exists.

The sidebar entry exists.

However the page cannot be opened.

Do NOT assume the frontend is broken.

Find the actual root cause.

==========================================================
PHASE 1
ROUTE AUDIT
==========================================================

Audit every route related to Layout Management.

Verify:

web.php

admin.php (if used)

Route Groups

Middleware

Prefixes

Route Names

Resource Routes

Named Routes

Ensure:

The sidebar points to the correct named route.

The route actually exists.

The URL matches the registered route.

No route conflicts exist.

==========================================================
PHASE 2
CONTROLLER AUDIT
==========================================================

Inspect the Layout Management controller.

Verify:

Controller exists.

Namespace is correct.

Methods exist.

Index()

Edit()

Update()

Store()

Destroy()

Ensure every route points to the correct controller method.

==========================================================
PHASE 3
INERTIA / VUE AUDIT
==========================================================

Verify:

Inertia::render()

Vue page path

Component name

Imports

Exports

Folder names

Case sensitivity

Ensure the rendered component actually exists.

==========================================================
PHASE 4
SIDEBAR AUDIT
==========================================================

Inspect the Admin Sidebar.

Verify:

Menu URL

Route helper

Named route

Permissions

Active state

Icons

Ensure clicking Layout Management opens the correct page.

==========================================================
PHASE 5
CMS AUDIT
==========================================================

Verify the Layout Management module loads correctly.

It should contain:

Navbar Settings

Footer Settings

Everything should load from the database.

==========================================================
PHASE 6
DATABASE AUDIT
==========================================================

Verify:

Settings table

Layout settings

Navbar settings

Footer settings

Relationships

Ensure no missing records are causing the page to fail.

If required, seed default records.

Do NOT duplicate data.

==========================================================
PHASE 7
PERMISSIONS
==========================================================

Verify:

Admin middleware

Authorization

Policies

Role permissions

Ensure administrators can access the module.

==========================================================
PHASE 8
DEBUG
==========================================================

If a 404 occurs,

identify exactly where it happens.

Determine whether it is caused by:

Missing Route

Wrong Route Name

Missing Controller

Missing Vue Component

Missing Inertia Page

Wrong Import

Middleware

Permission

Database Lookup

Do not guess.

Find the exact failing point.

==========================================================
PHASE 9
VERIFY THE SAVE FLOW
==========================================================

After fixing access,

verify the module works correctly.

Navbar:

✓ Logo

✓ Menu

✓ CTA Button

✓ Colors

✓ Background

✓ Hover Colors

✓ Sticky Settings

Footer:

✓ Company Info

✓ Links

✓ Services

✓ Social Media

✓ Newsletter

✓ Colors

✓ Copyright

Everything should save correctly.

==========================================================
FINAL TEST
==========================================================

Verify:

✓ Sidebar opens Layout Management.

✓ No 404 page.

✓ Navbar Settings load.

✓ Footer Settings load.

✓ Existing values appear.

✓ Editing works.

✓ Saving works.

✓ Database updates.

✓ Frontend updates.

✓ Refreshing the CMS still shows saved values.

==========================================================
IMPORTANT
==========================================================

Do NOT create a second Layout Management module.

Do NOT rename routes unnecessarily.

Do NOT replace working functionality.

Find the exact root cause of the 404 and repair the existing implementation so the Layout Management module is fully functional and production-ready.