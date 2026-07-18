Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT:

The CMS text editing is now working correctly.

The remaining issue is ONLY image uploads.

Do NOT modify the existing text CRUD.

Do NOT rebuild the CMS.

Do NOT create duplicate image upload components.

Your task is to perform a complete end-to-end audit of the image upload system and fix every issue preventing images from uploading, saving, updating, and displaying correctly.

====================================================
CURRENT PROBLEM
====================================================

Text fields save successfully.

Headings save.

Paragraphs save.

Buttons save.

SEO fields save.

However, every image upload fails.

Examples include:

- Hero Carousel Images
- CEO Image
- CEO Signature
- Gallery Images
- About Images
- Operational Excellence Images
- CTA Banner Background
- Logistics Banner
- Partner Logos
- Service Images
- Timeline Images
- Testimonial Photos
- Any image managed through the CMS

The upload either throws an error, fails silently, or does not save to the database.

====================================================
PHASE 1 — TRACE THE ENTIRE IMAGE FLOW
====================================================

For every image upload, trace the complete lifecycle:

Vue Upload Component

↓

File Input

↓

FormData

↓

Inertia Request

↓

Laravel Route

↓

Controller

↓

Validation

↓

Storage

↓

Media Library

↓

Database

↓

Frontend Rendering

Verify every step.

If any step fails, identify the exact cause and fix it.

====================================================
PHASE 2 — FRONTEND AUDIT
====================================================

Review every upload component.

Verify:

- File input binding
- v-model (if used)
- useForm()
- FormData generation
- multipart/form-data request
- Image preview
- Validation messages
- Upload progress
- Error handling
- Existing image preview
- Remove image action

Ensure the request actually contains the uploaded file.

====================================================
PHASE 3 — BACKEND AUDIT
====================================================

Review every upload endpoint.

Verify:

Routes

Controllers

Validation

Form Requests

Storage

Media Library

Filesystem

Transactions

Mass Assignment

Image Processing

Ensure Laravel correctly receives the uploaded file.

Verify:

$request->hasFile()

$request->file()

Storage::disk()

Media Library collections

Image replacement

Image deletion

====================================================
PHASE 4 — FILESYSTEM AUDIT
====================================================

Verify:

storage/app/public

public/storage symlink

filesystem.php

disk configuration

permissions

symbolic link

URL generation

asset()

Storage::url()

If storage is misconfigured, fix it.

Ensure uploaded files are publicly accessible.

====================================================
PHASE 5 — DATABASE AUDIT
====================================================

Verify image references are correctly stored.

Check:

media table (if using Spatie)

or image columns

or file path columns

Ensure:

- file path saves
- image URL saves
- old image updates
- replacement works
- delete works

====================================================
PHASE 6 — MEDIA LIBRARY
====================================================

If using Spatie Media Library, verify:

Collections

Conversions

Disk

Model relationships

addMedia()

clearMediaCollection()

getFirstMediaUrl()

Media deletion

Media replacement

Fix incorrect implementations.

====================================================
PHASE 7 — FRONTEND RENDERING
====================================================

After upload:

Save

↓

Database updates

↓

Media record updates

↓

Refresh page

↓

Correct image displays

↓

Frontend updates automatically

No hardcoded image paths.

No broken image URLs.

====================================================
PHASE 8 — TEST EVERY IMAGE TYPE
====================================================

Verify uploads for:

Hero Slider

CEO Image

CEO Signature

Gallery

Partners

Services

Testimonials

Timeline

CTA Banner

Background Images

Page Banners

About Images

Every upload should support:

Create

Replace

Delete

Preview

Save

Reload

Frontend display

====================================================
PHASE 9 — ERROR LOGGING
====================================================

If any upload fails:

Identify the exact reason.

Examples:

Validation failure

Wrong request type

Missing multipart/form-data

Storage permission

Wrong filesystem disk

Broken Media Library relationship

Wrong model

Missing symbolic link

Incorrect path generation

Mass assignment issue

CSRF issue

Route mismatch

Do NOT hide errors.

Fix the root cause.

====================================================
FINAL VERIFICATION
====================================================

After fixing everything:

Test every image upload manually.

Upload a new image.

Click Save.

Verify:

- No error occurs.
- The image is stored.
- The database updates.
- Refreshing the admin still shows the image.
- The frontend immediately displays the new image.
- Replacing the image removes the old one.
- Deleting the image removes it from storage and the database.

Do not stop until every image upload in the CMS is fully functional and production-ready.