<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="google-analytics-settings-page" class="backend-page">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-3 lg:col-start-2">
            <?php component('settings_nav'); ?>
        </div>
        <div id="google-analytics-settings" class="lg:col-span-6">
            <form>
                <fieldset>
                    <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 mb-4 py-2">
                        <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                            <?= lang('google_analytics') ?>
                        </h4>

                        <div>
                            <a href="<?= site_url('integrations') ?>" class="sb-btn-secondary mr-2">
                                <i class="fas fa-chevron-left mr-2"></i>
                                <?= lang('back') ?>
                            </a>

                            <?php if (can('edit', PRIV_SYSTEM_SETTINGS)): ?>
                                <button type="button" id="save-settings" class="sb-btn-primary">
                                    <i class="fas fa-check-square mr-2"></i>
                                    <?= lang('save') ?>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <div>
                            <div class="mb-3">
                                <label class="sb-label" for="google-analytics-code">
                                    <?= lang('google_analytics_code') ?>
                                </label>
                                <input id="google-analytics-code" placeholder="G-XXXXXXXXXX"
                                       class="sb-input" data-field="google_analytics_code">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <small>
                                        <?= lang('google_analytics_code_hint') ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php slot('after_primary_appointment_fields'); ?>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/http/google_analytics_settings_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/google_analytics_settings.js') ?>"></script>

<?php end_section('scripts'); ?>
