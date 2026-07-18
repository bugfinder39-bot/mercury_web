Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

Do NOT rebuild the CMS.

Do NOT create duplicate CRUD modules.

Do NOT create duplicate tables.

Do NOT create new page management architecture.

Your task is to FIX the existing Page Management system so that every homepage component is fully editable and correctly connected to the database.

## Current Problem

The Home page contains many dynamic CMS sections.

Examples include:

- Hero Carousel
- About Us
- Vision & Mission
- Why Choose Us
- Feature Services
- Statistics
- CEO Message
- Image Gallery
- Image + Text Showcase
- Operational Excellence
- Company Highlights
- Working Process
- Partners
- Testimonials
- Get In Touch
- CTA Banner
- Logistics Banner

These sections already appear inside the Page Management module.

However:

- editing text does nothing
- editing headings does nothing
- editing buttons does nothing
- editing images does nothing
- CRUD operations are incomplete
- frontend values never update
- some forms are not connected to the database

The UI exists but the backend integration is broken.

---

## Goal

When I open

Admin
→ Page Management
→ Home
→ Edit

I should see EVERY homepage component.

Each component should have its own editor.

Example:

Home

Hero Carousel
▼

About Us
▼

Vision & Mission
▼

CEO Message
▼

Image Gallery
▼

Working Process
▼

Testimonials
▼

CTA Banner
▼

etc.

Every section should be collapsible.

Every section should save independently.

---

## Fix Database Mapping

Review the entire CMS architecture.

Verify:

Pages

Sections

Section Items

Media

Settings

Relationships

Every component must load from the correct section.

Every save operation must update the correct database record.

No hardcoded values should remain.

---

## Fix Controllers

Review every controller.

Fix:

store()

update()

destroy()

validation

transactions

media uploads

section lookup

page lookup

relationship loading

Ensure every component saves to the proper model.

---

## Fix Vue Forms

Review every Vue page.

Fix:

v-model

useForm()

props

watchers

default values

submit methods

validation errors

loading states

success messages

After clicking Save,

the database must update immediately.

---

## Fix Image Upload

Images currently do not properly update.

Fix:

Upload

Replace

Delete

Preview

Multiple uploads

Media Library integration

Frontend rendering

Every uploaded image must appear on the frontend immediately after saving.

---

## Fix Rich Text

Rich text editors must correctly save and reload:

Paragraphs

Lists

Bold

Italic

Links

Headings

Formatting

No formatting should be lost.

---

## Fix Repeatable Components

The following sections contain multiple items:

Hero Slides

Gallery Images

Feature Cards

Testimonials

Working Process

Partners

Statistics

Vision & Mission

These sections must support:

Add Item

Edit Item

Delete Item

Drag & Drop

Ordering

Enable / Disable

Image Upload

Instant Save

Everything should update correctly.

---

## Dynamic Rendering

After editing a section in Page Management:

Save

↓

Database updates

↓

Frontend immediately reflects the new data

No hardcoded values.

No manual editing.

Everything must come from the CMS.

---

## Edit Experience

The Home page editor should behave like a real page builder.

Each section should have:

Section Title

Expand / Collapse

Image Upload

Rich Text

Buttons

Links

Repeater Fields

Preview

Save Button

Delete Button

Ordering Controls

Status Toggle

Every section should be editable independently.

---

## Validation

Every field should validate correctly.

Display errors beside the field.

Display success notification after saving.

Never silently fail.

---

## Final Audit

Perform a complete audit of:

Routes

Controllers

Models

Relationships

Migrations

Media Library

Vue Components

Page Management

Inertia Forms

Database Queries

Frontend Rendering

Find every reason why Page Management is failing to update homepage components and fix every issue.

The final result should be a fully functional Page Management system where every homepage component—including text, images, repeaters, buttons, gallery items, testimonials, and banners—can be edited from the CMS and immediately reflected on the frontend without requiring any code changes.