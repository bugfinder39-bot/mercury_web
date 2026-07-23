Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The Manage Users page already exists.

Currently it is only a placeholder.

Do NOT rebuild the CMS.

Do NOT create a second User Management module.

Do NOT replace the authentication system.

Do NOT break the existing login system.

Extend the existing Manage Users module and make it fully functional.

Modify ONLY what is necessary.

==========================================================
OBJECTIVE
==========================================================

The "Manage Users" page inside the CMS must become a complete User Management system.

Everything should work in production.

Administrators should be able to completely manage CMS users without touching the database.

==========================================================
CURRENT ISSUE
==========================================================

The page currently exists.

Navigation works.

UI exists.

However it is only a placeholder.

Most actions either do nothing or are incomplete.

Replace the placeholder implementation with a fully working system.

==========================================================
USE EXISTING AUTHENTICATION
==========================================================

Reuse the existing Laravel authentication.

Reuse the existing User model.

Reuse existing middleware.

Reuse existing login system.

Do NOT create another authentication system.

==========================================================
FEATURES
==========================================================

The Manage Users page should support:

✓ List Users

✓ Search Users

✓ Filter Users

✓ Create User

✓ Edit User

✓ Delete User

✓ Activate User

✓ Deactivate User

✓ Reset Password

✓ Change Password

✓ Change Email

✓ Change Name

✓ Change Role

✓ Last Login

✓ Created Date

✓ Updated Date

Everything should work.

==========================================================
USER TABLE
==========================================================

Display:

Avatar (optional)

Name

Email

Role

Status

Last Login

Created Date

Actions

Responsive

Sortable

Searchable

Paginated

==========================================================
CREATE USER
==========================================================

Allow administrators to create users.

Fields:

Name

Email

Password

Confirm Password

Role

Status

Avatar (optional)

Validation required.

==========================================================
EDIT USER
==========================================================

Allow editing:

Name

Email

Role

Status

Avatar

Password (optional)

Everything should update correctly.

==========================================================
DELETE USER
==========================================================

Implement safe deletion.

Before deleting:

Confirmation Modal

Prevent deleting the currently logged-in account.

Prevent deleting the last Super Admin.

Use Soft Deletes if the project already supports them.

Otherwise implement the safest approach.

==========================================================
ROLES
==========================================================

Use the existing role system.

If roles already exist,

reuse them.

Do NOT duplicate role tables.

Support:

Super Admin

Content Editor

Future roles

If roles require extension,

modify only what is necessary.

==========================================================
PERMISSIONS
==========================================================

Super Admin

Full access.

Content Editor

Cannot:

Delete Users

Create Super Admin

Modify Super Admin

Access system settings

Only edit allowed content.

Respect middleware and policies.

==========================================================
STATUS
==========================================================

Each user should support:

Active

Inactive

Inactive users cannot log in.

==========================================================
PASSWORD MANAGEMENT
==========================================================

Allow:

Change Password

Reset Password

Password validation

Secure hashing

==========================================================
PROFILE IMAGE
==========================================================

Optional.

If the project already supports media uploads,

reuse the existing media system.

Do NOT build another uploader.

==========================================================
DATABASE
==========================================================

Audit the existing database first.

Reuse:

users table

roles

permissions

relationships

If additional fields are required,

ONLY add the necessary columns.

Examples:

status

last_login_at

avatar

Only if missing.

Create proper migrations.

Maintain backward compatibility.

Do NOT duplicate tables.

==========================================================
LAST LOGIN
==========================================================

Automatically store:

Last Login Date

Last Login Time

Update it every successful login.

==========================================================
SEARCH
==========================================================

Support searching by:

Name

Email

Role

==========================================================
FILTERS
==========================================================

Filter by:

Role

Status

Created Date

==========================================================
UI
==========================================================

Maintain the existing Mercury CMS design.

Follow:

Navy

Orange

White

Same cards

Same buttons

Same typography

Same animations

Responsive

Professional

==========================================================
AUDIT
==========================================================

Audit:

Routes

Controllers

Models

Policies

Middleware

Validation

Database

Vue

Inertia

Frontend

Backend

Authentication

Authorization

Everything should work together.

==========================================================
TESTING
==========================================================

Verify:

✓ Create User

✓ Edit User

✓ Delete User

✓ Activate User

✓ Deactivate User

✓ Search

✓ Filter

✓ Password Reset

✓ Change Role

✓ Last Login updates

✓ Validation works

✓ Email uniqueness works

✓ Permissions work

✓ Editors cannot access restricted actions

✓ Super Admin has full access

✓ No console errors

✓ No Laravel errors

==========================================================
FINAL GOAL
==========================================================

Replace the placeholder Manage Users page with a complete production-ready User Management system.

It must integrate seamlessly with the existing authentication and CMS architecture.

Do not rebuild authentication.

Do not duplicate user management.

Reuse the existing Laravel User model, authentication, middleware, roles, and permissions.

Modify only the necessary controllers, Vue components, routes, database fields, policies, and validation to make the module fully functional while preserving backward compatibility.

At the end, provide a summary of:

• Files modified

• Database changes (if any)

• Routes added or updated

• Controllers updated

• Models updated

• Policies/Middleware updated

• Features completed

• Testing performed

Do not mark the task complete until every user management feature has been implemented and verified.