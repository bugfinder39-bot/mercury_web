Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

==========================================================
IMPORTANT
==========================================================

The website is already fully functional.

Do NOT rebuild the existing website.

Do NOT replace existing pages.

Do NOT duplicate any CMS modules.

Integrate this new feature into the existing architecture.

Modify ONLY what is necessary.

Maintain full backward compatibility.

If database changes are required, create proper migrations.

==========================================================
NEW FEATURE
INTERACTIVE GLOBAL NETWORK MAP
==========================================================

I want to add a new premium section called:

"Global Network"

This section should showcase Mercury Bangladesh's worldwide logistics network, including offices, agents, partners, ports, warehouses, and operational locations.

Everything must be fully dynamic and manageable through the existing CMS.

==========================================================
CMS INTEGRATION
==========================================================

Create a new CMS module called:

Global Network

This module must allow administrators to manage every location without touching the code.

==========================================================
GLOBAL NETWORK CRUD
==========================================================

The administrator should be able to:

✓ Create Location

✓ View Locations

✓ Edit Location

✓ Delete Location

✓ Search

✓ Filter

✓ Enable / Disable

✓ Reorder

Everything must work exactly like the existing CMS CRUD modules.

==========================================================
LOCATION INFORMATION
==========================================================

Each location should support:

Location Name

Country

City

Region (optional)

Location Type

Examples:

Corporate Office

Branch Office

Warehouse

Sea Port

Air Port

Partner Office

Agent

Distribution Center

Latitude

Longitude

Complete Address

Google Maps URL (optional)

Phone Number (optional)

Email (optional)

Website (optional)

Short Description

Display Order

Status

Featured Toggle

Custom Marker Color (optional)

Custom Marker Icon (optional)

==========================================================
MAP
==========================================================

Implement a modern interactive map.

Choose the most suitable production-ready mapping library.

Examples:

Google Maps

Leaflet

Mapbox

(Open-source solutions are preferred if they fit the project.)

Requirements:

Zoom

Pan

Marker Clustering (if many markers)

Smooth animations

Modern styling

Responsive

Fast loading

==========================================================
MARKERS
==========================================================

Every CMS location should automatically generate a marker.

Clicking a marker should open an information popup containing:

Location Name

Type

Address

Phone (if available)

Email (if available)

Description

Google Maps button (if available)

Everything must be rendered dynamically.

==========================================================
HOMEPAGE SECTION
==========================================================

Add a new Homepage section:

Global Network

Section Title

Section Subtitle

Description

Map

Everything editable from the CMS.

The administrator should be able to:

Change section title

Change description

Enable/Disable section

Reorder section

==========================================================
LAYOUT
==========================================================

Create a premium corporate design.

Possible layout:

Left Side

Title

Description

Statistics

CTA

Right Side

Interactive Map

OR

Full-width interactive map with content above.

Choose the design that best matches the existing Mercury design language.

==========================================================
ANIMATIONS
==========================================================

Add subtle animations.

Examples:

Marker fade-in

Marker hover effects

Popup transitions

Section reveal animation

Do not overuse animations.

Maintain a professional corporate appearance.

==========================================================
RESPONSIVE
==========================================================

Ensure the map works perfectly on:

Desktop

Laptop

Tablet

Mobile

Touch gestures should work correctly.

==========================================================
DATABASE
==========================================================

Audit the existing database.

Create only the necessary tables and relationships.

Do NOT duplicate existing structures.

Create proper migrations.

Create models.

Create relationships.

Create validation.

Maintain backward compatibility.

==========================================================
BACKEND
==========================================================

Audit and implement:

Controllers

Models

Policies

Validation

Services

Repositories (if used)

API responses

Inertia props

Everything must follow the existing project architecture.

==========================================================
FRONTEND
==========================================================

Implement:

Vue Components

Dynamic marker rendering

Dynamic CMS content

Loading states

Empty states

Responsive layout

Proper error handling

==========================================================
PERMISSIONS
==========================================================

Only authorized administrators may:

Create

Edit

Delete

Enable

Disable

Reorder

Locations.

Public visitors can only view the map.

==========================================================
SEO
==========================================================

Ensure this section remains SEO-friendly.

Use semantic HTML.

Lazy-load the map where appropriate for performance.

==========================================================
TESTING
==========================================================

Verify:

✓ Create location

✓ Edit location

✓ Delete location

✓ Enable location

✓ Disable location

✓ Reorder location

✓ Featured location

✓ Marker renders correctly

✓ Popup displays correct information

✓ Google Maps link works

✓ Homepage section updates dynamically

✓ CMS changes reflect immediately

✓ Mobile responsiveness

✓ No console errors

✓ No Laravel errors

==========================================================
FINAL REQUIREMENT
==========================================================

Implement a fully dynamic, enterprise-grade "Global Network" feature integrated into the existing CMS.

Everything—including the section content, map, markers, locations, ordering, visibility, and styling options—must be manageable through the CMS.

If database changes are required, create proper migrations and relationships.

Modify only the necessary backend, frontend, database, Vue components, controllers, models, and CMS pages.

Do not finish until the feature is production-ready, responsive, secure, fully CMS-driven, and seamlessly integrated into the existing website architecture.