Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the Footer.

Do NOT rebuild the CMS.

Do NOT create another Footer Settings module.

Do NOT create duplicate Footer Contact Information.

There are currently TWO different Footer Contact Information settings inside the CMS, and this is causing conflicts.

Your task is to consolidate everything into ONE clean implementation.

Modify ONLY what is necessary.

If database changes are required, create proper migrations while maintaining full backward compatibility.

==========================================================
CURRENT PROBLEM
==========================================================

There are currently TWO different places that manage Footer Contact Information.

1.

Layout Management

↓

Footer

↓

Contact Information

AND

2.

Global Settings

↓

Footer Contact Information

This creates duplicate data, conflicting settings, and confusion.

This architecture is incorrect.

==========================================================
OBJECTIVE
==========================================================

There must be ONLY ONE source of truth for all Footer Contact Information.

The Footer should ONLY read data from:

CMS

↓

Layout Management

↓

Footer

Remove all duplicate Footer Contact Information settings from Global Settings.

Do NOT leave two competing implementations.

==========================================================
CMS STRUCTURE
==========================================================

The Footer Contact Information should exist ONLY here:

Layout Management

↓

Footer

↓

Contact Information

Everything related to:

Phone Numbers

Email Addresses

Office Addresses

must be managed from this single location.

==========================================================
REMOVE DUPLICATION
==========================================================

Audit the entire project.

Search for every place that reads or writes:

Footer Phone

Footer Email

Footer Address

Footer Contact

Global Footer

Layout Footer

Remove duplicate implementations.

Update every controller, model, relationship, Vue component, and frontend component so they all use ONE shared Footer Contact source.

==========================================================
MULTIPLE PHONE NUMBERS
==========================================================

Currently,

only ONE phone number can be added.

This is NOT acceptable.

Replace the existing implementation with repeatable items.

Inside CMS:

Layout Management

↓

Footer

↓

Phone Numbers

Administrators should be able to:

✓ Add Phone

✓ Edit Phone

✓ Delete Phone

✓ Reorder Phone

✓ Enable / Disable Phone

Each phone item should support:

Phone Number

Label

Examples:

Office

Sales

Support

Hotline

WhatsApp

Display Order

Status

Unlimited phone numbers.

==========================================================
MULTIPLE EMAILS
==========================================================

Replace the single Email field.

Support unlimited Email Addresses.

Each Email should support:

Email

Label

Display Order

Status

Unlimited repeatable emails.

==========================================================
MULTIPLE ADDRESSES
==========================================================

Replace the single Address field.

Support unlimited Office Addresses.

Each address should support:

Office Name

Address

Google Maps URL (optional)

Display Order

Status

Unlimited repeatable addresses.

==========================================================
DATABASE
==========================================================

Audit the existing database.

Do NOT duplicate data.

Reuse existing tables whenever possible.

If repeatable tables already exist,

reuse them.

If new relationships or tables are genuinely required,

create ONLY what is necessary.

Create proper migrations.

Maintain backward compatibility.

If data currently exists in Global Settings,

migrate it into the Layout Management Footer automatically.

Do NOT lose existing data.

==========================================================
BACKEND
==========================================================

Audit:

Controllers

Models

Relationships

Services

Repositories

Validation

Inertia Props

Vue Components

Ensure every Footer Contact Information request now uses ONLY the Layout Management Footer.

Nothing should reference Global Settings anymore.

==========================================================
FRONTEND
==========================================================

Render everything dynamically.

Examples:

If there is:

1 Phone

Display one beautifully.

If there are:

5 Phones

Display all five properly.

If there are:

No Phones

Hide the phone section.

Do exactly the same for:

Emails

Addresses

No empty gaps should remain.

==========================================================
DESIGN
==========================================================

Maintain the existing Mercury design system.

Do NOT redesign the Footer.

Only improve the dynamic rendering.

Whether there is:

1 Phone

or

10 Phones

the layout should remain clean, responsive, elegant, and professional.

The same applies to:

Emails

Addresses

==========================================================
TESTING
==========================================================

Verify:

✓ Only ONE Footer Contact Information module exists inside the CMS.

✓ Global Settings no longer manages Footer Contact Information.

✓ Layout Management becomes the single source of truth.

✓ Add multiple phone numbers.

✓ Edit phone numbers.

✓ Delete phone numbers.

✓ Reorder phone numbers.

✓ Enable / Disable phone numbers.

✓ Add multiple emails.

✓ Edit emails.

✓ Delete emails.

✓ Reorder emails.

✓ Enable / Disable emails.

✓ Add multiple addresses.

✓ Edit addresses.

✓ Delete addresses.

✓ Reorder addresses.

✓ Enable / Disable addresses.

✓ Frontend updates immediately.

✓ Changes persist after refresh.

✓ No duplicated data.

✓ No conflicting queries.

✓ No console errors.

✓ No Laravel errors.

==========================================================
FINAL REQUIREMENT
==========================================================

Perform a complete audit of every Footer Contact Information implementation.

Remove duplicate CMS locations.

Make Layout Management → Footer the ONLY location that controls Footer Contact Information.

Implement fully functional repeatable CRUD for Phone Numbers, Email Addresses, and Office Addresses.

If database changes are necessary, perform them correctly using migrations and migrate any existing data safely.

Update every controller, model, relationship, Vue component, frontend component, and database query so the Footer uses one unified data source without conflicts.

Do not finish until the Footer Contact Information is fully dynamic, repeatable, conflict-free, production-ready, and managed entirely from one place in the CMS.