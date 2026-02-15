<h4 class="text-gray-500 dark:text-gray-400 py-3 mb-3 border-b border-gray-200 dark:border-gray-800 font-light">
    <?= lang('settings') ?>
</h4>

<nav id="settings-nav" class="flex flex-col gap-1">
    <a class="px-3 py-2 rounded-lg text-sm font-medium transition-colors text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" href="<?= site_url('general_settings') ?>">
        <?= lang('general_settings') ?>
    </a>

    <a class="px-3 py-2 rounded-lg text-sm font-medium transition-colors text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" href="<?= site_url('booking_settings') ?>">
        <?= lang('booking_settings') ?>
    </a>

    <a class="px-3 py-2 rounded-lg text-sm font-medium transition-colors text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" href="<?= site_url('business_settings') ?>">
        <?= lang('business_logic') ?>
    </a>

    <a class="px-3 py-2 rounded-lg text-sm font-medium transition-colors text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" href="<?= site_url('legal_settings') ?>">
        <?= lang('legal_contents') ?>
    </a>

    <a class="px-3 py-2 rounded-lg text-sm font-medium transition-colors text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" href="<?= site_url('integrations') ?>">
        <?= lang('integrations') ?>
    </a>
</nav>
