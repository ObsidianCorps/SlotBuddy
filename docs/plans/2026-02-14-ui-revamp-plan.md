# UI/UX Revamp Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Replace the Bootstrap + jQuery + Gulp frontend with Tailwind CSS + Vanilla JS + Vite, redesigning all views with a modern cal.com-inspired aesthetic including dark mode and collapsible sidebar navigation.

**Architecture:** Keep PHP/CodeIgniter views as the templating engine. Replace the CSS framework (Bootstrap -> Tailwind), JS approach (jQuery IIFEs -> Vanilla ES modules), and build tool (Gulp -> Vite). Each layout gets a Vite entry point. PHP helper resolves Vite assets for dev (HMR proxy) and prod (manifest.json).

**Tech Stack:** PHP 8.1+/CodeIgniter 3.x, Vite 5, Tailwind CSS 3.4, PostCSS, day.js, Tom Select, FullCalendar 6, Flatpickr, Tippy.js, Lucide Icons

---

## Task 1: Set Up Vite + Tailwind + PostCSS Build Pipeline

**Files:**
- Create: `vite.config.js`
- Create: `tailwind.config.js`
- Create: `postcss.config.js`
- Create: `src/css/app.css` (Tailwind directives)
- Create: `src/backend.js` (entry point stub)
- Create: `src/booking.js` (entry point stub)
- Create: `src/account.js` (entry point stub)
- Create: `src/message.js` (entry point stub)
- Modify: `package.json` (update dependencies and scripts)

**Step 1: Install new dependencies**

```bash
npm install --save tailwindcss@^3.4 postcss autoprefixer \
  vite@^5 dayjs tom-select lucide

npm install --save-dev @tailwindcss/forms @tailwindcss/typography
```

Remove old dependencies:
```bash
npm uninstall bootstrap @popperjs/core jquery jquery-jeditable \
  moment moment-timezone select2 trumbowyg cookieconsent \
  @fullcalendar/moment gulp gulp-babel gulp-cached gulp-changed \
  gulp-clean-css gulp-debug gulp-plumber gulp-rename gulp-sass \
  sass @babel/core @babel/preset-env babel-preset-minify \
  del fs-extra zip-dir
```

Keep: `fullcalendar flatpickr tippy.js @fortawesome/fontawesome-free`

**Step 2: Create `tailwind.config.js`**

```js
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './application/views/**/*.php',
    './src/**/*.{js,ts}',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        accent: {
          DEFAULT: 'var(--accent, #6366f1)',
          50: 'var(--accent-50, #eef2ff)',
          100: 'var(--accent-100, #e0e7ff)',
          500: 'var(--accent, #6366f1)',
          600: 'var(--accent-600, #4f46e5)',
          700: 'var(--accent-700, #4338ca)',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
```

**Step 3: Create `postcss.config.js`**

```js
export default {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
}
```

**Step 4: Create `vite.config.js`**

```js
import { defineConfig } from 'vite'
import { resolve } from 'path'

export default defineConfig({
  build: {
    outDir: 'assets/build',
    manifest: true,
    rollupOptions: {
      input: {
        backend: resolve(__dirname, 'src/backend.js'),
        booking: resolve(__dirname, 'src/booking.js'),
        account: resolve(__dirname, 'src/account.js'),
        message: resolve(__dirname, 'src/message.js'),
      },
    },
  },
  server: {
    origin: 'http://localhost:5173',
  },
})
```

**Step 5: Create `src/css/app.css`**

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

@layer base {
  :root {
    --accent: #6366f1;
    --accent-50: #eef2ff;
    --accent-100: #e0e7ff;
    --accent-600: #4f46e5;
    --accent-700: #4338ca;
  }

  body {
    @apply font-sans text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-950 antialiased;
  }
}

