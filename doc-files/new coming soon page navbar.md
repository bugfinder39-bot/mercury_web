Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the CMS.

Do NOT rebuild Layout Management.

Do NOT rebuild the Coming Soon page.

Do NOT create duplicate Navbar or Footer settings.

Extend the EXISTING architecture only.

Modify ONLY what is necessary.

If database changes are required, create only the minimum required migrations while maintaining full backward compatibility.

==========================================================
OBJECTIVE
==========================================================

There are TWO tasks.

Task 1:
Extend the Coming Soon page so I can independently enable or disable the Navbar and Footer through the existing CMS.

Task 2:
Extend the Footer so it supports multiple Phone Numbers, Email Addresses, and Office Addresses using repeatable fields managed entirely from the existing CMS.

Everything must integrate into the existing architecture.

==========================================================
==========================================================
TASK 1
COMING SOON PAGE
==========================================================
==========================================================

The Coming Soon page already exists.

Do NOT rebuild it.

Simply extend it.

----------------------------------------------------------
CMS
----------------------------------------------------------

Inside the existing CMS,

use the existing module.

Either:

Page Management

↓

Coming Soon

OR

Layout Management

↓

Coming Soon Settings

(whichever best fits the current architecture)

Do NOT create another settings page.

----------------------------------------------------------
NEW SETTINGS
----------------------------------------------------------

Add:

Show Navbar

Boolean Toggle

Default:

OFF

--------------------------------------------

Add:

Show Footer

Boolean Toggle

Default:

OFF

----------------------------------------------------------
FRONTEND BEHAVIOR
----------------------------------------------------------

Navbar OFF

↓

Hide Navbar completely.

No empty spacing.

Automatically adjust layout.

----------------------------------------------------------

Footer OFF

↓

Hide Footer completely.

No empty spacing.

Automatically adjust layout.

----------------------------------------------------------

Navbar ON

↓

Show existing Navbar.

----------------------------------------------------------

Footer ON

↓

Show existing Footer.

----------------------------------------------------------

The Coming Soon page must support:

✓ Navbar ON

✓ Navbar OFF

✓ Footer ON

✓ Footer OFF

✓ Navbar + Footer

✓ No Navbar + No Footer

The page should automatically adapt its layout beautifully.

==========================================================
DATABASE
==========================================================

Audit the current database first.

Reuse existing settings if possible.

If required,

ONLY add:

show_navbar

Boolean

Default FALSE

show_footer

Boolean

Default FALSE

Create proper migrations only if absolutely necessary.

==========================================================
==========================================================
TASK 2
FOOTER CONTACT INFORMATION
==========================================================
==========================================================

The Footer already exists.

Do NOT rebuild it.

Do NOT create another Footer module.

Extend the existing Footer Settings inside:

CMS

↓

Layout Management

↓

Footer

==========================================================
CURRENT LIMITATION
==========================================================

Currently,

the Footer only supports:

One Phone Number

One Email Address

One Office Address

This is too limited.

==========================================================
OBJECTIVE
==========================================================

The Footer should support unlimited:

Phone Numbers

Email Addresses

Office Addresses

Administrators should decide how many to display.

If only one exists,

the Footer should still look perfectly designed.

If multiple exist,

they should automatically render beautifully.

==========================================================
CMS
==========================================================

Inside the existing Footer settings,

replace the single fields with repeatable collections.

----------------------------------------------------------

PHONE NUMBERS

Repeatable CRUD

Each phone should support:

Phone Number

Label (optional)

Examples:

Office

Hotline

Sales

Support

WhatsApp

Display Order

Status

----------------------------------------------------------

EMAILS

Repeatable CRUD

Each email should support:

Email Address

Label (optional)

Display Order

Status

----------------------------------------------------------

OFFICE ADDRESSES

Repeatable CRUD

Each address should support:

Office Name (optional)

Address

Google Maps URL (optional)

Display Order

Status

==========================================================
CMS FEATURES
==========================================================

Each repeatable collection must support:

✓ Add

✓ Edit

✓ Delete

✓ Enable

✓ Disable

✓ Drag & Drop Ordering (or existing ordering system)

✓ Save

Everything should follow the same Repeatable Items architecture already used throughout the CMS.

==========================================================
FRONTEND
==========================================================

Render dynamically.

----------------------------------------------------------

If there is:

1 Phone Number

Display one beautifully.

----------------------------------------------------------

If there are:

5 Phone Numbers

Display all five elegantly.

----------------------------------------------------------

If there are:

No Phone Numbers

Hide the entire phone section automatically.

----------------------------------------------------------

Do exactly the same behavior for:

Emails

Addresses

==========================================================
DESIGN
==========================================================

Do NOT simply stack plain text.

Maintain the premium Mercury design.

Use:

Icons

Spacing

Labels

Typography

Proper alignment

Responsive layout

Hover effects where appropriate.

The Footer should continue looking clean and premium whether there is:

1 item

or

20 items.

==========================================================
DATABASE
==========================================================

Audit the existing Footer implementation first.

Reuse the existing structure whenever possible.

If repeatable tables already exist,

reuse them.

If additional tables or relationships are genuinely required,

create only what is necessary.

Maintain backward compatibility.

Do NOT duplicate data.

Do NOT create unnecessary tables.

==========================================================
BACKEND
==========================================================

Audit:

Models

Controllers

Relationships

Validation

Repositories

Services

API Responses

Inertia Props

Vue Components

Everything must remain synchronized.

==========================================================
TESTING
==========================================================

COMING SOON

✓ Navbar ON

✓ Navbar OFF

✓ Footer ON

✓ Footer OFF

✓ Layout adjusts automatically

✓ Settings persist after refresh

----------------------------------------------------------

FOOTER

✓ Add one phone

✓ Add five phones

✓ Delete phones

✓ Reorder phones

✓ Disable phones

✓ Add one email

✓ Add multiple emails

✓ Delete emails

✓ Reorder emails

✓ Disable emails

✓ Add one address

✓ Add multiple addresses

✓ Delete addresses

✓ Reorder addresses

✓ Disable addresses

Verify everything updates instantly on the frontend.

Verify responsive layouts.

Verify no empty gaps remain.

Verify no console errors.

Verify no Laravel errors.

==========================================================
FINAL GOAL
==========================================================

Extend the existing CMS without rebuilding it.

The Coming Soon page should allow administrators to independently show or hide the Navbar and Footer using simple CMS toggles.

The Footer should support unlimited Phone Numbers, Email Addresses, and Office Addresses through repeatable CMS items while automatically maintaining a clean, premium, responsive design regardless of whether there is one item or many.

Reuse the existing architecture, repeatable item system, Layout Management, and Page Management wherever possible.

Modify only the necessary controllers, Vue components, models, relationships, database fields, and migrations required to implement these features while preserving backward compatibility and keeping the codebase clean and production-ready.