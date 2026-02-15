<?php
/**
 * Local variables.
 *
 * @var bool $manage_mode
 * @var string $display_terms_and_conditions
 * @var string $display_privacy_policy
 */
?>

<div id="wizard-frame-4" class="wizard-frame hidden">
    <div class="space-y-5">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            <?= lang('appointment_confirmation') ?>
        </h2>

        <!-- Appointment & Customer Details (populated by JS) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div id="appointment-details" class="space-y-2">
                <!-- JS -->
            </div>
            <div id="customer-details" class="space-y-2">
                <!-- JS -->
            </div>
        </div>

        <?php slot('after_details'); ?>

        <?php if (setting('require_captcha')): ?>
            <div class="space-y-2">
                <label class="captcha-title sb-label flex items-center gap-2" for="captcha-text">
                    CAPTCHA
                    <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </button>
                </label>
                <img class="captcha-image rounded-lg border border-gray-200 dark:border-gray-700" src="<?= site_url('captcha') ?>" alt="CAPTCHA">
                <input id="captcha-text" class="captcha-text sb-input" type="text" value="" placeholder="Enter CAPTCHA"/>
                <span id="captcha-hint" class="text-sm text-red-500 opacity-0 transition-opacity">&nbsp;</span>
            </div>
        <?php endif; ?>

        <?php slot('after_captcha'); ?>

        <!-- Terms & Privacy -->
        <div class="space-y-3">
            <?php if ($display_terms_and_conditions): ?>
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" class="required mt-0.5 rounded border-gray-300 dark:border-gray-600 text-accent focus:ring-accent" id="accept-to-terms-and-conditions">
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        <?= strtr(lang('read_and_agree_to_terms_and_conditions'), [
                            '{$link}' => '<a href="#" data-modal="terms-and-conditions" class="text-accent hover:underline">',
                            '{/$link}' => '</a>',
                        ]) ?>
                    </span>
                </label>
            <?php endif; ?>

            <?php if ($display_privacy_policy): ?>
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" class="required mt-0.5 rounded border-gray-300 dark:border-gray-600 text-accent focus:ring-accent" id="accept-to-privacy-policy">
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        <?= strtr(lang('read_and_agree_to_privacy_policy'), [
                            '{$link}' => '<a href="#" data-modal="privacy-policy" class="text-accent hover:underline">',
                            '{/$link}' => '</a>',
                        ]) ?>
                    </span>
                </label>
            <?php endif; ?>

            <?php slot('after_select_policies'); ?>
        </div>
    </div>

    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100 dark:border-gray-800">
        <button type="button" id="button-back-4" class="button-back sb-btn-secondary" data-step_index="4">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <?= lang('back') ?>
        </button>
        <form id="book-appointment-form" class="inline-block" method="post">
            <button id="book-appointment-submit" type="button" class="sb-btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <?= $manage_mode ? lang('update') : lang('confirm') ?>
            </button>
            <input type="hidden" name="csrfToken"/>
            <input type="hidden" name="post_data"/>
        </form>
    </div>
</div>
