<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div class="space-y-4" id="calendar-page">
    <div class="flex flex-col md:flex-row items-start md:items-center gap-4" id="calendar-toolbar">
        <div id="calendar-filter" class="w-full md:w-64">
            <div class="calendar-filter-items">
                <select id="select-filter-item"
                        class="sb-input"
                        data-tippy-content="<?= lang('select_filter_item_hint') ?>"
                        aria-label="Filter">
                    <!-- JS -->
                </select>
            </div>
        </div>

        <div id="calendar-actions" class="flex flex-wrap items-center gap-2 md:ml-auto">
            <?php if (vars('calendar_view') === CALENDAR_VIEW_DEFAULT): ?>
                <button
                    id="enable-sync"
                    class="sb-btn-ghost"
                    data-tippy-content="<?= lang('enable_appointment_sync_hint') ?>"
                    hidden>
                    <i class="fas fa-rotate mr-2"></i>
                    <?= lang('enable_sync') ?>
                </button>

                <div class="relative inline-flex" id="sync-button-group" hidden>
                    <button type="button" class="sb-btn-ghost rounded-r-none border-r border-gray-200 dark:border-gray-700" id="trigger-sync"
                            data-tippy-content="<?= lang('trigger_sync_hint') ?>">
                        <i class="fas fa-rotate mr-2"></i>
                        <?= lang('synchronize') ?>
                    </button>
                    <button type="button" class="sb-btn-ghost rounded-l-none px-2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">
                            Toggle Dropdown
                        </span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <ul class="hidden absolute right-0 top-full mt-1 z-50 min-w-[10rem] rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 py-1 shadow-lg">
                        <li>
                            <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="#" id="disable-sync">
                                <?= lang('disable_sync') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (can('add', PRIV_APPOINTMENTS)): ?>
                <div class="relative inline-block">
                    <button class="sb-btn-ghost" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-plus-square"></i>
                    </button>
                    <ul class="hidden absolute left-0 top-full mt-1 z-50 min-w-[10rem] rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 py-1 shadow-lg">
                        <li>
                            <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="#" id="insert-appointment">
                                <?= lang('appointment') ?>
                            </a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="#" id="insert-unavailability">
                                <?= lang('unavailability') ?>
                            </a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="#"
                               id="insert-working-plan-exception" <?= session('role_slug') !== DB_SLUG_ADMIN
                                   ? 'hidden'
                                   : '' ?>>
                                <?= lang('working_plan_exception') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

            <button id="reload-appointments" class="sb-btn-ghost"
                    data-tippy-content="<?= lang('reload_appointments_hint') ?>">
                <i class="fas fa-sync-alt"></i>
            </button>

            <?php if (vars('calendar_view') === CALENDAR_VIEW_DEFAULT): ?>
                <a class="sb-btn-ghost" href="<?= site_url('calendar?view=table') ?>"
                   data-tippy-content="<?= lang('table') ?>">
                    <i class="fas fa-table"></i>
                </a>
            <?php endif; ?>

            <?php if (vars('calendar_view') === CALENDAR_VIEW_TABLE): ?>
                <a class="sb-btn-ghost" href="<?= site_url('calendar?view=default') ?>"
                   data-tippy-content="<?= lang('default') ?>">
                    <i class="fas fa-calendar-alt"></i>
                </a>
            <?php endif; ?>

            <?php slot('after_calendar_actions'); ?>
        </div>
    </div>

    <div id="calendar">
        <!-- Dynamically Generated Content -->
    </div>
</div>

<!-- Page Components -->

<?php component('appointments_modal', [
    'available_services' => vars('available_services'),
    'appointment_status_options' => vars('appointment_status_options'),
    'timezones' => vars('timezones'),
    'require_first_name' => vars('require_first_name'),
    'require_last_name' => vars('require_last_name'),
    'require_email' => vars('require_email'),
    'require_phone_number' => vars('require_phone_number'),
    'require_address' => vars('require_address'),
    'require_city' => vars('require_city'),
    'require_zip_code' => vars('require_zip_code'),
    'require_notes' => vars('require_notes'),
]); ?>

<?php component('unavailabilities_modal', [
    'timezones' => vars('timezones'),
    'timezone' => vars('timezone'),
]); ?>

<?php component('working_plan_exceptions_modal'); ?>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/vendor/fullcalendar/index.global.min.js') ?>"></script>
<script src="<?= asset_url('assets/vendor/fullcalendar-moment/index.global.min.js') ?>"></script>
<script src="<?= asset_url('assets/vendor/jquery-jeditable/jquery.jeditable.min.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/ui.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/calendar_default_view.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/calendar_table_view.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/calendar_event_popover.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/calendar_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/customers_http_client.js') ?>"></script>
<?php if (vars('calendar_view') === CALENDAR_VIEW_DEFAULT): ?>
    <script src="<?= asset_url('assets/js/utils/calendar_sync.js') ?>"></script>
    <script src="<?= asset_url('assets/js/http/google_http_client.js') ?>"></script>
    <script src="<?= asset_url('assets/js/http/caldav_http_client.js') ?>"></script>
<?php endif; ?>
<script src="<?= asset_url('assets/js/pages/calendar.js') ?>"></script>

<?php end_section('scripts'); ?>
