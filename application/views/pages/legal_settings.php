<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="legal-settings-page" class="backend-page">
    <div id="legal-contents">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-3 lg:col-start-2">
                <?php component('settings_nav'); ?>
            </div>
            <div class="lg:col-span-6">
                <form>
                    <fieldset>
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 mb-4 py-2">
                            <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                                <?= lang('legal_contents') ?>
                            </h4>

                            <?php if (can('edit', PRIV_SYSTEM_SETTINGS)): ?>
                                <button type="button" id="save-settings" class="sb-btn-primary">
                                    <i class="fas fa-check-square mr-2"></i>
                                    <?= lang('save') ?>
                                </button>
                            <?php endif; ?>
                        </div>

                        <div>
                            <div>
                                <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('cookie_notice') ?></h5>

                                <div class="flex items-center gap-2 mb-3">
                                    <input class="form-check-input display-switch" type="checkbox"
                                           id="display-cookie-notice">
                                    <label class="text-sm text-gray-700 dark:text-gray-300" for="display-cookie-notice">
                                        <?= lang('display_cookie_notice') ?>
                                    </label>
                                </div>

                                <div class="mb-5">
                                    <label class="sb-label"
                                           for="cookie-notice-content"><?= lang('cookie_notice_content') ?></label>
                                    <textarea id="cookie-notice-content" cols="30" rows="10" class="mb-3"></textarea>
                                </div>

                                <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('terms_and_conditions') ?></h5>

                                <div class="flex items-center gap-2 mb-3">
                                    <input class="form-check-input display-switch" type="checkbox"
                                           id="display-terms-and-conditions">
                                    <label class="text-sm text-gray-700 dark:text-gray-300" for="display-terms-and-conditions">
                                        <?= lang('display_terms_and_conditions') ?>
                                    </label>
                                </div>

                                <div class="mb-5">
                                    <label class="sb-label"
                                           for="terms-and-conditions-content"><?= lang(
                                               'terms_and_conditions_content',
                                           ) ?></label>
                                    <textarea id="terms-and-conditions-content" cols="30" rows="10"
                                              class="mb-3"></textarea>
                                </div>

                                <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('privacy_policy') ?></h5>

                                <div class="flex items-center gap-2 mb-3">
                                    <input class="form-check-input display-switch" type="checkbox"
                                           id="display-privacy-policy">
                                    <label class="text-sm text-gray-700 dark:text-gray-300" for="display-privacy-policy">
                                        <?= lang('display_privacy_policy') ?>
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label"
                                           for="privacy-policy-content"><?= lang('privacy_policy_content') ?></label>
                                    <textarea id="privacy-policy-content" cols="30" rows="10" class="mb-3"></textarea>
                                </div>
                            </div>
                        </div>

                        <?php slot('after_primary_fields'); ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/utils/ui.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/legal_settings_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/legal_settings.js') ?>"></script>


<?php end_section('scripts'); ?>
