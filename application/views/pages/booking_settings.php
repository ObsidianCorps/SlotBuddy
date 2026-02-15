<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="booking-settings-page" class="backend-page">
    <div id="booking-settings">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-3 lg:col-start-2">
                <?php component('settings_nav'); ?>
            </div>
            <div class="lg:col-span-6">
                <form>
                    <fieldset>
                        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-800 mb-4 py-2">
                            <h4 class="text-gray-500 dark:text-gray-400 mb-0 font-light">
                                <?= lang('booking_settings') ?>
                            </h4>

                            <?php if (can('edit', PRIV_SYSTEM_SETTINGS)): ?>
                                <button type="button" id="save-settings" class="sb-btn-primary">
                                    <i class="fas fa-check-square mr-2"></i>
                                    <?= lang('save') ?>
                                </button>
                            <?php endif; ?>
                        </div>

                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('fields') ?>
                        </h5>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-5 fields-row">
                            <div>
                                <div class="mb-5">
                                    <label for="first-name" class="sb-label">
                                        <?= lang('first_name') ?>
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" id="first-name" class="sb-input mb-2" readonly/>

                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-first-name"
                                                   data-field="display_first_name">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-first-name">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-first-name"
                                                   data-field="require_first_name">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-first-name">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="last-name" class="sb-label">
                                        <?= lang('last_name') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="last-name" class="sb-input mb-2" readonly/>
                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-last-name"
                                                   data-field="display_last_name">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-last-name">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-last-name"
                                                   data-field="require_last_name">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-last-name">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="email" class="sb-label">
                                        <?= lang('email') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="email" class="sb-input mb-2" readonly/>
                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-email"
                                                   data-field="display_email">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-email">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-email"
                                                   data-field="require_email">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-email">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone-number" class="sb-label">
                                        <?= lang('phone_number') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="phone-number" class="sb-input mb-2" readonly/>
                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-phone-number"
                                                   data-field="display_phone_number">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-phone-number">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-phone-number"
                                                   data-field="require_phone_number">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-phone-number">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="mb-5">
                                    <label for="address" class="sb-label">
                                        <?= lang('address') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="address" class="sb-input mb-2" readonly/>
                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-address"
                                                   data-field="display_address">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-address">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-address"
                                                   data-field="require_address">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-address">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="city" class="sb-label">
                                        <?= lang('city') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="city" class="sb-input mb-2" readonly/>
                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-city"
                                                   data-field="display_city">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-city">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-city"
                                                   data-field="require_city">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-city">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="zip-code" class="sb-label">
                                        <?= lang('zip_code') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="zip-code" class="sb-input mb-2" readonly/>
                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-zip-code"
                                                   data-field="display_zip_code">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-zip-code">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-zip-code"
                                                   data-field="require_zip_code">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-zip-code">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="sb-label">
                                        <?= lang('notes') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="notes" class="sb-input mb-2" rows="1" readonly></textarea>
                                    <div class="flex">
                                        <div class="flex items-center gap-2 mr-4">
                                            <input class="form-check-input display-switch" type="checkbox"
                                                   id="display-notes"
                                                   data-field="display_notes">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-notes">
                                                <?= lang('display') ?>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input require-switch" type="checkbox"
                                                   id="require-notes"
                                                   data-field="require_notes">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-notes">
                                                <?= lang('require') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('custom_fields') ?>
                        </h5>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5 fields-row">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div>
                                    <div class="mb-5">
                                        <label for="first-name" class="sb-label">
                                            <?= lang('custom_field') ?> #<?= $i ?>
                                            <span class="text-red-500">*</span>
                                        </label>

                                        <input type="text" id="custom-field-<?= $i ?>" class="sb-input mb-2"
                                               placeholder="<?= lang('label') ?>"
                                               data-field="label_custom_field_<?= $i ?>"
                                               aria-label="label"
                                        />

                                        <div class="flex">
                                            <div class="flex items-center gap-2 mr-4">
                                                <input class="form-check-input display-switch" type="checkbox"
                                                       id="display-custom-field-<?= $i ?>"
                                                       data-field="display_custom_field_<?= $i ?>">
                                                <label class="text-sm text-gray-700 dark:text-gray-300" for="display-custom-field-<?= $i ?>">
                                                    <?= lang('display') ?>
                                                </label>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                <input class="form-check-input require-switch" type="checkbox"
                                                       id="require-custom-field-<?= $i ?>"
                                                       data-field="require_custom_field_<?= $i ?>">
                                                <label class="text-sm text-gray-700 dark:text-gray-300" for="require-custom-field-<?= $i ?>">
                                                    <?= lang('require') ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>


                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('options') ?>
                        </h5>

                        <div>
                            <div>
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg mb-3 p-3">
                                    <div class="mb-3">
                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input" type="checkbox" id="customer-notifications"
                                                   data-field="customer_notifications">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="customer-notifications">
                                                <?= lang('customer_notifications') ?>
                                            </label>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <small>
                                                <?= lang('customer_notifications_hint') ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input" type="checkbox" id="limit-customer-access"
                                                   data-field="limit_customer_access">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="limit-customer-access">
                                                <?= lang('limit_customer_access') ?>
                                            </label>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <small>
                                                <?= lang('limit_customer_access_hint') ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input" type="checkbox" id="require-captcha"
                                                   data-field="require_captcha">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="require-captcha">
                                                CAPTCHA
                                            </label>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <small>
                                                <?= lang('require_captcha_hint') ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input" type="checkbox" id="display-any-provider"
                                                   data-field="display_any_provider">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-any-provider">
                                                <?= lang('any_provider') ?>
                                            </label>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <small>
                                                <?= lang('display_any_provider_hint') ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input" type="checkbox" id="display-login-button"
                                                   data-field="display_login_button">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-login-button">
                                                <?= lang('login_button') ?>
                                            </label>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <small>
                                                <?= lang('display_login_button_hint') ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input" type="checkbox"
                                                   id="display-delete-personal-information"
                                                   data-field="display_delete_personal_information">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="display-delete-personal-information">
                                                <?= lang('delete_personal_information') ?>
                                            </label>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <small>
                                                <?= lang('delete_personal_information_hint') ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-2">
                                            <input class="form-check-input" type="checkbox" id="disable-booking"
                                                   data-field="disable_booking">
                                            <label class="text-sm text-gray-700 dark:text-gray-300" for="disable-booking">
                                                <?= lang('disable_booking') ?>
                                            </label>
                                        </div>

                                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                            <small>
                                                <?= lang('disable_booking_hint') ?>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3" hidden>
                                        <label class="sb-label" for="disable-booking-message">
                                            <?= lang('display_message') ?>
                                        </label>
                                        <textarea id="disable-booking-message" cols="30" rows="10"
                                                  class="mb-3"></textarea>
                                    </div>
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

<script src="<?= asset_url('assets/js/http/booking_settings_http_client.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/booking_settings.js') ?>"></script>

<?php end_section('scripts'); ?>
