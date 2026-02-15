<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="integrations-page" class="backend-page">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-3 lg:col-start-2">
            <?php component('settings_nav'); ?>
        </div>
        <div id="integrations" class="lg:col-span-6">
            <h4 class="text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-800 py-3 mb-3 font-light">
                <?= lang('integrations') ?>
            </h4>

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                <?= lang('integrations_info') ?>
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="mb-4">
                    <div class="sb-card h-full flex flex-col">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-800">
                            <h5 class="font-light text-gray-500 dark:text-gray-400 mb-0">
                                <?= lang('webhooks') ?>
                            </h5>
                        </div>
                        <div class="p-4 flex-1">
                            <div class="mb-3 integration-info">
                                <small>
                                    <?= lang('webhooks_info') ?>
                                </small>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <a href="<?= site_url('webhooks') ?>" class="sb-btn-secondary w-full text-center">
                                <i class="fas fa-cogs mr-2"></i>
                                <?= lang('configure') ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="sb-card h-full flex flex-col">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-800">
                            <h5 class="font-light text-gray-500 dark:text-gray-400 mb-0">
                                <?= lang('google_analytics') ?>
                            </h5>
                        </div>
                        <div class="p-4 flex-1">
                            <div class="mb-3 integration-info">
                                <small>
                                    <?= lang('google_analytics_info') ?>
                                </small>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <a href="<?= site_url('google_analytics_settings') ?>"
                               class="sb-btn-secondary w-full text-center">
                                <i class="fas fa-cogs mr-2"></i>
                                <?= lang('configure') ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="sb-card h-full flex flex-col">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-800">
                            <h5 class="font-light text-gray-500 dark:text-gray-400 mb-0">
                                <?= lang('matomo_analytics') ?>
                            </h5>
                        </div>
                        <div class="p-4 flex-1">
                            <div class="mb-3 integration-info">
                                <small>
                                    <?= lang('matomo_analytics_info') ?>
                                </small>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <a href="<?= site_url('matomo_analytics_settings') ?>"
                               class="sb-btn-secondary w-full text-center">
                                <i class="fas fa-cogs mr-2"></i>
                                <?= lang('configure') ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="sb-card h-full flex flex-col">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-800">
                            <h5 class="font-light text-gray-500 dark:text-gray-400 mb-0">
                                <?= lang('api') ?>
                            </h5>
                        </div>
                        <div class="p-4 flex-1">
                            <div class="mb-3 integration-info">
                                <small>
                                    <?= lang('api_info') ?>
                                </small>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <a href="<?= site_url('api_settings') ?>" class="sb-btn-secondary w-full text-center">
                                <i class="fas fa-cogs mr-2"></i>
                                <?= lang('configure') ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="sb-card h-full flex flex-col">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-800">
                            <h5 class="font-light text-gray-500 dark:text-gray-400 mb-0">
                                <?= lang('ldap') ?>
                            </h5>
                        </div>
                        <div class="p-4 flex-1">
                            <div class="mb-3 integration-info">
                                <small>
                                    <?= lang('ldap_info') ?>
                                </small>
                            </div>
                        </div>
                        <div class="px-4 pb-4">
                            <a href="<?= site_url('ldap_settings') ?>" class="sb-btn-secondary w-full text-center">
                                <i class="fas fa-cogs mr-2"></i>
                                <?= lang('configure') ?>
                            </a>
                        </div>
                    </div>
                </div>

                <?php slot('after_integration_cards'); ?>
            </div>
        </div>
    </div>
</div>

<?php end_section('content'); ?>
