Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT hardcode any Navbar or Footer content.

Do NOT break the existing CMS architecture.

Do NOT create duplicate settings pages.

Everything must be fully dynamic and editable through the CMS.

==========================================================
OBJECTIVE
==========================================================

Create a new CMS module called:

Global Layout

or

Layout Management

This module will manage every global element that appears on every page of the website.

Inside this module there should be two main sections:

• Navbar Settings

• Footer Settings

Every change should immediately update the frontend after saving.

==========================================================
CMS MENU
==========================================================

Create a new admin menu.

Admin

↓

Layout Management

Inside it create:

• Navbar Settings

• Footer Settings

The UI should match the design of the existing CMS.

==========================================================
DATABASE
==========================================================

Create the necessary database structure if it does not already exist.

Do NOT hardcode any values.

Store every layout setting in the database.

Use the existing Settings architecture if possible.

Otherwise create a proper scalable solution.

==========================================================
NAVBAR SETTINGS
==========================================================

Everything in the Navbar must be editable.

Include:

------------------------------------------------

Brand Logo

Upload

Replace

Delete

Preview

------------------------------------------------

Website Name

------------------------------------------------

Navigation Menu

Add Menu

Edit Menu

Delete Menu

Reorder Menu

Enable / Disable Menu

Change Label

Change URL

Open in New Tab

------------------------------------------------

CTA Button

Button Text

Button URL

Enable / Disable

------------------------------------------------

Navbar Style

Transparent

Solid

Glass Morphism

Sticky

Enable / Disable Blur

Enable Shadow

Border Bottom

==========================================================
NAVBAR COLORS
==========================================================

The admin should be able to change:

Navbar Background

Navbar Text Color

Navbar Hover Color

Active Menu Color

CTA Background

CTA Text

CTA Hover Background

CTA Hover Text

Glass Opacity

Glass Blur

Border Color

Shadow Strength

These values should be stored in the database.

The frontend should automatically use these settings.

==========================================================
FOOTER SETTINGS
==========================================================

Everything inside the footer should be editable.

------------------------------------------------

Footer Logo

------------------------------------------------

Company Name

------------------------------------------------

Company Description

------------------------------------------------

Quick Links

CRUD

------------------------------------------------

Services List

CRUD

------------------------------------------------

Newsletter

Heading

Description

Enable / Disable

------------------------------------------------

Social Media

Facebook

LinkedIn

Instagram

YouTube

Twitter

WhatsApp

Add

Edit

Delete

Enable / Disable

------------------------------------------------

Office Address

------------------------------------------------

Phone

------------------------------------------------

Email

------------------------------------------------

Copyright Text

------------------------------------------------

Bottom Tagline

Example:

Precise • Calm • Dependable

Editable.

==========================================================
FOOTER COLORS
==========================================================

The admin should be able to change:

Footer Background

Footer Text

Heading Color

Link Color

Link Hover Color

Icon Background

Icon Color

Border Color

Newsletter Background

Newsletter Button Color

Newsletter Button Text

Copyright Color

Bottom Section Background

Shadow Strength

Everything should update dynamically.

==========================================================
TYPOGRAPHY
==========================================================

Allow changing:

Heading Color

Paragraph Color

Small Text Color

Navigation Font Weight

Footer Font Weight

==========================================================
SPACING
==========================================================

Allow changing:

Navbar Height

Footer Top Padding

Footer Bottom Padding

Container Width

==========================================================
LIVE PREVIEW
==========================================================

Whenever possible,

show a live preview of:

Navbar

Footer

before saving.

==========================================================
VALIDATION
==========================================================

Validate:

Logo Upload

Image Size

URL Format

Hex Color Values

Menu Labels

Required Fields

==========================================================
SAVE FLOW
==========================================================

When clicking Save:

Validate

↓

Update Database

↓

Upload Media

↓

Save Colors

↓

Refresh Layout

↓

Immediately update frontend.

==========================================================
REMOVE HARDCODED VALUES
==========================================================

Audit the entire project.

Remove every hardcoded value used in:

Navbar

Footer

Examples:

Logo

Company Name

Navigation Items

Footer Links

Services

Social Icons

Phone

Email

Address

Copyright

Tagline

Colors

Everything must come from the database.

==========================================================
RESPONSIVE
==========================================================

Ensure every editable change works correctly on:

Desktop

Tablet

Mobile

==========================================================
FINAL TEST
==========================================================

Verify:

✓ Change logo

✓ Change navbar background

✓ Change navbar text color

✓ Change CTA button color

✓ Add new menu item

✓ Remove menu item

✓ Reorder menu

✓ Change footer logo

✓ Edit company information

✓ Change footer colors

✓ Change social links

✓ Edit newsletter

✓ Edit quick links

✓ Edit services list

✓ Change copyright text

✓ Change tagline

✓ Refresh admin

✓ Refresh frontend

✓ Verify every change persists

✓ Verify all values come from the database

==========================================================
FINAL GOAL
==========================================================

Build a production-ready Global Layout Management system where the entire Navbar and Footer are fully dynamic.

The client should never need to edit code to change any Navbar or Footer content, styling, colors, menus, logos, social links, or branding.

Everything should be managed through the CMS, stored in the database, and reflected immediately on the frontend.