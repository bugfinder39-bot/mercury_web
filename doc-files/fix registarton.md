Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the authentication system.

Do NOT replace Laravel authentication.

Do NOT create a custom authentication system.

Modify ONLY what is necessary.

The objective is to convert the CMS into an **Admin-Managed User System**.

==========================================================
OBJECTIVE
==========================================================

The website should NOT allow public user registration.

Only authenticated Super Admins should be able to create CMS users.

There should be NO public registration anywhere on the website.

The only way to create a new user must be:

Super Admin Login

↓

CMS

↓

Manage Users

↓

Create User

==========================================================
PUBLIC REGISTRATION
==========================================================

Completely remove public registration.

Visitors must NOT be able to register.

This includes:

✓ Register Page

✓ Register Route

✓ Register Button

✓ Register Link

✓ Registration API

✓ Registration Form

✓ Registration Validation

✓ Registration Controller

✓ Registration Navigation

Everything related to public registration should be removed or disabled.

==========================================================
LOGIN PAGE
==========================================================

Redesign the Login page accordingly.

The Login page should ONLY contain:

Email

Password

Remember Me

Forgot Password (optional if already implemented)

Login Button

Nothing else.

There should NOT be:

Register Button

Create Account

Sign Up

New User

Join Now

Any registration-related links or text.

==========================================================
AUTHENTICATION ROUTES
==========================================================

Disable public registration routes.

Anyone visiting:

/register

or any registration endpoint

should receive:

404

or

403

depending on the existing architecture.

Do NOT leave the route accessible.

==========================================================
AUTHENTICATION CONTROLLERS
==========================================================

Remove or disable public registration logic.

Do NOT delete authentication.

Only disable registration.

Login functionality must continue working normally.

==========================================================
MANAGE USERS
==========================================================

The ONLY place where users can be created is:

Admin Dashboard

↓

Manage Users

↓

Create User

Only authorized administrators may access this feature.

==========================================================
PERMISSIONS
==========================================================

Super Admin

Can:

Create Users

Edit Users

Delete Users

Reset Passwords

Assign Roles

Deactivate Users

Content Editor

Cannot:

Create Users

Delete Users

Create Super Admins

Assign Roles

Access Manage Users

Manage authentication

Enforce permissions using middleware and policies.

==========================================================
DATABASE
==========================================================

Reuse the existing users table.

Reuse the existing authentication system.

Reuse the existing role system.

Do NOT create another users table.

Do NOT duplicate authentication.

Only modify the database if absolutely necessary.

Maintain backward compatibility.

==========================================================
NAVIGATION
==========================================================

Remove every registration link.

Check:

Login Page

Navbar

Authentication Pages

Mobile Menu

Footer

Forgot Password Page

Emails

Authentication Components

No public registration links should remain.

==========================================================
SECURITY
==========================================================

Ensure users cannot bypass the UI.

Even if someone manually visits:

/register

or submits a registration request,

registration must fail.

The backend must reject all public registration attempts.

Do NOT rely only on hiding the button.

==========================================================
AUDIT
==========================================================

Audit:

Routes

Controllers

Middleware

Policies

Vue Components

Inertia Pages

Authentication Views

Navigation Components

Buttons

Links

API Endpoints

Validation

Everything related to registration.

==========================================================
TESTING
==========================================================

Verify:

✓ Login works.

✓ Logout works.

✓ Forgot Password works (if enabled).

✓ Register page no longer exists.

✓ Register route is inaccessible.

✓ Register API is disabled.

✓ Public users cannot create accounts.

✓ Super Admin can create users from CMS.

✓ Newly created users can log in.

✓ Content Editors cannot create users.

✓ Existing authentication continues working.

✓ No console errors.

✓ No Laravel errors.

==========================================================
FINAL GOAL
==========================================================

Convert the authentication system into an Admin-Managed User System.

Public registration must be completely removed from both the frontend and backend.

The only method of creating a new user should be through:

Super Admin Login

↓

Manage Users

↓

Create User

The Login page should become a clean, professional sign-in page containing only login-related functionality.

Preserve the existing Laravel authentication architecture, modify only what is necessary, maintain backward compatibility, and ensure the system is secure by preventing any direct or indirect public registration attempts.