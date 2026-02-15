<?php
/**
 * Local variables.
 *
 * @var array $available_services
 * @var array $appointment_status_options
 * @var array $timezones
 * @var array $require_first_name
 * @var array $require_last_name
 * @var array $require_email
 * @var array $require_phone_number
 * @var array $require_address
 * @var array $require_city
 * @var array $require_zip_code
 * @var array $require_notes
 */
?>
<div id="appointments-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-dismiss="modal"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= lang('edit_appointment_title') ?></h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl" data-dismiss="modal">&times;</button>
            </div>

            <div class="p-4">
                <div class="modal-message hidden rounded-lg p-3 mb-3 text-sm"></div>

                <form>
                    <fieldset>
                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('appointment_details_title') ?></h5>

                        <input id="appointment-id" type="hidden">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <div class="mb-3">
                                    <label for="select-service" class="sb-label">
                                        <?= lang('service') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="select-service" class="required sb-input">
                                        <?php
                                        // Group services by category, only if there is at least one service
                                        // with a parent category.
                                        $has_category = false;

                                        foreach ($available_services as $service) {
                                            if (!empty($service['category_id'])) {
                                                $has_category = true;
                                                break;
                                            }
                                        }

                                        if ($has_category) {
                                            $grouped_services = [];

                                            foreach ($available_services as $service) {
                                                if (!empty($service['category_id'])) {
                                                    if (!isset($grouped_services[$service['category_name']])) {
                                                        $grouped_services[$service['category_name']] = [];
                                                    }

                                                    $grouped_services[$service['category_name']][] = $service;
                                                }
                                            }

                                            // We need the uncategorized services at the end of the list, so we will use
                                            // another iteration only for the uncategorized services.
                                            $grouped_services['uncategorized'] = [];

                                            foreach ($available_services as $service) {
                                                if ($service['category_id'] == null) {
                                                    $grouped_services['uncategorized'][] = $service;
                                                }
                                            }

                                            foreach ($grouped_services as $key => $group) {
                                                $group_label =
                                                    $key !== 'uncategorized'
                                                        ? e($group[0]['category_name'])
                                                        : 'Uncategorized';

                                                if (count($group) > 0) {
                                                    echo '<optgroup label="' . $group_label . '">';

                                                    foreach ($group as $service) {
                                                        echo '<option value="' .
                                                            $service['id'] .
                                                            '">' .
                                                            e($service['name']) .
                                                            '</option>';
                                                    }

                                                    echo '</optgroup>';
                                                }
                                            }
                                        } else {
                                            foreach ($available_services as $service) {
                                                echo '<option value="' .
                                                    $service['id'] .
                                                    '">' .
                                                    e($service['name']) .
                                                    '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <?php slot('after_select_appointment_service'); ?>

                                <div class="mb-3">
                                    <label for="select-provider" class="sb-label">
                                        <?= lang('provider') ?>
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="select-provider" class="required sb-input"></select>
                                </div>

                                <?php slot('after_select_appointment_provider'); ?>

                                <div class="mb-3">
                                    <?php component('color_selection', ['attributes' => 'id="appointment-color"']); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="appointment-location" class="sb-label">
                                        <?= lang('location') ?>
                                    </label>
                                    <input id="appointment-location" class="sb-input">
                                </div>

                                <div class="mb-3">
                                    <label for="appointment-status" class="sb-label">
                                        <?= lang('status') ?>
                                    </label>
                                    <select id="appointment-status" class="sb-input">
                                        <?php foreach ($appointment_status_options as $appointment_status_option): ?>
                                            <option value="<?= e($appointment_status_option) ?>">
                                                <?= e($appointment_status_option) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="mb-3">
                                    <label for="start-datetime"
                                           class="sb-label"><?= lang('start_date_time') ?></label>
                                    <input id="start-datetime" class="required sb-input">
                                </div>

                                <div class="mb-3">
                                    <label for="end-datetime" class="sb-label"><?= lang('end_date_time') ?></label>
                                    <input id="end-datetime" class="required sb-input">
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label">
                                        <?= lang('timezone') ?>
                                    </label>

                                    <div
                                        class="border border-gray-200 dark:border-gray-600 rounded-lg flex justify-between items-center bg-gray-50 dark:bg-gray-700 timezone-info">
                                        <div class="border-r border-gray-200 dark:border-gray-600 w-1/2 p-1 text-center">
                                            <small class="text-gray-600 dark:text-gray-300">
                                                <?= lang('provider') ?>:
                                                <span class="provider-timezone">
                                                    -
                                                </span>
                                            </small>
                                        </div>
                                        <div class="w-1/2 p-1 text-center">
                                            <small class="text-gray-600 dark:text-gray-300">
                                                <?= lang('current_user') ?>:
                                                <span>
                                                    <?= $timezones[session('timezone', 'UTC')] ?>
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="appointment-notes" class="sb-label">
                                        <?= lang('notes') ?>
                                        <?php if ($require_notes): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <textarea id="appointment-notes" class="<?= $require_notes
                                        ? 'required'
                                        : '' ?> sb-input" rows="3"></textarea>
                                </div>

                                <?php slot('after_primary_appointment_fields'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <?php slot('after_appointment_details'); ?>

                    <br>

                    <fieldset>
                        <h5 class="text-gray-500 dark:text-gray-400 mb-3 font-light">
                            <?= lang('customer_details_title') ?>
                            <button id="new-customer" class="sb-btn-ghost text-sm px-2 py-1" type="button"
                                    data-tippy-content="<?= lang('clear_fields_add_existing_customer_hint') ?>">
                                <i class="fas fa-plus-square mr-2"></i>
                                <?= lang('new') ?>
                            </button>
                            <button id="select-customer" class="sb-btn-ghost text-sm px-2 py-1" type="button"
                                    data-tippy-content="<?= lang('pick_existing_customer_hint') ?>">
                                <i class="fas fa-hand-pointer mr-2"></i>
                                <span>
                                    <?= lang('select') ?>
                                </span>
                            </button>

                            <input id="filter-existing-customers"
                                   placeholder="<?= lang('type_to_filter_customers') ?>"
                                   style="display: none;" class="sb-input text-sm">
                        </h5>

                        <div id="existing-customers-list" style="display: none;"></div>

                        <input id="customer-id" type="hidden">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <div class="mb-3">
                                    <label for="first-name" class="sb-label">
                                        <?= lang('first_name') ?>
                                        <?php if ($require_first_name): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" id="first-name"
                                           class="<?= $require_first_name ? 'required' : '' ?> sb-input"
                                           maxlength="100"/>
                                </div>

                                <div class="mb-3">
                                    <label for="last-name" class="sb-label">
                                        <?= lang('last_name') ?>
                                        <?php if ($require_last_name): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" id="last-name"
                                           class="<?= $require_last_name ? 'required' : '' ?> sb-input"
                                           maxlength="120"/>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="sb-label">
                                        <?= lang('email') ?>
                                        <?php if ($require_email): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" id="email"
                                           class="<?= $require_email ? 'required' : '' ?> sb-input"
                                           maxlength="120"/>
                                </div>

                                <div class="mb-3">
                                    <label for="phone-number" class="sb-label">
                                        <?= lang('phone_number') ?>
                                        <?php if ($require_phone_number): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" id="phone-number" maxlength="60"
                                           class="<?= $require_phone_number ? 'required' : '' ?> sb-input"/>
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

                                <?php component('custom_fields'); ?>

                                <?php slot('after_primary_customer_custom_fields'); ?>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label for="address" class="sb-label">
                                        <?= lang('address') ?>
                                        <?php if ($require_address): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" id="address"
                                           class="<?= $require_address ? 'required' : '' ?> sb-input"
                                           maxlength="120"/>
                                </div>

                                <div class="mb-3">
                                    <label for="city" class="sb-label">
                                        <?= lang('city') ?>
                                        <?php if ($require_city): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" id="city"
                                           class="<?= $require_city ? 'required' : '' ?> sb-input"
                                           maxlength="120"/>
                                </div>

                                <div class="mb-3">
                                    <label for="zip-code" class="sb-label">
                                        <?= lang('zip_code') ?>
                                        <?php if ($require_zip_code): ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" id="zip-code"
                                           class="<?= $require_zip_code ? 'required' : '' ?> sb-input"
                                           maxlength="120"/>
                                </div>

                                <div class="mb-3">
                                    <label class="sb-label" for="timezone">
                                        <?= lang('timezone') ?>
                                        <span class="text-red-500" hidden>*</span>
                                    </label>
                                    <?php component('timezone_dropdown', [
                                        'attributes' => 'id="timezone" class="sb-input required"',
                                        'grouped_timezones' => vars('grouped_timezones'),
                                    ]); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="customer-notes" class="sb-label">
                                        <?= lang('notes') ?>
                                    </label>
                                    <textarea id="customer-notes" rows="2" class="sb-input"></textarea>
                                </div>

                                <?php slot('after_primary_customer_fields'); ?>
                            </div>
                        </div>
                    </fieldset>

                    <?php slot('after_customer_details'); ?>
                </form>
            </div>

            <div class="flex justify-end gap-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <?php slot('before_appointment_actions'); ?>

                <button class="sb-btn-secondary" data-dismiss="modal">
                    <?= lang('cancel') ?>
                </button>
                <button id="save-appointment" class="sb-btn-primary">
                    <i class="fas fa-check-square mr-2"></i>
                    <?= lang('save') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/components/appointments_modal.js') ?>"></script>

<?php end_section('scripts'); ?>
