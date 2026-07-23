Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
CRITICAL ISSUE
==========================================================

The Live Exchange Rates feature has been implemented, but refreshing rates always fails.

The CMS displays:

"Failed to fetch live rates. Using last known market rates."

The fallback mechanism works correctly, but the system is unable to retrieve fresh exchange rates from the API.

Do NOT hide the error.

Do NOT disable the refresh button.

Find the exact root cause and fix it properly.

==========================================================
OBJECTIVE
==========================================================

Perform a complete audit of the Live Exchange Rates implementation.

Determine exactly why the API request is failing.

Do not assume the cause.

==========================================================
AUDIT
==========================================================

Audit the following:

• Exchange Rate Service
• API Client
• Controller
• Service Layer
• Scheduled Job
• Queue Jobs (if used)
• Cache
• Environment Variables
• Configuration Files
• HTTP Client
• Error Handling
• Logging
• API Response Parsing
• Timeout Configuration
• SSL Verification
• Rate Limiting
• Network Requests

==========================================================
VERIFY API
==========================================================

Verify that:

✓ The API endpoint is correct.

✓ The API key exists.

✓ The API key is valid.

✓ Environment variables are loaded correctly.

✓ The request headers are correct.

✓ The HTTP client is sending the request correctly.

✓ The response is being parsed correctly.

✓ API errors are handled properly.

If the API provider has changed its response format, update the parser accordingly.

==========================================================
LARAVEL CONFIGURATION
==========================================================

Verify:

config/services.php

.env

.env.example

config/cache.php

config/app.php

HTTP Client configuration

Timeout values

SSL settings

Cache settings

==========================================================
LOGGING
==========================================================

Improve logging.

If the API request fails, log the actual reason.

Examples:

Invalid API key

401 Unauthorized

403 Forbidden

404 Endpoint Not Found

429 Rate Limit

500 Server Error

Network Timeout

DNS Failure

SSL Failure

JSON Parsing Error

Missing Currency

Unexpected Response Format

The administrator should never receive only a generic error.

==========================================================
CACHE
==========================================================

Keep the current fallback behavior.

If the API fails:

Continue showing the last successful exchange rates.

Do not clear valid cached data.

If there is no cached data:

Display an informative message.

==========================================================
CMS
==========================================================

Add a diagnostics section showing:

API Status

Last Successful Sync

Last Failed Sync

Failure Reason

Current API Provider

Current Cache Status

Last Response Code

Last Response Time

These diagnostics should only be visible to administrators.

==========================================================
TESTING
==========================================================

Verify:

✓ Refresh button works.

✓ Automatic scheduled updates work.

✓ Manual refresh works.

✓ API key validation works.

✓ Invalid API key is handled correctly.

✓ Timeout handling works.

✓ Cache fallback works.

✓ Logs contain detailed errors.

✓ No console errors.

✓ No Laravel errors.

==========================================================
FINAL REQUIREMENT
==========================================================

Do not implement a workaround.

Identify the exact root cause of the failed API requests.

Fix the integration properly.

Maintain the existing CMS interface and fallback mechanism.

Modify only the necessary files.

At the end, provide:

1. The root cause.
2. The affected files.
3. The API provider being used.
4. The exact API endpoint.
5. Any environment variables that need to be configured.
6. Confirmation that manual refresh, scheduled updates, and cache fallback are all working correctly and production-ready.






==========================================================
API PROVIDER REQUIREMENT
==========================================================

Do NOT use unreliable or paid exchange rate providers.

Use the Frankfurter API as the default exchange rate provider.

Official API:
https://api.frankfurter.dev/

The implementation must use Frankfurter as the primary data source.

==========================================================
IMPLEMENTATION REQUIREMENTS
==========================================================

• Integrate the Frankfurter API using Laravel's HTTP Client.
• Use the latest supported Frankfurter endpoints.
• Store the base currency in the CMS settings (default: BDT if supported, otherwise use EUR and convert accordingly).
• Fetch all enabled currencies in a single request whenever possible.
• Parse and validate the API response before updating the database.
• Handle network failures, timeouts, and invalid responses gracefully.
• Cache the latest successful response.
• Continue displaying cached rates if the API is unavailable.
• Log detailed API errors for administrators.

==========================================================
CONFIGURATION
==========================================================

The API provider should be configurable.

Create a service layer so the application can easily switch to another provider in the future without changing business logic.

Do NOT hardcode the API inside controllers.

Use:

- ExchangeRateService interface
- FrankfurterExchangeRateService implementation

so additional providers can be added later.

==========================================================
CMS
==========================================================

Display in the CMS:

• Current Provider: Frankfurter
• Last Successful Sync
• Last Failed Sync
• Response Time
• API Status
• Last Error (if any)

==========================================================
TESTING
==========================================================

Verify that:

✓ Frankfurter API returns live rates.
✓ Manual Refresh updates the database.
✓ Automatic Scheduler updates rates.
✓ Cached values are used if Frankfurter is unavailable.
✓ No duplicate requests are made.
✓ All enabled currencies update correctly.
✓ The implementation is production-ready.