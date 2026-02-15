<!doctype html>
<html lang="<?= config('language_code') ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#6366f1">
    <?php slot('meta'); ?>
    <title><?= vars('page_title') ?? lang('backend_section') ?> | SlotBuddy</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <link rel="icon" sizes="192x192" href="<?= base_url('assets/img/logo.png') ?>">

    <?php component('company_color_style', ['company_color' => setting('company_color')]); ?>

    <?= vite_assets('src/backend.js') ?>
    <?php slot('styles'); ?>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-950">

    <!-- Mobile header -->
    <div class="lg:hidden fixed top-0 inset-x-0 z-30 h-14 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center px-4">
        <button id="mobile-sidebar-toggle" type="button" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
            <i class="fas fa-bars text-gray-600 dark:text-gray-300"></i>
        </button>
        <span class="ml-3 font-semibold text-gray-900 dark:text-white">SlotBuddy</span>
    </div>

    <!-- Sidebar overlay (mobile) -->
    <div id="sidebar-overlay" class="hidden fixed inset-0 z-30 bg-black/50 lg:hidden"></div>

    <?php component('backend_sidebar', ['active_menu' => vars('active_menu')]); ?>

    <!-- Main content -->
    <main id="main-content" class="lg:pl-64 pt-14 lg:pt-0 min-h-screen transition-all duration-200">
        <div class="p-4 lg:p-6">
            <?php slot('content'); ?>
        </div>
    </main>

    <?php component('backend_footer'); ?>

    <?php component('js_vars_script'); ?>
    <?php component('js_lang_script'); ?>

    <!-- Legacy vendor libraries (loaded as regular scripts for backward compat with old page JS) -->
    <script src="<?= asset_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= asset_url('assets/vendor/moment/moment.min.js') ?>"></script>
    <script src="<?= asset_url('assets/vendor/moment-timezone/moment-timezone-with-data.min.js') ?>"></script>
    <script src="<?= asset_url('assets/js/app.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/date.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/file.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/http.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/lang.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/message.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/string.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/url.js') ?>"></script>
    <script src="<?= asset_url('assets/js/utils/validation.js') ?>"></script>

    <?php slot('scripts'); ?>
</body>
</html>
