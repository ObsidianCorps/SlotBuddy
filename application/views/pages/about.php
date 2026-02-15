<?php extend('layouts/backend_layout'); ?>

<?php section('content'); ?>

<div id="about-page" class="max-w-4xl mx-auto px-4 py-6 backend-page">
    <div id="about" class="max-w-3xl mx-auto">

        <div class="text-center my-10">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="SlotBuddy Logo" class="mb-5 mx-auto">

            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                SlotBuddy
            </h3>
            <h6 class="text-primary-600 dark:text-primary-400">
                Online Appointment Scheduler
            </h6>
        </div>

        <p class="mb-10 text-gray-700 dark:text-gray-300">
            <?= lang('about_app_info') ?>
        </p>

        <div class="sb-card mb-10">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h5 class="font-light text-gray-500 dark:text-gray-400 mb-0">
                    <?= lang('current_version') ?>
                </h5>
            </div>
            <div class="p-4">
                <strong class="text-gray-900 dark:text-white">
                    <?= config('version') ?>
                </strong>
            </div>
        </div>

        <h4 class="font-light text-gray-500 dark:text-gray-400 mb-3">
            <?= lang('support') ?>
        </h4>

        <p class="text-gray-700 dark:text-gray-300">
            <?= lang('about_app_support') ?>
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 mb-10">
            <div>
                <a class="sb-btn-ghost block text-center w-full" href="https://slotbuddy.org" target="_blank">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    <?= lang('official_website') ?>
                </a>
            </div>

            <div>
                <a class="sb-btn-ghost block text-center w-full"
                   href="https://groups.google.com/forum/#!forum/slotbuddy" target="_blank">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    <?= lang('support_group') ?>
                </a>
            </div>

            <div>
                <a class="sb-btn-ghost block text-center w-full"
                   href="https://github.com/ppa/SlotBuddy/issues" target="_blank">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    <?= lang('project_issues') ?>
                </a>
            </div>

            <div>
                <a class="sb-btn-ghost block text-center w-full" href="https://facebook.com/slotbuddy" target="_blank">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Facebook
                </a>
            </div>

            <div>
                <a class="sb-btn-ghost block text-center w-full" href="https://x.com/slotbuddy" target="_blank">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    X.com
                </a>
            </div>

            <div>
                <a class="sb-btn-ghost block text-center w-full" href="https://github.com/ppa/SlotBuddy"
                   target="_blank">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Customize SlotBuddy
                </a>
            </div>
        </div>

        <h4 class="font-light text-gray-500 dark:text-gray-400 mb-3">
            <?= lang('license') ?>
        </h4>

        <p class="text-gray-700 dark:text-gray-300">
            <?= lang('about_app_license') ?>
        </p>

        <div class="mb-10">
            <a class="sb-btn-ghost block text-center w-1/2 mx-auto" href="https://www.gnu.org/licenses/gpl-3.0.en.html"
               target="_blank">
                <i class="fas fa-external-link-alt mr-2"></i>
                GPL-3.0
            </a>
        </div>
    </div>
</div>

<?php end_section('content'); ?>
