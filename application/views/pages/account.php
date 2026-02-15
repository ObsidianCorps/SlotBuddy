<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="account-page" class="max-w-4xl mx-auto px-4 py-6 backend-page">
    <div id="account">
        <div>
            <div class="max-w-3xl mx-auto">
                <form>
                    <fieldset>
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 mb-4 py-2">
                            <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                                <?= lang('account') ?>
                            </h4>

                            <?php if (can('edit', PRIV_USER_SETTINGS)): ?>
                                <button type="button" id="save-settings" class="sb-btn-primary">
                                    <i class="fas fa-check-square mr-2"></i>
                                    <?= lang('save') ?>
                                </button>
                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <input type="hidden" id="user-id">

                                <div class="mb-3">
                                    <label class="sb-label" for="first-name">
                                        <?= lang('first_name') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input id="first-name" class="sb-input required">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="last-name">
                                        <?= lang('last_name') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input id="last-name" class="sb-input required">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="email">
                                        <?= lang('email') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input id="email" class="sb-input required">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="phone-number">
                                        <?= lang('phone_number') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input id="phone-number" class="sb-input required">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="mobile-number">
                                        <?= lang('mobile_number') ?>
                                    </label>
                                    <input id="mobile-number" class="sb-input">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="address">
                                        <?= lang('address') ?>
                                    </label>
                                    <input id="address" class="sb-input">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="city">
                                        <?= lang('city') ?>
                                    </label>
                                    <input id="city" class="sb-input">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="state">
                                        <?= lang('state') ?>
                                    </label>
                                    <input id="state" class="sb-input">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="zip-code">
                                        <?= lang('zip_code') ?>
                                    </label>
                                    <input id="zip-code" class="sb-input">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="notes">
                                        <?= lang('notes') ?>
                                    </label>
                                    <textarea id="notes" class="sb-input" rows="3"></textarea>
                                </div>
                            </div>

                            <div>
                                <div class="mb-3">
                                    <label class="sb-label" for="username">
                                        <?= lang('username') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input id="username" class="sb-input required">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="password">
                                        <?= lang('password') ?>
                                    </label>
                                    <input type="password" id="password" class="sb-input"
                                           autocomplete="new-password">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="retype-password">
                                        <?= lang('retype_password') ?>
                                    </label>
                                    <input type="password" id="retype-password" class="sb-input"
                                           autocomplete="new-password">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="calendar-view"><?= lang('calendar') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="calendar-view" class="sb-input required">
                                        <option value="default"><?= lang('default') ?></option>
                                        <option value="table"><?= lang('table') ?></option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="language">
                                        <?= lang('language') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <select id="language" class="sb-input required">
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
                                    </label>
                                    <?php component('timezone_dropdown', [
                                        'attributes' => 'id="timezone" class="sb-input required"',
                                        'grouped_timezones' => vars('grouped_timezones'),
                                    ]); ?>
                                </div>

                                <div>
                                    <label class="sb-label mb-3">
                                        <?= lang('options') ?>
                                    </label>
                                </div>

                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg mb-3 p-3">
                                    <div class="flex items-center gap-2">
                                        <input class="w-4 h-4 rounded accent-primary-600" id="notifications" type="checkbox">
                                        <label class="text-sm text-gray-700 dark:text-gray-300" for="notifications">
                                            <?= lang('receive_notifications') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/http/account_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/account.js') ?>"></script>

<?php end_section('scripts'); ?>
