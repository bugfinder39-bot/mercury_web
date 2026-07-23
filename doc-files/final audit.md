Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
FINAL PRODUCTION READINESS AUDIT
==========================================================

This project is approaching production deployment.

Do NOT implement any new features.

Do NOT redesign the UI.

Do NOT rewrite the architecture unless absolutely necessary.

Your task is to perform a comprehensive enterprise-grade audit of the entire project and make only the improvements required for a secure, stable, optimized, maintainable, and production-ready application.

Think and work like a Senior Laravel Architect, Senior Vue Developer, DevOps Engineer, Database Administrator, Security Engineer, Performance Engineer, and QA Engineer.

==========================================================
OBJECTIVE
==========================================================

Audit every part of the application.

Find hidden issues.

Find architectural weaknesses.

Find security vulnerabilities.

Find performance bottlenecks.

Find scalability issues.

Find database problems.

Find frontend issues.

Find backend issues.

Find deployment issues.

Fix only what is necessary.

Preserve backward compatibility.

==========================================================
ARCHITECTURE AUDIT
==========================================================

Audit the entire architecture.

Verify:

✓ MVC structure

✓ Service Layer

✓ Repository usage (if applicable)

✓ Controllers

✓ Models

✓ Policies

✓ Middleware

✓ Events

✓ Jobs

✓ Scheduling

✓ Route organization

✓ Dependency Injection

✓ SOLID principles

✓ DRY

✓ KISS

✓ Separation of concerns

Identify duplicated logic.

Identify dead code.

Identify unnecessary complexity.

==========================================================
DATABASE AUDIT
==========================================================

Audit:

Tables

Relationships

Indexes

Foreign Keys

Constraints

Migrations

Seeders

Soft Deletes

Cascade Rules

Query Performance

Duplicate Columns

Unused Tables

Unused Columns

Verify every query.

Eliminate N+1 queries.

Optimize eager loading.

Optimize indexes.

==========================================================
SECURITY AUDIT
==========================================================

Perform a complete security review.

Verify:

Authentication

Authorization

Policies

Role Permissions

Password Security

Session Security

CSRF Protection

XSS Protection

SQL Injection Protection

Mass Assignment

Validation

File Upload Security

Storage Security

API Security

Rate Limiting

Sensitive Data Exposure

Environment Variables

Debug Mode

Error Pages

Headers

Cookies

Remember Me

Session Timeout

Access Control

Directory Traversal

Privilege Escalation

Broken Access Control

Secure File Downloads

Security Logging

Audit Logging

Admin Routes

Public Routes

Hidden Routes

==========================================================
BACKEND AUDIT
==========================================================

Audit:

Controllers

Services

Jobs

Queues

Caching

Mail

Notifications

Storage

Error Handling

Logging

Validation

Resource Usage

Code Quality

Unused Code

Exception Handling

==========================================================
FRONTEND AUDIT
==========================================================

Audit:

Vue Components

Inertia

Layouts

Responsive Design

Accessibility

Animations

Transitions

Performance

Bundle Size

Lazy Loading

Image Optimization

Component Reuse

State Management

Loading States

Error States

Empty States

SEO

Meta Tags

Open Graph

Structured Data

==========================================================
CMS AUDIT
==========================================================

Audit every CMS module.

Verify:

CRUD

Validation

Permissions

Search

Filters

Sorting

Pagination

Media Uploads

Enable/Disable

Ordering

Relationships

Settings

Role Access

Delete Protection

Confirmations

==========================================================
MEDIA AUDIT
==========================================================

Audit:

Image Uploads

Storage

Optimization

Compression

WebP Support

File Validation

Orphan Files

Broken References

Unused Media

==========================================================
PERFORMANCE AUDIT
==========================================================

Measure and optimize:

Database Queries

Response Times

Memory Usage

CPU Usage

Caching

Route Cache

Config Cache

View Cache

Lazy Loading

Asset Optimization

Image Optimization

Chunk Splitting

Vite Build

==========================================================
LOAD & SCALABILITY AUDIT
==========================================================

Ensure the application can scale.

Audit:

Concurrent Users

Database Connections

Caching Strategy

Queue Workers

Scheduled Jobs

Session Storage

File Storage

Asset Delivery

Memory Consumption

Large Dataset Handling

Pagination

Search Performance

Dashboard Performance

Homepage Performance

==========================================================
DEPLOYMENT AUDIT
==========================================================

Prepare the application for production.

Verify:

Production Environment

APP_DEBUG=false

APP_ENV=production

Config Cache

Route Cache

View Cache

Event Cache

Storage Link

Permissions

Logs

Queue Workers

Scheduler

HTTPS

Trusted Proxies

Trusted Hosts

Environment Variables

Production Error Handling

==========================================================
SEO AUDIT
==========================================================

Verify:

Titles

Descriptions

Canonical URLs

Schema.org

Open Graph

Twitter Cards

Robots

Sitemap

Structured Data

Friendly URLs

==========================================================
ACCESSIBILITY AUDIT
==========================================================

Verify:

Keyboard Navigation

ARIA Labels

Alt Text

Color Contrast

Focus States

Screen Reader Compatibility

Semantic HTML

==========================================================
CODE QUALITY
==========================================================

Audit:

Unused Controllers

Unused Models

Unused Components

Unused Imports

Unused CSS

Unused Routes

Duplicate Logic

Duplicate Queries

Dead Code

Naming Conventions

Comments

Documentation

==========================================================
LOGGING
==========================================================

Ensure meaningful logging exists for:

Authentication

System Errors

CMS Actions

Critical Failures

API Failures

Scheduled Jobs

Queue Failures

Do not expose sensitive information in logs.

==========================================================
TESTING
==========================================================

Perform a complete regression audit.

Verify every module.

Verify every route.

Verify every page.

Verify every CMS section.

Verify every API.

Verify every upload.

Verify every setting.

Verify every role.

Verify every permission.

Verify every feature.

Ensure there are:

✓ No 404 errors

✓ No SQL errors

✓ No Laravel exceptions

✓ No Vue errors

✓ No Console errors

✓ No Missing Components

✓ No Broken Images

✓ No Broken Routes

✓ No Broken Relationships

==========================================================
FINAL REPORT
==========================================================

Do NOT simply say "everything looks good."

Provide a detailed audit report.

Categorize findings by:

Critical

High

Medium

Low

For each issue provide:

• Problem

• Risk

• Root Cause

• Recommended Fix

• Files Modified (if fixed)

• Impact

Also provide:

Production Readiness Score (0–100)

Security Score

Performance Score

Scalability Score

Maintainability Score

Code Quality Score

SEO Score

Accessibility Score

Finally, confirm whether the project is ready for production deployment.

Do not mark the project as production-ready until all critical and high-priority issues have been resolved.