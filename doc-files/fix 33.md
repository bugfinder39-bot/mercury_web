Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
CRITICAL REGRESSION
==========================================================

The Dashboard Widgets implementation continues introducing database regressions.

The Dashboard currently crashes because it is querying:

badge

from the announcements table.

The announcements table does NOT contain this column.

This is another example of assuming the database schema instead of auditing it.

==========================================================
STOP ASSUMING DATABASE COLUMNS
==========================================================

From this point forward:

NEVER write a query using a column name unless you have verified that it exists.

Before writing any query, inspect:

• Migration

• Database table

• Model

• Existing CRUD implementation

• Existing validation

• Existing resource

Only after auditing should queries be written.

==========================================================
FULL PROJECT AUDIT
==========================================================

Audit every Dashboard Widget.

Inspect every widget one by one.

Verify that every queried table exists.

Verify that every queried column exists.

Do NOT stop after fixing the Announcement widget.

Search the entire Dashboard Widgets module for any query using assumed columns.

Audit:

Announcements

Exchange Rates

Visitor Analytics

Messages

Users

Company Statistics

Global Network

Certifications

Media Library

Audit Logs

Every other widget.

==========================================================
REPAIR
==========================================================

For every widget:

Use ONLY existing database fields.

If a requested field does not exist:

• Do NOT create a new database column.

• Do NOT create unnecessary migrations.

• Adapt the widget to the current schema.

If a visual element (such as Badge, Trend, Previous Rate, etc.) requires data that doesn't exist, either:

• Derive it from existing data where appropriate, or

• Hide that element gracefully.

Never crash the Dashboard because of missing fields.

==========================================================
ROBUSTNESS
==========================================================

The Dashboard must never fail because one widget has an issue.

If one widget encounters an error:

• Log the error.

• Display a graceful fallback for that widget.

• Continue rendering the rest of the Dashboard.

One broken widget must never bring down the entire Dashboard.

==========================================================
TESTING
==========================================================

Verify every widget individually.

Verify every query.

Verify every model.

Verify every table.

Verify every column.

Run a full regression test to ensure:

✓ Dashboard loads.

✓ Homepage loads.

✓ CMS loads.

✓ Public website loads.

✓ Exchange Rates work.

✓ Announcements work.

✓ No SQL errors.

✓ No QueryException.

✓ No missing columns.

✓ No console errors.

✓ No Laravel errors.

==========================================================
FINAL REQUIREMENT
==========================================================

Do not continue adding features until every Dashboard Widget has been audited against the real database schema.

Modify only the necessary files.

At the end provide:

1. Every incorrect database assumption that was found.
2. Every widget that was repaired.
3. Files modified.
4. Confirmation that all Dashboard Widgets are using only verified database fields and that the Dashboard is production-ready.