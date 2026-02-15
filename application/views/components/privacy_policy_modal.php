<?php
/**
 * Local variables.
 *
 * @var string $privacy_policy_content
 */
?>

<div id="privacy-policy-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-dismiss="modal"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= lang('privacy_policy') ?></h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl" data-dismiss="modal">&times;</button>
            </div>
            <div class="p-4 text-gray-700 dark:text-gray-300">
                <?= pure_html($privacy_policy_content) ?>
            </div>
            <div class="flex justify-end gap-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" class="sb-btn-secondary" data-dismiss="modal">
                    <?= lang('close') ?>
                </button>
            </div>
        </div>
    </div>
</div>
