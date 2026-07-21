
Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

The Global Layout Management module is already implemented and working.

Do NOT rebuild it.

Do NOT create duplicate Navbar or Footer settings.

Do NOT modify existing functionality unless necessary.

Only extend the existing Footer Settings with additional design customization options while preserving full backward compatibility.

==========================================================
OBJECTIVE
==========================================================

The current footer works correctly but visually feels too plain.

The footer should become more premium, colorful, modern, and visually engaging while maintaining a professional corporate appearance.

Only use the existing brand colors:

• Navy Blue
• Orange
• White

Do NOT introduce any additional colors.

Every new visual customization must be editable through the existing Layout Management CMS.

==========================================================
FOOTER REDESIGN
==========================================================

Redesign the footer to make it more eye-catching.

Improve:

• Typography
• Color hierarchy
• Icon styling
• Link styling
• Section separation
• Hover effects
• Spacing
• Shadows
• Background accents

The footer should feel premium but still corporate.

==========================================================
BACKGROUND
==========================================================

Allow the footer to support:

• Solid White
• Solid Navy
• White with subtle navy accents
• White with orange accent lines
• Navy gradient
• White gradient using only navy and white

Store the selected style in the existing Layout Management.

==========================================================
TEXT COLORS
==========================================================

Extend the existing Footer Settings.

Add editable options for:

Main Heading Color

Paragraph Color

Secondary Text Color

Quick Links Color

Quick Links Hover Color

Services Links Color

Services Hover Color

Newsletter Heading Color

Newsletter Description Color

Copyright Text Color

Bottom Tagline Color

Everything should be editable from the CMS.

==========================================================
ICON DESIGN
==========================================================

Redesign all footer icons.

Instead of plain icons, use:

• Circular backgrounds
• Rounded square backgrounds
• Orange gradient backgrounds
• Navy outlined circles

Icons should have:

Hover animation

Smooth scaling

Shadow

Background transition

Border transition

All icon colors and backgrounds should be editable from Layout Management.

Add CMS options for:

Icon Background Color

Icon Color

Icon Hover Background

Icon Hover Color

Icon Border Color

Icon Shadow Strength

==========================================================
NEWSLETTER
==========================================================

Improve the Newsletter section.

Allow editing:

Input Background

Input Border

Input Text Color

Placeholder Color

Button Background

Button Text

Button Hover Background

Button Hover Text

Button Shadow

==========================================================
DIVIDERS
==========================================================

Improve separators.

Instead of plain horizontal lines,

support:

Orange divider

Navy divider

Gradient divider

Thin accent line

Double line

Everything selectable from CMS.

==========================================================
SOCIAL ICONS
==========================================================

Improve social media icons.

Use:

Hover animation

Lift effect

Orange glow

Smooth rotation

Background transition

Add CMS controls:

Social Icon Background

Social Icon Color

Hover Background

Hover Color

Border

Shadow

==========================================================
HOVER EFFECTS
==========================================================

Improve links.

Add:

Underline animation

Color transition

Slide effect

Arrow animation

Everything should remain subtle and professional.

==========================================================
SPACING
==========================================================

Allow editing:

Top Padding

Bottom Padding

Column Gap

Section Gap

Container Width

These values should be editable through the existing Layout Management.

==========================================================
ANIMATIONS
==========================================================

Add premium animations.

Footer reveal

Fade In

Slide Up

Link hover

Icon hover

Newsletter button animation

Smooth transitions

Animations should remain subtle.

==========================================================
LAYOUT MANAGEMENT
==========================================================

Do NOT create a new CMS module.

Use the existing:

Admin

↓

Layout Management

↓

Footer Settings

Only add the new customization options described above.

Preserve all existing settings.

==========================================================
DATABASE
==========================================================

Do NOT duplicate settings.

Extend the existing database structure only if additional fields are required.

Use proper migrations.

Maintain backward compatibility.

==========================================================
FINAL TEST
==========================================================

Verify:

✓ Existing Footer Settings still work

✓ New Footer Settings appear in Layout Management

✓ Every new color option saves correctly

✓ Icon styles update immediately

✓ Text colors update immediately

✓ Divider styles update

✓ Newsletter styling updates

✓ Footer background updates

✓ Hover effects work

✓ Animations work

✓ Refreshing the frontend keeps all settings

✓ Everything is stored in the database

✓ No existing functionality is broken

==========================================================
FINAL GOAL
==========================================================

Create a premium, elegant, and visually engaging footer that uses only Navy Blue, Orange, and White.

The footer should feel more colorful through contrast, gradients, icon styling, typography, spacing, and subtle animations—not by introducing additional colors.

Every new visual customization must be manageable through the existing Layout Management CMS so the client can change the appearance at any time without modifying code.