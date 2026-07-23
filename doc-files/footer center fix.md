Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The Footer Contact Information has already been converted to support multiple Phone Numbers, Email Addresses, and Office Addresses.

Do NOT rebuild the Footer.

Do NOT redesign the Footer.

Do NOT change the existing design language.

Modify ONLY what is necessary to fix the layout issue.

Maintain full backward compatibility.

==========================================================
CURRENT ISSUE
==========================================================

The Footer Contact Information section contains three blocks:

• Office Addresses
• Contact Numbers
• Email Inquiries

Each block has an icon on the left.

Currently, when there is only one item, the icon alignment looks correct.

However, when multiple Phone Numbers, Email Addresses, or Office Addresses are added through the CMS, the icon remains fixed at the top beside the first item.

This creates an unbalanced and unprofessional layout.

==========================================================
OBJECTIVE
==========================================================

The icon should automatically align itself vertically with the entire content block.

Regardless of whether there are:

• 1 item
• 2 items
• 3 items
• 10 items

the icon should always stay visually centered relative to the content beside it.

The alignment must happen automatically without requiring any manual adjustment.

==========================================================
EXPECTED BEHAVIOR
==========================================================

Example:

One Phone Number

📞
Phone Number

↓

Icon vertically centered.

----------------------------------------------------------

Three Phone Numbers

📞
Phone 1
Phone 2
Phone 3

↓

The phone icon should automatically move to the vertical center of the entire phone list.

----------------------------------------------------------

The same behavior must apply to:

✓ Office Addresses

✓ Email Addresses

==========================================================
LAYOUT REQUIREMENTS
==========================================================

Audit the Footer layout.

Use the most appropriate responsive layout approach.

Examples include:

• Flexbox
• CSS Grid
• Self-alignment
• Auto-centering
• Dynamic height alignment

Choose the best solution based on the existing implementation.

Do NOT hardcode heights.

Do NOT use fixed positioning.

Do NOT use magic margin or padding values.

The layout must adapt automatically to any number of items.

==========================================================
RESPONSIVE
==========================================================

Verify alignment on:

Desktop

Laptop

Tablet

Mobile

Small Mobile

The icons must remain correctly aligned on every screen size.

==========================================================
CMS COMPATIBILITY
==========================================================

The icon positioning must remain dynamic after:

Adding items

Deleting items

Reordering items

Enabling items

Disabling items

No manual changes should ever be required.

==========================================================
DESIGN
==========================================================

Keep the current Mercury design.

Do NOT change:

Colors

Typography

Spacing

Cards

Icons

Only improve the alignment behavior.

The final layout should look clean, balanced, and premium.

==========================================================
TESTING
==========================================================

Verify:

✓ 1 Phone Number

✓ 2 Phone Numbers

✓ 5 Phone Numbers

✓ 1 Email

✓ Multiple Emails

✓ 1 Address

✓ Multiple Addresses

✓ Mixed combinations

✓ Responsive layout

✓ No overlapping

✓ No overflow

✓ No console errors

✓ No Laravel errors

==========================================================
FINAL GOAL
==========================================================

Fix the Footer Contact Information layout so the left-side icons automatically remain vertically centered relative to the entire content block, regardless of how many Phone Numbers, Email Addresses, or Office Addresses are added through the CMS.

Implement the solution using a responsive, dynamic layout (not fixed spacing), modify only the necessary frontend components and styles, preserve the existing design, and ensure the behavior is fully automatic and production-ready.