Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT break the existing Contact Form.

Do NOT remove any current functionality.

Do NOT hardcode any content.

Everything must be fully dynamic and manageable through the CMS.

==========================================================
OBJECTIVE
==========================================================

Redesign the Contact page to improve user experience and information hierarchy.

The page order should become:

1. Contact Form (First)
2. Office Locations (Second)
3. Office Team / Contact Persons (Third)

Everything must be editable from the CMS.

==========================================================
NEW CONTACT PAGE STRUCTURE
==========================================================

SECTION 1

SEND US A MESSAGE

This should appear immediately after the page banner.

The contact form should become the primary focus.

Requirements:

• Centered layout
• Large width (800-900px)
• Premium card design
• Better spacing
• Soft shadow
• Responsive
• Existing functionality remains unchanged

Do not change the form logic.

==========================================================
SECTION 2

OUR OFFICE LOCATIONS

Move the Office Locations section below the contact form.

Keep the existing Office cards.

Everything should remain editable.

Admin should still be able to:

Add Office

Edit Office

Delete Office

Reorder Office

Enable / Disable Office

Google Map

Address

Phone

Email

Business Hours

Office Image

Everything should continue using the existing CMS and database.

==========================================================
SECTION 3

OFFICE TEAM

Create an entirely new section below Office Locations.

This section will display company contact persons.

Examples:

Managing Director

Operations Manager

Sales Executive

Customer Support

Documentation Officer

Branch Manager

Marketing Manager

The design should be modern and professional.

==========================================================
CMS
==========================================================

Inside

Admin

↓

Page Management

↓

Contact Page

Create a new component called

Office Team

This should function like all other dynamic components.

==========================================================
DATABASE
==========================================================

Create a proper scalable database structure if needed.

Each person should be stored independently.

Do NOT hardcode any people.

Everything should come from the database.

==========================================================
ADMIN FEATURES
==========================================================

The admin should be able to

Add Person

Edit Person

Delete Person

Reorder Person

Enable / Disable Person

Everything should save immediately.

==========================================================
EACH PERSON SHOULD SUPPORT
==========================================================

Profile Photo

Full Name

Designation

Department

Office Location

Phone Number

Mobile Number

WhatsApp Number

Email Address

Extension Number

LinkedIn URL

Facebook URL

Display Order

Status

Short Description

==========================================================
IMAGE SUPPORT
==========================================================

Support:

Upload

Replace

Delete

Preview

Everything should use the existing media upload system.

==========================================================
CARD DESIGN
==========================================================

Each person should have a modern card.

Include:

Circular profile photo

Name

Designation

Department

Phone

Email

WhatsApp

LinkedIn

Call button

Email button

WhatsApp button

Orange accent icons

Soft shadows

Rounded corners

Hover animation

Consistent spacing

Responsive design

==========================================================
LAYOUT
==========================================================

Desktop

3 cards per row

Tablet

2 cards per row

Mobile

1 card per row

Automatically wrap when more people are added.

==========================================================
SCALABILITY
==========================================================

The layout must support unlimited people.

If there are:

3 people

Show 3 cards.

6 people

Automatically create two rows.

12 people

Automatically continue creating rows.

No code changes should ever be required.

Everything should be generated dynamically.

==========================================================
CMS VALIDATION
==========================================================

Validate:

Name

Designation

Phone

Email

Image

URLs

Status

==========================================================
SAVE FLOW
==========================================================

Admin edits person

↓

Clicks Save

↓

Validation

↓

Database updates

↓

Media uploads

↓

Refresh CMS

↓

Frontend automatically updates

==========================================================
REMOVE HARDCODED CONTENT
==========================================================

Audit the new Office Team section.

No hardcoded:

Names

Photos

Phone numbers

Emails

Designation

Department

Social links

Everything must come from the database.

==========================================================
RESPONSIVE
==========================================================

Desktop

Tablet

Mobile

Must all work perfectly.

==========================================================
FINAL TEST
==========================================================

Verify:

✓ Contact form still works

✓ Office locations still work

✓ Add new office person

✓ Edit person

✓ Delete person

✓ Reorder people

✓ Enable / Disable person

✓ Upload profile photo

✓ Replace profile photo

✓ Delete profile photo

✓ Update phone number

✓ Update designation

✓ Update email

✓ Update social links

✓ Refresh CMS

✓ Refresh frontend

✓ Everything persists in the database

✓ No hardcoded content remains

==========================================================
FINAL GOAL
==========================================================

Create a production-ready Contact page where:

• The Contact Form appears first.

• Office Locations appear second.

• Office Team appears third.

The Office Team must be fully dynamic, scalable, and managed entirely through the CMS. The client should be able to add, edit, delete, reorder, enable, or disable unlimited team members without touching any code. All data, images, and settings must be stored in the database and reflected immediately on the frontend.