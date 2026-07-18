Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT:

Do NOT assume the existing implementation is correct.

Do NOT create duplicate CMS modules.

Do NOT create duplicate CRUD pages.

Do NOT create duplicate database tables.

Your task is to perform a COMPLETE END-TO-END AUDIT of the entire Page Management system, including both the backend and frontend, and fix every issue preventing it from functioning correctly.

======================================================
OBJECTIVE
======================================================

The Page Management module must become the single source of truth for every public page.

When an administrator edits any page component and clicks Save:

CMS Form
↓
Validation
↓
Controller
↓
Database
↓
Media Library
↓
Frontend Rendering

Everything must update correctly.

======================================================
FULL AUDIT
======================================================

Audit EVERYTHING related to Page Management.

Backend:

- Routes
- Controllers
- Models
- Relationships
- Form Requests
- Validation
- Services
- Repositories
- Policies
- Media Library
- Database Queries
- Transactions
- Migrations

Frontend:

- Vue Components
- Inertia Pages
- useForm()
- v-model
- Props
- Emits
- API Requests
- Save Actions
- Delete Actions
- Upload Components
- Rich Text Editor
- Sortable Lists
- Image Preview
- Notifications
- Validation Display

======================================================
TRACE THE ENTIRE SAVE FLOW
======================================================

For EVERY editable field:

1. Change the value.
2. Click Save.
3. Verify the request is sent.
4. Verify validation passes.
5. Verify the controller executes.
6. Verify the model updates.
7. Verify the database row changes.
8. Verify uploaded media is stored.
9. Verify relationships remain intact.
10. Refresh the page.
11. Verify the saved value reloads.
12. Visit the frontend.
13. Verify the frontend displays the updated value.

If any step fails:

- Find the root cause.
- Fix it.
- Retest.

Repeat until every field works correctly.

======================================================
VERIFY EVERY COMPONENT
======================================================

The following sections must be fully editable from Page Management:

Hero Carousel

About

Vision

Mission

Why Choose Us

Feature Services

Statistics

CEO Message

Image Gallery

Image + Text Showcase

Operational Excellence

Company Highlights

Working Process

Partners

Testimonials

Get In Touch

CTA Banner

Logistics Banner

Every component should load existing data from the database.

Nothing should be hardcoded.

======================================================
VERIFY EVERY FIELD
======================================================

For every section verify:

Heading

Subheading

Description

Rich Text

Images

Background Images

Buttons

Button URLs

Icons

Alt Text

Status

Order

Links

SEO

Gallery Images

Repeater Items

Everything must:

Load

Edit

Save

Reload

Render

======================================================
IMAGE TEST
======================================================

Verify image uploads.

Test:

Upload

Replace

Delete

Preview

Multiple Images

Gallery Images

Background Images

CEO Image

Partner Logos

Hero Slides

Testimonials

Images must immediately appear on the frontend after saving.

======================================================
REPEATER TEST
======================================================

Test repeatable components.

Hero Slides

Gallery

Testimonials

Working Process

Partners

Statistics

Vision Cards

Verify:

Create

Edit

Delete

Sort

Status Toggle

Save

Frontend Update

======================================================
PAGE MANAGEMENT UI
======================================================

Review the entire admin/pages interface.

Ensure every section has:

Expand / Collapse

Preview

Proper Labels

Validation

Save Button

Delete Button

Image Upload

Rich Text Editor

Loading State

Success Notification

Error Notification

Drag & Drop Ordering

Everything should function correctly.

======================================================
DATABASE AUDIT
======================================================

Verify:

Pages

Sections

Section Items

Media

Settings

Relationships

Foreign Keys

Ordering

Section Types

Page Associations

Fix any broken relationship.

======================================================
FRONTEND AUDIT
======================================================

Verify that every frontend component reads data ONLY from the CMS.

Remove any remaining hardcoded text, images, or placeholder data.

Every component should render dynamically from the database.

======================================================
FINAL VALIDATION
======================================================

After completing all fixes:

Perform a full manual verification.

For every page:

Home

About

Services

Contact

Open Page Management.

Change several values.

Save.

Refresh the admin page.

Verify the new values remain.

Open the public website.

Verify the frontend immediately reflects every change.

If any field, image, repeater, or component does not update correctly, continue debugging until it is fully functional.

Do not stop after fixing one issue.

Only finish when the entire Page Management module is production-ready and every editable component works correctly from the CMS.