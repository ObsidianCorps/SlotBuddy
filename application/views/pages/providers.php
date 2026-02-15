<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div class="backend-page" id="providers-page">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" id="providers">
        <div id="filter-providers" class="filter-records lg:col-span-1">
            <div class="sb-card">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <?= lang('providers') ?>
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
                        <button id="add-provider" class="sb-btn-primary">
                            <i class="fas fa-plus-square mr-2"></i>
                            <?= lang('add') ?>
                        </button>
                        <button id="edit-provider" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-edit mr-2"></i>
                            <?= lang('edit') ?>
                        </button>
                        <button id="delete-provider" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-trash-alt mr-2"></i>
                            <?= lang('delete') ?>
                        </button>
                    </div>

                    <div class="save-cancel-group" style="display:none;">
                        <button id="save-provider" class="sb-btn-primary">
                            <i class="fas fa-check-square mr-2"></i>
                            <?= lang('save') ?>
                        </button>
                        <button id="cancel-provider" class="sb-btn-secondary">
                            <?= lang('cancel') ?>
                        </button>
                    </div>

                    <?php slot('after_page_actions'); ?>
                </div>

                <ul class="nav nav-pills switch-view flex border-b border-gray-200 dark:border-gray-700 mb-4">
                    <li class="nav-item">
                        <a class="nav-link active inline-block px-4 py-2 text-sm font-medium rounded-t-lg" href="#details" data-bs-toggle="tab">
                            <?= lang('details') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inline-block px-4 py-2 text-sm font-medium rounded-t-lg" href="#working-plan" data-bs-toggle="tab">
                            <?= lang('working_plan') ?>
                        </a>
                    </li>
                </ul>

                <?php
