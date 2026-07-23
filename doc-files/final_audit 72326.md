Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
FINAL PRODUCTION AUDIT
==========================================================

This project is now nearly complete.

Your task is NOT to build new features.

Your task is to perform a COMPLETE production-ready audit of the entire project.

Act as a Senior:

• Laravel Architect
• Vue.js Architect
• UI/UX Lead
• Security Engineer
• Database Engineer
• Performance Engineer
• DevOps Engineer
• QA Engineer

Assume this project will go LIVE immediately after this audit.

Find every possible weakness.

Fix every issue.

Optimize everything.

Modify ONLY what is necessary.

Never break existing functionality.

==========================================================
DO NOT SKIP ANYTHING
==========================================================

Audit absolutely everything.

Frontend

Backend

Database

CMS

Authentication

Authorization

Uploads

Media

Storage

Performance

SEO

Accessibility

Responsive Design

Animations

Security

Code Quality

Everything.

==========================================================
1. FULL CODEBASE AUDIT
==========================================================

Inspect the entire project.

Remove:

Dead Code

Unused Components

Unused Imports

Unused Variables

Unused Controllers

Unused Routes

Duplicate Logic

Duplicate CSS

Duplicate Vue Components

Duplicate Helpers

Duplicate Services

Duplicate Queries

Deprecated Code

Commented Production Code

Clean everything.

==========================================================
2. PERFORMANCE AUDIT
==========================================================

Optimize:

Database Queries

N+1 Queries

Eager Loading

Caching

Lazy Loading

Vue Rendering

Component Re-rendering

Image Loading

Media Queries

Bundle Size

Assets

Icons

Fonts

Animations

Transitions

Memory Usage

API Calls

Remove unnecessary requests.

==========================================================
3. DATABASE AUDIT
==========================================================

Audit:

Indexes

Relationships

Foreign Keys

Constraints

Nullable Fields

Data Integrity

Migrations

Rollback Safety

Unused Tables

Unused Columns

Duplicate Data

Slow Queries

Optimize database performance.

==========================================================
4. SECURITY AUDIT
==========================================================

Perform a full security audit.

Check:

Authentication

Authorization

Policies

Middleware

Roles

Permissions

CSRF

XSS

SQL Injection

Mass Assignment

Validation

File Upload Security

File Type Validation

File Size Validation

Rate Limiting

Password Hashing

Sensitive Data Exposure

Session Security

Cookie Security

Route Protection

Hidden Admin Routes

Access Control

Ensure Content Editors cannot access Super Admin functionality.

Ensure public visitors cannot access CMS.

Ensure registration is completely disabled.

==========================================================
5. FILE UPLOAD AUDIT
==========================================================

Audit every upload.

Hero Banner

Hero Carousel

Gallery

Partners

CEO Image

Office Images

Any media uploader.

Verify:

Upload

Replace

Delete

Preview

Persist

Frontend Rendering

Storage

Media Library

Filesystem

==========================================================
6. CMS AUDIT
==========================================================

Audit every CMS module.

Dashboard

Page Management

Layout Management

Services CRUD

Partners CRUD

Messages Inbox

Manage Users

Global Settings

SEO

Repeatable Items

Every CRUD operation must work.

Verify:

Create

Read

Update

Delete

Sorting

Ordering

Status

Enable/Disable

Image Upload

Search

Filters

Validation

==========================================================
7. UI / UX AUDIT
==========================================================

Audit every page.

Home

About

Services

Contact

Coming Soon

Login

CMS

Verify:

Spacing

Typography

Alignment

Color Consistency

Card Consistency

Buttons

Icons

Hover States

Animations

Responsive Design

Loading States

Empty States

Error States

Premium appearance.

Nothing should look unfinished.

==========================================================
8. RESPONSIVE AUDIT
==========================================================

Test:

Desktop

Laptop

Tablet

Mobile

Small Mobile

No overflow.

No broken layouts.

No clipped text.

No overlapping components.

==========================================================
9. ANIMATION AUDIT
==========================================================

Audit every animation.

Ensure:

Smooth

GPU Accelerated

No lag

No jitter

Consistent timing

No excessive animation

Maintain premium feel.

==========================================================
10. SEO AUDIT
==========================================================

Verify:

Meta Titles

Descriptions

Canonical

Open Graph

Twitter Cards

Structured Data

Robots

Sitemap

Alt Text

Semantic HTML

Heading Hierarchy

==========================================================
11. ACCESSIBILITY AUDIT
==========================================================

Verify:

Keyboard Navigation

Focus States

Labels

ARIA

Contrast

Screen Reader Support

Image Alt Text

Forms

Buttons

==========================================================
12. ERROR HANDLING
==========================================================

Audit:

404

403

419

422

500

Validation Errors

Upload Errors

CMS Errors

API Errors

Show professional error messages.

Never expose sensitive information.

==========================================================
13. AUTHENTICATION AUDIT
==========================================================

Verify:

Login

Logout

Forgot Password

Session Timeout

Remember Me

Admin Access

Content Editor Access

Permission Checks

No public registration.

==========================================================
14. CODE QUALITY
==========================================================

Refactor where necessary.

Follow Laravel best practices.

Follow Vue best practices.

Follow SOLID principles.

Reduce duplication.

Improve maintainability.

==========================================================
15. LOAD & SCALABILITY AUDIT
==========================================================

Review whether the application is ready for production traffic.

Optimize:

Database connections

Queries

Image loading

Caching opportunities

Asset delivery

Laravel configuration

Vue rendering

Session handling

Memory usage

Queue readiness (if applicable)

Ensure the application remains stable under normal production load.

==========================================================
16. FINAL QA TEST
==========================================================

Test every feature.

Every page.

Every CMS module.

Every CRUD.

Every upload.

Every animation.

Every responsive breakpoint.

Every permission.

Every route.

Everything.

Nothing should remain broken.

==========================================================
17. CLEANUP
==========================================================

Remove:

Temporary Debug Code

dd()

dump()

console.log()

Unused migrations

Unused assets

Unused routes

Unused API endpoints

Debug comments

Development leftovers

==========================================================
18. PRODUCTION READINESS
==========================================================

Ensure the project is ready for deployment.

Review:

APP_ENV

APP_DEBUG

Storage

Cache

Route Cache

Config Cache

View Cache

Permissions

Environment variables

Asset compilation

Production configuration

Do not change deployment-specific values unnecessarily, but identify anything that must be configured before going live.

==========================================================
FINAL REQUIREMENT
==========================================================

Do NOT stop after finding one issue.

Continue auditing until the ENTIRE project has been reviewed.

Fix every issue you discover.

At the end provide a complete audit report including:

• Security improvements made

• Performance optimizations made

• Database optimizations made

• UI/UX improvements made

• CMS issues fixed

• Upload issues fixed

• Authentication improvements

• Code quality improvements

• Files modified

• Database changes (if any)

• Remaining recommendations (if any)

Only declare the project complete when it is production-ready, secure, optimized, consistent, and fully functional across the frontend, backend, database, CMS, and all supported devices.