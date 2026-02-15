<?php
/**
 * Local variables.
 *
 * @var array $timezones
 * @var string $timezone
 */
?>

<div id="unavailabilities-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-dismiss="modal"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= lang('new_unavailability_title') ?></h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl" data-dismiss="modal">&times;</button>
            </div>
            <div class="p-4">
                <div class="modal-message hidden rounded-lg p-3 mb-3 text-sm"></div>

                <form>
                    <fieldset>
                        <input id="unavailability-id" type="hidden">

                        <div class="mb-3">
                            <label for="unavailability-provider" class="sb-label">
                                <?= lang('provider') ?>
                            </label>
                            <select id="unavailability-provider" class="sb-input"></select>
                        </div>

                        <?php slot('after_select_appointment_provider'); ?>

                        <div class="mb-3">
                            <label for="unavailability-start" class="sb-label">
                                <?= lang('start') ?>
                                <span class="text-red-500">*</span>
                            </label>
                            <input id="unavailability-start" class="sb-input">
                        </div>

                        <div class="mb-3">
                            <label for="unavailability-end" class="sb-label">
                                <?= lang('end') ?>
                                <span class="text-red-500">*</span>
                            </label>
                            <input id="unavailability-end" class="sb-input">
                        </div>

                        <div class="mb-3">
                            <label class="sb-label">
                                <?= lang('timezone') ?>
                            </label>

                            <div
                                class="border border-gray-200 dark:border-gray-600 rounded-lg flex justify-between items-center bg-gray-50 dark:bg-gray-700 timezone-info">
                                <div class="border-r border-gray-200 dark:border-gray-600 w-1/2 p-1 text-center">
                                    <small class="text-gray-600 dark:text-gray-300">
                                        <?= lang('provider') ?>:
                                        <span class="provider-timezone">
                                            -
                                        </span>
                                    </small>
                                </div>
                                <div class="w-1/2 p-1 text-center">
                                    <small class="text-gray-600 dark:text-gray-300">
                                        <?= lang('current_user') ?>:
                                        <span>
                                            <?= $timezones[session('timezone', 'UTC')] ?>
                                        </span>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="unavailability-notes" class="sb-label">
                                <?= lang('notes') ?>
                            </label>
                            <textarea id="unavailability-notes" rows="3" class="sb-input"></textarea>
                        </div>

                        <?php slot('after_primary_unavailability_fields'); ?>
                    </fieldset>
                </form>
            </div>
            <div class="flex justify-end gap-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <?php slot('after_unavailability_actions'); ?>

                <button class="sb-btn-secondary" data-dismiss="modal">
                    <?= lang('cancel') ?>
                </button>
                <button id="save-unavailability" class="sb-btn-primary">
                    <i class="fas fa-check-square mr-2"></i>
                    <?= lang('save') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/components/unavailabilities_modal.js') ?>"></script>

<?php end_section('scripts'); ?>
