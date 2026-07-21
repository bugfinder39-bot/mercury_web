Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

STOP making assumptions.

STOP implementing temporary fixes.

STOP creating workarounds.

Several attempts have already failed.

This is now a FULL PROJECT AUDIT AND ROOT CAUSE INVESTIGATION.

Do NOT stop until you find the exact cause of the issue.

Do NOT rebuild the project.

Do NOT replace the CMS architecture.

Do NOT replace the media system.

Modify ONLY what is necessary.

==========================================================
CURRENT ISSUE
==========================================================

The Hero Banner image upload and Hero Carousel image upload DO NOT WORK anywhere in the project.

This affects every page.

Whenever an image is selected and saved,

the upload fails.

The CMS shows:

"The hero media file failed to upload."

or

"The image media file failed to upload."

Images are never saved.

Images never appear on the frontend.

Previous fixes have failed.

This is almost certainly a deeper architectural problem.

==========================================================
OBJECTIVE
==========================================================

Perform a COMPLETE PROJECT AUDIT.

Inspect EVERYTHING related to image uploading.

Do not stop at the Hero Banner.

Find the actual root cause.

Repair the existing implementation.

==========================================================
AUDIT THE ENTIRE PROJECT
==========================================================

Audit every layer.

Vue

↓

Components

↓

Reusable Upload Components

↓

Inertia

↓

Axios

↓

FormData

↓

Routes

↓

Controllers

↓

Form Requests

↓

Validation

↓

Models

↓

Traits

↓

Repositories

↓

Services

↓

Media Helpers

↓

Spatie Media Library

↓

Laravel Filesystem

↓

Storage

↓

Database

↓

Frontend Rendering

↓

CMS

↓

Environment

Everything.

==========================================================
SEARCH THE ENTIRE PROJECT
==========================================================

Search the complete project for:

"The hero media file failed to upload."

"The image media file failed to upload."

"failed to upload"

"addMedia"

"addMediaFromRequest"

"HasMedia"

"InteractsWithMedia"

"hero_image"

"hero_banner"

"hero_carousel"

"media"

Inspect every related file.

==========================================================
COMPARE WITH WORKING FEATURES
==========================================================

Search the entire CMS.

Find every place where image uploads already work.

Examples:

Partner Logos

Gallery

CEO Image

Office Images

Service Images

Any image uploader.

Compare them line-by-line with Hero Banner and Hero Carousel.

If another uploader works,

reuse the same implementation.

Do NOT invent a different upload flow.

==========================================================
VERIFY REQUEST FLOW
==========================================================

Verify:

File Input

↓

Vue

↓

FormData

↓

Browser Request

↓

Laravel Request

↓

Validation

↓

Storage

↓

Media

↓

Database

↓

Frontend

At every stage verify that the uploaded image exists.

Do not assume.

==========================================================
VERIFY CONTROLLERS
==========================================================

Audit every upload controller.

Verify:

store()

update()

validation

request key names

file handling

media collections

exception handling

return responses

==========================================================
VERIFY MODELS
==========================================================

Audit every related model.

Verify:

HasMedia

InteractsWithMedia

fillable

casts

relationships

registered media collections

collection names

media conversions

media retrieval

==========================================================
VERIFY DATABASE
==========================================================

Audit every related table.

Verify:

media

hero_banner

hero_carousel

page_sections

repeatable_items

morph relationships

foreign keys

nullable columns

image references

ONLY modify the database if absolutely necessary.

If a migration is required,

create the smallest possible migration.

Maintain backward compatibility.

==========================================================
VERIFY STORAGE
==========================================================

Audit:

config/filesystems.php

storage/app/public

public/storage

storage:link

permissions

disk configuration

temporary upload location

generated URLs

==========================================================
VERIFY ENVIRONMENT
==========================================================

Audit:

.env

APP_URL

FILESYSTEM_DISK

QUEUE_CONNECTION

CACHE

SESSION

Anything affecting uploads.

==========================================================
VERIFY LARAVEL LOGS
==========================================================

Read:

storage/logs/laravel.log

Locate every upload exception.

Fix every upload-related error.

Do NOT ignore warnings.

==========================================================
VERIFY CONSOLE
==========================================================

Inspect:

Browser Console

Network Tab

Request Payload

Response Payload

Status Codes

JavaScript Errors

Vue Errors

Inertia Errors

==========================================================
REMOVE GENERIC ERRORS
==========================================================

Replace every generic upload error with the actual exception during debugging.

Do NOT hide the original exception.

Log everything.

==========================================================
TEST EVERYTHING
==========================================================

After fixing,

test every upload.

HOME HERO

ABOUT HERO

SERVICES HERO

CONTACT HERO

HERO CAROUSEL

Replace Image

Delete Image

Re-upload Image

Refresh CMS

Refresh Frontend

Everything must work.

==========================================================
FINAL REPORT
==========================================================

Do NOT simply say "fixed."

Provide a technical report.

Include:

1. Root cause.

2. Why previous fixes failed.

3. Which files were modified.

4. Which database changes were required (if any).

5. Which controller changed.

6. Which model changed.

7. Which Vue component changed.

8. Which storage issue was fixed.

9. Which media collection was fixed.

10. Confirmation that uploads now work.

==========================================================
FINAL REQUIREMENT
==========================================================

Do NOT stop until Hero Banner and Hero Carousel image uploads work correctly.

The final implementation must be production-ready.

The CMS must successfully upload, replace, delete, save, and display images across all pages.

Repair the existing architecture instead of rebuilding it.

If any database, model, controller, Vue component, filesystem configuration, storage configuration, media collection, or environment configuration is preventing uploads, fix ONLY those necessary parts while preserving the existing project structure.