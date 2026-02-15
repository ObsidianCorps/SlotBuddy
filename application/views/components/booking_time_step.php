<?php
/**
 * Local variables.
 *
 * @var array $grouped_timezones
 */
?>

<div id="wizard-frame-2" class="wizard-frame hidden">
    <div class="space-y-5">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            <?= lang('appointment_date_and_time') ?>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Calendar / Date Picker -->
            <div>
                <div id="select-date"></div>
                <?php slot('after_select_date'); ?>
            </div>

            <!-- Time Slots -->
            <div class="space-y-4">
                <div>
                    <label for="select-timezone" class="sb-label">
                        <?= lang('timezone') ?>
                    </label>
                    <?php component('timezone_dropdown', [
                        'attributes' => 'id="select-timezone" class="sb-input" value="UTC"',
                        'grouped_timezones' => $grouped_timezones,
                    ]); ?>
                </div>

                <?php slot('after_select_timezone'); ?>

                <div>
                    <label class="sb-label"><?= lang('available_hours') ?></label>
                    <div id="available-hours" class="grid grid-cols-2 sm:grid-cols-3 gap-2 max-h-64 overflow-y-auto pr-1">
                        <!-- JS populates time slot buttons here -->
                    </div>
                </div>

                <?php slot('after_available_hours'); ?>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100 dark:border-gray-800">
        <button type="button" id="button-back-2" class="button-back sb-btn-secondary" data-step_index="2">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <?= lang('back') ?>
        </button>
        <button type="button" id="button-next-2" class="button-next sb-btn-primary" data-step_index="2">
            <?= lang('next') ?>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</div>
