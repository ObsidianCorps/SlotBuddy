<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div class="backend-page" id="admins-page">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" id="admins">
        <div id="filter-admins" class="filter-records lg:col-span-1">
            <div class="sb-card">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        <?= lang('admins') ?>
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
                        <button id="add-admin" class="sb-btn-primary">
                            <i class="fas fa-plus-square mr-2"></i>
                            <?= lang('add') ?>
                        </button>
                        <button id="edit-admin" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-edit mr-2"></i>
                            <?= lang('edit') ?>
                        </button>
                        <button id="delete-admin" class="sb-btn-secondary" disabled="disabled">
                            <i class="fas fa-trash-alt mr-2"></i>
                            <?= lang('delete') ?>
                        </button>
                    </div>

                    <div class="save-cancel-group" style="display:none;">
                        <button id="save-admin" class="sb-btn-primary">
                            <i class="fas fa-check-square mr-2"></i>
                            <?= lang('save') ?>
                        </button>
                        <button id="cancel-admin" class="sb-btn-secondary">
                            <?= lang('cancel') ?>
                        </button>
                    </div>

                    <?php slot('after_page_actions'); ?>
                </div>

                <h4 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                    <?= lang('details') ?>
                </h4>

                <div class="form-message alert" style="display:none;"></div>

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
                            <input id="email" class="sb-input required" maxlength="512" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="sb-label" for="phone-number">
                                <?= lang('phone_number') ?>
                                <span class="text-red-500" hidden>*</span>
                            </label>
                            <input id="phone-number" class="sb-input required" maxlength="128" disabled>
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
                            <input id="state" class="sb-input" maxlength="128" disabled>
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
                            <input type="password" id="password" class="sb-input required" maxlength="512"
                                   autocomplete="new-password" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="sb-label" for="password-confirm">
                                <?= lang('retype_password') ?>
                                <span class="text-red-500" hidden>*</span>
                            </label>
                            <input type="password" id="password-confirm" class="sb-input required"
                                   maxlength="512" autocomplete="new-password" disabled>
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
                                <input class="form-check-input" type="checkbox" id="notifications" disabled>
                                <label class="text-sm text-gray-700 dark:text-gray-300" for="notifications">
                                    <?= lang('receive_notifications') ?>
                                </label>
                            </div>
                        </div>

                        <?php slot('after_secondary_fields'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/http/account_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/http/admins_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/admins.js') ?>"></script>

<?php end_section('scripts'); ?>
