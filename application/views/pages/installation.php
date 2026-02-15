<!doctype html>
<html lang="<?= config('language_code') ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Installation | SlotBuddy</title>

    <link rel="icon" type="image/x-icon" href="<?= asset_url('assets/img/favicon.ico') ?>">
    <?= vite_assets('src/message.js') ?>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
<div id="loading" class="d-none fixed inset-0 z-50 flex items-center justify-center bg-black/20">
    <div class="h-8 w-8 animate-spin rounded-full border-4 border-gray-300 border-t-accent"></div>
</div>

<header class="bg-white dark:bg-gray-800 shadow-sm mb-6">
    <div class="max-w-5xl mx-auto px-4 py-4">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white page-title">SlotBuddy Installation</h1>
    </div>
</header>

<div class="max-w-5xl mx-auto px-4 min-h-full">
    <div class="mb-8">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Welcome to the SlotBuddy installation page.</h3>
        <p class="text-gray-700 dark:text-gray-300">
            This page will help you set the main settings of your SlotBuddy installation. You will be able to
            edit these settings and many more in the backend session of your system. Remember to use the
            <strong class="text-primary-600 dark:text-primary-400"><?= site_url('user/login') ?></strong> URL to connect to the backend section
            of SlotBuddy.

            If you face any problems during the usage of SlotBuddy you can always check the
            <a href="https://slotbuddy.org/docs.html" class="text-primary-600 hover:text-primary-700 dark:text-primary-400">Documentation</a> and
            <a href="https://groups.google.com/group/slotbuddy" class="text-primary-600 hover:text-primary-700 dark:text-primary-400">Support Group</a> for getting help. You may also
            submit new issues on
            <a href="https://github.com/ppa/SlotBuddy/issues" class="text-primary-600 hover:text-primary-700 dark:text-primary-400">GitHub Issues</a>
            in order to help our development process.
        </p>
    </div>

    <div class="alert rounded-lg p-3 mb-3 text-sm" hidden></div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
        <div class="admin-settings">
            <h3 class="text-gray-500 dark:text-gray-400 mb-3 font-light">Administrator</h3>

            <div class="mb-3">
                <label class="sb-label" for="first-name">
                    <?= lang('first_name') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="first-name" class="sb-input required" maxlength="256">
            </div>

            <div class="mb-3">
                <label class="sb-label" for="last-name">
                    <?= lang('last_name') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="last-name" class="sb-input required" maxlength="512">
            </div>

            <div class="mb-3">
                <label class="sb-label" for="email">
                    <?= lang('email') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="email" class="sb-input required" maxlength="512">
            </div>

            <div class="mb-3">
                <label class="sb-label" for="phone-number">
                    <?= lang('phone_number') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="phone-number" class="sb-input required" maxlength="128">
            </div>

            <div class="mb-3">
                <label class="sb-label" for="username">
                    <?= lang('username') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="username" class="sb-input required" maxlength="256">
            </div>

            <div class="mb-3">
                <label class="sb-label" for="password">
                    <?= lang('password') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password" class="sb-input required" maxlength="512">
            </div>

            <div class="mb-3">
                <label class="sb-label" for="password-confirm">
                    <?= lang('retype_password') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password-confirm" class="sb-input required" maxlength="512">
            </div>

            <div class="mb-3">
                <label class="sb-label" for="language">
                    <?= lang('language') ?>
                    <span class="text-red-500">*</span>
                </label>
                <select id="language" class="sb-input required">
                    <?php
                    $config_lang = config('language');
                    foreach (vars('available_languages') as $lang): ?>
                        <option value="<?= $lang ?>"<?= $lang == $config_lang ? ' selected' : '' ?>>
                            <?= ucfirst($lang) ?>
                        </option>
                    <?php endforeach;
                    ?>
                </select>
            </div>

        </div>

        <div class="company-settings">
            <h3 class="text-gray-500 dark:text-gray-400 mb-3 font-light"><?= lang('company') ?></h3>

            <div class="mb-3">
                <label class="sb-label" for="company-name">
                    <?= lang('company_name') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="company-name" data-field="company_name" class="required sb-input">
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <small>
                        <?= lang('company_name_hint') ?>
                    </small>
                </div>
            </div>

            <div class="mb-3">
                <label class="sb-label" for="company-email">
                    <?= lang('company_email') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="company-email" data-field="company_email" class="required sb-input">
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <small>
                        <?= lang('company_email_hint') ?>
                    </small>
                </div>
            </div>

            <div class="mb-3">
                <label class="sb-label" for="company-link">
                    <?= lang('company_link') ?>
                    <span class="text-red-500">*</span>
                </label>
                <input id="company-link" data-field="company_link" class="required sb-input">
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <small>
                        <?= lang('company_link_hint') ?>
                    </small>
                </div>
            </div>

        </div>
    </div>

    <br>

    <p class="text-gray-700 dark:text-gray-300">
        You will be able to set your business logic in the backend settings page after the installation is complete.
        <br>
        Press the following button to complete the installation process.
    </p>

    <br>

    <div class="mb-2">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">License</h3>
        <p class="text-gray-700 dark:text-gray-300">
        SlotBuddy is licensed under the <span class="inline-block bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs font-medium px-2 py-0.5 rounded">GPL-3.0 license</span>. By using the
        code
        of SlotBuddy in any way <br> you agree with the terms described in the following url:
        <a href="https://www.gnu.org/licenses/gpl-3.0.en.html" class="text-primary-600 hover:text-primary-700 dark:text-primary-400">https://www.gnu.org/licenses/gpl-3.0.en.html</a>
        </p>
    </div>

    <br>

    <button type="button" id="install" class="sb-btn-primary">
        Install SlotBuddy
    </button>
</div>

<footer class="text-center text-gray-500 dark:text-gray-400 py-6 mt-8">
    Powered by <a href="https://slotbuddy.org" class="text-primary-600 hover:text-primary-700 dark:text-primary-400">SlotBuddy</a>
</footer>

<?php component('js_vars_script'); ?>
<?php component('js_lang_script'); ?>

<script src="<?= asset_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= asset_url('assets/js/app.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/message.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/validation.js') ?>"></script>
<script src="<?= asset_url('assets/js/utils/url.js') ?>"></script>
<script src="<?= asset_url('assets/js/pages/installation.js') ?>"></script>

</body>
</html>
