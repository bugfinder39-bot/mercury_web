Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the CMS.

Do NOT create duplicate settings.

Do NOT hardcode exchange rates.

Integrate this feature into the existing architecture.

Modify ONLY what is necessary.

Maintain full backward compatibility.

If database changes are required, create proper migrations.

==========================================================
NEW FEATURE
LIVE EXCHANGE RATES
==========================================================

I want to add a fully dynamic Live Exchange Rates feature to the website.

The exchange rates should be automatically updated from a reliable exchange rate API while also allowing administrators to manually override values if needed.

Everything must be fully manageable through the existing CMS.

==========================================================
CMS MODULE
==========================================================

Create a CMS module named:

Exchange Rates

The administrator should be able to:

✓ View Exchange Rates

✓ Refresh Rates Manually

✓ Enable / Disable Auto Update

✓ Enable / Disable Individual Currency

✓ Reorder Currencies

✓ Edit Display Name

✓ Override Exchange Rate (Manual Mode)

✓ Restore Automatic Value

✓ Search

✓ Filter

Everything should follow the existing CMS architecture.

==========================================================
SECTION SETTINGS
==========================================================

Create section settings similar to all other homepage components.

Allow administrators to configure:

Section Title

Section Subtitle

Description

Enable / Disable Section

Display Order

Homepage Visibility

Footer Visibility (optional)

Sidebar Visibility (optional)

Background Style

Animation Style

Auto Refresh Interval

==========================================================
SUPPORTED CURRENCIES
==========================================================

The administrator should be able to manage currencies such as:

USD

EUR

GBP

CNY

JPY

SGD

AED

INR

BDT

and any additional currencies if required.

Currencies should be configurable through the CMS.

==========================================================
AUTOMATIC API UPDATE
==========================================================

Integrate a reliable exchange rate API.

Requirements:

Automatic updates

Manual refresh

Error handling

Fallback values

Caching

Retry logic

If the API is temporarily unavailable:

Display the last successful exchange rates.

Do NOT break the frontend.

==========================================================
MANUAL OVERRIDE
==========================================================

Administrators should be able to:

Enable Manual Mode

Enter custom exchange rates

Disable Manual Mode

Return to live API values

The system should clearly indicate whether a rate is:

Live

or

Manual

==========================================================
DISPLAY OPTIONS
==========================================================

The administrator should decide where exchange rates appear.

Options include:

Homepage Section

Footer

Sidebar

Dedicated Exchange Rates Page

The display location must be configurable through the CMS.

==========================================================
FRONTEND
==========================================================

Create a premium responsive design.

Each currency card should display:

Currency Flag

Currency Code

Currency Name

Current Exchange Rate

Last Updated

Change Indicator (Up / Down / Same)

Everything should update dynamically.

==========================================================
ANIMATIONS
==========================================================

Use subtle animations:

Card Reveal

Number Transition

Refresh Animation

Hover Effect

Do not overuse animations.

==========================================================
DATABASE
==========================================================

Audit the existing database first.

Create only the necessary tables and fields.

Store:

Currency

Exchange Rate

Source

Last Updated

Manual Override

Status

Display Order

Create proper migrations only if required.

Maintain backward compatibility.

==========================================================
BACKEND
==========================================================

Implement:

Controllers

Models

Validation

Services

Scheduled Tasks

API Integration

Caching

Error Handling

Inertia Props

Everything must follow the existing project architecture.

==========================================================
SCHEDULER
==========================================================

Use Laravel Scheduler for automatic updates.

Allow the refresh interval to be configurable through the CMS.

Examples:

Every Hour

Every 6 Hours

Every 12 Hours

Daily

==========================================================
PERMISSIONS
==========================================================

Only authorized administrators may:

Refresh Rates

Override Rates

Enable / Disable Currencies

Change Settings

Public visitors can only view the exchange rates.

==========================================================
RESPONSIVE
==========================================================

Desktop

Laptop

Tablet

Mobile

Small Mobile

Cards should adapt automatically.

==========================================================
TESTING
==========================================================

Verify:

✓ Live API updates work

✓ Manual refresh works

✓ Manual override works

✓ Restore live values works

✓ API failure uses cached values

✓ Homepage display works

✓ Section enable/disable works

✓ Currency ordering works

✓ Responsive layout

✓ Scheduler updates rates

✓ No console errors

✓ No Laravel errors

==========================================================
FINAL REQUIREMENT
==========================================================

Implement a fully CMS-driven Live Exchange Rates feature integrated into the existing website architecture.

Everything—including section content, currencies, API settings, manual overrides, scheduling, ordering, visibility, animations, and display locations—must be manageable through the CMS.

Modify only the necessary backend, frontend, database, Vue components, controllers, models, services, and scheduler configuration.

Do not finish until the feature is production-ready, secure, optimized, responsive, fully CMS-driven, and seamlessly integrated into the existing project while preserving backward compatibility.