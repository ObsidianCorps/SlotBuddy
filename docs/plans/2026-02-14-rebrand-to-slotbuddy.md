# Rebrand Easy!Appointments → SlotBuddy Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Rename all references from Easy!Appointments to SlotBuddy across the entire codebase, rename EA_* classes to SB_*, and create CLAUDE.md.

**Architecture:** Systematic find-and-replace in dependency order: structural renames first (EA_→SB_ files/classes), then brand string replacements (longest-first to avoid partial matches), then config/package updates, then CLAUDE.md creation.

**Tech Stack:** PHP/CodeIgniter 3.x, JavaScript, SCSS, Gulp, Composer, npm

---

## Task 1: Rename EA_* Core Files to SB_*

**Files:**
- Rename: All 26 files in `application/core/EA_*.php` → `application/core/SB_*.php`

**Step 1: Rename all EA_* files to SB_* files**

```bash
cd /home/ppa/projects/SlotBuddy/application/core
for f in EA_*.php; do
  git mv "$f" "SB_${f#EA_}"
done
```

**Step 2: Verify the renames**

```bash
ls /home/ppa/projects/SlotBuddy/application/core/SB_*.php | wc -l
```
Expected: 26 files

**Step 3: Commit**

```bash
git add application/core/
git commit -m "rename: EA_* core files to SB_*"
```

---

## Task 2: Update Class Names and References Inside Core Files

**Files:**
- Modify: All 26 `application/core/SB_*.php` files (class declarations)
- Modify: `application/config/config.php:232` (subclass_prefix)

**Step 1: Replace class names EA_ → SB_ inside core files**

```bash
cd /home/ppa/projects/SlotBuddy
find application/core -name 'SB_*.php' -exec sed -i 's/class EA_/class SB_/g' {} +
find application/core -name 'SB_*.php' -exec sed -i 's/EA_Controller/SB_Controller/g' {} +
find application/core -name 'SB_*.php' -exec sed -i 's/EA_Model/SB_Model/g' {} +
```

**Step 2: Update subclass_prefix in config**

In `application/config/config.php` line 232, change:
```php
$config['subclass_prefix'] = 'EA_';
```
to:
```php
$config['subclass_prefix'] = 'SB_';
```

**Step 3: Verify no EA_ class declarations remain in core**

```bash
grep -r 'class EA_' application/core/
```
Expected: No output

**Step 4: Commit**

```bash
git add application/core/ application/config/config.php
git commit -m "rename: update EA_ class names to SB_ and subclass_prefix"
```

---

## Task 3: Update All extends EA_ References

**Files:**
- Modify: ~125 files across `application/controllers/`, `application/models/`, `application/migrations/`

**Step 1: Replace extends EA_Controller with extends SB_Controller**

```bash
cd /home/ppa/projects/SlotBuddy
find application/controllers application/migrations -name '*.php' \
  -exec sed -i 's/extends EA_Controller/extends SB_Controller/g' {} +
```

**Step 2: Replace extends EA_Model with extends SB_Model**

```bash
find application/models -name '*.php' \
  -exec sed -i 's/extends EA_Model/extends SB_Model/g' {} +
```

**Step 3: Replace extends EA_Migration with extends SB_Migration**

```bash
find application/migrations -name '*.php' \
  -exec sed -i 's/extends EA_Migration/extends SB_Migration/g' {} +
```

**Step 4: Verify no extends EA_ references remain**

```bash
grep -r 'extends EA_' application/
```
Expected: No output

**Step 5: Commit**

```bash
git add application/
git commit -m "rename: update all extends EA_* to extends SB_*"
```

---

## Task 4: Replace Brand Strings (Longest First)

This replaces brand name strings across the entire codebase (excluding `system/`, `vendor/`, `node_modules/`, `.git/`, lock files, and our design doc).

**Files:**
- Modify: ~358 files across `application/`, `assets/`, `docs/`, root configs

**Step 1: Replace "Easy!Appointments - Online Appointment Scheduler"**

```bash
cd /home/ppa/projects/SlotBuddy
find . -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' -o -name '*.css' \
  -o -name '*.md' -o -name '*.yml' -o -name '*.yaml' -o -name '*.json' \
  -o -name '*.html' -o -name '*.xml' -o -name '*.txt' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  ! -path './.git/*' ! -path './docs/plans/*' \
  ! -name 'package-lock.json' ! -name 'composer.lock' \
  -exec sed -i 's/Easy!Appointments - Online Appointment Scheduler/SlotBuddy - Online Appointment Scheduler/g' {} +
```

