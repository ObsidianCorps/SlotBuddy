<?php
/**
 * @var string $company_color
 */

/**
 * Generate a lighter shade of a hex color by mixing with white.
 */
function color_shade(string $hex, float $percent): string
{
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    if ($percent > 0) {
        // Lighten (mix with white)
        $r = round($r + (255 - $r) * $percent);
        $g = round($g + (255 - $g) * $percent);
        $b = round($b + (255 - $b) * $percent);
    } else {
        // Darken (mix with black)
        $factor = 1 + $percent;
        $r = round($r * $factor);
        $g = round($g * $factor);
        $b = round($b * $factor);
    }

    return sprintf('#%02x%02x%02x', max(0, min(255, $r)), max(0, min(255, $g)), max(0, min(255, $b)));
}
?>

<?php if (!empty($company_color) && $company_color !== DEFAULT_COMPANY_COLOR): ?>
    <style>
        :root {
            --accent: <?= $company_color ?>;
            --accent-50: <?= color_shade($company_color, 0.9) ?>;
            --accent-100: <?= color_shade($company_color, 0.8) ?>;
            --accent-600: <?= color_shade($company_color, -0.1) ?>;
            --accent-700: <?= color_shade($company_color, -0.2) ?>;
        }

        /* Flatpickr overrides */
        .flatpickr-calendar .flatpickr-months,
        .flatpickr-calendar .flatpickr-months .flatpickr-month,
        .flatpickr-calendar .flatpickr-weekdays,
        .flatpickr-calendar .flatpickr-current-month .flatpickr-monthDropdown-months,
        .flatpickr-calendar span.flatpickr-weekday {
            background: var(--accent) !important;
            color: white !important;
        }

        .flatpickr-day.selected,
        .flatpickr-day.selected:hover,
        .flatpickr-day.selected:focus,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange {
            background: var(--accent) !important;
            border-color: var(--accent) !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month {
            background-color: var(--accent) !important;
        }

        /* FullCalendar event color */
        .fc-daygrid-event {
            color: rgb(51, 51, 51) !important;
        }

        /* Legacy Bootstrap compat (remove when fully migrated) */
        .btn-primary {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary:focus {
            background-color: var(--accent-600);
            border-color: var(--accent-600);
        }

        .form-control:focus {
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 2px color-mix(in srgb, var(--accent) 25%, transparent);
        }

        .form-check-input:checked {
            background-color: var(--accent) !important;
            border-color: var(--accent) !important;
        }
    </style>
<?php endif; ?>
