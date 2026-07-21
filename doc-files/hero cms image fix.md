Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

The website is already fully functional.

Do NOT rebuild the Hero Banner system.

Do NOT create new Hero Banner components.

Do NOT create duplicate upload logic.

Do NOT replace the existing media architecture.

Do NOT create unnecessary database tables.

Your job is to find the exact root cause of the Hero Banner image upload failure and fix the existing implementation.

Modify only what is absolutely necessary while preserving backward compatibility.

==========================================================
CURRENT ISSUE
==========================================================

Every page has a Hero Banner managed through the CMS.

Pages:

• Home
• About
• Services
• Contact

Everything else works correctly.

However, whenever I try to upload or replace a Hero Banner image from the CMS, the upload fails.

The image is never saved.

No preview appears.

Nothing is stored.

Nothing is displayed on the frontend.

The issue exists on ALL Hero Banner sections, so this is likely a shared upload or media issue.

==========================================================
OBJECTIVE
==========================================================

Fix the Hero Banner image upload system completely.

After the fix, every Hero Banner should support:

✓ Upload Image

✓ Replace Image

✓ Remove Image

✓ Save Image

✓ Preview Image inside CMS

✓ Display Image on Frontend

✓ Persist after page refresh

✓ Edit image multiple times

without breaking any existing functionality.

==========================================================
DO NOT GUESS
==========================================================

Perform a complete end-to-end audit.

Trace the entire upload pipeline.

CMS Form

↓

Vue Upload Component

↓

FormData

↓

Inertia Request

↓

Laravel Request

↓

Validation

↓

Controller

↓

Model

↓

Media Library / Storage

↓

Filesystem

↓

Database

↓

Frontend Rendering

Find the exact point where the upload fails.

Fix the existing implementation instead of creating a workaround.

==========================================================
PHASE 1
CMS FORM AUDIT
==========================================================

Inspect every Hero Banner edit form.

Verify:

Image input

File picker

Preview

FormData generation

multipart/form-data request

Validation

Update request

Replace request

Delete request

Ensure the file is actually being submitted.

==========================================================
PHASE 2
REQUEST AUDIT
==========================================================

Verify:

multipart/form-data

Correct request payload

Uploaded file exists in the request

Maximum upload size

Accepted MIME types

Validation rules

CSRF handling

Nothing should silently fail.

==========================================================
PHASE 3
CONTROLLER AUDIT
==========================================================

Inspect the Hero Banner controller.

Verify:

Store

Update

Replace

Delete

Validation

Media handling

Storage handling

Error handling

Ensure image uploads are processed correctly.

==========================================================
PHASE 4
MODEL AUDIT
==========================================================

Inspect Hero Banner related models.

Verify:

fillable

casts

relationships

media collections

accessors

mutators

image retrieval methods

Ensure models correctly save and retrieve uploaded images.

==========================================================
PHASE 5
MEDIA LIBRARY / STORAGE
==========================================================

If using Spatie Media Library:

Verify:

Media collections

Collection names

Single file collections

Replacing existing media

Deleting old media

Retrieving media URLs

If using Laravel Storage:

Verify:

Storage disk

Filesystem configuration

Public storage link

File permissions

Storage paths

Public accessibility

Everything should work correctly.

==========================================================
PHASE 6
DATABASE AUDIT
==========================================================

Inspect the existing Hero Banner database structure.

If additional fields are required,

ONLY modify what is absolutely necessary.

If migrations are required,

create proper migrations.

Maintain backward compatibility.

Do NOT duplicate tables.

Do NOT create unnecessary columns.

Do NOT replace the existing structure.

==========================================================
PHASE 7
FRONTEND AUDIT
==========================================================

Verify:

Uploaded images display correctly.

Existing images load correctly.

Replacing images updates immediately.

Deleting images removes them immediately.

No placeholder image overrides uploaded images.

No hardcoded paths.

==========================================================
CMS FEATURES
==========================================================

The CMS must support:

Upload Hero Image

Replace Hero Image

Remove Hero Image

Preview Uploaded Image

Save

Update

Persist after refresh

This should work for:

✓ Home Hero

✓ About Hero

✓ Services Hero

✓ Contact Hero

==========================================================
ERROR HANDLING
==========================================================

If upload fails,

display a proper validation or upload error.

Never fail silently.

Provide meaningful error messages.

==========================================================
TESTING
==========================================================

Test every Hero Banner individually.

HOME

Upload

Replace

Delete

Refresh

ABOUT

Upload

Replace

Delete

Refresh

SERVICES

Upload

Replace

Delete

Refresh

CONTACT

Upload

Replace

Delete

Refresh

Verify:

✓ Images upload successfully.

✓ Images persist after refresh.

✓ Images display on the frontend.

✓ Images can be replaced.

✓ Images can be removed.

✓ No duplicate files remain.

✓ Old images are cleaned up properly.

✓ No console errors.

✓ No Laravel errors.

✓ No storage errors.

==========================================================
OPTIMIZATION
==========================================================

Use the existing upload architecture.

Prevent duplicate uploads.

Prevent orphaned files.

Optimize image handling.

Do not introduce unnecessary complexity.

==========================================================
FINAL GOAL
==========================================================

The Hero Banner image upload system must work flawlessly across Home, About, Services, and Contact pages.

Administrators should be able to upload, replace, remove, preview, and save Hero Banner images directly from the CMS.

If the issue requires database changes, storage configuration updates, media collection fixes, controller changes, model updates, or frontend adjustments, make ONLY the necessary modifications while preserving the existing architecture and maintaining full backward compatibility.

The final implementation should be clean, production-ready, and fully integrated with the existing CMS without rebuilding the Hero Banner system.