**Step 2: Replace "Easy!Appointments"**

```bash
find . -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' -o -name '*.css' \
  -o -name '*.md' -o -name '*.yml' -o -name '*.yaml' -o -name '*.json' \
  -o -name '*.html' -o -name '*.xml' -o -name '*.txt' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  ! -path './.git/*' ! -path './docs/plans/*' \
  ! -name 'package-lock.json' ! -name 'composer.lock' \
  -exec sed -i 's/Easy!Appointments/SlotBuddy/g' {} +
```

**Step 3: Replace "EasyAppointments" (PascalCase)**

```bash
find . -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' -o -name '*.css' \
  -o -name '*.md' -o -name '*.yml' -o -name '*.yaml' -o -name '*.json' \
  -o -name '*.html' -o -name '*.xml' -o -name '*.txt' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  ! -path './.git/*' ! -path './docs/plans/*' \
  ! -name 'package-lock.json' ! -name 'composer.lock' \
  -exec sed -i 's/EasyAppointments/SlotBuddy/g' {} +
```

**Step 4: Replace "easyappointments" (lowercase)**

```bash
find . -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' -o -name '*.css' \
  -o -name '*.md' -o -name '*.yml' -o -name '*.yaml' -o -name '*.json' \
  -o -name '*.html' -o -name '*.xml' -o -name '*.txt' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  ! -path './.git/*' ! -path './docs/plans/*' \
  ! -name 'package-lock.json' ! -name 'composer.lock' \
  -exec sed -i 's/easyappointments/slotbuddy/g' {} +
```

**Step 5: Replace "easy-appointments"**

```bash
find . -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' -o -name '*.css' \
  -o -name '*.md' -o -name '*.yml' -o -name '*.yaml' -o -name '*.json' \
  -o -name '*.html' -o -name '*.xml' -o -name '*.txt' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  ! -path './.git/*' ! -path './docs/plans/*' \
  ! -name 'package-lock.json' ! -name 'composer.lock' \
  -exec sed -i 's/easy-appointments/slotbuddy/g' {} +
```

**Step 6: Replace "easyappts" (social media handles)**

```bash
find . -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' -o -name '*.css' \
  -o -name '*.md' -o -name '*.yml' -o -name '*.yaml' -o -name '*.json' \
  -o -name '*.html' -o -name '*.xml' -o -name '*.txt' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  ! -path './.git/*' ! -path './docs/plans/*' \
  ! -name 'package-lock.json' ! -name 'composer.lock' \
  -exec sed -i 's/easyappts/slotbuddy/g' {} +
```

**Step 7: Verify no old brand names remain (excluding system/vendor/git/plans)**

```bash
grep -r --include='*.php' --include='*.js' --include='*.scss' --include='*.md' \
  --include='*.yml' --include='*.json' \
  -l 'Easy!Appointments\|EasyAppointments\|easyappointments\|easy-appointments\|easyappts' \
  --exclude-dir=system --exclude-dir=vendor --exclude-dir=node_modules \
  --exclude-dir=.git --exclude-dir=plans \
  --exclude='package-lock.json' --exclude='composer.lock' .
```
Expected: No output (or only the design doc)

**Step 8: Commit**

```bash
git add -A
git commit -m "rename: replace all Easy!Appointments brand strings with SlotBuddy"
```

---

## Task 5: Update Copyright Headers

**Files:**
- Modify: All PHP files in `application/`, JS files in `assets/js/`, SCSS files in `assets/css/`

The brand string replacements in Task 4 already handle most of the header. This task handles the remaining author/link lines that weren't caught.

**Step 1: Update @author lines**

```bash
cd /home/ppa/projects/SlotBuddy
find application assets -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  -exec sed -i 's/@author      A\.Tselegidis <alextselegidis@gmail\.com>/@author      SlotBuddy Contributors/g' {} +
```

**Step 2: Update @copyright lines**

```bash
find application assets -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  -exec sed -i 's/@copyright   Copyright (c) Alex Tselegidis/@copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors/g' {} +
```

**Step 3: Update @link lines**

```bash
find application assets -type f \( -name '*.php' -o -name '*.js' -o -name '*.scss' \) \
  ! -path './system/*' ! -path './vendor/*' ! -path './node_modules/*' \
  -exec sed -i 's|@link        https://slotbuddy.org|@link        https://github.com/ppa/SlotBuddy|g' {} +
```

**Step 4: Verify headers look correct**

```bash
head -15 application/core/SB_Controller.php
head -15 assets/js/pages/booking.js
```
Expected: Updated header with SlotBuddy branding

