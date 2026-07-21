Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT rebuild the Office Team module.

Do NOT remove the Office Team functionality.

Do NOT break the CMS.

Do NOT remove the database structure unless it is only used for profile images.

Your task is to redesign the Office Team section by removing staff profile photos while keeping the entire module fully dynamic and editable through the CMS.

==========================================================
OBJECTIVE
==========================================================

The current Office Team cards display profile photos.

I no longer want profile photos.

The design should be cleaner, simpler, and more corporate.

The Office Team should become an information-based contact directory.

==========================================================
FRONTEND
==========================================================

Remove the profile image completely.

Remove:

• Circular profile photo
• Image placeholder
• Avatar container
• Image spacing

Redesign each card without leaving empty space.

Use typography and icons to create a premium corporate layout.

==========================================================
CARD DESIGN
==========================================================

Each Office Team card should display only:

• Full Name
• Designation
• Department (optional)
• Office Location
• Phone Number
• Mobile Number
• WhatsApp Number
• Email Address
• Extension Number (optional)
• LinkedIn (optional)
• Facebook (optional)
• Short Description (optional)

Use:

• Orange icons
• Soft shadows
• Rounded corners
• Modern spacing
• Hover elevation
• Professional typography
• Clean layout

No profile image should appear.

==========================================================
CMS
==========================================================

Inside:

Admin

↓

Page Management

↓

Contact Page

↓

Office Team

Remove every image-related field.

Remove:

• Profile Photo Upload
• Image Preview
• Replace Image
• Delete Image

The admin should only manage text-based information.

==========================================================
DATABASE
==========================================================

Audit the Office Team database structure.

If the profile image field is no longer required anywhere in the project:

• Remove the unused image column through a proper migration.

OR

If keeping the image field improves future extensibility:

• Keep the database column but remove it from the CMS and frontend.

Do NOT break existing data.

Do NOT create duplicate migrations.

==========================================================
REMOVE IMAGE LOGIC
==========================================================

Remove image-related logic only from the Office Team module.

Remove:

• Image upload handling
• Image validation
• Image preview
• Image replacement
• Image deletion
• Media library integration
• Image rendering

Do not affect image uploads used elsewhere in the CMS.

==========================================================
SAVE FLOW
==========================================================

Verify that editing the following fields still works:

✓ Name

✓ Designation

✓ Department

✓ Office Location

✓ Phone

✓ Mobile

✓ WhatsApp

✓ Email

✓ Extension

✓ LinkedIn

✓ Facebook

✓ Short Description

Everything should continue saving correctly through the CMS.

==========================================================
RESPONSIVE
==========================================================

Desktop

3 cards per row

Tablet

2 cards per row

Mobile

1 card per row

Automatically wrap when more team members are added.

==========================================================
FINAL TEST
==========================================================

Verify:

✓ Add team member

✓ Edit team member

✓ Delete team member

✓ Reorder team member

✓ Enable/Disable team member

✓ Update contact information

✓ Save changes

✓ Refresh CMS

✓ Refresh frontend

✓ No profile image is displayed

✓ No image upload option exists in the CMS

✓ Everything continues working correctly

==========================================================
FINAL GOAL
==========================================================

Create a clean, elegant, corporate Office Team section that serves as a professional contact directory.

The section should no longer display staff photos or allow photo uploads. Instead, it should focus on names, designations, departments, contact information, and social links.

The module must remain fully dynamic, scalable, CMS-managed, database-driven, and production-ready.