// This form message is outside the details view, so that it can be
// visible when the user has working plan view active.
?>

                <div class="form-message alert" style="display:none;"></div>

                <div class="tab-content">
                    <div class="details-view tab-pane fade show active clearfix" id="details">
                        <h4 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('details') ?>
                        </h4>

                        <input type="hidden" id="id" class="record-id">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="details">
                                <div class="mb-3">
                                    <label class="sb-label" for="first-name">
                                        <?= lang('first_name') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <input id="first-name" class="sb-input required" maxlength="256" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="last-name">
                                        <?= lang('last_name') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <input id="last-name" class="sb-input required" maxlength="512" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="email">
                                        <?= lang('email') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <input id="email" class="sb-input required" max="512" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="phone-number">
                                        <?= lang('phone_number') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <input id="phone-number" class="sb-input required" max="128" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="mobile-number">
                                        <?= lang('mobile_number') ?>

                                    </label>
                                    <input id="mobile-number" class="sb-input" maxlength="128" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="address">
                                        <?= lang('address') ?>
                                    </label>
                                    <input id="address" class="sb-input" maxlength="256" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="city">
                                        <?= lang('city') ?>

                                    </label>
                                    <input id="city" class="sb-input" maxlength="256" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="state">
                                        <?= lang('state') ?>
                                    </label>
                                    <input id="state" class="sb-input" maxlength="256" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="zip-code">
                                        <?= lang('zip_code') ?>

                                    </label>
                                    <input id="zip-code" class="sb-input" maxlength="64" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="notes">
                                        <?= lang('notes') ?>
                                    </label>
                                    <textarea id="notes" class="sb-input" rows="3" disabled></textarea>
                                </div>

                                <?php slot('after_primary_fields'); ?>
                            </div>
                            <div class="settings">
                                <div class="mb-3">
                                    <label class="sb-label" for="username">
                                        <?= lang('username') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <input id="username" class="sb-input required" maxlength="256" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="password">
                                        <?= lang('password') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <input type="password" id="password" class="sb-input required"
                                           maxlength="512" autocomplete="new-password" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="password-confirm">
                                        <?= lang('retype_password') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <input type="password" id="password-confirm"
                                           class="sb-input required" maxlength="512"
                                           autocomplete="new-password" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="calendar-view">
                                        <?= lang('calendar') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <select id="calendar-view" class="sb-input required" disabled>
                                        <option value="default"><?= lang('default') ?></option>
                                        <option value="table"><?= lang('table') ?></option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="language">
                                        <?= lang('language') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <select id="language" class="sb-input required" disabled>
                                        <?php foreach (vars('available_languages') as $available_language): ?>
                                            <option value="<?= $available_language ?>">
                                                <?= ucfirst($available_language) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="timezone">
                                        <?= lang('timezone') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <?php component('timezone_dropdown', [
                                        'attributes' => 'id="timezone" class="sb-input required" disabled',
                                        'grouped_timezones' => vars('grouped_timezones'),
                                    ]); ?>
                                </div>

                                <?php if (setting('ldap_is_active')): ?>
                                    <div class="mb-3">
                                        <label for="ldap-dn" class="sb-label">
                                            <?= lang('ldap_dn') ?>
                                        </label>
                                        <input type="text" id="ldap-dn" class="sb-input" maxlength="100" disabled/>
                                    </div>
                                <?php endif; ?>

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

                                    <div class="text-gray-500 dark:text-gray-400 mt-1 mb-3">
                                        <small>
                                            <?= lang('private_hint') ?>
                                        </small>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <input class="form-check-input" type="checkbox" id="notifications" disabled>
                                        <label class="text-sm text-gray-700 dark:text-gray-300" for="notifications">
                                            <?= lang('receive_notifications') ?>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="sb-label mb-3">
                                        <?= lang('services') ?>
                                    </label>
                                </div>

                                <div id="provider-services" class="sb-card p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                                    <!-- JS -->
                                </div>

                                <?php slot('after_secondary_fields'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="working-plan-view tab-pane fade clearfix" id="working-plan">
                        <h4 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('working_plan') ?>
                        </h4>

                        <button id="reset-working-plan" class="sb-btn-primary"
                                data-tippy-content="<?= lang('reset_working_plan') ?>">
                            <i class="fas fa-undo-alt mr-2"></i>
                            <?= lang('reset_plan') ?></button>
                        <table class="working-plan w-full text-sm mt-2">
                            <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('day') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('start') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('end') ?></th>
                            </tr>
                            </thead>
                            <tbody><!-- Dynamic Content --></tbody>
                        </table>

                        <?php slot('after_working_plan'); ?>

                        <br>

                        <h4 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('breaks') ?>
                        </h4>

                        <p class="text-gray-600 dark:text-gray-400">
                            <?= lang('add_breaks_during_each_day') ?>
                        </p>

                        <div>
                            <button type="button" class="add-break sb-btn-primary">
                                <i class="fas fa-plus-square mr-2"></i>
                                <?= lang('add_break') ?>
                            </button>
                        </div>

                        <br>

                        <table class="breaks w-full text-sm">
                            <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('day') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('start') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('end') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('actions') ?></th>
                            </tr>
                            </thead>
                            <tbody><!-- Dynamic Content --></tbody>
                        </table>

                        <?php slot('after_breaks'); ?>

                        <br>

                        <h4 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('working_plan_exceptions') ?>
                        </h4>

                        <p class="text-gray-600 dark:text-gray-400">
                            <?= lang('add_working_plan_exceptions_during_each_day') ?>
                        </p>

                        <div>
                            <button type="button" class="add-working-plan-exception sb-btn-primary mr-2">
                                <i class="fas fa-plus-square mr-2"></i>
                                <?= lang('add_working_plan_exception') ?>
                            </button>
                        </div>

                        <br>

                        <table class="working-plan-exceptions w-full text-sm">
                            <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('day') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('start') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('end') ?></th>
                                <th class="text-left py-2 px-3 text-gray-700 dark:text-gray-300"><?= lang('actions') ?></th>
                            </tr>
                            </thead>
                            <tbody><!-- Dynamic Content --></tbody>
                        </table>

                        <?php component('working_plan_exceptions_modal'); ?>

                        <?php slot('after_working_plan_exceptions'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/vendor/jquery-jeditable/jquery.jeditable.min.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/ui.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/working_plan.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/account_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/providers_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/providers.js') ?>"></script>

<?php end_section('scripts'); ?>



