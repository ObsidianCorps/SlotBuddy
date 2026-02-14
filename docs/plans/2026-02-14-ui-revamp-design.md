# SlotBuddy UI/UX Revamp Design

**Date:** 2026-02-14
**Status:** Approved
**Branch:** feature/ui-revamp

## Context

Complete UI/UX overhaul inspired by cal.com's modern, clean design language. Replace the aging Bootstrap + jQuery + Gulp stack with Tailwind CSS + Vanilla JS + Vite. Keep PHP/CodeIgniter view templating.

## Decisions

- **Framework:** Keep PHP views, no SPA framework
- **CSS:** Bootstrap 5.3 → Tailwind CSS 3.x
- **JS:** jQuery → Vanilla JS, IIFEs → ES modules
- **Build:** Gulp + Babel + SCSS → Vite + PostCSS
- **Colors:** Neutral palette + configurable accent color (default indigo #6366f1)
- **Dark mode:** Yes, from day one (Tailwind `dark:` variant)
- **Navigation:** Top navbar → Collapsible left sidebar (backend)
- **Scope:** Everything at once (all layouts, pages, components)

## Build Pipeline

### Remove
- `gulpfile.js`, `babel.config.json`
- SCSS compilation pipeline
- `assets/vendor/` directory (Vite handles dependencies)

### Add
- `vite.config.js` — Multi-entry (one per layout), PostCSS + Tailwind
- `tailwind.config.js` — Custom design tokens, dark mode class strategy
- `postcss.config.js` — Tailwind + autoprefixer
- `src/` directory — JS entry points per layout with ES module imports

### Entry Points
```
src/
  booking.js       → booking layout entry
  backend.js       → backend layout entry
  account.js       → account layout entry
  message.js       → message layout entry
```

### PHP Integration
- Dev: Vite dev server proxy (HMR on localhost:5173)
- Prod: `manifest.json` maps entry points to hashed filenames
- Helper function: `vite_assets('src/booking.js')` outputs correct `<script>/<link>` tags

## Design System

### Colors
```
Accent:     configurable via CSS --accent (default #6366f1 indigo)
Gray:       50-950 neutral scale (Tailwind defaults)
Success:    #22c55e (green-500)
Warning:    #f59e0b (amber-500)
Danger:     #ef4444 (red-500)
Info:       #3b82f6 (blue-500)
```

### Typography
- Font: Inter (400, 500, 600, 700)
- Scale: text-xs (12px), text-sm (14px), text-base (16px), text-lg (18px), text-xl (20px)

### Spacing & Borders
- Border radius: rounded (6px), rounded-lg (8px), rounded-xl (12px)
- Shadows: shadow-sm, shadow, shadow-lg (subtle, not heavy)
- Consistent 4px spacing grid

### Dark Mode
- `<html class="dark">` toggle
- Respects `prefers-color-scheme` as default
- Manual override stored in localStorage
- All components define both light and dark variants

### Company Color Override
- CSS variable `--accent` set inline from PHP `setting('company_color')`
- Tailwind `theme.extend.colors.accent` references the CSS variable
- All accent-colored elements use `bg-accent`, `text-accent`, `ring-accent`

## Layout Designs

### Booking Page (Public)
Cal.com-inspired split layout:
- Left panel: company branding, service info, description
- Right panel: date picker + time slot grid
- Single-page flow (replaces 4-step wizard)
- Time slots as pill buttons in responsive grid
- Customer info form slides in after time selection
- Confirmation inline
- Mobile: vertical stack

### Backend Layout (Admin)
- Collapsible left sidebar with icon labels
- Sections: Calendar, Bookings, Customers, Services, Settings
- Logo/name at top, user avatar at bottom
- Main content: page title bar + white/dark card containers
- Tables with hover states, clean borders

### Account Layout (Login)
- Centered card on subtle background
- Company logo above form
- Clean inputs with accent focus ring
- Minimal, no distractions

### Message Layout
- Centered card with icon, title, message
- Action button if applicable

## Component Patterns

### Buttons
- Primary: solid accent, white text, rounded-lg
- Secondary: outline accent border, accent text
- Ghost: no border, accent text, hover bg
- Danger: red variant for destructive actions

### Inputs
- Rounded border, gray-300 default
- Focus: accent ring (ring-2 ring-accent)
- Labels above (not floating)
- Error: red border + error text below

### Cards
- White bg (dark: gray-800), rounded-xl, shadow-sm
- Subtle border (gray-200 / dark:gray-700)
- Consistent padding (p-6)

### Modals
- Centered overlay, backdrop-blur
- White/dark card, rounded-xl
- X close button top-right
- Actions bottom-right

### Tables
- Clean header (gray-50 bg), subtle borders
- Row hover state
- Inline actions (edit/delete icons)

### Sidebar Navigation
- Full: icon + label (w-64)
- Collapsed: icon only (w-16)
- Active item: accent bg-opacity-10, accent text, left border
- Hover: gray-100 (dark: gray-800)

## Library Changes

| Remove | Replace | Reason |
|--------|---------|--------|
| jQuery 3.7 | Vanilla JS | Modern browsers, no need |
| Bootstrap 5.3 | Tailwind CSS 3.x | Utility-first, better DX |
| @popperjs/core | (kept by Tippy.js) | — |
| Moment.js + TZ | day.js + dayjs/timezone | 97% smaller |
| Select2 | Tom Select | No jQuery dep |
| Trumbowyg | Tiptap Lite | No jQuery dep |
| jQuery Jeditable | Vanilla contenteditable | Tiny, no lib needed |
| Bootswatch themes | Tailwind dark: + accent var | Simpler, more flexible |
| Gulp + Babel | Vite | Fast, modern, HMR |

### Keep
- FullCalendar 6 (restyle with Tailwind-compatible CSS)
- Flatpickr (already jQuery-free)
- Tippy.js (already jQuery-free)
- FontAwesome 6 (or consider Lucide icons)
- CookieConsent

## File Structure Changes

### New
```
src/                    # JS entry points (ES modules)
  booking.js
  backend.js
  account.js
  message.js
  lib/                  # Shared utilities (ES modules)
    http.js
    date.js
    ui.js
    ...
  pages/                # Page-specific modules
  components/           # Component modules
  http/                 # HTTP client modules
vite.config.js
tailwind.config.js
postcss.config.js
```

### Modified
```
application/views/layouts/     # Updated HTML structure + Tailwind classes
application/views/pages/       # Updated markup
application/views/components/  # Updated markup
assets/css/                    # Replaced with Tailwind input CSS
```

### Removed
```
gulpfile.js
babel.config.json
assets/vendor/                 # Vite handles this
assets/css/themes/             # Replaced by Tailwind dark mode + accent
assets/css/general.scss        # Replaced
assets/css/layouts/*.scss      # Replaced
```

## Migration Strategy

1. Set up Vite + Tailwind + PostCSS pipeline
2. Create new layout templates with Tailwind (sidebar, responsive)
3. Port shared utilities to ES modules (http, date, validation, lang)
4. Port each page one at a time (booking first, then backend pages)
5. Port components (modals, forms, tables)
6. Restyle FullCalendar to match design system
7. Remove old CSS/JS/Gulp files
8. Test all pages end-to-end
