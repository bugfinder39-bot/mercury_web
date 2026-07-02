# Design Guideline
## Mercury Bangladesh (Pvt.) Ltd. — Website Visual Identity

| | |
|---|---|
| **Direction** | Professional, minimal, corporate — light theme only |
| **Stack** | Tailwind CSS + DaisyUI, Vue 3 |
| **Version** | 1.0 |

---

## 1. Design Philosophy

Mercury moves cargo across borders reliably, on schedule, with paperwork that has to be exact. The design should feel the same way: **precise, calm, and dependable** — not decorative, not trendy. Every choice below is built around the vocabulary of freight itself: manifests, routes, ports, containers, bills of lading — so the site feels authentically like a logistics company, not a generic corporate template with a ship icon added.

**Three words that govern every decision:** Precise · Calm · Dependable.

If a design choice feels playful, loud, or purely decorative, it's off-brand. If it feels engineered, legible, and quietly confident, it's on-brand.

---

## 2. Color System

A restrained palette: one deep "harbor" navy, one slate neutral, a near-white working background, and a single accent used sparingly — the way a shipping manifest uses red ink only for the one thing that needs your attention.

| Token | Hex | Role |
|---|---|---|
| **Harbor Navy** | `#0B2540` | Primary brand color — nav bar, footer, dark section backgrounds, primary headings on light bg |
| **Deep Ocean** | `#123A5E` | Secondary navy — gradients, hover states on navy elements, secondary buttons |
| **Slate** | `#5B6B79` | Body copy, secondary text, borders, icon strokes |
| **Fog** | `#F5F7FA` | Alternate section background (used to separate sections without hard lines) |
| **Cloud White** | `#FFFFFF` | Base page background, card surfaces |
| **Signal Amber** | `#E8770C` | **The one accent.** CTAs, active nav state, key stat highlight, form focus ring. Used deliberately, never as a background wash. |

**Supporting/semantic (not part of core palette — data only):**

| Token | Hex | Role |
|---|---|---|
| **Freight Green** | `#1F7A5C` | SLA/compliance positive indicators, success states, form success messages |
| **Alert Red** | `#C0392B` | Form errors only |

### Usage rules
- **Backgrounds:** alternate sections between Cloud White and Fog to create rhythm without borders or shadows.
- **Navy is a surface, not just a text color** — use it as a full section background 1–2 times per page (e.g., the stats bar, the footer, one CTA band) so it reads as structural, not just "dark text."
- **Amber is rationed:** one primary CTA per view, active states, and small data accents (e.g., the number inside a stat, an active nav underline). If more than ~10% of a screen is amber, pull it back.
- Never introduce a second accent hue. Discipline here is what makes it read "corporate," not "startup."
- **No dark theme.** Do not implement a `data-theme` toggle. Lock DaisyUI to a single custom light theme (config in Section 10).

---

## 3. Typography

A three-role type system, chosen to echo the world of freight documentation — one confident structural face for headings, one highly legible face for body copy, and one monospace face reserved for data (stats, reference numbers, labels) the way a bill of lading uses a fixed-width font for tracking codes.

| Role | Typeface | Source | Weights used |
|---|---|---|---|
| **Display / Headings** | **Archivo** (Expanded width for hero/H1 only) | Google Fonts | 600 (SemiBold), 700 (Bold) |
| **Body** | **IBM Plex Sans** | Google Fonts | 400 (Regular), 500 (Medium) |
| **Data / Labels / Eyebrows** | **IBM Plex Mono** | Google Fonts | 500 (Medium), uppercase, tracked |

### Why this pairing
- **Archivo Expanded** gives headlines an engineered, confident width — reads as structural rather than fashionable, fitting "premium corporate logistics."
- **IBM Plex Sans** is a workhorse humanist sans with excellent readability at body sizes and a technical heritage that supports (not competes with) the headline face.
- **IBM Plex Mono** is the signature move: small uppercase mono labels are used as "eyebrows" above section headings and as the format for stat units — visually quoting a shipping manifest or container ID without being literal about it.

### Type scale (desktop → mobile)

