Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

The website is already fully functional.

Do NOT rebuild the Hero Banner.

Do NOT create a new upload system.

Do NOT replace the existing CMS architecture.

Do NOT create duplicate media tables.

Modify ONLY what is necessary.

==========================================================
CURRENT ISSUE
==========================================================

Inside the CMS, every Hero Banner image upload fails.

The error shown is:

"The image media file failed to upload."

This happens on:

✓ Home Hero Banner

✓ About Hero Banner

✓ Services Hero Banner

✓ Contact Hero Banner

The upload never completes.

No image is saved.

No preview is generated.

Nothing appears on the frontend.

Because every Hero Banner fails, this is likely a shared media upload issue rather than an individual Hero Banner issue.

==========================================================
OBJECTIVE
==========================================================

Find the ROOT CAUSE of the upload failure.

Do not implement workarounds.

Repair the existing upload architecture.

==========================================================
PERFORM A COMPLETE MEDIA UPLOAD AUDIT
==========================================================

Audit the complete upload pipeline.

CMS File Input

↓

Vue Component

↓

FormData

↓

Axios / Inertia Request

↓

Laravel Request

↓

Validation

↓

Controller

↓

Model

↓

Media Library

↓

Filesystem

↓

Storage Disk

↓

Database

↓

Frontend

Find exactly where the upload fails.

==========================================================
CHECK THE REQUEST
==========================================================

Verify:

multipart/form-data

Correct FormData

Correct file object

Request contains uploaded file

CSRF

Request headers

Network request

Maximum upload size

Validation rules

Allowed MIME types

Allowed extensions

==========================================================
CHECK THE CONTROLLER
==========================================================

Verify:

store()

update()

Validation

File handling

Media upload

Exception handling

Return values

Error responses

Nothing should silently fail.

==========================================================
CHECK THE MODEL
==========================================================

Inspect the Hero Banner model.

Verify:

fillable

casts

relationships

media collections

HasMedia implementation

InteractsWithMedia trait

Media collection names

Single file configuration

Media conversions

==========================================================
CHECK SPATIE MEDIA LIBRARY
==========================================================

If using Spatie Media Library verify:

Media collections exist.

Collection names match exactly.

Media is attached correctly.

Old media is replaced correctly.

Media retrieval works.

No collection mismatch exists.

==========================================================
CHECK STORAGE
==========================================================

Verify:

config/filesystems.php

Default disk

Public disk

Storage permissions

storage/app/public

public/storage symbolic link

Writable directories

Correct filesystem configuration

Correct URL generation

==========================================================
CHECK DATABASE
==========================================================

Audit existing database structure.

Verify:

Media relationships

Foreign keys

Morph relationships

Stored paths

If a migration is required,

modify ONLY what is necessary.

Do NOT duplicate tables.

Do NOT replace the existing architecture.

==========================================================
CHECK FRONTEND
==========================================================

Verify:

Preview rendering

Image URL generation

Media retrieval

Image replacement

Image deletion

No hardcoded paths

==========================================================
ERROR HANDLING
==========================================================

Replace generic errors with proper debugging.

Return the real exception.

Log the actual Laravel exception.

Display meaningful validation errors.

Never hide the original error.

==========================================================
TESTING
==========================================================

Test each Hero Banner.

HOME

Upload

Replace

Delete

ABOUT

Upload

Replace

Delete

SERVICES

Upload

Replace

Delete

CONTACT

Upload

Replace

Delete

Verify:

✓ Upload succeeds

✓ Preview appears

✓ Save succeeds

✓ Refresh persists

✓ Frontend displays image

✓ Replace works

✓ Delete works

✓ No duplicate media

✓ No storage issues

✓ No console errors

✓ No Laravel exceptions

==========================================================
FINAL GOAL
==========================================================

The Hero Banner image upload system must work flawlessly across every page.

Find the exact root cause of the "The image media file failed to upload." error.

Fix only the necessary files, controllers, models, media collections, storage configuration, or database structure while preserving the existing CMS architecture and maintaining backward compatibility.

Do not rebuild the upload system. Repair the existing one so that administrators can upload, replace, delete, preview, and display Hero Banner images reliably across Home, About, Services, and Contact pages.