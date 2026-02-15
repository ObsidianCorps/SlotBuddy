<?php
/**
 * Local variables.
 *
 * @var array $available_services
 */
?>

<div id="wizard-frame-1" class="wizard-frame hidden">
    <div class="space-y-5">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            <?= lang('service_and_provider') ?>
        </h2>

        <div class="space-y-4">
            <div>
                <label for="select-service" class="sb-label">
                    <?= lang('service') ?>
                </label>
                <select id="select-service" class="sb-input">
                    <option value=""><?= lang('please_select') ?></option>
                    <?php
                    // Group services by category, only if there is at least one service with a parent category.
                    $has_category = false;
                    foreach ($available_services as $service) {
                        if (!empty($service['service_category_id'])) {
                            $has_category = true;
                            break;
                        }
                    }

                    if ($has_category) {
                        $grouped_services = [];

                        foreach ($available_services as $service) {
                            if (!empty($service['service_category_id'])) {
                                if (!isset($grouped_services[$service['service_category_name']])) {
                                    $grouped_services[$service['service_category_name']] = [];
                                }
                                $grouped_services[$service['service_category_name']][] = $service;
                            }
                        }

                        $grouped_services['uncategorized'] = [];
                        foreach ($available_services as $service) {
                            if ($service['service_category_id'] == null) {
                                $grouped_services['uncategorized'][] = $service;
                            }
                        }

                        foreach ($grouped_services as $key => $group) {
                            $group_label = $key !== 'uncategorized' ? $group[0]['service_category_name'] : 'Uncategorized';
                            if (count($group) > 0) {
                                echo '<optgroup label="' . e($group_label) . '">';
                                foreach ($group as $service) {
                                    echo '<option value="' . $service['id'] . '">' . e($service['name']) . '</option>';
                                }
                                echo '</optgroup>';
                            }
                        }
                    } else {
                        foreach ($available_services as $service) {
                            echo '<option value="' . $service['id'] . '">' . e($service['name']) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <?php slot('after_select_service'); ?>

            <div hidden>
                <label for="select-provider" class="sb-label">
                    <?= lang('provider') ?>
                </label>
                <select id="select-provider" class="sb-input">
                    <option value=""><?= lang('please_select') ?></option>
                </select>
            </div>

            <?php slot('after_select_provider'); ?>

            <div id="service-description" class="text-sm text-gray-500 dark:text-gray-400">
                <!-- JS -->
            </div>

            <?php slot('after_service_description'); ?>
        </div>
    </div>

    <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-100 dark:border-gray-800">
        <button type="button" id="button-next-1" class="button-next sb-btn-primary" data-step_index="1">
            <?= lang('next') ?>
            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</div>
