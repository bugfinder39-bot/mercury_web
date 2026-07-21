
Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT rebuild the Page Management system.

Do NOT create a new ordering system.

Do NOT duplicate database tables.

Do NOT change the existing CMS architecture.

The ordering functionality already works perfectly on every other page.

Only the Contact page is broken.

Your task is to find the root cause and make the Contact page behave exactly like the other pages.

==========================================================
CURRENT ISSUE
==========================================================

Inside CMS:

Page Management

↓

Contact Page

↓

Page Sections

I have three sections:

1. Contact Form
2. Office Locations
3. Meet Our Office Team

When I change their order inside the CMS, the new order saves successfully.

However...

The live Contact page always displays the sections in the same fixed order.

The ordering changes have absolutely no effect.

==========================================================
EXPECTED BEHAVIOR
==========================================================

If I change:

Office Team

↓

Order 1

It should become the first section.

If I move:

Office Locations

↓

Order 3

It should become the last section.

The frontend must always display sections according to the CMS order.

Exactly like every other page.

==========================================================
DO NOT IMPLEMENT A NEW SYSTEM
==========================================================

The ordering system already exists.

It already works on:

Home

About

Services

Other pages

Reuse the exact same architecture.

Do NOT create another ordering implementation.

==========================================================
PHASE 1
DATABASE AUDIT
==========================================================

Verify:

display_order

sort_order

order

position

or whatever ordering field already exists.

Ensure the CMS actually updates the database correctly.

If it already updates correctly,

leave it unchanged.

==========================================================
PHASE 2
MODEL AUDIT
==========================================================

Inspect:

Page

PageSection

Contact Section

Related Models

Verify that ordering is applied correctly.

Check scopes.

Check relationships.

Check default ordering.

==========================================================
PHASE 3
CONTROLLER AUDIT
==========================================================

Inspect the Contact page controller.

Verify:

How page sections are loaded.

Whether they are sorted.

Whether they are eager loaded.

Whether they ignore the display_order field.

Compare the Contact page with another page where ordering works correctly.

Use the same implementation.

==========================================================
PHASE 4
FRONTEND AUDIT
==========================================================

Inspect the Contact page Vue component.

Verify:

No hardcoded section order.

No manually rendered sequence.

No fixed layout.

No conditional rendering that forces:

Contact Form

↓

Office Locations

↓

Office Team

Instead,

render the page dynamically using the ordered collection received from the backend.

==========================================================
COMPARE WITH OTHER PAGES
==========================================================

Compare the Contact page implementation with pages where ordering works correctly.

Identify the exact difference.

Reuse the same logic.

Do NOT invent a new solution.

==========================================================
DATABASE
==========================================================

If the issue is caused by a missing column,

missing relationship,

or missing migration,

only add what is absolutely necessary.

Do NOT modify unrelated tables.

Do NOT duplicate data.

Maintain backward compatibility.

==========================================================
VERIFY EACH SECTION
==========================================================

Confirm that all Contact page sections respect ordering:

✓ Contact Form

✓ Office Locations

✓ Meet Our Office Team

Any future section added to the Contact page must also automatically follow the CMS order.

==========================================================
TESTING
==========================================================

Perform the following tests:

Move Office Team to Order 1.

Save.

Refresh frontend.

Office Team should now appear first.

Move Office Locations to Order 3.

Save.

Refresh frontend.

Office Locations should now appear last.

Move Contact Form to Order 2.

Save.

Refresh frontend.

Order should immediately update.

Repeat multiple times.

The ordering should always match the CMS.

==========================================================
FINAL GOAL
==========================================================

The Contact page must use the exact same dynamic section ordering system used throughout the rest of the website.

The frontend should never rely on hardcoded section positions.

It must always render sections based on the order configured in the CMS.

Find the root cause, fix only what is necessary, preserve the existing architecture, and ensure future Contact page sections also follow the same ordering automatically.