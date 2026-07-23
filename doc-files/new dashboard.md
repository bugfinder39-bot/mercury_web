Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website and CMS are already fully functional.

Do NOT rebuild the Dashboard.

Do NOT redesign the existing UI.

Integrate this feature into the current CMS architecture.

Modify only the necessary files.

Maintain full backward compatibility.

==========================================================
NEW FEATURE
CUSTOMIZABLE DASHBOARD WIDGETS
==========================================================

I want to transform the Admin Dashboard into a fully customizable dashboard.

Administrators should be able to choose which widgets are displayed, reorder them, enable/disable them, and customize their behavior entirely from the CMS.

Everything must follow the same architecture as the other CMS modules.

==========================================================
CMS MODULE
==========================================================

Create a module named:

Dashboard Widgets

The administrator should be able to:

✓ Enable Widget

✓ Disable Widget

✓ Change Display Order

✓ Resize Widget (Small / Medium / Large / Full Width)

✓ Choose Dashboard Position

✓ Change Refresh Interval

✓ Search Widgets

✓ Preview Widgets

✓ Restore Default Layout

Everything must integrate into the existing CMS.

==========================================================
AVAILABLE WIDGETS
==========================================================

Create widgets for:

Website Visitors

Today's Visitors

Online Visitors

Page Views

Contact Messages

Unread Messages

Quote Requests

Announcements

Exchange Rates

Latest News

Recent Users

Latest Activity

Audit Logs

Media Library Statistics

Storage Usage

Company Statistics

Homepage Components Status

System Health

Server Information

Scheduled Jobs Status

Cache Status

Database Status

Each widget should be independent and reusable.

==========================================================
WIDGET SETTINGS
==========================================================

Each widget should support:

Title

Subtitle

Icon

Background Style

Chart Type (if applicable)

Refresh Interval

Display Order

Widget Size

Animation

Enable / Disable

Permission Control

==========================================================
SECTION SETTINGS
==========================================================

Dashboard administrators should be able to:

Enable Dashboard Widgets

Disable Dashboard Widgets

Restore Default Dashboard

Save Custom Layout

Export Layout

Import Layout

==========================================================
LAYOUT
==========================================================

Create a responsive drag-and-drop dashboard layout.

Widgets should automatically rearrange without breaking the layout.

Support:

Desktop

Laptop

Tablet

Mobile

==========================================================
REAL-TIME DATA
==========================================================

Widgets should update dynamically where appropriate.

Examples:

Visitor Count

Online Users

Exchange Rates

Unread Messages

Announcements

Do not reload the entire dashboard.

Use efficient polling or other suitable techniques.

==========================================================
CHARTS
==========================================================

Where applicable, include charts such as:

Line Chart

Bar Chart

Pie Chart

Area Chart

Mini Statistics Cards

All charts should be responsive and performant.

==========================================================
PERMISSIONS
==========================================================

Only authorized administrators should be able to:

Create Widgets

Configure Widgets

Reorder Widgets

Delete Widgets

Enable / Disable Widgets

Other user roles should only see the widgets they have permission to access.

==========================================================
DATABASE
==========================================================

Audit the existing database first.

Create only the necessary tables.

Store:

Widget Settings

Display Order

Layout

Visibility

Refresh Interval

User Preferences

Permissions

Use proper migrations.

==========================================================
BACKEND
==========================================================

Implement:

Models

Controllers

Services

Validation

Policies

Relationships

Inertia Props

Everything should follow the existing project architecture.

==========================================================
TESTING
==========================================================

Verify:

✓ Widgets load correctly.

✓ Enable / Disable works.

✓ Drag-and-drop ordering works.

✓ Widget resizing works.

✓ Dashboard layout is preserved.

✓ Responsive layout works.

✓ Charts render correctly.

✓ Permissions work.

✓ No console errors.

✓ No Laravel errors.

==========================================================
FINAL REQUIREMENT
==========================================================

Implement a fully CMS-driven Dashboard Widgets system integrated into the existing admin dashboard.

Everything—including widget visibility, layout, ordering, refresh intervals, permissions, and appearance—must be configurable through the CMS.

Modify only the necessary backend, frontend, database, Vue components, controllers, models, and services.

Do not finish until the feature is production-ready, secure, responsive, optimized, fully customizable, and seamlessly integrated into the existing CMS without introducing regressions.