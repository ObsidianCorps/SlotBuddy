<!doctype html>
<html lang="<?= config('language_code') ?>" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#6366f1">
    <?php slot('meta'); ?>
    <title><?= vars('page_title') ?? lang('account') ?> | SlotBuddy</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <?= vite_assets('src/account.js') ?>
    <?php slot('styles'); ?>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-950 flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <?php slot('content'); ?>

        <p class="mt-6 text-center text-sm text-gray-400 dark:text-gray-500">
            Powered by <a href="https://github.com/ppa/SlotBuddy" class="hover:text-accent transition-colors">SlotBuddy</a>
        </p>
    </div>

    <?php component('js_vars_script'); ?>
    <?php component('js_lang_script'); ?>
    <?php slot('scripts'); ?>
</body>
</html>
