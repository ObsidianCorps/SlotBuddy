<?php
/**
 * Local variables.
 *
 * @var string $display_first_name
 * @var string $require_first_name
 * @var string $display_last_name
 * @var string $require_last_name
 * @var string $display_email
 * @var string $require_email
 * @var string $display_phone_number
 * @var string $require_phone_number
 * @var string $display_address
 * @var string $require_address
 * @var string $display_city
 * @var string $require_city
 * @var string $display_zip_code
 * @var string $require_zip_code
 * @var string $display_notes
 * @var string $require_notes
 */
?>

<div id="wizard-frame-3" class="wizard-frame hidden">
    <div class="space-y-5">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            <?= lang('customer_information') ?>
        </h2>

        <div id="form-message" class="hidden text-sm text-red-600 dark:text-red-400"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Left column -->
            <div class="field-col space-y-4">
                <?php if ($display_first_name): ?>
                    <div>
                        <label for="first-name" class="sb-label">
                            <?= lang('first_name') ?>
                            <?php if ($require_first_name): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <input type="text" id="first-name"
                               class="<?= $require_first_name ? 'required' : '' ?> sb-input" maxlength="100"/>
                    </div>
                <?php endif; ?>

                <?php if ($display_last_name): ?>
                    <div>
                        <label for="last-name" class="sb-label">
                            <?= lang('last_name') ?>
                            <?php if ($require_last_name): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <input type="text" id="last-name"
                               class="<?= $require_last_name ? 'required' : '' ?> sb-input" maxlength="120"/>
                    </div>
                <?php endif; ?>

                <?php if ($display_email): ?>
                    <div>
                        <label for="email" class="sb-label">
                            <?= lang('email') ?>
                            <?php if ($require_email): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <input type="email" id="email"
                               class="<?= $require_email ? 'required' : '' ?> sb-input" maxlength="120"/>
                    </div>
                <?php endif; ?>

                <?php if ($display_phone_number): ?>
                    <div>
                        <label for="phone-number" class="sb-label">
                            <?= lang('phone_number') ?>
                            <?php if ($require_phone_number): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <input type="tel" id="phone-number" maxlength="60"
                               class="<?= $require_phone_number ? 'required' : '' ?> sb-input"/>
                    </div>
                <?php endif; ?>

                <?php slot('info_first_column'); ?>

                <?php component('custom_fields'); ?>

                <?php slot('after_custom_fields'); ?>
            </div>

            <!-- Right column -->
            <div class="field-col space-y-4">
                <?php if ($display_address): ?>
                    <div>
                        <label for="address" class="sb-label">
                            <?= lang('address') ?>
                            <?php if ($require_address): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <input type="text" id="address"
                               class="<?= $require_address ? 'required' : '' ?> sb-input" maxlength="120"/>
                    </div>
                <?php endif; ?>

                <?php if ($display_city): ?>
                    <div>
                        <label for="city" class="sb-label">
                            <?= lang('city') ?>
                            <?php if ($require_city): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <input type="text" id="city"
                               class="<?= $require_city ? 'required' : '' ?> sb-input" maxlength="120"/>
                    </div>
                <?php endif; ?>

                <?php if ($display_zip_code): ?>
                    <div>
                        <label for="zip-code" class="sb-label">
                            <?= lang('zip_code') ?>
                            <?php if ($require_zip_code): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <input type="text" id="zip-code"
                               class="<?= $require_zip_code ? 'required' : '' ?> sb-input" maxlength="120"/>
                    </div>
                <?php endif; ?>

                <?php if ($display_notes): ?>
                    <div>
                        <label for="notes" class="sb-label">
                            <?= lang('notes') ?>
                            <?php if ($require_notes): ?>
                                <span class="text-red-500">*</span>
                            <?php endif; ?>
                        </label>
                        <textarea id="notes" maxlength="500" rows="3"
                                  class="<?= $require_notes ? 'required' : '' ?> sb-input"></textarea>
                    </div>
                <?php endif; ?>

                <?php slot('info_second_column'); ?>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100 dark:border-gray-800">
        <button type="button" id="button-back-3" class="button-back sb-btn-secondary" data-step_index="3">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <?= lang('back') ?>
        </button>
        <button type="button" id="button-next-3" class="button-next sb-btn-primary" data-step_index="3">
            <?= lang('next') ?>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</div>
