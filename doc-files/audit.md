Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT:
Do NOT assume the current Page Management implementation is correct.

Your task is to completely audit and rebuild the existing Page Management module while preserving the current database architecture.

The module located at:

admin/pages

is currently non-functional.

The UI exists, but editing pages does not work.

Editing text does not work.

Editing images does not work.

Saving does not work.

Repeaters do not work.

CRUD does not work.

Frontend never updates.

The goal is to make Page Management the single source of truth for every public page.

------------------------------------------------

STEP 1

Audit the entire Page Management module.

Review:

Routes

Controllers

Vue Pages

Inertia Pages

Components

Models

Relationships

Validation

Media Library

Policies

Form Requests

Database Queries

Section Rendering

Find every broken or incomplete implementation.

------------------------------------------------

STEP 2

Verify database mapping.

The following must be correctly connected:

pages

sections

section_items

media

settings

services

partners

Every section shown inside Page Management must load directly from these tables.

Do not use hardcoded arrays.

------------------------------------------------

STEP 3

Fix Edit Page.

When clicking

Admin

→ Page Management

→ Home

→ Edit

the edit page should automatically load every section belonging to Home.

Example

Hero

About

Vision

Mission

Services

Statistics

CEO Message

Gallery

Working Process

Testimonials

CTA Banner

Every section must load its own data.

------------------------------------------------

STEP 4

Each section must have a fully working editor.

Support

Text

Textarea

Rich Text

Images

Buttons

Links

Icons

Repeaters

Gallery

Ordering

Status

SEO

Every field should already contain the current saved values.

------------------------------------------------

STEP 5

Saving.

Clicking Save should

Validate

Update database

Upload media

Replace media

Delete removed media

Update ordering

Show success notification

Remain on the page

------------------------------------------------

STEP 6

Repeaters.

Gallery

Testimonials

Hero Slides

Working Process

Partners

Statistics

Vision Cards

must support

Create

Update

Delete

Sorting

Status

Image upload

------------------------------------------------

STEP 7

Frontend.

After saving

Refresh frontend

Everything should immediately display the new data.

No hardcoded content.

------------------------------------------------

STEP 8

Media.

Fix media handling.

Support

Upload

Replace

Delete

Preview

Multiple Images

Media Library

Old images should be removed correctly.

------------------------------------------------

STEP 9

Error Handling.

Display

Validation errors

Upload errors

Database errors

Success messages

Loading states

Never silently fail.

------------------------------------------------

STEP 10

Final Audit.

Test every page.

Home

About

Services

Contact

Verify every section can

Load

Edit

Save

Delete

Reorder

Upload Images

Render correctly.

If anything inside admin/pages is only a UI placeholder or partially implemented, replace it with a fully functional implementation connected to the existing CMS architecture.

Do NOT create duplicate modules.

Do NOT create duplicate tables.

Do NOT hardcode content.

The final result should be a production-ready dynamic Page Management system where every section of every page can be fully managed from the CMS.