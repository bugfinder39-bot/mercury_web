Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT rebuild the Office Team module.

Do NOT create duplicate CMS components.

Do NOT create duplicate database tables.

Do NOT hardcode any staff information.

Everything already exists inside the CMS.

Your task is to investigate why the Office Team section appears and works correctly inside the CMS but does NOT appear on the Contact page frontend.

Find the root cause and fix it properly.

==========================================================
CURRENT ISSUE
==========================================================

Inside the CMS:

Admin

↓

Page Management

↓

Contact Page

↓

Office Team

Everything works correctly.

I can:

✓ Add Staff

✓ Edit Staff

✓ Delete Staff

✓ Reorder Staff

✓ Enable / Disable Staff

✓ Save Information

The data is stored successfully.

However...

The Contact page frontend does not display the Office Team section.

Nothing appears.

This indicates that the frontend is not properly connected to the CMS/database.

==========================================================
DO NOT GUESS
==========================================================

Perform a complete end-to-end audit.

Trace the entire data flow.

CMS

↓

Database

↓

Model

↓

Relationship

↓

Controller

↓

API / Inertia Props

↓

Vue Component

↓

Frontend Rendering

Identify exactly where the chain breaks.

==========================================================
PHASE 1
DATABASE AUDIT
==========================================================

Verify that Office Team records are actually stored.

Check:

Table

Relationships

Foreign Keys

Page ID

Section ID

Status

Display Order

Soft Deletes

Ensure records are valid.

==========================================================
PHASE 2
MODEL AUDIT
==========================================================

Inspect all related models.

Verify:

Relationships

fillable

casts

Scopes

Status filtering

Ordering

Ensure the Office Team model correctly returns data.

==========================================================
PHASE 3
CONTROLLER AUDIT
==========================================================

Inspect the Contact page controller.

Verify:

Queries

Relationships

Eager Loading

Page Sections

Office Team retrieval

Ensure Office Team data is included when rendering the Contact page.

==========================================================
PHASE 4
INERTIA / VUE AUDIT
==========================================================

Inspect the Contact page.

Verify:

Props

Component imports

Conditional rendering

v-if

v-for

Data binding

Ensure Office Team data reaches the frontend.

==========================================================
PHASE 5
RENDERING
==========================================================

Ensure the Office Team section renders dynamically.

If there are:

0 people

Display nothing or an appropriate empty state.

If there are:

1 person

Display one card.

If there are:

3 people

Display three cards.

If there are:

20 people

Automatically create additional rows.

Nothing should be hardcoded.

==========================================================
CMS CONNECTION
==========================================================

Verify every CMS action updates the frontend.

Test:

Add Staff

↓

Save

↓

Refresh frontend

↓

New staff appears.

Edit Staff

↓

Save

↓

Frontend updates immediately.

Delete Staff

↓

Frontend removes the card.

Disable Staff

↓

Frontend hides the card.

Reorder Staff

↓

Frontend follows the new order.

==========================================================
SECTION SETTINGS
==========================================================

Verify the Office Team section itself is connected.

Check:

Section Status

Section Visibility

Section Slug

Section Type

Page Assignment

Display Order

Ensure the Contact page actually renders the Office Team section.

==========================================================
REMOVE HARDCODED DATA
==========================================================

Audit the Contact page.

Ensure:

No placeholder data

No hardcoded people

No fake arrays

Everything must come directly from the CMS database.

==========================================================
FINAL TEST
==========================================================

Verify:

✓ Office Team appears on the Contact page.

✓ Add Staff works.

✓ Edit Staff works.

✓ Delete Staff works.

✓ Reorder Staff works.

✓ Enable / Disable Staff works.

✓ Refreshing the page preserves changes.

✓ Frontend always reflects the current CMS data.

✓ No console errors.

✓ No Laravel errors.

✓ No broken queries.

==========================================================
IMPORTANT
==========================================================

Do NOT implement a temporary workaround.

Find the exact reason why the frontend is not reading the Office Team data.

Fix the existing architecture so the CMS and frontend remain fully synchronized.

The Contact page must always render the Office Team section dynamically from the database, exactly like the other CMS-managed sections.