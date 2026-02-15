<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div class="backend-page" id="webhooks-page">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" id="webhooks">
        <div id="filter-webhooks" class="filter-records lg:col-span-1">
            <div class="sb-card">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <?= lang('webhooks') ?>
                    </h2>
                </div>
                <div class="p-4">
                    <form class="mb-4">
                        <div class="flex">
                            <input type="text" class="key sb-input rounded-r-none" aria-label="keyword">

                            <button class="filter sb-btn-secondary rounded-l-none border-l-0" type="submit"
                                    data-tippy-content="<?= lang('filter') ?>">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <?php slot('after_page_title'); ?>
                </div>

                <div class="results divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- JS -->
                </div>
            </div>
        </div>

        <div class="record-details lg:col-span-2">
            <div class="sb-card p-6">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <a href="<?= site_url('integrations') ?>" class="sb-btn-secondary mr-2">
                        <i class="fas fa-chevron-left mr-2"></i>
                        <?= lang('back') ?>
                    </a>

                    <div class="add-edit-delete-group inline-flex rounded-md shadow-sm">
                        <button id="add-webhook" class="sb-btn-primary">
                            <i class="fas fa-plus-square mr-2"></i>
                            <?= lang('add') ?>
                        </button>
                        <button id="edit-webhook" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-edit mr-2"></i>
                            <?= lang('edit') ?>
                        </button>
                        <button id="delete-webhook" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-trash-alt mr-2"></i>
                            <?= lang('delete') ?>
                        </button>
                    </div>

                    <div class="save-cancel-group" style="display:none;">
                        <button id="save-webhook" class="sb-btn-primary">
                            <i class="fas fa-check-square mr-2"></i>
                            <?= lang('save') ?>
                        </button>
                        <button id="cancel-webhook" class="sb-btn-secondary">
                            <?= lang('cancel') ?>
                        </button>
                    </div>

                    <?php slot('after_page_actions'); ?>
                </div>

                <h4 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                    <?= lang('details') ?>
                </h4>

                <div class="form-message alert" style="display:none;"></div>

                <input type="hidden" id="id">

                <div class="mb-3">
                    <label class="sb-label" for="name">
                        <?= lang('name') ?>
                        <span class="text-red-500" hidden>*</span>
                    </label>
                    <input id="name" class="sb-input required" maxlength="128" disabled>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="url">
                        <?= lang('url') ?>
                        <span class="text-red-500" hidden>*</span>
                    </label>
                    <input id="url" class="sb-input required" disabled>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="secret-header">
                        <?= lang('secret_header') ?>
                    </label>

                    <input id="secret-header" class="sb-input" disabled>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="secret-token">
                        <?= lang('secret_token') ?>
                    </label>

                    <input id="secret-token" class="sb-input" disabled>
                </div>

                <div>
                    <label class="sb-label mb-3" for="actions">
                        <?= lang('actions') ?>
                    </label>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-lg mb-3 p-3">
                    <div id="actions">
                        <?php foreach (vars('available_actions') as $available_action): ?>
                            <div class="mb-3">
                                <div class="flex items-center gap-2">
                                    <input class="form-check-input" type="checkbox"
                                           id="include-<?= str_replace('_', '-', $available_action) ?>"
                                           data-action="<?= $available_action ?>">

                                    <label class="text-sm text-gray-700 dark:text-gray-300"
                                           for="include-<?= str_replace('_', '-', $available_action) ?>">
                                        <?= lang($available_action) ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div>
                    <label class="sb-label mb-3">
                        <?= lang('options') ?>
                    </label>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-lg mb-3 p-3">
                    <div class="flex items-center gap-2">
                        <input class="form-check-input" type="checkbox" id="is-ssl-verified">

                        <label class="text-sm text-gray-700 dark:text-gray-300" for="is-ssl-verified">
                            <?= lang('verify_ssl') ?>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="notes">
                        <?= lang('notes') ?>
                    </label>
                    <textarea id="notes" rows="4" class="sb-input" disabled></textarea>
                </div>

                <?php slot('after_primary_fields'); ?>
            </div>
        </div>
    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/http/webhooks_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/webhooks.js') ?>"></script>

<?php end_section('scripts'); ?>
