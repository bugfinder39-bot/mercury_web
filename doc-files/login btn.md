Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

The website is already fully functional.

Do NOT rebuild the Navbar.

Do NOT rebuild the Layout Management module.

Do NOT create duplicate settings.

Do NOT modify existing backend logic unless absolutely necessary.

Only extend the existing Navbar and Layout Management with the required functionality.

==========================================================
OBJECTIVE
==========================================================

I want to add a professional Login button/icon to the website navbar.

The Login button must be fully manageable from the CMS.

I should be able to show or hide it whenever I want.

The implementation must follow the existing architecture of the Layout Management module.

==========================================================
NAVBAR LOGIN BUTTON
==========================================================

Add a premium Login button to the far right side of the navbar.

The Login button should visually match the overall design language of the website.

It should not look like an afterthought.

Use the existing theme:

Primary Navy

Orange

White

(Optional Light Steel Blue if already used)

The Login button should include:

• Elegant Login/User icon
• Login text
• Modern rounded design
• Glass effect (if enabled in navbar)
• Soft shadow
• Premium hover effect
• Smooth animation
• Orange accent
• Proper spacing
• Responsive behavior

If the navbar is transparent or glass,
the Login button should automatically adapt to the navbar style.

==========================================================
BUTTON DESIGN
==========================================================

The Login button should feel like one of the premium CTA elements.

Examples of interactions:

Hover Lift

Glow

Smooth Color Transition

Animated Arrow or Icon Movement

Subtle Scale

Ripple Effect

Soft Shadow Animation

If the user is already authenticated,
the button should automatically become:

Dashboard

or

Profile

depending on the existing authentication flow.

Do NOT break the current authentication system.

==========================================================
RESPONSIVE
==========================================================

Desktop

Show icon + text.

Tablet

Show icon + text if space allows.

Mobile

Display inside the mobile menu.

Maintain consistent styling.

==========================================================
LAYOUT MANAGEMENT
==========================================================

Extend the existing:

CMS

↓

Layout Management

↓

Navbar Settings

Do NOT create a new settings page.

Only extend the existing Navbar settings.

==========================================================
NEW CMS OPTION
==========================================================

Add:

Show Login Button

Type:

Boolean Toggle

Default:

ON

Description:

Enable or disable the Login button in the website navbar.

==========================================================
DATABASE
==========================================================

If the existing Layout Settings table does not already contain this option,

add ONLY the required field.

Example:

show_login_button

Boolean

Default TRUE

Create a proper migration.

Do NOT create another table.

Do NOT duplicate Layout Settings.

Maintain backward compatibility.

==========================================================
FRONTEND LOGIC
==========================================================

If

Show Login Button = TRUE

↓

Display the Login button.

If

Show Login Button = FALSE

↓

Hide the Login button completely.

No empty spacing should remain.

The navbar should automatically adjust its layout.

==========================================================
AUDIT
==========================================================

Verify that the new setting follows the existing Layout Management architecture.

Ensure:

Controller

Validation

Model

Migration

Vue

Inertia Props

Database

Frontend

All remain synchronized.

Do NOT hardcode the button visibility.

==========================================================
TESTING
==========================================================

Verify the following:

✓ Enable Login Button

↓

Save

↓

Refresh frontend

↓

Button appears.

✓ Disable Login Button

↓

Save

↓

Refresh frontend

↓

Button disappears.

✓ Refresh the CMS.

↓

Setting remains saved.

✓ Refresh the website.

↓

Visibility matches the CMS.

✓ Mobile navbar also follows the setting.

✓ No console errors.

✓ No Laravel errors.

==========================================================
ANIMATION
==========================================================

The Login button should use the same premium animation language as the rest of the website.

Examples:

Soft Fade

Hover Lift

Scale

Icon Slide

Glow

Smooth Color Transition

Micro Interaction

Keep the animation elegant and professional.

==========================================================
FINAL GOAL
==========================================================

Create a premium Login button that looks like a natural part of the website's design system rather than a generic navigation link.

The button must integrate perfectly with the existing Navbar design, follow the website's color palette and animation style, be fully responsive, and be completely manageable from the existing Layout Management CMS through a simple Show Login Button toggle.

Implement this by extending the existing architecture only. Add or modify only the database fields that are absolutely necessary, preserve backward compatibility, and do not rebuild any existing functionality.