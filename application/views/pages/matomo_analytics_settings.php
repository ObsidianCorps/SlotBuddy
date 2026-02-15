<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="matomo-analytics-settings-page" class="backend-page">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-3 lg:col-start-2">
            <?php component('settings_nav'); ?>
        </div>
        <div id="matomo-analytics-settings" class="lg:col-span-6">
            <form>
                <fieldset>
                    <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 mb-4 py-2">
                        <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                            <?= lang('matomo_analytics') ?>
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
                                <label class="sb-label" for="matomo-analytics-url">
                                    <?= lang('matomo_analytics_url') ?>
                                </label>
                                <input id="matomo-analytics-url" placeholder="//example.org/url/to/matomo/"
                                       data-field="matomo_analytics_url" class="sb-input">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <small>
                                        <?= lang('matomo_analytics_url_hint') ?>
                                    </small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="sb-label" for="matomo-analytics-site-id">
                                    <?= lang('matomo_analytics_site_id') ?>
                                </label>
                                <input id="matomo-analytics-site-id" data-field="matomo_analytics_site_id"
                                       class="sb-input">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <small>
                                        <?= lang('matomo_analytics_site_id_hint') ?>
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

<script src="<?= asset_url('assets/js/http/matomo_analytics_settings_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/matomo_analytics_settings.js') ?>"></script>

<?php end_section('scripts'); ?>
