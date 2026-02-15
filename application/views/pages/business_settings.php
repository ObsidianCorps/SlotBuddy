<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="business-logic-page" class="backend-page">
    <div id="business-logic">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-3 lg:col-start-2">
                <?php component('settings_nav'); ?>
            </div>
            <div class="lg:col-span-6">
                <form>
                    <fieldset>
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 mb-4 py-2">
                            <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                                <?= lang('business_logic') ?>
                            </h4>

                            <?php if (can('edit', PRIV_SYSTEM_SETTINGS)): ?>
                                <button type="button" id="save-settings" class="sb-btn-primary">
                                    <i class="fas fa-check-square mr-2"></i>
                                    <?= lang('save') ?>
                                </button>
                            <?php endif; ?>
                        </div>

                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('working_plan') ?></h5>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <?= lang('edit_working_plan_hint') ?>
                        </p>

                        <table class="working-plan table table-striped">
                            <thead>
                            <tr>
                                <th><?= lang('day') ?></th>
                                <th><?= lang('start') ?></th>
                                <th><?= lang('end') ?></th>
                            </tr>
                            </thead>
                            <tbody><!-- Dynamic Content --></tbody>
                        </table>

                        <div class="text-right mb-5">
                            <button class="sb-btn-secondary" id="apply-global-working-plan" type="button">
                                <i class="fas fa-check"></i>
                                <?= lang('apply_to_all_providers') ?>
                            </button>
                        </div>

                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('breaks') ?></h5>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <?= lang('edit_breaks_hint') ?>
                        </p>

                        <div class="mt-2">
                            <button type="button" class="add-break sb-btn-primary">
                                <i class="fas fa-plus-square mr-2"></i>
                                <?= lang('add_break') ?>
                            </button>
                        </div>

                        <br>

                        <table class="breaks table table-striped mb-5">
                            <thead>
                            <tr>
                                <th><?= lang('day') ?></th>
                                <th><?= lang('start') ?></th>
                                <th><?= lang('end') ?></th>
                                <th><?= lang('actions') ?></th>
                            </tr>
                            </thead>
                            <tbody><!-- Dynamic Content --></tbody>
                        </table>

                        <?php if (can('view', PRIV_BLOCKED_PERIODS)): ?>
                            <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('blocked_periods') ?></h5>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <?= lang('blocked_periods_hint') ?>
                            </p>

                            <div class="mb-5">
                                <a href="<?= site_url('blocked_periods') ?>" class="sb-btn-primary">
                                    <i class="fas fa-cogs mr-2"></i>
                                    <?= lang('configure') ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang(
                            'allow_rescheduling_cancellation_before',
                        ) ?></h5>

                        <div class="mb-5">
                            <label for="book-advance-timeout" class="sb-label">
                                <?= lang('timeout_minutes') ?>
                            </label>
                            <input id="book-advance-timeout" data-field="book_advance_timeout" class="sb-input"
                                   type="number" min="15">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                <small>
                                    <?= lang('book_advance_timeout_hint') ?>
                                </small>
                            </div>
                        </div>

                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('future_booking_limit') ?></h5>

                        <div class="mb-5">
                            <label for="future-booking-limit" class="sb-label">
                                <?= lang('limit_days') ?>
                            </label>
                            <input id="future-booking-limit" data-field="future_booking_limit" class="sb-input"
                                   type="number" min="15">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                <small>
                                    <?= lang('future_booking_limit_hint') ?>
                                </small>
                            </div>
                        </div>

                        <div class="flex justify-start items-center mb-3">
                            <h5 class="text-gray-500 dark:text-gray-400 mb-0 mr-3 font-light">
                                <?= lang('appointment_status_options') ?>
                            </h5>
                        </div>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <?= lang('appointment_status_options_info') ?>
                        </p>

                        <?php component('appointment_status_options', [
                            'attributes' => 'id="appointment-status-options"',
                        ]); ?>

                        <?php slot('after_primary_fields'); ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/vendor/jquery-jeditable/jquery.jeditable.min.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/ui.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/working_plan.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/business_settings_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/business_settings.js') ?>"></script>

<?php end_section('scripts'); ?>
