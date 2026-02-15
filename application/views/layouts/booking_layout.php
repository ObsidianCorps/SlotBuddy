<!doctype html>
<html lang="<?= config('language_code') ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#6366f1">
    <meta property="og:title" content="<?= lang('page_title') . ' ' . vars('company_name') ?> | SlotBuddy"/>
    <meta property="og:description" content="Book Your Appointment"/>
    <meta property="og:url" content="<?= base_url() ?>">
    <meta property="og:type" content="website">
    <?php slot('meta'); ?>
    <title><?= lang('page_title') . ' ' . vars('company_name') ?> | SlotBuddy</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <?php component('company_color_style', ['company_color' => vars('company_color')]); ?>
    <?= vite_assets('src/booking.js') ?>
    <?php slot('styles'); ?>
</head>
<body class="min-h-full bg-gray-50 dark:bg-gray-950 flex items-center justify-center p-4 sm:p-8">
    <div class="w-full max-w-4xl">
        <?php slot('content'); ?>
        <p class="mt-6 text-center text-sm text-gray-400 dark:text-gray-500">
            Powered by <a href="https://github.com/ppa/SlotBuddy" class="hover:text-accent transition-colors">SlotBuddy</a>
        </p>
    </div>

    <?php component('js_vars_script'); ?>
    <?php component('js_lang_script'); ?>
    <?php component('google_analytics_script', ['google_analytics_code' => vars('google_analytics_code')]); ?>
    <?php component('matomo_analytics_script', [
        'matomo_analytics_url' => vars('matomo_analytics_url'),
        'matomo_analytics_site_id' => vars('matomo_analytics_site_id'),
    ]); ?>
    <?php slot('scripts'); ?>
</body>
</html>
