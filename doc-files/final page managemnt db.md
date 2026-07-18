Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

Do NOT immediately write new code.

Your first task is to investigate the architecture like a senior Laravel developer.

====================================================

PROBLEM

The frontend pages render correctly.

The Page Management module exists.

The edit forms exist.

However, clicking Save does not update anything.

I inspected the database and noticed that many of the newly added homepage components do not even exist inside the database.

Examples include:

- CEO Message
- Gallery
- Image + Text Showcase
- Working Process
- Company Highlights
- Testimonials
- Logistics Banner
- CTA Banner

This strongly suggests that the issue is NOT simply CRUD.

The CMS architecture itself may be incomplete.

====================================================

PHASE 1 — FULL ARCHITECTURE AUDIT

Audit the complete CMS architecture.

Review:

Routes

Controllers

Models

Vue Components

Inertia Pages

Page Management

Database

Relationships

Media Library

Seeders

Factories

Section Registration

Section Rendering

Validation

Form Requests

====================================================

PHASE 2 — TRACE THE SAVE FLOW

Trace exactly what happens when clicking Save.

Verify:

Does the Vue form submit?

↓

Does it call the correct route?

↓

Does the request reach Laravel?

↓

Does the controller execute?

↓

Does validation pass?

↓

Does it query the correct Section?

↓

Does that Section actually exist?

↓

Does update() execute?

↓

Does the database change?

↓

Does the frontend reload?

If any step fails,

identify the exact cause.

====================================================

PHASE 3 — DATABASE AUDIT

Inspect the database.

Verify whether every frontend component has a corresponding database record.

Example:

Home Page

Hero

About

CEO Message

Gallery

Testimonials

Working Process

Company Highlights

Operational Excellence

Partners

CTA Banner

etc.

Every section displayed on the frontend should exist inside the CMS database.

If records are missing,

determine WHY.

Examples:

Missing Seeder

Missing Migration

Section never created

Wrong relationship

Wrong page_id

Wrong section_type

Wrong slug

Section registration missing

====================================================

PHASE 4 — PAGE MANAGEMENT AUDIT

Verify that Page Management dynamically loads sections from the database.

It should NOT use:

hardcoded arrays

fake JSON

placeholder objects

temporary data

Every section should come directly from the database.

====================================================

PHASE 5 — FIX THE ROOT CAUSE

Do NOT patch symptoms.

Fix the actual architectural problem.

If database records are missing,

generate the correct migrations/seeders or initialization logic.

If section registration is missing,

implement it.

If controllers are querying incorrect records,

fix them.

If Page Management is using placeholders,

replace them with dynamic database data.

====================================================

PHASE 6 — VERIFY

After fixing everything,

perform a complete audit.

Verify:

Change Heading

↓

Save

↓

Database updates

↓

Refresh admin

↓

Value persists

↓

Open frontend

↓

New value displays.

Repeat this process for every homepage component.

====================================================

FINAL GOAL

The CMS should become the single source of truth.

Every homepage section must:

- exist in the database
- load from the database
- save to the database
- update the frontend dynamically
- never use hardcoded content

Do not stop after fixing one issue.

Continue debugging until the entire architecture is production-ready.