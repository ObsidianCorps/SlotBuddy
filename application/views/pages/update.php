<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Update | SlotBuddy</title>

    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">
    <?= vite_assets('src/message.js') ?>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
<header class="bg-white dark:bg-gray-800 shadow-sm mb-6">
    <div class="max-w-5xl mx-auto px-4 py-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white page-title">SlotBuddy Update</h1>
    </div>
</header>

<div class="max-w-5xl mx-auto px-4">
    <div>
        <div>
            <?php if (vars('success')): ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Success!</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">
                        The database got updated successfully.
                    </p>
                    <hr class="my-4 border-gray-200 dark:border-gray-700">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        You can now use the latest SlotBuddy version.
                    </p>
                    <a href="<?= site_url('about') ?>" class="sb-btn-primary inline-block">
                                                <?= lang('backend_section') ?>
                    </a>
                </div>
            <?php else: ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 mb-6">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Failure!</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-4">
                        There was an error during the update process.
                    </p>
                    <hr class="my-4 border-gray-200 dark:border-gray-700">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        Please restore your database backup.
                    </p>
                    <a href="<?= site_url('login') ?>" class="sb-btn-primary inline-block">
                                                <?= lang('backend_section') ?>
                    </a>

                    <p class="text-gray-700 dark:text-gray-300 mt-4">
                        Please restore your database backup.
                    </p>
                </div>

                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 text-left text-gray-700 dark:text-gray-300">
                    Error Message: <?= vars('exception') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="text-center text-gray-500 dark:text-gray-400 py-6 mt-8">
    Powered by <a href="https://slotbuddy.org" class="text-primary-600 hover:text-primary-700 dark:text-primary-400">SlotBuddy</a>
</footer>

</body>
</html>
