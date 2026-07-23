Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the existing CMS.

Do NOT replace the existing Page Management system.

Do NOT create duplicate page architectures.

Do NOT break any existing pages.

Extend the current CMS architecture by adding ONE new page called "Coming Soon" that follows the exact same design system and CMS structure as the other pages.

Modify ONLY what is necessary.

==========================================================
OBJECTIVE
==========================================================

Create a brand-new page:

Coming Soon

This page should be fully integrated into the existing website and CMS.

It must follow the exact same premium design language used throughout the website.

The page should communicate that a particular feature, service, or page is currently under development.

The message should feel professional, premium, trustworthy, and exciting.

It should clearly say:

• Coming Soon

• Work In Progress

while encouraging visitors to check back later.

==========================================================
DESIGN REQUIREMENTS
==========================================================

The Coming Soon page must NOT look like a plain maintenance page.

It should feel like a premium corporate landing page.

Use the existing design system.

Follow:

• Navy Blue

• Orange

• White

• Optional Light Steel Blue (if already used in the project)

Maintain consistency with:

Navbar

Footer

Typography

Animations

Cards

Buttons

Spacing

Gradients

Glass effects

Micro interactions

Everything should immediately feel like part of the Mercury website.

==========================================================
LAYOUT
==========================================================

Create a beautiful full-page layout.

Suggested structure:

1.

Premium Hero Section

Large title:

COMING SOON

Animated subtitle

Decorative graphics

Background illustration

Floating shipping elements

Animated cargo icons

Premium CTA

2.

Work In Progress Section

Short explanation

Progress illustration

Construction style but elegant

Timeline or progress indicator (optional)

3.

What To Expect

Cards describing upcoming features

Dynamic CMS content

4.

Stay Connected

Optional CTA

Contact Button

Return Home Button

==========================================================
ANIMATIONS
==========================================================

Use the same premium animation language as the rest of the website.

Examples:

Hero Text Reveal

Typewriter

Word Reveal

Fade

Slide

Floating Elements

Gradient Animation

Hover Effects

Button Animation

Icon Animation

Scroll Reveal

Everything should feel polished.

==========================================================
CMS INTEGRATION
==========================================================

Create this page using the existing Page Management architecture.

Do NOT hardcode content.

The Coming Soon page should be fully editable.

==========================================================
PAGE MANAGEMENT
==========================================================

Inside CMS:

Page Management

↓

Coming Soon

Administrators should be able to edit every section.

==========================================================
CMS EDITABLE CONTENT
==========================================================

Hero Badge

Hero Title

Hero Subtitle

Work In Progress Title

Work In Progress Description

CTA Button Text

CTA Button URL

Return Home Button

Return Home URL

Progress Label

Expected Launch Text

Footer CTA

All text should be editable.

==========================================================
REPEATABLE COMPONENTS
==========================================================

Allow repeatable cards for:

Upcoming Features

Services Coming Soon

Announcements

Each item should support:

Title

Subtitle

Description

Icon

Image (optional)

Order

Status

Everything should follow the existing Repeatable Items architecture.

==========================================================
COMING SOON PAGE TOGGLE
==========================================================

Add a new option inside:

CMS

↓

Layout Management

↓

Global Settings

OR

Website Settings

(whichever fits the existing architecture best)

Create:

Enable Coming Soon Mode

Boolean Toggle

Default:

OFF

==========================================================
HOW IT SHOULD WORK
==========================================================

If

Coming Soon Mode = OFF

↓

Website behaves normally.

All pages work normally.

If

Coming Soon Mode = ON

↓

Visitors are redirected to the Coming Soon page.

The Coming Soon page becomes the primary public page.

Exceptions:

Admin Panel

Authentication

Login

Dashboard

CMS

must continue working normally.

Only public visitors should see the Coming Soon page.

==========================================================
OPTIONAL PAGE SELECTION
==========================================================

If the current architecture allows,

add another CMS option:

Coming Soon Target

Dropdown

Examples:

Entire Website

Home Only

Services Page

About Page

Contact Page

Specific Page

If implementing this would require major architectural changes,

skip it.

Only implement if it naturally fits the existing CMS.

==========================================================
DATABASE
==========================================================

Audit the existing architecture first.

Reuse existing tables whenever possible.

If additional fields are required,

create proper migrations.

Only add what is necessary.

Do NOT duplicate tables.

Maintain backward compatibility.

==========================================================
NAVIGATION
==========================================================

The Coming Soon page should automatically use:

Existing Navbar

Existing Footer

Existing Theme

Existing Layout

Existing SEO structure

No duplicate layouts.

==========================================================
RESPONSIVE
==========================================================

Desktop

Tablet

Mobile

The page must remain visually impressive on every device.

==========================================================
TESTING
==========================================================

Verify:

✓ Coming Soon page renders correctly.

✓ All content comes from CMS.

✓ Toggle OFF

↓

Website works normally.

✓ Toggle ON

↓

Public visitors see Coming Soon page.

✓ Admin panel still works.

✓ Login still works.

✓ Dashboard still works.

✓ All page content updates from CMS.

✓ Repeatable components work.

✓ Order changes work.

✓ Enable/Disable works.

✓ Responsive layout works.

✓ Animations work.

✓ No console errors.

✓ No Laravel errors.

==========================================================
SEO
==========================================================

Allow editing:

SEO Title

Meta Description

OG Title

OG Description

OG Image

Canonical URL

through the existing SEO & Meta Settings system.

==========================================================
FINAL GOAL
==========================================================

Create a premium "Coming Soon / Work In Progress" page that feels like a natural extension of the Mercury website rather than a generic maintenance page.

The page must be fully CMS-driven, beautifully designed, responsive, animated, and follow the exact same visual identity, typography, spacing, color palette, and interaction patterns used throughout the rest of the website.

Administrators should be able to:

• Turn Coming Soon Mode ON/OFF

• Edit every section

• Manage repeatable content

• Control page content from the CMS

• Keep the existing website architecture intact

Implement this by extending the current system only, modifying the database only when required, and preserving full backward compatibility.