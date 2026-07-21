Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

The Hero Banner image upload is STILL failing.

The previous fixes did NOT solve the issue.

Do NOT attempt another blind fix.

Do NOT guess.

Do NOT create another upload implementation.

Do NOT rebuild the media system.

Instead, perform a complete debugging investigation and identify the REAL exception causing the upload failure.

==========================================================
CURRENT ISSUE
==========================================================

When uploading an image inside the Hero Banner CMS,

the CMS displays:

"The image media file failed to upload."

The image never uploads.

This happens for:

• Home Hero

• About Hero

• Services Hero

• Contact Hero

The issue is still present.

==========================================================
YOUR FIRST TASK
==========================================================

Stop hiding the real exception.

Find where this generic message is generated.

It is likely inside:

try {

...

} catch (...) {

return "The image media file failed to upload.";

}

Temporarily remove this generic error handling.

Return the ORIGINAL Laravel exception instead.

Or log it completely.

I need the REAL error.

Do NOT hide it.

==========================================================
DEBUG EVERYTHING
==========================================================

Audit the complete upload flow.

Vue

↓

FormData

↓

Network Request

↓

Laravel Request

↓

Validation

↓

Controller

↓

Media Upload

↓

Filesystem

↓

Database

↓

Response

At every step verify that the upload succeeds.

==========================================================
CHECK REQUEST
==========================================================

Verify:

Request contains image

$request->hasFile(...)

$request->file(...)

Request payload

multipart/form-data

CSRF

Validation

==========================================================
CHECK CONTROLLER
==========================================================

Verify:

store()

update()

Validation

Media upload

Exception handling

Find the exact line throwing the exception.

==========================================================
CHECK MODEL
==========================================================

Verify:

HasMedia

InteractsWithMedia

Media Collections

Collection names

Single File collections

Fillable

Relationships

==========================================================
CHECK STORAGE
==========================================================

Verify:

storage/app/public

public/storage

storage:link

Filesystem

Disk configuration

Permissions

Writable directories

==========================================================
CHECK SPATIE
==========================================================

Verify:

Media Collections

Collection names

Media conversions

addMedia()

addMediaFromRequest()

clearMediaCollection()

getFirstMediaUrl()

==========================================================
CHECK DATABASE
==========================================================

Verify:

Media table

Morph relationships

Foreign keys

Stored paths

If database changes are required,

modify ONLY what is necessary.

==========================================================
CHECK LOGS
==========================================================

Inspect:

storage/logs/laravel.log

Find the upload exception.

Do NOT ignore warnings.

Find the exact exception.

==========================================================
FINAL REQUIREMENT
==========================================================

Do NOT stop after fixing it.

Explain WHY it was failing.

Examples:

Wrong media collection

Missing storage link

Permission issue

Validation issue

Incorrect disk

Wrong request key

Missing trait

Broken relationship

Filesystem configuration

Missing migration

Controller bug

Vue upload bug

Anything else.

Then permanently fix the root cause.

==========================================================
TEST
==========================================================

After fixing,

verify:

✓ Upload image

✓ Save

✓ Refresh

✓ Image persists

✓ Replace image

✓ Delete image

✓ Upload on Home

✓ Upload on About

✓ Upload on Services

✓ Upload on Contact

✓ No exceptions

✓ No generic error

The upload system should be production-ready and fully functional without rebuilding the existing architecture.