| Style | Desktop | Tablet | Mobile | Weight | Tracking |
|---|---|---|---|---|---|
| Eyebrow (mono label) | 13px | 13px | 12px | 500 | +0.12em, uppercase |
| H1 (Hero) | 56px / 1.05 | 42px | 32px | Archivo 700 | -0.01em |
| H2 (Section title) | 36px / 1.15 | 30px | 26px | Archivo 700 | -0.01em |
| H3 (Card/tile title) | 22px / 1.3 | 20px | 19px | Archivo 600 | normal |
| Body Large (intro text) | 18px / 1.6 | 17px | 16px | Plex Sans 400 | normal |
| Body | 16px / 1.65 | 16px | 15px | Plex Sans 400 | normal |
| Caption / meta | 13px / 1.4 | 13px | 12px | Plex Sans 500 | normal |
| Stat number | 44px / 1.0 | 36px | 30px | Archivo 700 | normal |
| Stat unit/label | 13px mono | 13px | 12px | Plex Mono 500 | +0.08em, uppercase |

**Rule:** Never mix a serif into this system. Never use more than 2 weights of Archivo and 2 of Plex Sans on one screen — restraint in weight is as important as restraint in color.

---

## 4. Signature Element — "Manifest Marks"

The one deliberately memorable device, used consistently but sparingly:

1. **Mono eyebrow tags** above every major section heading, formatted like a document reference:
   `MB · 01 — ABOUT US` or `ROUTE / WHY MERCURY`
   Small, uppercase, letter-spaced, in Slate or Amber, mono font. This is the site's fingerprint — it appears once per section, never mid-paragraph.

2. **Route-line divider**: a thin 1px horizontal line with small circular "port" markers (dots), used once per page as a structural divider — e.g., beneath the hero, or threading through the stats bar — evoking a shipping lane on a map. Not animated confetti; a single quiet static (or gently scroll-revealed) line.

3. **Timeline points (About → Our History)**: this is the one place a literal point-to-point / numbered design is justified, because the content genuinely is a chronological sequence. Use the mono eyebrow style for years (`2016`, `2019`, `2023`) connected by the same route-line device.

Do not reuse numbered markers (01/02/03) decoratively elsewhere — reserve sequence numbering for places where order is actually meaningful (History timeline, step-based content). Service cards and partner logos are **not** sequences — no numbering there.

---

## 5. Layout & Grid

- **Grid:** 12-column, max content width **1280px**, gutters 24px (desktop), 16px (mobile).
- **Section vertical rhythm:** 96–120px top/bottom padding on desktop sections, 56–72px on mobile. Consistent rhythm is what makes a minimal design feel intentional rather than sparse.
- **Corner radius:** small and consistent — `rounded-lg` (8px) for cards/buttons/inputs, `rounded-full` only for badges, avatars, and pill-shaped tags. Avoid DaisyUI's default heavy `rounded-2xl`/`rounded-3xl` on cards — it reads playful, not corporate.
- **Elevation:** avoid heavy drop shadows. Prefer a **1px hairline border** (`border-slate-200`) over `shadow-lg`. Where a shadow is used (e.g., hover state on a card), keep it soft and low-opacity: `0 4px 16px rgba(11,37,64,0.08)`.
- **Dividers:** hairline 1px, Slate at 15% opacity, not full-strength black rules.

### Section anatomy (applies to Home, About, Services)
```
┌───────────────────────────────────────────┐
│  MB · 0X — SECTION LABEL     (mono eyebrow)│
│  Section Heading                (H2)       │
│  Optional 1–2 line supporting copy         │
│                                             │
│  [ content: grid / flex / tiles / cards ]  │
└───────────────────────────────────────────┘
```

---

## 6. Component Guidelines

### 6.1 Navigation Bar
- Fixed/sticky, Cloud White background with a hairline bottom border (not a shadow) on scroll.
- Logo left, nav links center-right, one Amber primary CTA button ("Get a Quote" / "Contact Us") far right.
- Active link indicated by a **1px Amber underline**, not a filled pill — keep it minimal.
- Mobile: slide-in drawer from the right on Navy background, links in white/Plex Sans, CTA button remains Amber.

### 6.2 Hero (Home carousel)
- Full-bleed image or Navy gradient background, 70–85vh height (not full 100vh — avoid the generic "giant hero" cliché; leave the next section peeking in).
- Text block: mono eyebrow → Archivo H1 → one line of body copy → one primary (Amber) + one ghost/outline (white border) CTA pair.
- Carousel dots: small, mono-labelled if slide count ≤ 4 (e.g. "01 / 02 / 03"), positioned bottom-left, not center — center dots are the template default.
- Autoplay 6–7s interval, pause on hover/focus, respect `prefers-reduced-motion` (disable autoplay, show static first slide).

