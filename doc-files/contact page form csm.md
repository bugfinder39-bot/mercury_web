Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

The website is already fully functional.

Do NOT rebuild the Contact Page.

Do NOT create another Contact Form system.

Do NOT duplicate CMS components.

Do NOT duplicate database tables.

Do NOT hardcode form fields.

Only extend the existing Contact Form component and integrate it fully with the existing Page Management architecture.

==========================================================
OBJECTIVE
==========================================================

Currently, the Contact Form is mostly hardcoded.

I want the Contact Form to become a fully CMS-driven component, just like every other section on the website.

Everything should be editable from the CMS.

The Contact Form itself should behave like the other Contact page sections.

It should support:

• Dynamic ordering
• Enable/Disable
• Full content editing
• Dynamic form fields
• Future scalability

==========================================================
PAGE MANAGEMENT
==========================================================

Inside CMS:

Page Management

↓

Contact Page

↓

The Contact Form should become a normal Page Section.

Exactly like:

✓ Office Locations

✓ Office Team

It must:

• Respect Display Order

• Respect Visibility

• Respect Status

• Respect Enable/Disable

The Contact Form must move automatically when I change its order.

Example:

Order 1

↓

Contact Form becomes first.

Order 3

↓

Contact Form becomes last.

It should behave exactly like every other Contact page component.

==========================================================
CMS CONTENT EDITING
==========================================================

The Contact Form section itself should become editable.

Allow editing:

Section Badge

Example:

MESSAGE DESK

Section Number

Example:

MB · 01

Section Title

Example:

Send Us A Message

Subtitle

Example:

Our coordinators will review your cargo requirements immediately.

Form Card Title

Example:

Send a Message

Form Description

Button Text

Button Icon

Success Message

Error Message

Required Field Text

Placeholder Text

Everything should come from CMS.

==========================================================
DYNAMIC FORM BUILDER
==========================================================

I want to configure which fields appear.

Create a Form Fields manager inside the existing Contact Form component.

Each field should have:

Field Label

Field Name

Field Type

Placeholder

Required

Width

Order

Status

==========================================================
SUPPORTED FIELD TYPES
==========================================================

Support:

Single Line Text

Email

Phone

Number

Textarea

Dropdown

Radio

Checkbox

Date

Time

File Upload (optional for future)

Hidden

==========================================================
FIELD SETTINGS
==========================================================

Each field should support:

Label

Placeholder

Required ON/OFF

Visible ON/OFF

Half Width

Full Width

Validation

Default Value

Display Order

Help Text

==========================================================
FIELD ORDERING
==========================================================

Inside CMS,

I should be able to drag or reorder fields.

Example:

Full Name

↓

Email

↓

Phone

↓

Company

↓

Subject

↓

Message

The frontend should automatically render fields in that order.

==========================================================
ENABLE / DISABLE FIELDS
==========================================================

Every field should have:

Show

Hide

Toggle

If disabled,

the field disappears completely from the frontend.

No empty spacing should remain.

==========================================================
FORM SUBMISSION
==========================================================

Do NOT break the existing form submission.

Keep the current backend logic.

Only make the frontend render dynamically.

Existing message inbox functionality must continue working.

==========================================================
DATABASE
==========================================================

Audit the existing database first.

If possible,

reuse the existing tables.

Only create or modify tables if absolutely necessary.

If additional fields are required,

create proper migrations.

Maintain backward compatibility.

Do NOT duplicate data.

==========================================================
PAGE ORDERING
==========================================================

Ensure the Contact Form itself follows the existing Page Sections ordering system.

Use the same implementation already used by:

Home Page

About Page

Services Page

Office Locations

Office Team

Do NOT implement a separate ordering system.

==========================================================
FRONTEND
==========================================================

The Contact Form component should render dynamically.

Everything should come from CMS.

No hardcoded:

Labels

Titles

Descriptions

Placeholders

Button Text

Field Order

Field Visibility

==========================================================
AUDIT
==========================================================

Audit the complete flow.

CMS

↓

Database

↓

Models

↓

Relationships

↓

Controller

↓

Inertia

↓

Vue

↓

Frontend

Find any hardcoded values and replace them with CMS-driven values while preserving existing functionality.

==========================================================
TESTING
==========================================================

Verify:

✓ Edit section title

↓

Frontend updates.

✓ Edit subtitle

↓

Frontend updates.

✓ Edit button text

↓

Frontend updates.

✓ Add new field

↓

Appears automatically.

✓ Delete field

↓

Disappears.

✓ Disable field

↓

Hidden.

✓ Reorder fields

↓

Frontend follows new order.

✓ Reorder Contact Form section

↓

Moves correctly on Contact page.

✓ Form submission still works.

✓ Messages still reach the inbox.

✓ Validation still works.

✓ Responsive layout still works.

✓ No console errors.

✓ No Laravel errors.

==========================================================
RESPONSIVE
==========================================================

Maintain a premium responsive layout.

Desktop

Tablet

Mobile

Half-width fields should automatically stack on smaller screens.

==========================================================
FINAL GOAL
==========================================================

Transform the existing Contact Form into a fully CMS-driven, enterprise-level dynamic component.

The Contact Form must become a first-class Page Section that behaves exactly like every other section on the Contact page.

Administrators should be able to:

• Edit every piece of text

• Enable or disable the section

• Change the section order

• Add, edit, remove, and reorder form fields

• Configure field visibility

• Configure required fields

• Configure placeholders

• Configure button text

without modifying any code.

Do not rebuild the existing system. Extend the current architecture, reuse existing models and relationships wherever possible, modify the database only where necessary, preserve backward compatibility, and ensure all changes integrate seamlessly with the existing CMS and Contact page.