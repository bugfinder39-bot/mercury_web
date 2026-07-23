Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
LAYOUT REGRESSION - FIX PROPERLY
==========================================================

The Announcement System has introduced a layout issue.

The website already has an advanced Navbar system with multiple modes.

After adding the Announcement Bar, the Navbar layout is breaking.

The Announcement Bar is being hidden underneath the Navbar when the Navbar is using Transparent, Blur/Glass, or Sticky mode.

Do NOT use temporary fixes.

Do NOT hardcode margins or padding.

Do NOT add random spacing values.

Find the root cause and integrate the Announcement Bar correctly into the existing layout architecture.

==========================================================
CURRENT NAVBAR FEATURES
==========================================================

The Navbar already supports:

✓ Transparent Mode

✓ Blur / Glass Mode

✓ Solid Mode

✓ Sticky Navbar

✓ Responsive Mobile Menu

✓ CMS Layout Management

These features are already working and MUST continue working.

==========================================================
OBJECTIVE
==========================================================

The Announcement Bar and Navbar should work together as a single layout system.

The Announcement Bar should never overlap the Navbar.

The Navbar should never hide the Announcement Bar.

The layout should automatically adjust based on CMS settings.

==========================================================
EXPECTED BEHAVIOR
==========================================================

Case 1

Announcement OFF

↓

Navbar behaves exactly as it currently does.

No spacing changes.

----------------------------------------------------------

Case 2

Announcement ON

↓

Announcement appears above the Navbar.

Navbar automatically moves below it.

No overlap.

No clipping.

No hidden content.

----------------------------------------------------------

Case 3

Transparent Navbar

↓

Announcement stays above.

Transparent Navbar begins immediately below the announcement.

Hero section starts correctly beneath the combined header.

----------------------------------------------------------

Case 4

Blur / Glass Navbar

↓

Blur effect remains intact.

Announcement remains fully visible.

No stacking conflicts.

----------------------------------------------------------

Case 5

Sticky Navbar

↓

Announcement remains at the top.

Sticky Navbar positions correctly beneath it (or follows the intended sticky behavior).

No jumping during scroll.

No flickering.

==========================================================
LAYOUT ARCHITECTURE
==========================================================

Audit:

Global Layout

App Layout

Navbar Component

Announcement Component

Header Wrapper

Sticky Logic

Z-Index hierarchy

Positioning

Scroll behavior

Transparent mode

Blur mode

Responsive layout

Refactor the layout if necessary so the Announcement Bar becomes part of the global header structure instead of being an independent element that conflicts with the Navbar.

==========================================================
CMS COMPATIBILITY
==========================================================

The fix must continue respecting CMS settings.

When Announcement is disabled:

No reserved spacing should remain.

When Announcement is enabled:

Spacing should automatically adjust.

No manual CSS changes should ever be required.

==========================================================
RESPONSIVE
==========================================================

Verify on:

Desktop

Laptop

Tablet

Mobile

Small Mobile

No overlap.

No hidden elements.

No broken spacing.

==========================================================
ANIMATIONS
==========================================================

Ensure any announcement animations work correctly with the Navbar.

No layout shifts.

No flickering.

No jumping.

==========================================================
TESTING
==========================================================

Verify every combination:

✓ Announcement OFF + Transparent Navbar

✓ Announcement ON + Transparent Navbar

✓ Announcement OFF + Blur Navbar

✓ Announcement ON + Blur Navbar

✓ Announcement OFF + Solid Navbar

✓ Announcement ON + Solid Navbar

✓ Sticky Navbar

✓ Mobile Menu

✓ Responsive Layout

✓ Scroll Behavior

✓ No overlapping

✓ No clipping

✓ No console errors

✓ No Laravel errors

==========================================================
FINAL REQUIREMENT
==========================================================

Do not apply a CSS workaround.

Audit the existing layout architecture and integrate the Announcement Bar into the global header correctly.

The Navbar and Announcement Bar must behave as one cohesive layout system.

Preserve all existing Navbar functionality, maintain backward compatibility, modify only the necessary files, and ensure the final implementation is fully responsive, production-ready, and configurable through the CMS.