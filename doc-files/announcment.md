Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the CMS.

Do NOT create duplicate announcement modules.

Integrate this feature into the existing architecture.

Modify ONLY what is necessary.

Maintain full backward compatibility.

If database changes are required, create proper migrations.

==========================================================
NEW FEATURE
ANNOUNCEMENT SYSTEM
==========================================================

I want to implement a fully dynamic Announcement System that can be managed entirely from the existing CMS.

The announcement should be displayable anywhere in the website depending on the administrator's settings.

Everything must be editable through the CMS.

==========================================================
CMS MODULE
==========================================================

Create a CMS module named:

Announcements

The administrator should be able to:

✓ Create Announcement

✓ Edit Announcement

✓ Delete Announcement

✓ Search

✓ Filter

✓ Enable / Disable

✓ Pin Announcement

✓ Schedule Announcement

✓ Set Start Date

✓ Set End Date

✓ Preview

✓ Reorder

Everything should follow the existing CMS architecture.

==========================================================
ANNOUNCEMENT INFORMATION
==========================================================

Each announcement should support:

Title

Short Description

Full Description (optional)

Announcement Type

Examples:

General

Holiday Notice

Maintenance

Shipping Delay

Service Update

Emergency Notice

Success Message

Information

Priority

Low

Normal

High

Critical

Background Color

Text Color

Icon (optional)

Button Text (optional)

Button URL (optional)

Display Order

Status

Pinned

Dismissible

==========================================================
DISPLAY OPTIONS
==========================================================

The administrator should decide where announcements appear.

Options include:

Top Bar (above Navbar)

Homepage Only

All Pages

Specific Pages

Popup (optional)

Banner

Inline Section

Everything should be configurable.

==========================================================
SECTION SETTINGS
==========================================================

Inside the CMS allow:

Enable / Disable Announcement System

Show Multiple Announcements

Maximum Announcements

Auto Rotate

Animation Style

Display Duration

Sticky Toggle

==========================================================
SCHEDULING
==========================================================

Allow administrators to:

Schedule announcement publishing.

Automatically publish.

Automatically expire.

Hide expired announcements.

==========================================================
FRONTEND
==========================================================

Announcements should automatically appear based on CMS settings.

Use smooth animations.

Professional styling.

Responsive layout.

No layout shifts.

==========================================================
DATABASE
==========================================================

Audit existing database.

Reuse existing structures if possible.

Create only necessary tables and relationships.

Create proper migrations.

==========================================================
BACKEND
==========================================================

Implement:

Models

Controllers

Policies

Validation

Services

Relationships

Inertia Props

==========================================================
PERMISSIONS
==========================================================

Only authorized administrators may:

Create

Edit

Delete

Enable

Disable

Schedule

Reorder

Announcements.

==========================================================
TESTING
==========================================================

Verify:

✓ Create announcement

✓ Edit announcement

✓ Delete announcement

✓ Enable announcement

✓ Disable announcement

✓ Schedule announcement

✓ Expire announcement

✓ Sticky announcement

✓ Homepage display

✓ All pages display

✓ Responsive layout

✓ No console errors

✓ No Laravel errors

==========================================================
FINAL REQUIREMENT
==========================================================

Implement a fully CMS-driven Announcement System that is completely customizable.

Every aspect including content, appearance, scheduling, visibility, animation, ordering, and placement must be manageable from the CMS.

Modify only the necessary backend, frontend, database, Vue components, controllers, models, and CMS pages.

Do not finish until the feature is production-ready, responsive, secure, fully integrated into the existing architecture, and can be enabled or disabled like every other feature in the CMS.