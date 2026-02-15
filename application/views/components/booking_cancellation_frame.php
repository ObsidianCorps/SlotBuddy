<?php
/**
 * Local variables.
 *
 * @var bool $manage_mode
 * @var array $appointment_data
 * @var bool $display_delete_personal_information
 */
?>

<?php if ($manage_mode): ?>
    <div id="cancel-appointment-frame" class="flex items-center justify-between gap-4 p-4 mb-4 rounded-lg bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800">
        <p class="text-sm text-amber-800 dark:text-amber-200">
            <?= lang('cancel_appointment_hint') ?>
        </p>
        <form id="cancel-appointment-form" method="post" class="shrink-0"
              action="<?= site_url('booking_cancellation/of/' . $appointment_data['hash']) ?>">
            <input id="hidden-cancellation-reason" name="cancellation_reason" type="hidden">
            <button id="cancel-appointment" type="button" class="sb-btn-secondary text-amber-700 dark:text-amber-300 border-amber-300 dark:border-amber-700 hover:bg-amber-100 dark:hover:bg-amber-900/50">
                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <?= lang('cancel') ?>
            </button>
        </form>
    </div>

    <?php if ($display_delete_personal_information): ?>
        <div class="flex items-center justify-between gap-4 p-4 mb-4 rounded-lg bg-red-50 dark:bg-red-950/30 border border-red-200 dark:border-red-800">
            <p class="text-sm text-red-800 dark:text-red-200">
                <?= lang('delete_personal_information_hint') ?>
            </p>
            <button id="delete-personal-information" type="button" class="sb-btn-danger shrink-0">
                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <?= lang('delete') ?>
            </button>
        </div>
    <?php endif; ?>
<?php endif; ?>