**Step 5: Commit**

```bash
git add application/ assets/
git commit -m "rename: update copyright headers to SlotBuddy Contributors"
```

---

## Task 6: Update Package and Config Files

**Files:**
- Modify: `composer.json`
- Modify: `package.json`
- Modify: `docker-compose.yml`
- Modify: `config-sample.php`
- Modify: `openapi.yml`

Most brand strings were already replaced by Task 4. This task handles structural changes.

**Step 1: Update composer.json name and support URLs**

Change `"name": "alextselegidis/slotbuddy"` to `"name": "slotbuddy/slotbuddy"`.
Update author block to include SlotBuddy. Update support URLs to point to the new GitHub repo.

**Step 2: Update package.json**

Update author, repository URL, and bugs URL to point to the SlotBuddy repo.

**Step 3: Verify config-sample.php DB_NAME**

Check that Task 4 already changed `DB_NAME = 'easyappointments'` to `DB_NAME = 'slotbuddy'`.

**Step 4: Verify docker-compose.yml**

Check that `MYSQL_DATABASE=easyappointments` was changed to `MYSQL_DATABASE=slotbuddy`.

**Step 5: Commit**

```bash
git add composer.json package.json docker-compose.yml config-sample.php openapi.yml
git commit -m "rename: update package configs for SlotBuddy"
```

---

## Task 7: Handle Remaining EA_ References in Non-Core Files

After Tasks 1-4, there may be remaining `EA_` references in doc comments, strings, or non-standard locations.

**Step 1: Search for remaining EA_ references (excluding system/vendor)**

```bash
grep -rn 'EA_' --include='*.php' --include='*.js' --include='*.md' \
  --exclude-dir=system --exclude-dir=vendor --exclude-dir=node_modules \
  --exclude-dir=.git .
```

**Step 2: Replace remaining @package EasyAppointments → @package SlotBuddy** (already handled by Task 4)

**Step 3: Replace any remaining EA_ that should be SB_**

Only replace `EA_` when it's a class prefix reference (not arbitrary text containing "EA_"). Review the grep output and replace case by case.

**Step 4: Commit**

```bash
git add -A
git commit -m "rename: clean up remaining EA_ references"
```

---

## Task 8: Verify the Rename Is Complete

**Step 1: Run comprehensive search for any remaining old branding**

```bash
# Search for old branding (should return 0 results outside system/vendor/plans)
grep -rn --include='*.php' --include='*.js' --include='*.scss' --include='*.json' \
  --include='*.yml' --include='*.md' \
  --exclude-dir=system --exclude-dir=vendor --exclude-dir=node_modules \
  --exclude-dir=.git --exclude-dir=plans \
  --exclude='package-lock.json' --exclude='composer.lock' \
  -E 'Easy!Appointments|easyappointments|alextselegidis' .
```

**Step 2: Run existing tests to check for breakage**

```bash
cd /home/ppa/projects/SlotBuddy
composer test
```

**Step 3: If tests fail, fix issues before proceeding**

Review failures — most likely from class name mismatches or missed references.

---

## Task 9: Create CLAUDE.md

**Files:**
- Create: `/home/ppa/projects/SlotBuddy/CLAUDE.md`

**Step 1: Write CLAUDE.md**

Create `/home/ppa/projects/SlotBuddy/CLAUDE.md` with the following content describing:

- Project overview (SlotBuddy, fork of Easy!Appointments, PHP/CodeIgniter 3.x)
- Tech stack details (PHP 8.1+, CodeIgniter 3.x, MySQL, Bootstrap 5, FullCalendar 6, Gulp)
- Directory structure overview
- Key conventions:
  - SB_* prefix for CodeIgniter extension classes in `application/core/`
  - Controllers extend SB_Controller, Models extend SB_Model
  - Migrations extend SB_Migration and are numbered sequentially (060 is latest)
  - Language files in `application/language/<locale>/translations_lang.php`
  - Frontend JS in `assets/js/`, SCSS in `assets/css/`
  - Build with `npm run build`, dev with `npm start`
  - Tests with `composer test` (PHPUnit)
- Development workflow
- Important file paths
- Testing instructions
- Copyright header format for new files

**Step 2: Commit**

```bash
git add CLAUDE.md
git commit -m "docs: add CLAUDE.md for SlotBuddy project"
```

---

## Task 10: Final Commit Summary

**Step 1: Review git log**

```bash
git log --oneline -10
```

**Step 2: Verify clean working tree**

```bash
git status
```

Expected: Clean working tree with all changes committed.
