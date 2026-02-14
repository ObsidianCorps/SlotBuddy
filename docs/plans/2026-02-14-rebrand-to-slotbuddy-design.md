# Rebrand Easy!Appointments to SlotBuddy

**Date:** 2026-02-14
**Status:** Approved

## Context

SlotBuddy is a fork of Easy!Appointments. The original repository is slow and inactive.
This design covers renaming all references from Easy!Appointments to SlotBuddy throughout
the codebase, plus creating a CLAUDE.md for the project.

## Scope

### In Scope

1. **Class/file renames:** `EA_*` → `SB_*` (25+ CodeIgniter extension classes)
2. **Brand string replacements** across all files (2,258+ occurrences)
3. **Package/config updates:** composer.json, package.json, config-sample.php, docker-compose.yml, openapi.yml
4. **Copyright headers:** Dual attribution (original + SlotBuddy contributors)
5. **Translation files:** 46+ language files
6. **CLAUDE.md creation:** Project conventions and architecture documentation

### Out of Scope

- Database table names (no prefix, keep as-is)
- CodeIgniter `system/` directory (3rd party)
- Lock file regeneration (done separately)
- Logo artwork (needs designer)

## String Replacement Order

Replacements applied longest-first to avoid partial matches:

| Find | Replace |
|------|---------|
| `Easy!Appointments - Online Appointment Scheduler` | `SlotBuddy - Online Appointment Scheduler` |
| `Easy!Appointments` | `SlotBuddy` |
| `EasyAppointments` | `SlotBuddy` |
| `easyappointments` | `slotbuddy` |
| `easy-appointments` | `slotbuddy` |
| `easyappts` | `slotbuddy` |
| `EA_` (class prefix) | `SB_` |

## Copyright Header Format

```php
/**
 * SlotBuddy - Online Appointment Scheduler
 *
 * @package     SlotBuddy
 * @author      SlotBuddy Contributors
 * @copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://github.com/ppa/SlotBuddy
 */
```

## Decisions

- **EA_ → SB_:** Full rename for clean break
- **Copyright:** Dual attribution (GPL requires preserving original)
- **DB name default:** Changed to `slotbuddy`
- **Approach:** Single comprehensive pass, not gradual