@layer components {
    .sb-input {
        @apply block w-full rounded-lg border border-gray-300 dark:border-gray-600
               bg-white dark:bg-gray-800 px-3 py-2 text-sm
               text-gray-900 dark:text-gray-100
               placeholder-gray-400 dark:placeholder-gray-500
               focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent
               transition-colors;
    }

    .sb-btn-primary {
        @apply inline-flex items-center justify-center rounded-lg px-4 py-2.5
               text-sm font-medium text-white
               bg-accent hover:bg-accent-600 active:bg-accent-700
               focus:outline-none focus:ring-2 focus:ring-accent/50
               transition-colors disabled:opacity-50 disabled:cursor-not-allowed;
    }

    .sb-btn-secondary {
        @apply inline-flex items-center justify-center rounded-lg px-4 py-2.5
               text-sm font-medium
               text-gray-700 dark:text-gray-200
               border border-gray-300 dark:border-gray-600
               bg-white dark:bg-gray-800
               hover:bg-gray-50 dark:hover:bg-gray-700
               focus:outline-none focus:ring-2 focus:ring-accent/50
               transition-colors;
    }

    .sb-btn-ghost {
        @apply inline-flex items-center justify-center rounded-lg px-4 py-2.5
               text-sm font-medium
               text-gray-600 dark:text-gray-300
               hover:bg-gray-100 dark:hover:bg-gray-800
               focus:outline-none focus:ring-2 focus:ring-accent/50
               transition-colors;
    }

    .sb-btn-danger {
        @apply inline-flex items-center justify-center rounded-lg px-4 py-2.5
               text-sm font-medium text-white
               bg-red-500 hover:bg-red-600 active:bg-red-700
               focus:outline-none focus:ring-2 focus:ring-red-500/50
               transition-colors;
    }

    .sb-card {
        @apply bg-white dark:bg-gray-900 rounded-xl shadow-sm
               border border-gray-200 dark:border-gray-800;
    }

    .sb-label {
        @apply block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1;
    }

    .sb-nav-item {
        @apply flex items-center gap-3 px-3 py-2 rounded-lg text-sm
               text-gray-600 dark:text-gray-400
               hover:bg-gray-100 dark:hover:bg-gray-800
               hover:text-gray-900 dark:hover:text-white
               transition-colors cursor-pointer;
    }

    .sb-nav-active {
        @apply bg-accent/10 text-accent dark:text-accent
               border-l-2 border-accent;
    }

    /* Hide labels when sidebar is collapsed */
    .sidebar-collapsed .sidebar-label {
        @apply hidden;
    }
}
```

**Step 6: Create entry point stubs**

`src/backend.js`:
```js
import './css/app.css'
import { initDarkMode, toggleDarkMode } from './lib/dark-mode.js'

initDarkMode()
document.getElementById('dark-mode-toggle')?.addEventListener('click', toggleDarkMode)
```

`src/booking.js`:
```js
import './css/app.css'
import { initDarkMode } from './lib/dark-mode.js'
initDarkMode()
```

`src/account.js`:
```js
import './css/app.css'
import { initDarkMode } from './lib/dark-mode.js'
initDarkMode()
```

`src/message.js`:
```js
import './css/app.css'
import { initDarkMode } from './lib/dark-mode.js'
initDarkMode()
```

**Step 7: Update `package.json` scripts**

```json
{
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  }
}
```

**Step 8: Delete old build files**

```bash
rm -f gulpfile.js babel.config.json
```

**Step 9: Test the build**

```bash
npm run build
```
Expected: `assets/build/` directory created with manifest.json and compiled JS/CSS chunks.

**Step 10: Commit**

```bash
git add vite.config.js tailwind.config.js postcss.config.js \
  src/ package.json package-lock.json
git rm gulpfile.js babel.config.json
git commit -m "build: replace Gulp+Bootstrap+SCSS with Vite+Tailwind+PostCSS"
```

---

## Task 2: Create Vite-PHP Asset Helper

**Files:**
- Create: `application/helpers/vite_helper.php`
- Modify: `application/config/autoload.php` (autoload the helper)

**Step 1: Create `application/helpers/vite_helper.php`**

```php
<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Output Vite asset tags for a given entry point.
 *
 * In development: connects to Vite dev server (HMR).
 * In production: reads manifest.json for hashed filenames.
 *
 * @param string $entry Entry point name (e.g., 'src/backend.js')
 */
