# SlotBuddy

Online appointment scheduling system. Fork of Easy!Appointments, rebranded and actively maintained.

## Tech Stack

- **Backend:** PHP 8.1+, CodeIgniter 3.x
- **Database:** MySQL 8.0 (default, also supports PostgreSQL/SQLite via CI drivers)
- **Frontend:** JavaScript (vanilla + jQuery), Bootstrap 5.3, FullCalendar 6, SCSS
- **Build:** Gulp, Babel, npm
- **Testing:** PHPUnit 9.6

## Project Structure

```
application/
  config/         # CI config (app.php has version, config.php has subclass_prefix)
  controllers/    # Route controllers (PascalCase)
  controllers/api/v1/  # REST API controllers (*_api_v1.php)
  core/           # SB_* CodeIgniter class extensions
  helpers/        # Helper functions (*_helper.php)
  language/       # 46 language translation dirs
  libraries/      # Service classes (Notifications, Google_sync, etc.)
  migrations/     # Sequential numbered migrations (001-060)
  models/         # Database models (*_model.php, extend SB_Model)
  views/          # PHP templates (layouts/, pages/, components/, emails/)
assets/
  css/            # SCSS source files (themes/, layouts/, pages/)
  img/            # Images, logos, favicon
  js/             # JavaScript (pages/, http/, utils/, layouts/, components/)
docker/           # Docker config (php-fpm, nginx, mysql, etc.)
docs/             # Documentation markdown files
system/           # CodeIgniter framework (DO NOT MODIFY)
```

## Key Conventions

### Class Prefixes
- Framework extensions use `SB_` prefix: `SB_Controller`, `SB_Model`, `SB_Migration`
- Config: `$config['subclass_prefix'] = 'SB_';` in `application/config/config.php`

### Inheritance
- Controllers extend `SB_Controller`
- Models extend `SB_Model`
- Migrations extend `SB_Migration`

### Naming
- Controllers: PascalCase (`Booking.php`, `Backend_api.php`)
- Models: `*_model.php` (e.g., `Appointments_model.php`)
- Helpers: `*_helper.php`
- API controllers: `*_api_v1.php`
- Migrations: `NNN_description.php` (latest: 060)

### Routes
- Default controller: `booking`
- API: `api/v1/{resource}` (RESTful, defined in `application/config/routes.php`)
- API resources: appointments, admins, customers, providers, secretaries, services, service_categories, unavailabilities, webhooks, blocked_periods, settings, availabilities

## Development

```bash
npm install          # Install frontend dependencies
composer install     # Install PHP dependencies
npm start            # Watch + compile (Gulp dev server)
npm run build        # Production build
composer test        # Run PHPUnit tests (APP_ENV=testing)
```

### Docker
```bash
docker-compose up -d  # Starts php-fpm, nginx, mysql, phpmyadmin, mailpit, swagger-ui
```
- App: http://localhost
- phpMyAdmin: http://localhost:8080
- Mailpit: http://localhost:8025
- Swagger: http://localhost:8000
- Default DB: `slotbuddy`, user: `user`, password: `password`

## Configuration

Copy `config-sample.php` to `config.php` and set:
- `BASE_URL` — your installation URL
- `DB_HOST`, `DB_NAME`, `DB_USERNAME`, `DB_PASSWORD`
- `GOOGLE_SYNC_FEATURE`, `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET` (optional)

## Copyright Headers for New Files

```php
/* ----------------------------------------------------------------------------
 * SlotBuddy - Online Appointment Scheduler
 *
 * @package     SlotBuddy
 * @author      SlotBuddy Contributors
 * @copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://github.com/ppa/SlotBuddy
 * @since       v1.5.2
 * ---------------------------------------------------------------------------- */
```

## Important Notes

- `system/` directory is the CodeIgniter framework — never modify it directly
- Database tables have no prefix (direct names: `appointments`, `users`, `services`, etc.)
- Version is in `application/config/app.php` (`$config['version']`)
- Translations: one file per language at `application/language/{locale}/translations_lang.php`
- Lock files (`composer.lock`, `package-lock.json`) still reference old package names — regenerate with `composer install` and `npm install`
