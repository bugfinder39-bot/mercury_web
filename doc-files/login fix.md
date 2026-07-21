Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

IMPORTANT

Do NOT rebuild the authentication system.

Do NOT replace Laravel Breeze/Fortify/Jetstream (whichever is currently installed).

Do NOT generate a new login page.

Do NOT modify working authentication logic unless necessary.

Your task is to perform a complete audit of the authentication frontend and identify the root cause of why the Login and Registration forms are not rendering correctly.

==========================================================
CURRENT ISSUE
==========================================================

The Login page loads.

The page title is visible.

The subtitle is visible.

However:

• Email field is missing.

• Password field is missing.

• Remember Me checkbox is missing.

• Forgot Password link is missing.

• Login button is missing.

The Registration page has the same problem.

The page loads but the form fields do not appear.

This issue started after recent UI/CMS changes.

==========================================================
FULL FRONTEND AUDIT
==========================================================

Inspect every authentication page.

Login

Register

Forgot Password

Reset Password

Verify:

Vue Components

Inertia Pages

Layouts

Slots

Authentication Components

Tailwind Classes

Transitions

Conditional Rendering

==========================================================
VERIFY COMPONENT RENDERING
==========================================================

Check whether the form components are actually rendering.

Verify:

Input components

Button components

Checkbox

Labels

Validation

Slots

Children

If components are not rendering,

find the exact reason.

==========================================================
CHECK CONDITIONAL LOGIC
==========================================================

Inspect for:

v-if

v-show

computed properties

props

permissions

authentication guards

layout conditions

Ensure no condition is hiding the form.

==========================================================
CHECK STYLING
==========================================================

Inspect CSS and Tailwind.

Verify that no class is causing:

display:none

visibility:hidden

opacity:0

overflow:hidden

height:0

width:0

absolute positioning

negative z-index

incorrect flex/grid alignment

transform issues

pointer-events:none

Fix any styling that hides the form.

==========================================================
CHECK JAVASCRIPT
==========================================================

Inspect browser console.

Fix any:

Vue errors

Component import errors

Runtime errors

Undefined variables

Missing props

Hydration issues

Compilation issues

Resolve every JavaScript error before continuing.

==========================================================
CHECK LAYOUT
==========================================================

Inspect:

GuestLayout

Authentication Layout

App Layout

Container

Slots

Children

Ensure the layout renders child components correctly.

==========================================================
CHECK INPUT COMPONENTS
==========================================================

Verify:

TextInput

InputLabel

PrimaryButton

Checkbox

InputError

Ensure all components are imported correctly.

Ensure they render correctly.

==========================================================
CHECK AUTH PAGES
==========================================================

Inspect:

Login.vue

Register.vue

ForgotPassword.vue

ResetPassword.vue

ConfirmPassword.vue

Verify that every field exists and is rendered.

==========================================================
VERIFY BUILD
==========================================================

Check for:

Broken imports

Wrong component paths

Missing exports

Failed Vite build

Broken aliases

==========================================================
FINAL TEST
==========================================================

After fixing:

Login page should display:

✓ Email field

✓ Password field

✓ Remember Me

✓ Forgot Password

✓ Login Button

Registration page should display:

✓ Name

✓ Email

✓ Password

✓ Confirm Password

✓ Register Button

Forgot Password page should display correctly.

Reset Password page should display correctly.

Verify:

✓ Validation works

✓ Authentication works

✓ Registration works

✓ Logout works

✓ No console errors

✓ No Vue warnings

✓ Responsive layout

==========================================================
IMPORTANT
==========================================================

Do NOT guess.

Find the exact root cause.

Explain what was broken.

Fix the root cause instead of applying temporary CSS fixes.

Only finish after every authentication page is fully functional and production-ready.