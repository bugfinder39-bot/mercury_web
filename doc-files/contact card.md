Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT:

Do NOT hardcode any office information.

Do NOT duplicate the existing Contact section.

Do NOT break the current CMS architecture.

Everything must be fully dynamic and manageable through the existing Page Management CMS.

==================================================
OBJECTIVE
==================================================

The Contact page currently displays only one office information card.

I need to support multiple office locations.

Initially there will be two office cards:

• Dhaka Office
• Chattogram Office

The design should be clean, modern, and responsive.

==================================================
DATABASE
==================================================

Implement this using the existing CMS architecture.

If necessary, create a proper database structure for office locations.

Each office should be stored dynamically.

Each office should belong to the Contact page.

Do NOT hardcode office data inside Vue components.

Every office must come from the database.

==================================================
CMS
==================================================

Integrate office management into the existing Page Management system.

Inside:

Admin
→ Page Management
→ Contact Page

Add a new section called:

Office Locations

This should function exactly like the other CMS components.

The admin should be able to:

• Add Office
• Edit Office
• Delete Office
• Reorder Offices
• Enable / Disable Office
• Save Changes

Everything must be saved to the database.

==================================================
EACH OFFICE SHOULD SUPPORT
==================================================

Office Name
Example:

Dhaka Headquarters

Chattogram Branch

Office Badge
Example:

MB · 01

MB · 02

Office Title

Short Description

Full Address

Google Map Embed URL

Phone Number

Email Address

Office Hours

Emergency Contact

Latitude

Longitude

Office Image (optional)

Display Order

Status (Active / Inactive)

==================================================
CONTACT PAGE DESIGN
==================================================

Redesign the office section.

Instead of showing only one office card,

display both office cards side by side on desktop.

Desktop:

----------------------------
Dhaka Office | Chattogram Office
----------------------------

Tablet:

2 columns if space allows.

Mobile:

Stack vertically.

Each office should have its own premium card.

==================================================
CARD DESIGN
==================================================

Each office card should contain:

Office Badge

Office Name

Description

Address

Phone

Email

Office Hours

Google Map button

Optional office image

Orange icons

Soft shadow

Rounded corners

Subtle hover animation

Modern spacing

Glass effect only if it improves the design.

==================================================
GOOGLE MAP
==================================================

Each office should have its own map.

When selecting Dhaka Office,

display the Dhaka map.

When selecting Chattogram Office,

display the Chattogram map.

If both office cards are visible simultaneously,

either:

Option 1 (Preferred):

Display each office card with its own embedded Google Map below it.

OR

Option 2:

Display one large Google Map below.

Clicking an office card updates the map dynamically.

Implement whichever provides the best user experience.

==================================================
CMS IMAGE SUPPORT
==================================================

If an office image is uploaded:

Display it automatically.

Support:

Upload

Replace

Delete

Preview

Everything should use the existing media upload system.

==================================================
DATABASE FLOW
==================================================

Verify the complete workflow.

Admin edits office

↓

Clicks Save

↓

Validation

↓

Database updates

↓

Media updates

↓

Refresh CMS

↓

Data persists

↓

Frontend automatically updates

Everything should be fully dynamic.

==================================================
REMOVE HARDCODED DATA
==================================================

Remove every hardcoded office detail.

No hardcoded:

Address

Phone

Email

Office Hours

Map

Title

Description

Everything must come directly from the database.

==================================================
ANIMATIONS
==================================================

Add subtle animations.

Cards:

Fade Up

Hover Lift

Soft Shadow Increase

Icon Animation

Map:

Fade In

Smooth Transition

Buttons:

Hover Scale

Smooth Background Transition

==================================================
RESPONSIVE
==================================================

Desktop:

Two office cards with proper spacing.

Tablet:

Responsive two-column layout.

Mobile:

Single column.

Maintain perfect spacing on every screen size.

==================================================
FINAL TEST
==================================================

After implementation verify:

✓ Add new office

✓ Edit office

✓ Delete office

✓ Change office order

✓ Disable office

✓ Upload office image

✓ Update Google Map

✓ Save changes

✓ Refresh admin

✓ Data persists

✓ Frontend updates immediately

✓ No hardcoded content remains

==================================================
FINAL GOAL
==================================================

Create a production-ready multi-office management system where every office location is completely dynamic and managed through the existing Page Management CMS.

Initially, the website should display two office cards:

• Dhaka Office
• Chattogram Office

However, the system should be scalable so that additional office locations can be added in the future without any code changes—only through the CMS.