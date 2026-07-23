Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

==========================================================
CRITICAL DATABASE REGRESSION
==========================================================

The Dashboard Widgets implementation introduced another database regression.

The Dashboard now crashes with:

SQLSTATE[42S22]

Unknown column:

rate

from the exchange_rates table.

This happened because the implementation assumed the database schema instead of auditing the existing project.

==========================================================
DO NOT DO THIS
==========================================================

Do NOT create a new "rate" column just to satisfy the query.

Do NOT modify the database without first auditing it.

Do NOT hardcode database field names.

==========================================================
YOUR TASK
==========================================================

Perform a complete audit of the existing Exchange Rates module.

Determine the ACTUAL database schema before writing queries.

Audit:

• exchange_rates table

• migrations

• ExchangeRate model

• controllers

• services

• DashboardWidgetController

• Dashboard widgets

• Exchange Rate provider implementation

Determine which column actually stores the current exchange rate.

Update every query to use the real schema.

==========================================================
CHECK FOR OTHER REGRESSIONS
==========================================================

Search the entire project for queries referencing:

rate

previous_rate

trend

updated_at

or any other assumed fields.

Verify every field exists before using it.

==========================================================
DASHBOARD
==========================================================

Repair every Dashboard widget that depends on Exchange Rates.

Do not assume columns.

If a widget requires information that doesn't exist,

adapt the widget to the existing schema instead of modifying the database.

==========================================================
FINAL REQUIREMENT
==========================================================

Modify only the necessary files.

Do not create unnecessary migrations.

Do not duplicate fields.

Use the existing database structure.

At the end provide:

1. The actual exchange_rates schema.

2. The incorrect assumptions that caused the error.

3. Every file modified.

4. Confirmation that the Dashboard loads successfully and all widgets work correctly.