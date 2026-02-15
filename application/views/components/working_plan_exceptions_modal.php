<div id="working-plan-exceptions-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-dismiss="modal"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= lang('working_plan_exception') ?></h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl" data-dismiss="modal">&times;</button>
            </div>
            <div class="p-4">
                <div class="mb-3">
                    <label class="sb-label" for="working-plan-exceptions-date"><?= lang('date') ?></label>
                    <input class="sb-input" id="working-plan-exceptions-date">
                </div>

                <div class="flex items-center gap-2 mb-3">
                    <input class="w-4 h-4 rounded accent-primary-600" type="checkbox" id="working-plan-exceptions-is-non-working-day">
                    <label class="text-sm text-gray-700 dark:text-gray-300" for="working-plan-exceptions-is-non-working-day">
                        <?= lang('make_non_working_day') ?>
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <div class="mb-3">
                            <label class="sb-label" for="working-plan-exceptions-start"><?= lang('start') ?></label>
                            <input class="sb-input" id="working-plan-exceptions-start">
                        </div>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label class="sb-label" for="working-plan-exceptions-end"><?= lang('end') ?></label>
                            <input class="sb-input" id="working-plan-exceptions-end">
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= lang('breaks') ?></h3>

                <p class="text-gray-600 dark:text-gray-400">
                    <?= lang('add_breaks_during_each_day') ?>
                </p>

                <div>
                    <button type="button" class="sb-btn-ghost text-sm working-plan-exceptions-add-break">
                        <i class="fas fa-plus-square mr-2"></i>
                        <?= lang('add_break') ?>
                    </button>
                </div>

                <br>

                <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300" id="working-plan-exceptions-breaks">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-2"><?= lang('start') ?></th>
                        <th class="px-4 py-2"><?= lang('end') ?></th>
                        <th class="px-4 py-2"><?= lang('actions') ?></th>
                    </tr>
                    </thead>
                    <tbody><!-- Dynamic Content --></tbody>
                </table>

                <?php slot('after_primary_working_plan_exception_fields'); ?>
            </div>
            <div class="flex justify-end gap-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <?php slot('before_working_plan_exception_actions'); ?>

                <button type="button" class="sb-btn-secondary" data-dismiss="modal">
                    <?= lang('cancel') ?>
                </button>
                <button type="button" class="sb-btn-primary" id="working-plan-exceptions-save">
                    <i class="fas fa-check-square mr-2"></i>
                    <?= lang('save') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/components/working_plan_exceptions_modal.js') ?>"></script>

<?php end_section('scripts'); ?>
