Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the homepage.

Do NOT create duplicate CMS modules.

Do NOT create duplicate layouts.

Integrate this feature into the existing architecture.

Modify ONLY what is necessary.

Maintain full backward compatibility.

If database changes are required, create proper migrations.

==========================================================
NEW FEATURE
CERTIFICATIONS & MEMBERSHIPS
==========================================================

I want to add a premium "Certifications & Memberships" section to the website.

This section should highlight the company's professional certifications, industry memberships, licenses, awards, and accreditations.

Everything must be fully dynamic and manageable through the existing CMS.

==========================================================
CMS INTEGRATION
==========================================================

Create a new CMS module named:

Certifications & Memberships

Everything should be editable without touching the code.

==========================================================
CRUD FEATURES
==========================================================

The administrator should be able to:

✓ Create Certification

✓ View Certifications

✓ Edit Certifications

✓ Delete Certifications

✓ Search

✓ Filter

✓ Enable / Disable

✓ Reorder

✓ Duplicate (optional)

Everything should follow the existing CMS CRUD architecture.

==========================================================
CERTIFICATION INFORMATION
==========================================================

Each Certification should support:

Title

Short Name (optional)

Category

Examples:

Certification

Membership

License

Award

Accreditation

Affiliation

Issuing Organization

Issue Date (optional)

Expiry Date (optional)

Certificate Number (optional)

Short Description

Detailed Description (optional)

Official Website URL (optional)

Display Order

Status

Featured Toggle

==========================================================
MEDIA MANAGEMENT
==========================================================

Each Certification should support:

Organization Logo

Certificate Image

Certificate PDF (optional)

Background Image (optional)

Everything must use the existing media management system.

Support:

Upload

Replace

Delete

Preview

Optimization

Validation

==========================================================
SECTION SETTINGS
==========================================================

Allow administrators to customize:

Section Title

Section Subtitle

Description

Enable / Disable Section

Display Order

Background Style

Grid Columns

Desktop Layout

Mobile Layout

Button Text

Button URL (optional)

==========================================================
FRONTEND
==========================================================

Display the certifications using premium cards.

Each card should include:

Organization Logo

Certification Name

Issuing Organization

Short Description

Issue Date (if available)

Expiry Date (if available)

View Details Button (optional)

View Certificate Button (if PDF/Image exists)

Everything should render dynamically from CMS.

==========================================================
DETAIL MODAL
==========================================================

When a certification card is clicked,

open a professional modal or detail panel displaying:

Large Logo

Large Certificate Image

Full Description

Certificate Number

Issuing Organization

Issue Date

Expiry Date

Official Website Link

Certificate Download Button (if PDF exists)

Everything should be dynamic.

==========================================================
DESIGN
==========================================================

Maintain the Mercury design language.

Premium appearance.

Use:

Modern Cards

Soft Shadows

Rounded Corners

Subtle Hover Effects

Smooth Animations

Elegant Typography

Consistent Spacing

The section should feel suitable for an enterprise logistics company.

==========================================================
ANIMATIONS
==========================================================

Include subtle animations:

Fade In

Card Hover Lift

Image Zoom

Smooth Modal Opening

Viewport Reveal

Do not overuse animations.

==========================================================
RESPONSIVE
==========================================================

Desktop

Laptop

Tablet

Mobile

Small Mobile

Cards should automatically rearrange.

No overflow.

No broken layouts.

==========================================================
DATABASE
==========================================================

Audit the existing database first.

Create only the necessary tables, fields, and relationships.

Reuse existing media architecture.

Create proper migrations only if required.

Maintain backward compatibility.

==========================================================
BACKEND
==========================================================

Implement:

Controllers

Models

Policies

Validation

Relationships

Services

Repositories (if applicable)

Inertia Props

Everything should follow the existing architecture.

==========================================================
MEDIA VALIDATION
==========================================================

Validate:

Logo

Certificate Image

Certificate PDF

Accepted formats

Maximum file size

Safe uploads

Secure storage

==========================================================
PERMISSIONS
==========================================================

Only authorized administrators may:

Create

Edit

Delete

Enable

Disable

Reorder

Upload files

Public visitors can only view the section.

==========================================================
SEO
==========================================================

Ensure the section remains SEO-friendly.

Use semantic HTML.

Optimize images.

Lazy-load images where appropriate.

Provide proper alt text.

==========================================================
TESTING
==========================================================

Verify:

✓ Create certification

✓ Edit certification

✓ Delete certification

✓ Reorder certification

✓ Enable certification

✓ Disable certification

✓ Upload logo

✓ Replace logo

✓ Delete logo

✓ Upload certificate image

✓ Upload certificate PDF

✓ Modal opens correctly

✓ Download works

✓ Official website link works

✓ Responsive layout

✓ CMS changes immediately reflect on the frontend

✓ No console errors

✓ No Laravel errors

==========================================================
FINAL REQUIREMENT
==========================================================

Implement a fully dynamic, enterprise-grade Certifications & Memberships section integrated into the existing CMS.

Everything—including section content, cards, logos, certificate images, PDFs, descriptions, ordering, visibility, and styling—must be manageable through the CMS.

If database changes are required, create proper migrations and relationships.

Modify only the necessary backend, frontend, database, Vue components, controllers, models, and CMS pages.

Do not finish until the feature is production-ready, responsive, secure, optimized, fully CMS-driven, and seamlessly integrated into the existing website architecture.