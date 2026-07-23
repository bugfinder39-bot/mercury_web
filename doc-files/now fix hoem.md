Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
CRITICAL REGRESSION
==========================================================

After implementing the Exchange Rate Provider Management feature, several previously completed homepage features have disappeared.

The Homepage CMS also no longer contains these sections.

This is a critical regression.

These features were already completed, tested, and working before this implementation.

They MUST be restored.

==========================================================
MISSING FEATURES
==========================================================

The following homepage sections and their CMS modules have disappeared:

• Announcement System

• Live Exchange Rates

• Company Statistics (if affected)

• Global Network Map (if affected)

• Certifications & Memberships (if affected)

• Any other recently added homepage components that were previously working.

Audit the project and identify every missing component.

==========================================================
OBJECTIVE
==========================================================

Do NOT recreate these features from scratch.

Do NOT create duplicate database records.

Do NOT create duplicate CMS pages.

Find out why these components disappeared and restore them.

==========================================================
AUDIT
==========================================================

Perform a complete audit of:

• Homepage Builder

• Homepage CMS

• Page Management

• Layout Management

• Homepage Component Registry

• Dynamic Section Loader

• Vue Components

• Inertia Props

• Controllers

• Models

• Services

• Database Tables

• Migrations

• Seeders

• Navigation

• Section Visibility Logic

Determine why the homepage is no longer loading these components.

==========================================================
RESTORE
==========================================================

Restore every missing feature exactly as it existed before.

Each feature must retain:

✓ CMS CRUD

✓ Enable / Disable

✓ Ordering

✓ Visibility

✓ Animations

✓ Existing Data

✓ Relationships

✓ Media

✓ Permissions

No existing data should be lost.

==========================================================
HOMEPAGE CMS
==========================================================

Restore every missing homepage section inside the Homepage CMS.

Each section should once again support:

✓ Enable / Disable

✓ Sort Order

✓ Title

✓ Subtitle

✓ Description

✓ Section Settings

✓ Visibility

✓ Animation

✓ Background Options

All previously available CMS functionality must return.

==========================================================
DATABASE
==========================================================

Do NOT create duplicate tables.

Do NOT create duplicate migrations.

Reuse existing data.

If records still exist in the database but are no longer displayed, restore the connections instead of creating new records.

==========================================================
BACKWARD COMPATIBILITY
==========================================================

Preserve everything currently working.

Verify:

✓ Homepage

✓ Navbar

✓ Footer

✓ Announcement System

✓ Exchange Rates

✓ Company Statistics

✓ Global Network Map

✓ Certifications

✓ Contact Forms

✓ CMS

✓ Dashboard

✓ Authentication

Nothing should regress.

==========================================================
TESTING
==========================================================

Verify:

✓ All homepage sections appear.

✓ All Homepage CMS sections appear.

✓ Existing content is preserved.

✓ Enable / Disable works.

✓ Ordering works.

✓ CRUD works.

✓ Responsive layout works.

✓ No console errors.

✓ No Laravel errors.

==========================================================
FINAL REQUIREMENT
==========================================================

Do not rebuild the homepage.

Do not recreate missing features.

Audit the existing implementation, determine why the homepage component registry or CMS lost these sections, reconnect them to the existing architecture, and restore all previously completed functionality.

Modify only the necessary files.

At the end provide:

1. Root cause of the regression.
2. Files modified.
3. Components restored.
4. Confirmation that all homepage sections and Homepage CMS modules are fully functional and production-ready.