function vite_assets(string $entry): string
{
    $dev_server = 'http://localhost:5173';
    $manifest_path = FCPATH . 'assets/build/.vite/manifest.json';

    // Development mode: use Vite dev server
    if (config('debug'))
    {
        $context = stream_context_create(['http' => ['timeout' => 1]]);
        $check = @file_get_contents($dev_server . '/@vite/client', false, $context);

        if ($check !== false)
        {
            return '<script type="module" src="' . $dev_server . '/@vite/client"></script>' . PHP_EOL
                 . '<script type="module" src="' . $dev_server . '/' . $entry . '"></script>' . PHP_EOL;
        }
    }

    // Production mode: read manifest
    if ( ! file_exists($manifest_path))
    {
        return '<!-- Vite manifest not found. Run: npm run build -->';
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);

    if ( ! isset($manifest[$entry]))
    {
        return '<!-- Vite entry not found: ' . htmlspecialchars($entry) . ' -->';
    }

    $asset = $manifest[$entry];
    $base_url = base_url('assets/build/');
    $html = '';

    // CSS files
    if ( ! empty($asset['css']))
    {
        foreach ($asset['css'] as $css_file)
        {
            $html .= '<link rel="stylesheet" href="' . $base_url . $css_file . '">' . PHP_EOL;
        }
    }

    // JS file
    if ( ! empty($asset['file']))
    {
        $html .= '<script type="module" src="' . $base_url . $asset['file'] . '"></script>' . PHP_EOL;
    }

    return $html;
}
```

**Step 2: Autoload the helper**

In `application/config/autoload.php`, add `'vite'` to the helpers array.

**Step 3: Commit**

```bash
git add application/helpers/vite_helper.php application/config/autoload.php
git commit -m "feat: add Vite-PHP asset integration helper"
```

---

## Task 3: Port Shared JS Utilities to ES Modules

**Files:**
- Create: `src/lib/vars.js` (bridge to PHP vars)
- Create: `src/lib/url.js` (from `assets/js/utils/url.js`)
- Create: `src/lib/http.js` (from `assets/js/utils/http.js`)
- Create: `src/lib/date.js` (day.js wrapper, replaces moment.js)
- Create: `src/lib/validation.js` (from `assets/js/utils/validation.js`)
- Create: `src/lib/message.js` (toast/modal notifications)
- Create: `src/lib/string.js` (from `assets/js/utils/string.js`)
- Create: `src/lib/file.js` (from `assets/js/utils/file.js`)
- Create: `src/lib/dark-mode.js` (new)
- Create: `src/lib/sidebar.js` (new)

**Approach:** Convert each IIFE module from `window.App.Utils.X = (function() { ... })()` to standard ES module exports. Replace jQuery calls with vanilla JS. Replace Moment.js with day.js.

**Step 1: Create `src/lib/vars.js`**

```js
export function vars(key) {
    return window.__slotbuddy_vars?.[key] ?? null
}

export function lang(key) {
    return window.__slotbuddy_lang?.[key] ?? key
}
```

**Step 2: Create `src/lib/url.js`**

```js
import { vars } from './vars.js'

