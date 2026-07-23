Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
EXCHANGE RATE API PROVIDER MANAGEMENT
==========================================================

The Exchange Rates module currently supports only a single API provider.

I want to refactor it into a multi-provider architecture.

The system must support multiple exchange rate providers and allow administrators to switch between them without modifying any code.

Maintain full backward compatibility.

Do not redesign the existing CMS.

Modify only the necessary backend, frontend, services, and database.

==========================================================
SUPPORTED PROVIDERS
==========================================================

Implement support for the following providers:

1. Frankfurter API
https://api.frankfurter.dev/

2. Fawaz Ahmed Currency API
https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/

The architecture must allow additional providers to be added easily in the future.

==========================================================
SERVICE ARCHITECTURE
==========================================================

Do NOT call APIs directly from controllers.

Create a clean provider architecture.

Example:

ExchangeRateProviderInterface

↓

FrankfurterExchangeRateProvider

↓

FawazAhmedExchangeRateProvider

↓

ExchangeRateManager

The manager should automatically use the currently selected provider.

Controllers must communicate only with the manager.

Business logic should never know which provider is active.

==========================================================
CMS SETTINGS
==========================================================

Under Exchange Rates → Settings, add a new section:

Exchange Rate Provider

Administrators should be able to:

✓ Select Active Provider

Options:

• Frankfurter API

• Fawaz Ahmed Currency API

Only one provider should be active at a time.

Saving the setting should immediately switch the provider without requiring code changes.

==========================================================
PROVIDER INFORMATION
==========================================================

Display:

Current Provider

Provider Status

Provider URL

Last Successful Sync

Last Failed Sync

Last Response Time

Cache Status

==========================================================
AUTO FAILOVER
==========================================================

Add an optional CMS setting:

Enable Automatic Failover

If enabled:

When the primary provider fails,

the system should automatically attempt the secondary provider.

Example:

Primary:

Frankfurter

↓

Unavailable

↓

Automatically use

Fawaz Ahmed

If both providers fail,

use cached exchange rates.

Never break the frontend.

==========================================================
CMS OPTIONS
==========================================================

Allow administrators to configure:

✓ Active Provider

✓ Enable Automatic Failover

✓ Auto Refresh Interval

✓ API Timeout

✓ Retry Attempts

✓ Cache Duration

✓ Default Base Currency

✓ Enable Logging

Everything should be editable through the CMS.

==========================================================
CACHE
==========================================================

Maintain the existing cache system.

If both providers fail:

Continue displaying the most recent successful exchange rates.

Never clear valid cached data.

==========================================================
ERROR HANDLING
==========================================================

Log detailed information for every failed request.

Include:

Provider Name

Request URL

HTTP Status

Response Time

Timeout

Response Body

Error Message

Stack Trace (if applicable)

Display only user-friendly messages in the CMS.

==========================================================
DIAGNOSTICS
==========================================================

Create a Provider Diagnostics panel.

Display:

Current Active Provider

Provider Health

Last Successful Sync

Last Failed Sync

Current Cache Status

Automatic Failover Status

Last Response Time

==========================================================
TEST CONNECTION
==========================================================

Add a "Test Connection" button.

The administrator should be able to test each provider independently.

Display:

✓ Success

or

Detailed Failure Reason

without affecting production data.

==========================================================
TESTING
==========================================================

Verify:

✓ Frankfurter API works.

✓ Fawaz Ahmed API works.

✓ Switching providers works instantly.

✓ Scheduler works with both providers.

✓ Manual Refresh works with both providers.

✓ Cache works with both providers.

✓ Automatic Failover works correctly.

✓ Existing CMS functionality remains unchanged.

✓ No console errors.

✓ No Laravel errors.

==========================================================
FINAL REQUIREMENT
==========================================================

Implement a scalable multi-provider Exchange Rate system that integrates seamlessly into the existing CMS.

Support Frankfurter API and Fawaz Ahmed Currency API out of the box.

Allow administrators to switch providers through the CMS without changing code.

Support automatic failover, diagnostics, connection testing, caching, logging, and scheduler integration.

Preserve backward compatibility.

Modify only the necessary files.

At the end, provide:

1. Files modified.
2. New architecture overview.
3. Provider switching flow.
4. Failover strategy.
5. Cache strategy.
6. Confirmation that both providers are fully functional, interchangeable, and production-ready.