### 6.3 About Us / Our Story (image + text flex)
- 50/50 split on desktop (stack on mobile, image first).
- Image: single photo, subtle Navy duotone overlay option for brand cohesion across otherwise varied stock photography — this keeps a mixed photo library feeling like one brand.
- No image shadow; if separation is needed, use a thin 1px border in Fog.

### 6.4 Vision / Mission / Foundation Tiles
- 2–3 column grid, Cloud White cards, hairline border, generous internal padding (32px).
- Icon (line-style, 2px stroke, Navy or Slate — never filled/glyph icons, they read less corporate) top-left, H3 title, 2–3 line body text.
- Hover: border shifts from Slate-15% to Navy, no scale/lift animation (keep it calm).

### 6.5 Why Choose Us
- Text-led section; if paired with a supporting list, use a simple checkmark or thin-line icon + short label list (2 columns on desktop), not heavy iconography.

### 6.6 Feature Services / All Services Cards
- 3-column grid desktop, 1-column mobile.
- Card: Cloud White, hairline border, icon, H3 service name, 2-line description, text link ("Learn more →") in Amber — no filled button inside cards, reserve solid Amber buttons for primary page-level CTAs only.

### 6.7 Stats Bar (Experience / Shipments / Countries / SLA)
- Full-width **Navy** band (one of the 1–2 navy moments per page) — this is where Amber and mono do their best work: large Archivo numbers in white, Amber for the "+" or "%" suffix, Plex Mono uppercase label beneath.
- 4-column grid desktop, 2-column mobile, separated by thin 1px white-15%-opacity vertical dividers (desktop only).
- Numbers animate on scroll-into-view with a simple count-up (600–900ms, ease-out) — the one motion moment worth having.

### 6.8 Partners
- Grayscale logos by default, full color on hover (a classic, appropriately restrained "trust bar" pattern) — logos in a single-row scroller or static grid depending on count.
- Keep a consistent logo bounding box (equal height, e.g. 40px) regardless of each partner's native logo proportions.

### 6.9 History Timeline (About)
- Vertical on mobile, horizontal or vertical on desktop (vertical recommended for readability with longer descriptions).
- Route-line device (Section 4) connects each year marker; mono year label, Archivo H3 milestone title, short body text.

### 6.10 Contact Form
- Single column, max-width 560px, generous field spacing (20px vertical gap).
- Inputs: Cloud White fill, 1px Slate-25% border, `rounded-lg`, focus state = 2px Amber ring (no glow/blur).
- Labels above fields (not floating labels — floating labels reduce clarity and feel less corporate).
- Primary submit button: solid Amber, full-width on mobile, auto-width on desktop.
- Validation errors: Alert Red text below field, red 1px border on the field — no red background fill.
- Success state: inline Freight Green confirmation message, form fields clear.

### 6.11 Footer
- Navy background, white/Fog text, 4-column layout desktop (Company, Quick Links, Services, Contact/Social) collapsing to accordion or stacked on mobile.
- Bottom bar: hairline white-10% border, copyright + tagline in mono caption style.

### 6.12 Buttons

| Variant | Style |
|---|---|
| Primary | Solid Amber `#E8770C`, white text, `rounded-lg`, no shadow, subtle darken on hover (`#CC6608`) |
| Secondary (on light bg) | Transparent, 1.5px Navy border, Navy text, fills Navy w/ white text on hover |
| Secondary (on navy bg) | Transparent, 1.5px white border, white text, fills white w/ Navy text on hover |
| Text link | Amber text, underline on hover only, arrow (→) suffix for "learn more" style links |

All buttons: no scale/bounce on hover — a slight color transition only (150ms ease). Corporate restraint applies to interaction, not just color.

---

## 7. Iconography & Imagery

- **Icons:** line-style only, 1.5–2px stroke weight, consistent corner rounding, single-color (Navy or Slate, Amber only for active/highlighted states). Recommended set: **Lucide** (already available in the stack via `lucide-react`/vue equivalent, or Heroicons Outline as fallback) — never mix icon families.
- **Photography:** real freight/logistics imagery — ports, containers, cargo ships, warehouses, trucks, people at work — never generic stock "handshake" or "globe with lines" clichés. Apply a subtle Navy duotone/overlay (10–20% opacity) across all hero and section photography to unify a photo library that may come from multiple sources.
- **Illustrations/graphics** (if used for empty states, map pins, etc.): flat, 2-tone (Navy + Amber accent only), consistent stroke weight with the icon set.
- **Avoid:** stock "shipping container isometric 3D icon" cliché sets, gradients-on-everything, drop-shadowed floating cards, glassmorphism — none of these fit a minimal corporate direction.

