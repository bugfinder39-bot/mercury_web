Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

Do NOT create duplicate tables, duplicate controllers, duplicate routes, or duplicate CMS modules.

Do NOT change any existing functionality, routing, API, authentication, business logic, or database structure unless required to make the new sections fully functional.

## Task

The newly created Home Page sections already exist in the frontend and are visible under the Page Management module in the CMS.

However, the CRUD operations are not working correctly.

Your task is to fully integrate these sections into the existing dynamic CMS architecture and fix every CRUD issue.

The following sections must be fully functional:

- CEO Message
- Image Gallery
- Image + Text Showcase
- Why Businesses Trust Mercury
- Operational Excellence
- Company Highlights
- Working Process
- Testimonials
- Logistics Banner / CTA Banner
- Any other newly created Home Page section

---

# Fix the Existing CMS

Review the entire CMS architecture.

Ensure these sections are properly connected to:

- Database
- Models
- Controllers
- Validation
- Vue Forms
- API
- Inertia Pages
- Page Management
- Media Library
- Dynamic Section Renderer

Do NOT hardcode any data.

Everything must come from the database.

---

# CRUD Must Work

Every section must support:

✅ Create

✅ Read

✅ Update

✅ Delete

Without any errors.

If any CRUD action currently fails, find the root cause and fix it.

---

# Page Management

The sections already appear in Page Management.

Ensure every section can:

- Open Edit Page
- Load existing data
- Save changes
- Delete records
- Restore existing values
- Show validation errors
- Display success messages
- Display error messages

---

# Image Upload

Fix image uploads.

Every section should correctly support:

- Upload
- Replace
- Delete
- Preview
- Multiple uploads where applicable

Use the existing Media Library.

Images should automatically appear on the frontend after saving.

---

# Rich Text

Rich text editors should correctly save and load:

- Paragraphs
- Headings
- Lists
- Links
- Formatting

No HTML should be lost.

---

# Repeatable Items

Sections like:

- Gallery
- Testimonials
- Company Highlights
- Working Process

must fully support:

- Add new item
- Edit item
- Delete item
- Drag & Drop ordering
- Active / Inactive toggle

without refreshing the page.

---

# Forms

Review every admin form.

Fix:

- Missing bindings
- Wrong field names
- Missing validation
- Incorrect model mapping
- Broken image inputs
- Broken select inputs
- Broken toggle switches

All forms should load existing data correctly.

---

# Backend

Review:

Controllers

Form Requests

Validation

Policies

Routes

Repositories

Services

Models

Relationships

Mass Assignment

Media Collections

Transactions

Fix every issue preventing CRUD from working.

---

# Frontend

Review:

Vue Components

Inertia Forms

useForm()

v-model

Image Upload Components

Rich Text Components

Sortable Lists

Delete Confirmation

Loading States

Validation Display

Success Notifications

Error Handling

Everything should work smoothly.

---

# Database

Verify:

Foreign Keys

Relationships

Section Types

Section Items

Media Relations

Ordering

Status

Page Associations

Do NOT create duplicate records.

Reuse the existing dynamic CMS architecture.

---

# Dynamic Rendering

After saving content in the CMS,

the frontend must automatically update using the existing dynamic page rendering system.

No hardcoded content should remain.

---

# Delete Operations

Currently verify and fix:

Delete buttons

Delete confirmation modal

Soft Delete (if enabled)

Permanent Delete

Image deletion

Gallery image deletion

Testimonial deletion

Everything should remove records correctly.

---

# Ordering

Fix drag-and-drop ordering.

The order should immediately save to the database.

The frontend should respect the saved order.

---

# Final Audit

After fixing everything:

Perform a complete audit of:

- Database
- Backend
- CMS
- API
- Media Library
- Admin Dashboard
- Page Management
- Dynamic Renderer
- Frontend

Find and fix every issue preventing the new Home Page sections from working correctly.

The final result should be a fully dynamic CMS where every newly created Home Page component is completely manageable from the admin panel with working CRUD, image uploads, sorting, status toggles, and live frontend rendering.