export function siteUrl(uri = '') {
    const baseUrl = vars('base_url') || '/'
    return baseUrl.replace(/\/$/, '') + '/' + uri.replace(/^\//, '')
}
```

**Step 3: Create `src/lib/http.js`**

```js
import { siteUrl } from './url.js'

export function request(method, url, data) {
    return fetch(siteUrl(url), {
        method,
        mode: 'cors',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/json' },
        redirect: 'follow',
        body: data ? JSON.stringify(data) : undefined,
    }).then(async (response) => {
        if (!response.ok) {
            const message = await response.text()
            const error = new Error(message)
            error.status = response.status
            throw error
        }
        return response.json()
    })
}

export function upload(method, url, file) {
    const formData = new FormData()
    formData.append('file', file, file.name)
    return fetch(siteUrl(url), {
        method,
        redirect: 'follow',
        body: formData,
    }).then(async (response) => {
        if (!response.ok) {
            const message = await response.text()
            const error = new Error(message)
            error.status = response.status
            throw error
        }
        return response.json()
    })
}

export function download(method, url) {
    return fetch(siteUrl(url), {
        method,
        mode: 'cors',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/json' },
        redirect: 'follow',
    }).then(async (response) => {
        if (!response.ok) {
            const message = await response.text()
            const error = new Error(message)
            error.status = response.status
            throw error
        }
        return response.arrayBuffer()
    })
}
```

**Step 4: Create `src/lib/date.js`**

```js
import dayjs from 'dayjs'
import utc from 'dayjs/plugin/utc'
import timezone from 'dayjs/plugin/timezone'
import customParseFormat from 'dayjs/plugin/customParseFormat'

dayjs.extend(utc)
dayjs.extend(timezone)
dayjs.extend(customParseFormat)

export { dayjs }

export function formatDate(date, format = 'YYYY-MM-DD') {
    return dayjs(date).format(format)
}

export function formatTime(date, format = 'HH:mm') {
    return dayjs(date).format(format)
}

export function toTimezone(date, tz) {
    return dayjs(date).tz(tz)
}
```

**Step 5: Create `src/lib/validation.js`**

```js
export function isEmailValid(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return re.test(email)
}

export function isPhoneValid(phone) {
    const re = /^[+]?[\d\s\-().]{7,20}$/
    return re.test(phone)
}

export function isRequired(value) {
    return value !== null && value !== undefined && String(value).trim() !== ''
}
```

**Step 6: Create `src/lib/message.js`**

```js
export function toast(message, type = 'info', duration = 4000) {
    const colors = {
        info: 'bg-blue-500',
        success: 'bg-green-500',
        warning: 'bg-amber-500',
        error: 'bg-red-500',
    }

    const el = document.createElement('div')
    el.className = [
        'fixed top-4 right-4 z-50 px-4 py-3 rounded-lg text-white shadow-lg',
        'transition-all duration-300',
        colors[type] || colors.info,
    ].join(' ')
    el.textContent = message
    document.body.appendChild(el)

    setTimeout(() => {
        el.classList.add('opacity-0', 'translate-x-4')
        setTimeout(() => el.remove(), 300)
    }, duration)
}

export function confirm(title, body, onConfirm) {
    const backdrop = document.createElement('div')
    backdrop.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm'

    const card = document.createElement('div')
    card.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full mx-4 p-6'

    const heading = document.createElement('h3')
    heading.className = 'text-lg font-semibold text-gray-900 dark:text-white mb-2'
    heading.textContent = title

    const content = document.createElement('div')
    content.className = 'text-gray-600 dark:text-gray-300 mb-6'
    content.textContent = body

    const actions = document.createElement('div')
    actions.className = 'flex justify-end gap-3'

    const cancelBtn = document.createElement('button')
    cancelBtn.className = 'sb-btn-secondary'
    cancelBtn.textContent = 'Cancel'
    cancelBtn.addEventListener('click', () => backdrop.remove())

    const confirmBtn = document.createElement('button')
    confirmBtn.className = 'sb-btn-primary'
    confirmBtn.textContent = 'OK'
    confirmBtn.addEventListener('click', () => {
        onConfirm?.()
        backdrop.remove()
    })

    actions.append(cancelBtn, confirmBtn)
    card.append(heading, content, actions)
    backdrop.appendChild(card)
    backdrop.addEventListener('click', (e) => {
        if (e.target === backdrop) backdrop.remove()
    })

    document.body.appendChild(backdrop)
}
```

**Step 7: Create `src/lib/dark-mode.js`**

```js
export function initDarkMode() {
    const stored = localStorage.getItem('sb-dark-mode')
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
    if (stored === 'dark' || (stored === null && prefersDark)) {
        document.documentElement.classList.add('dark')
    }
}

export function toggleDarkMode() {
    const isDark = document.documentElement.classList.toggle('dark')
    localStorage.setItem('sb-dark-mode', isDark ? 'dark' : 'light')
}
```

**Step 8: Create `src/lib/sidebar.js`**

```js
export function initSidebar() {
    const sidebar = document.getElementById('sidebar')
    const toggle = document.getElementById('sidebar-toggle')
    const mobileToggle = document.getElementById('mobile-sidebar-toggle')
    const overlay = document.getElementById('sidebar-overlay')

    toggle?.addEventListener('click', () => {
        sidebar.classList.toggle('w-64')
        sidebar.classList.toggle('w-16')
        sidebar.classList.toggle('sidebar-collapsed')
        localStorage.setItem('sb-sidebar',
            sidebar.classList.contains('sidebar-collapsed') ? 'collapsed' : 'expanded')
    })

    mobileToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full')
        overlay?.classList.toggle('hidden')
    })

    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full')
        overlay.classList.add('hidden')
    })

    if (localStorage.getItem('sb-sidebar') === 'collapsed') {
        sidebar?.classList.remove('w-64')
        sidebar?.classList.add('w-16', 'sidebar-collapsed')
    }
}
```

**Step 9: Commit**

```bash
git add src/lib/
git commit -m "feat: port shared JS utilities to ES modules"
```

---

## Task 4: Update PHP Components for New JS Globals

**Files:**
- Modify: `application/views/components/js_vars_script.php`
- Modify: `application/views/components/js_lang_script.php`

**Step 1: Update `js_vars_script.php`**

Change to output `window.__slotbuddy_vars` so the new ES modules can read them via `src/lib/vars.js`.

**Step 2: Update `js_lang_script.php`**

Change to output `window.__slotbuddy_lang`.

**Step 3: Commit**

```bash
git add application/views/components/
git commit -m "feat: update PHP var/lang components for new JS globals"
```

---

## Task 5: Rewrite Account Layout + Login Page

**Files:**
- Modify: `application/views/layouts/account_layout.php`
- Modify: `application/views/pages/login.php`
- Modify: `application/views/pages/recovery.php`

The simplest layout. Establishes the Tailwind + Vite pattern.

**Step 1: Rewrite `account_layout.php` with Tailwind + Vite**

Replace all Bootstrap classes and vendor script tags. Use `vite_assets('src/account.js')` instead of individual vendor/script tags.

**Step 2: Rewrite `login.php` with Tailwind classes**

Centered card, clean inputs with `sb-input`, `sb-btn-primary`, `sb-card` classes.
Replace jQuery form submission with vanilla JS using imported `request()` from `src/lib/http.js`.

**Step 3: Rewrite `recovery.php` similarly**

**Step 4: Commit**

```bash
git add application/views/
git commit -m "feat: rewrite account layout and login with Tailwind"
```

---

## Task 6: Rewrite Backend Layout with Sidebar

**Files:**
- Modify: `application/views/layouts/backend_layout.php`
- Create: `application/views/components/backend_sidebar.php`
- Modify: `application/views/components/backend_footer.php`
- Update: `src/backend.js`

**Step 1: Create `backend_sidebar.php`**

Collapsible left sidebar with sections: Calendar, Customers, Services (services + categories), Users (providers + secretaries + admins), Settings. Dark mode toggle and user info at bottom.

**Step 2: Rewrite `backend_layout.php`**

Replace Bootstrap layout with: mobile header bar + sidebar overlay + sidebar component + main content area with `lg:pl-64` offset. Use `vite_assets('src/backend.js')`.

**Step 3: Update `src/backend.js`**

Import sidebar init and dark mode toggle.

**Step 4: Commit**

```bash
git add application/views/ src/
git commit -m "feat: rewrite backend layout with collapsible sidebar"
```

---

## Task 7: Rewrite Booking Page (Cal.com-Inspired)

**Files:**
- Modify: `application/views/layouts/booking_layout.php`
- Modify: `application/views/pages/booking.php`
- Modify: booking step components (type, time, info, final)
- Create: `src/pages/booking.js`
- Create: `src/http/booking-http-client.js`

**Step 1: Rewrite `booking_layout.php`**

Minimal centered layout with `vite_assets('src/booking.js')`.

**Step 2: Redesign booking page**

Cal.com-inspired split-panel:
- Left: company info, service details
- Right: date picker + time slot grid, then customer form, then confirmation
- Single-page flow (no numbered step circles)
- Responsive: stacks vertically on mobile

**Step 3: Port `assets/js/pages/booking.js` to `src/pages/booking.js`**

Convert 982-line jQuery module to vanilla ES module:
- `$('#el')` -> `document.getElementById('el')`
- `moment()` -> `dayjs()`
- `$.post()` -> `request('POST', ...)`

**Step 4: Port booking HTTP client to ES module**

**Step 5: Commit**

```bash
git add application/views/ src/
git commit -m "feat: rewrite booking page with cal.com-inspired design"
```

---

## Task 8: Rewrite Calendar Page

**Files:**
- Modify: `application/views/pages/calendar.php`
- Create: `src/pages/calendar.js`
- Create: `src/css/fullcalendar-overrides.css`

**Step 1: Restyle calendar page with Tailwind**

Modern toolbar with segmented Day/Week/Month control. Clean filter bar.

**Step 2: Create FullCalendar CSS overrides**

Match FullCalendar colors, fonts, borders to design system tokens.

**Step 3: Port calendar JS to ES modules**

Convert calendar page, event popover, table view, sync utilities.

**Step 4: Commit**

```bash
git commit -m "feat: restyle calendar page and FullCalendar"
```

---

## Task 9: Rewrite CRUD Pages (Customers, Services, Providers, etc.)

**Files:**
- Modify: customers, services, service_categories, providers, secretaries, admins, blocked_periods, webhooks page views
- Create: corresponding `src/pages/*.js` and `src/http/*-http-client.js` ES modules

**Pattern for all CRUD pages:**
- `sb-card` container with header (title + "Add New" button)
- Search/filter bar
- Clean table with hover states
- Modal or slide-over for create/edit
- Replace Select2 with Tom Select
- Replace jQuery with vanilla JS

Convert one page (customers) as the template, then replicate for the rest.

**Commit after each page or related group.**

---

## Task 10: Rewrite Settings Pages

**Files:**
- Modify: general_settings, business_settings, booking_settings, legal_settings, api_settings, google_analytics_settings, matomo_analytics_settings, ldap_settings, integrations page views
- Modify: `application/views/components/settings_nav.php`

**Design:** Vertical tab navigation within content area. Clean forms with `sb-input`, `sb-label`, `sb-btn-*` classes.

**Commit after settings group.**

---

## Task 11: Rewrite Modals

**Files:**
- Modify: appointments_modal, unavailabilities_modal, working_plan_exceptions_modal, cookie_notice_modal, terms_and_conditions_modal, privacy_policy_modal
- Create: `src/components/modal.js` (vanilla modal open/close controller)

**Pattern:** Replace Bootstrap modal markup with vanilla overlay + `sb-card`. Use `data-modal-target` attributes and vanilla JS for open/close.

**Commit after modals.**

---

## Task 12: Rewrite Remaining Pages

**Files:**
- Modify: message_layout, recovery, account, about, installation, update, privacy pages

Follow established patterns. Simple pages.

**Commit per group.**

---

## Task 13: Update Company Color Component

**Files:**
- Modify: `application/views/components/company_color_style.php`

Set CSS custom properties `--accent`, `--accent-50`, `--accent-600`, `--accent-700` from the company_color setting.

**Commit.**

---

## Task 14: Remove Old Frontend Files

**Files:**
- Delete: `assets/vendor/` directory
- Delete: `assets/css/` directory (themes, general, layouts, pages, components SCSS)
- Delete: `assets/js/` directory (old jQuery code)
- Update: `.gitignore` (add `assets/build/`, `node_modules/`)

```bash
git rm -r assets/vendor/ assets/css/ assets/js/
git commit -m "chore: remove old Bootstrap/jQuery/Gulp frontend files"
```

---

## Task 15: Final Verification

**Step 1: Build production assets**

```bash
npm run build
```

**Step 2: PHP syntax check**

```bash
find application -name '*.php' -exec php -l {} \; 2>&1 | grep -v 'No syntax errors'
```

**Step 3: Verify all routes render (manual check or curl)**

- `/` (booking), `/login`, `/calendar`, `/customers`, `/services`
- `/providers`, `/general_settings`, `/installation`

**Step 4: Fix any issues and commit**