---

## 8. Motion Guidelines

Motion should feel like cargo moving on schedule — smooth, purposeful, never bouncy.

- **Page load:** simple fade/slide-up (16px, 400ms ease-out) for hero content only.
- **Scroll reveals:** subtle fade + 12px slide-up on section entry, staggered 60–80ms between grid items (tiles, cards, partner logos). Keep the total reveal under ~500ms so it never feels sluggish.
- **Stats count-up:** the one "signature" animation moment (Section 6.7).
- **Hover states:** color/border transitions only, 150–200ms ease. No scale, no rotate, no shadow "lift" — these read as generic template polish rather than intentional design.
- **Carousel transitions:** crossfade or slide, 500–600ms, ease-in-out.
- Always respect `prefers-reduced-motion: reduce` — disable count-up, scroll-reveal, and autoplay carousel, showing final states directly.

---

## 9. Responsive Rules

| Breakpoint | Width | Notes |
|---|---|---|
| `sm` | 640px | Single-column stacking begins |
| `md` | 768px | 2-column grids for tiles/services |
| `lg` | 1024px | Full nav appears, 3–4 column grids, stats bar horizontal |
| `xl` | 1280px | Max content width reached, extra space becomes margin |

**Rules:**
- Design mobile-first; every section in Section 6 has an explicit mobile behavior — never leave it to "shrink and hope."
- Touch targets minimum 44×44px on mobile (nav links, carousel dots, form fields).
- Hero text never exceeds ~90% viewport width on mobile; avoid orphaned single words on the last line of H1.
- Images use responsive `srcset`/`sizes` — the CMS should store at least 2 sizes per uploaded image (e.g., 1600px hero, 800px card) to avoid shipping oversized files to mobile.

---

## 10. Tailwind / DaisyUI Implementation

### 10.1 Tailwind color tokens (`tailwind.config.js`)
```js
theme: {
  extend: {
    colors: {
      navy: {
        DEFAULT: '#0B2540',
        light: '#123A5E',
      },
      slate: {
        DEFAULT: '#5B6B79',
      },
      fog: '#F5F7FA',
      amber: {
        DEFAULT: '#E8770C',
        dark: '#CC6608',
      },
      freight: {
        green: '#1F7A5C',
      },
      alert: {
        red: '#C0392B',
      },
    },
    fontFamily: {
      display: ['Archivo', 'sans-serif'],
      body: ['"IBM Plex Sans"', 'sans-serif'],
      mono: ['"IBM Plex Mono"', 'monospace'],
    },
    borderRadius: {
      DEFAULT: '8px',
    },
  },
}
```

### 10.2 DaisyUI single light theme (`daisyui.config`)
```js
daisyui: {
  themes: [
    {
      mercury: {
        "primary": "#0B2540",
        "primary-content": "#FFFFFF",
        "secondary": "#123A5E",
        "accent": "#E8770C",
        "accent-content": "#FFFFFF",
        "neutral": "#5B6B79",
        "base-100": "#FFFFFF",
        "base-200": "#F5F7FA",
        "base-300": "#E7EBEF",
        "info": "#123A5E",
        "success": "#1F7A5C",
        "error": "#C0392B",
        "--rounded-box": "0.5rem",
        "--rounded-btn": "0.5rem",
        "--rounded-badge": "9999px",
        "--tab-radius": "0.5rem",
      },
    },
  ],
  darkTheme: false,   // explicitly disable dark theme support
}
```
Apply `data-theme="mercury"` at the root `<html>` element and do not implement a theme switcher.

---

## 11. Do / Don't Summary

| Do | Don't |
|---|---|
| One accent color (Amber), used sparingly | Multiple bright accent colors |
| Hairline borders for separation | Heavy drop shadows everywhere |
| Mono eyebrow labels as the signature device | Numbered markers (01/02/03) on non-sequential content |
| Navy as a structural section background (stats, footer, CTA band) | Navy used only as body text color, never as a surface |
| Calm, color/border-only hover states | Bouncy scale/rotate hover animations |
| Real freight photography with Navy duotone | Generic globe/handshake stock imagery |
| Consistent 8px corner radius | Mixed radii (some 4px, some 24px) across components |
| Mobile-first, explicit responsive behavior per component | "Just let it shrink" responsive approach |

---

*This guideline should be handed to development alongside the Requirements Analysis document. Recommend a one-page static style-tile (color swatches + type specimen + one hero mockup) be produced and approved before full-page builds begin, to lock the direction early.*
