<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div class="backend-page" id="services-page">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" id="services">
        <div id="filter-services" class="filter-records lg:col-span-1">
            <div class="sb-card">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <?= lang('services') ?>
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
                    <div class="add-edit-delete-group inline-flex rounded-md shadow-sm">
                        <button id="add-service" class="sb-btn-primary">
                            <i class="fas fa-plus-square mr-2"></i>
                            <?= lang('add') ?>
                        </button>
                        <button id="edit-service" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-edit mr-2"></i>
                            <?= lang('edit') ?>
                        </button>
                        <button id="delete-service" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-trash-alt mr-2"></i>
                            <?= lang('delete') ?>
                        </button>
                    </div>

                    <div class="save-cancel-group" style="display:none;">
                        <button id="save-service" class="sb-btn-primary">
                            <i class="fas fa-check-square mr-2"></i>
                            <?= lang('save') ?>
                        </button>
                        <button id="cancel-service" class="sb-btn-secondary">
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
                    <label class="sb-label" for="duration">
                        <?= lang('duration_minutes') ?>
                        <span class="text-red-500" hidden>*</span>
                    </label>
                    <input id="duration" class="sb-input required" type="number" min="<?= EVENT_MINIMUM_DURATION ?>"
                           disabled>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="price">
                        <?= lang('price') ?>
                        <span class="text-red-500" hidden>*</span>
                    </label>
                    <input id="price" class="sb-input required" disabled>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="currency">
                        <?= lang('currency') ?>

                    </label>
                    <input id="currency" class="sb-input" maxlength="32" disabled>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="service-category-id">
                        <?= lang('category') ?>
                    </label>
                    <select id="service-category-id" class="sb-input" disabled></select>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="availabilities-type">
                        <?= lang('availabilities_type') ?>

                    </label>
                    <select id="availabilities-type" class="sb-input" disabled>
                        <option value="<?= AVAILABILITIES_TYPE_FLEXIBLE ?>">
                            <?= lang('flexible') ?>
                        </option>
                        <option value="<?= AVAILABILITIES_TYPE_FIXED ?>">
                            <?= lang('fixed') ?>
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="attendants-number" disabled>
                        <?= lang('attendants_number') ?>
                        <span class="text-red-500" hidden>*</span>
                    </label>
                    <input id="attendants-number" class="sb-input required" type="number" min="1">
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="location">
                        <?= lang('location') ?>
                    </label>
                    <input id="location" class="sb-input" disabled>
                </div>

                <div class="mb-3">
                    <?php component('color_selection', ['attributes' => 'id="color"']); ?>
                </div>

                <div>
                    <label class="sb-label mb-3">
                        <?= lang('options') ?>
                    </label>
                </div>

                <div class="border border-gray-200 dark:border-gray-700 rounded-lg mb-3 p-3">
                    <div class="flex items-center gap-2">
                        <input class="form-check-input" type="checkbox" id="is-private">

                        <label class="text-sm text-gray-700 dark:text-gray-300" for="is-private">
                            <?= lang('hide_from_public') ?>
                        </label>
                    </div>

                    <div class="text-gray-500 dark:text-gray-400 mt-1">
                        <small>
                            <?= lang('private_hint') ?>
                        </small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="description">
                        <?= lang('description') ?>
                    </label>
                    <textarea id="description" rows="4" class="sb-input" disabled></textarea>
                </div>

                <?php slot('after_primary_fields'); ?>
            </div>
        </div>
    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/http/services_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/service_categories_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/services.js') ?>"></script>

<?php end_section('scripts'); ?>
