
Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT rebuild the Office Team module.

Do NOT recreate the database unless absolutely necessary.

Do NOT rewrite the existing CRUD.

Everything except the staff profile image is working correctly.

Your task is to find and fix ONLY the image upload system for the Office Team.

==========================================================
CURRENT ISSUE
==========================================================

The Office Team CMS is fully functional.

The following works correctly:

✓ Add Person

✓ Edit Person

✓ Delete Person

✓ Reorder Person

✓ Enable / Disable Person

✓ Save Text Fields

✓ Save Phone

✓ Save Email

✓ Save Designation

✓ Save Department

✓ Save Social Links

Only ONE thing is broken:

The Profile Photo does not save or update.

Changing the staff image either does nothing or fails.

==========================================================
DO NOT GUESS
==========================================================

Do not apply random fixes.

Perform a complete investigation to identify the exact root cause.

Trace the image from the browser to the frontend.

==========================================================
PHASE 1
Frontend Audit
==========================================================

Inspect the Office Team Vue components.

Verify:

File Input

Image Upload Component

useForm()

FormData

multipart/form-data

v-model

Image Preview

Existing Image Preview

Replace Image

Delete Image

Ensure the selected file is actually included in the request.

==========================================================
PHASE 2
Network Audit
==========================================================

Inspect the browser request.

Verify:

The image file exists inside the request payload.

Request headers.

Multipart request.

CSRF.

Correct route.

Correct HTTP method.

==========================================================
PHASE 3
Controller Audit
==========================================================

Inspect the Office Team controller.

Verify:

$request->hasFile()

$request->file()

Validation

Storage

Media upload

Database save

Image replacement

Image deletion

Do not ignore upload failures.

==========================================================
PHASE 4
Database Audit
==========================================================

Verify how profile photos are stored.

Check whether the project uses:

Spatie Media Library

Image path column

Media table

Relationships

Ensure the uploaded image is actually saved.

If the database needs a missing column or relationship, create the proper migration.

Do NOT duplicate data.

==========================================================
PHASE 5
Media Library Audit
==========================================================

If using Spatie Media Library verify:

HasMedia interface

InteractsWithMedia trait

Media collections

addMedia()

clearMediaCollection()

getFirstMediaUrl()

Image conversions

Disk configuration

Storage path

Public URLs

==========================================================
PHASE 6
Filesystem Audit
==========================================================

Verify:

storage/app/public

public/storage symlink

filesystem.php

permissions

Storage::url()

asset()

Image URL generation

==========================================================
PHASE 7
Frontend Rendering
==========================================================

Verify that the Office Team cards load the image dynamically.

Do not use placeholder images.

The image displayed must come from the database or media library.

==========================================================
PHASE 8
Image Replacement
==========================================================

When changing a profile image:

Old image should be removed.

New image should be uploaded.

Database should update.

Frontend should immediately display the new image.

Refreshing the page should still show the new image.

==========================================================
FINAL TEST
==========================================================

Test the following:

✓ Upload first profile photo

✓ Save

✓ Refresh CMS

✓ Image persists

✓ Refresh frontend

✓ Image displays

✓ Replace profile image

✓ Old image removed

✓ New image displayed

✓ Delete image

✓ Placeholder shown (if designed)

✓ No console errors

✓ No Laravel errors

✓ No broken image URLs

==========================================================
IMPORTANT
==========================================================

If the issue is caused by a missing database column, missing media relationship, missing media collection, incorrect model configuration, or missing migration, implement the proper fix.

Do NOT apply temporary workarounds.

Find the exact root cause and implement a production-ready solution that integrates correctly with the existing CMS architecture.