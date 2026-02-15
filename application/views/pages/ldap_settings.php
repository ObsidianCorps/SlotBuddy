<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="ldap-settings-page" class="backend-page">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-3 lg:col-start-2">
            <?php component('settings_nav'); ?>
        </div>
        <div id="ldap-settings" class="lg:col-span-6">
            <form>
                <fieldset>
                    <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 mb-4 py-2">
                        <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                            <?= lang('ldap') ?>
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

                    <?php if (!extension_loaded('ldap')): ?>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 text-yellow-800 dark:text-yellow-200 rounded-lg p-4 mb-4">
                            <?= lang('ldap_extension_not_loaded') ?>
                        </div>
                    <?php endif; ?>

                    <div>
                        <div>
                            <div class="mb-3">
                                <div class="flex items-center gap-2 mb-3">
                                    <input class="form-check-input" type="checkbox" id="ldap-is-active"
                                           data-field="ldap_is_active">
                                    <label class="text-sm text-gray-700 dark:text-gray-300" for="ldap-is-active">
                                        <?= lang('active') ?>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="sb-label" for="ldap-host">
                                    <?= lang('host') ?>
                                </label>
                                <input id="ldap-host" class="sb-input" data-field="ldap_host">
                            </div>

                            <div class="mb-3">
                                <label class="sb-label" for="ldap-port">
                                    <?= lang('port') ?>
                                </label>
                                <input id="ldap-port" class="sb-input" data-field="ldap_port">
                            </div>

                            <div class="mb-3">
                                <label class="sb-label" for="ldap-user_dn">
                                    <?= lang('user_dn') ?>
                                </label>
                                <input id="ldap-user_dn" class="sb-input" data-field="ldap_user_dn">
                            </div>

                            <div class="mb-3">
                                <label class="sb-label" for="ldap-password">
                                    <?= lang('password') ?>
                                </label>
                                <input id="ldap-password" type="password" class="sb-input"
                                       data-field="ldap_password">
                            </div>

                            <div class="mb-3">
                                <label class="sb-label" for="ldap-base-dn">
                                    <?= lang('base_dn') ?>
                                </label>
                                <input id="ldap-base-dn" class="sb-input" data-field="ldap_base_dn">
                            </div>

                            <div class="mb-3">
                                <div class="flex mb-2">
                                    <label class="sb-label mb-0" for="ldap-filter">
                                        <?= lang('filter') ?>
                                    </label>
                                    <button type="button" class="sb-btn-secondary text-sm py-0 ml-auto"
                                            id="ldap-reset-filter">
                                        <i class="fas fa-undo mr-2"></i>
                                        <?= lang('reset') ?>
                                    </button>
                                </div>
                                <input id="ldap-filter" class="sb-input" data-field="ldap_filter">
                            </div>

                            <div class="mb-3">
                                <div class="flex mb-2">
                                    <label class="sb-label mb-0" for="ldap-field-mapping">
                                        <?= lang('field_mapping') ?>
                                    </label>
                                    <button type="button" class="sb-btn-secondary text-sm py-0 ml-auto"
                                            id="ldap-reset-field-mapping">
                                        <i class="fas fa-undo mr-2"></i>
                                        <?= lang('reset') ?>
                                    </button>
                                </div>

                                <textarea id="ldap-field-mapping" class="sb-input" rows="5"
                                          data-field="ldap_field_mapping"></textarea>
                            </div>
                        </div>
                    </div>

                    <?php slot('after_primary_appointment_fields'); ?>
                </fieldset>
            </form>

            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 mb-4 py-2">
                <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                    <?= lang('search') ?>
                </h4>
            </div>

            <p class="text-gray-500 dark:text-gray-400 text-sm">
                <?= lang('ldap_search_hint') ?>
            </p>

            <form id="ldap-search-form" class="mb-3">
                <label class="sb-label" for="ldap-search-keyword">
                    <?= lang('keyword') ?>
                </label>

                <div class="flex">
                    <input id="ldap-search-keyword" class="sb-input rounded-r-none">

                    <button type="submit" class="sb-btn-secondary rounded-l-none border-l-0">
                        <?= lang('search') ?>
                    </button>
                </div>
            </form>

            <div id="ldap-search-results" class="mb-3">
                <!-- JS -->
            </div>
        </div>
    </div>
</div>

<?php component('ldap_import_modal', [
    'roles' => vars('roles'),
]); ?>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/http/customers_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/providers_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/secretaries_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/admins_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/ldap_settings_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/ldap_settings.js') ?>"></script>

<?php end_section('scripts'); ?>
