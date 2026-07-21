Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

This is NOT a new feature request.

This is a BUG FIX.

Previous attempts have FAILED.

Do NOT attempt another random fix.

Do NOT guess.

Do NOT create a new upload system.

Do NOT rebuild Hero Banner.

Do NOT rebuild Hero Carousel.

Do NOT replace the Media Library.

Do NOT create duplicate controllers, models, or database tables.

Your task is to audit the existing implementation, find the exact root cause, and permanently repair it.

Modify ONLY what is necessary.

==========================================================
CURRENT ISSUE
==========================================================

Image uploads are completely broken for:

✓ Hero Banner

✓ Hero Carousel

across all pages.

Whenever I select an image and save, the CMS displays:

"The hero media file failed to upload."

or

"The image media file failed to upload."

The upload never completes.

The image is not stored.

The frontend never receives the image.

The issue affects ALL Hero Banner and Hero Carousel components.

This indicates the problem is within the shared upload infrastructure.

==========================================================
YOUR FIRST TASK
==========================================================

Search the ENTIRE project for these strings:

"The hero media file failed to upload."

"The image media file failed to upload."

"failed to upload"

Locate every catch block that returns these generic errors.

Remove the generic error handling temporarily.

Return or log the ORIGINAL Laravel exception.

Do NOT hide the real error.

==========================================================
PERFORM A COMPLETE CODE AUDIT
==========================================================

Audit every file related to media uploads.

Including but not limited to:

Vue Components

Inertia Forms

Axios Requests

FormData

Laravel Controllers

Form Requests

Validation

Models

Traits

Services

Repositories

Media Helpers

Storage Helpers

Media Library Configuration

Filesystem Configuration

Routes

Database Relationships

Everything involved in uploading media.

==========================================================
VERIFY REQUEST FLOW
==========================================================

Confirm:

The browser actually sends the file.

FormData contains the file.

The request is multipart/form-data.

Laravel receives the uploaded file.

$request->hasFile()

returns TRUE.

$request->file()

contains the uploaded file.

==========================================================
VERIFY CONTROLLERS
==========================================================

Audit every controller responsible for:

Hero Banner

Hero Carousel

Media Upload

Verify:

Validation

Store

Update

Delete

Media handling

Exception handling

Return responses

==========================================================
VERIFY MODELS
==========================================================

Audit every related model.

Verify:

HasMedia implementation

InteractsWithMedia trait

fillable

casts

relationships

media collections

singleFile collections

collection names

media retrieval methods

==========================================================
VERIFY SPATIE MEDIA LIBRARY
==========================================================

If Spatie Media Library is used, verify:

Collections exist.

Collection names match.

Collection registration.

Media conversions.

Media URLs.

Replacing existing media.

Deleting old media.

==========================================================
VERIFY FILESYSTEM
==========================================================

Audit:

config/filesystems.php

public disk

storage disk

temporary upload location

public/storage symlink

storage permissions

directory permissions

URL generation

==========================================================
VERIFY DATABASE
==========================================================

Inspect ONLY if required.

Check:

media table

foreign keys

morph relationships

stored file paths

If a database modification is genuinely required,

modify ONLY the necessary columns or relationships.

Do NOT rebuild tables.

Maintain backward compatibility.

==========================================================
COMPARE WITH OTHER UPLOADS
==========================================================

Search the project for any CMS component where image upload already works correctly.

Examples:

Gallery

CEO Image

Office Image

Partner Logos

Service Images

Any working uploader.

Compare that implementation line by line with Hero Banner and Hero Carousel.

Reuse the proven implementation instead of inventing a new one.

==========================================================
LARAVEL LOGS
==========================================================

Read:

storage/logs/laravel.log

Locate the upload exception.

Identify:

Exact exception type

Exact file

Exact line number

Fix THAT issue.

==========================================================
TEST EVERYTHING
==========================================================

Verify:

HOME HERO

Upload

Replace

Delete

ABOUT HERO

Upload

Replace

Delete

SERVICES HERO

Upload

Replace

Delete

CONTACT HERO

Upload

Replace

Delete

HERO CAROUSEL

Upload

Replace

Delete

Refresh every page.

Verify uploaded images persist.

Verify images display on the frontend.

Verify no orphaned files remain.

Verify no console errors.

Verify no Laravel errors.

==========================================================
FINAL REPORT
==========================================================

Do NOT simply say "fixed."

Provide a technical summary including:

1. The exact root cause.

2. Which file(s) contained the bug.

3. Which line(s) were modified.

4. Why the upload failed.

5. Which files were changed.

6. Whether any database changes were required.

7. Why the fix permanently resolves the issue.

The final result must be a production-ready Hero Banner and Hero Carousel upload system that works reliably through the existing CMS without rebuilding the existing architecture.