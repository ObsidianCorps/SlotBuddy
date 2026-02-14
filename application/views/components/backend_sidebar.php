<?php
/**
 * @var string $active_menu
 */
?>
<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-900
              border-r border-gray-200 dark:border-gray-800
              transform -translate-x-full lg:translate-x-0
              transition-all duration-200 flex flex-col">

    <!-- Logo -->
    <div class="h-16 flex items-center gap-3 px-4 border-b border-gray-200 dark:border-gray-800 flex-shrink-0">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="SlotBuddy" class="h-8 w-8 flex-shrink-0">
        <span class="font-semibold text-gray-900 dark:text-white sidebar-label">SlotBuddy</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <!-- Calendar -->
        <?php if (can('view', PRIV_APPOINTMENTS)): ?>
            <a href="<?= site_url('calendar') ?>"
               class="sb-nav-item <?= $active_menu == PRIV_APPOINTMENTS ? 'sb-nav-active' : '' ?>">
                <i class="fas fa-calendar-alt w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('calendar') ?></span>
            </a>
        <?php endif; ?>

        <!-- Customers -->
        <?php if (can('view', PRIV_CUSTOMERS)): ?>
            <a href="<?= site_url('customers') ?>"
               class="sb-nav-item <?= $active_menu == PRIV_CUSTOMERS ? 'sb-nav-active' : '' ?>">
                <i class="fas fa-user-friends w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('customers') ?></span>
            </a>
        <?php endif; ?>

        <!-- Services Section -->
        <?php if (can('view', PRIV_SERVICES)): ?>
            <div class="pt-4 pb-1 px-3">
                <span class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500 sidebar-label">
                    <?= lang('services') ?>
                </span>
            </div>
            <a href="<?= site_url('services') ?>" class="sb-nav-item <?= $active_menu == PRIV_SERVICES ? 'sb-nav-active' : '' ?>">
                <i class="fas fa-business-time w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('services') ?></span>
            </a>
            <a href="<?= site_url('service_categories') ?>" class="sb-nav-item">
                <i class="fas fa-tags w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('categories') ?></span>
            </a>
        <?php endif; ?>

        <!-- Users Section -->
        <?php if (can('view', PRIV_USERS)): ?>
            <div class="pt-4 pb-1 px-3">
                <span class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500 sidebar-label">
                    <?= lang('users') ?>
                </span>
            </div>
            <a href="<?= site_url('providers') ?>" class="sb-nav-item">
                <i class="fas fa-user-md w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('providers') ?></span>
            </a>
            <a href="<?= site_url('secretaries') ?>" class="sb-nav-item">
                <i class="fas fa-user-tie w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('secretaries') ?></span>
            </a>
            <a href="<?= site_url('admins') ?>" class="sb-nav-item">
                <i class="fas fa-user-shield w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('admins') ?></span>
            </a>
        <?php endif; ?>

        <!-- Settings Section -->
        <?php if (can('view', PRIV_SYSTEM_SETTINGS)): ?>
            <div class="pt-4 pb-1 px-3">
                <span class="text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500 sidebar-label">
                    <?= lang('system') ?? 'System' ?>
                </span>
            </div>
            <a href="<?= site_url('general_settings') ?>"
               class="sb-nav-item <?= $active_menu == PRIV_SYSTEM_SETTINGS ? 'sb-nav-active' : '' ?>">
                <i class="fas fa-cog w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-label"><?= lang('settings') ?></span>
            </a>
        <?php endif; ?>
    </nav>

    <!-- Bottom section -->
    <div class="border-t border-gray-200 dark:border-gray-800 p-3 space-y-1 flex-shrink-0">
        <button id="dark-mode-toggle" type="button" class="sb-nav-item w-full">
            <i class="fas fa-moon w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-label"><?= lang('dark_mode') ?? 'Dark mode' ?></span>
        </button>

        <a href="<?= site_url('account') ?>" class="sb-nav-item">
            <i class="fas fa-user-circle w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-label"><?= e(vars('user_display_name')) ?></span>
        </a>

        <a href="<?= site_url('logout') ?>" class="sb-nav-item text-red-500 hover:text-red-600 dark:text-red-400">
            <i class="fas fa-sign-out-alt w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-label"><?= lang('log_out') ?></span>
        </a>

        <button id="sidebar-toggle" type="button" class="sb-nav-item w-full hidden lg:flex">
            <i class="fas fa-chevron-left w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-label"><?= lang('collapse') ?? 'Collapse' ?></span>
        </button>
    </div>
</aside>
