<?php extend('layouts/account_layout'); ?>

<?php section('content'); ?>

<div class="sb-card p-8">
    <div class="flex justify-center mb-6">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="SlotBuddy" class="h-16 w-16">
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-1">
        <?= lang('backend_section') ?>
    </h2>

    <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-6">
        <?= lang('you_need_to_login') ?>
    </p>

    <div id="login-error" class="hidden mb-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 px-4 py-3 text-sm text-red-700 dark:text-red-400">
    </div>

    <form id="login-form" class="space-y-4">
        <div>
            <label for="username" class="sb-label">
                <?= lang('username') ?>
            </label>
            <input type="text" id="username" placeholder="<?= lang('enter_username_here') ?>" class="sb-input" required />
        </div>

        <div>
            <label for="password" class="sb-label">
                <?= lang('password') ?>
            </label>
            <input type="password" id="password" placeholder="<?= lang('enter_password_here') ?>" class="sb-input" required />
        </div>

        <button type="submit" id="login" class="sb-btn-primary w-full">
            <?= lang('login') ?>
        </button>

        <p class="text-center">
            <a href="<?= site_url('recovery') ?>" class="text-sm text-accent hover:text-accent-600 transition-colors">
                <?= lang('forgot_your_password') ?>
            </a>
        </p>
    </form>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('login-form');
    var errorEl = document.getElementById('login-error');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        var username = document.getElementById('username').value.trim();
        var password = document.getElementById('password').value.trim();

        if (!username || !password) {
            errorEl.textContent = (window.__slotbuddy_lang && window.__slotbuddy_lang.fields_are_required) || 'All fields are required.';
            errorEl.classList.remove('hidden');
            return;
        }

        errorEl.classList.add('hidden');

        var submitBtn = document.getElementById('login');
        submitBtn.disabled = true;

        try {
            var baseUrl = ((window.__slotbuddy_vars && window.__slotbuddy_vars.base_url) || '/').replace(/\/$/, '');
            var csrfToken = (window.__slotbuddy_vars && window.__slotbuddy_vars.csrf_token) || '';

            var response = await fetch(baseUrl + '/login/validate', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'csrf_token=' + encodeURIComponent(csrfToken)
                    + '&username=' + encodeURIComponent(username)
                    + '&password=' + encodeURIComponent(password),
            });

            var result = await response.json();

            if (result.success) {
                window.location.href = (window.__slotbuddy_vars && window.__slotbuddy_vars.dest_url) || baseUrl + '/calendar';
            } else {
                errorEl.textContent = (window.__slotbuddy_lang && window.__slotbuddy_lang.login_failed) || 'Login failed. Please try again.';
                errorEl.classList.remove('hidden');
            }
        } catch (error) {
            errorEl.textContent = (window.__slotbuddy_lang && window.__slotbuddy_lang.login_failed) || 'Login failed. Please try again.';
            errorEl.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
        }
    });
});
</script>

<?php end_section('scripts'); ?>
