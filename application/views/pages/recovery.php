<?php extend('layouts/account_layout'); ?>

<?php section('content'); ?>

<div class="sb-card p-8">
    <div class="flex justify-center mb-6">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="SlotBuddy" class="h-16 w-16">
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-1">
        <?= lang('forgot_your_password') ?>
    </h2>

    <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-6">
        <?= lang('type_username_and_email_for_new_password') ?>
    </p>

    <div id="recovery-message" class="hidden mb-4 rounded-lg px-4 py-3 text-sm">
    </div>

    <form id="recovery-form" class="space-y-4">
        <div>
            <label for="username" class="sb-label">
                <?= lang('username') ?>
            </label>
            <input type="text" id="username" placeholder="<?= lang('enter_username_here') ?>" class="sb-input" required />
        </div>

        <div>
            <label for="email" class="sb-label">
                <?= lang('email') ?>
            </label>
            <input type="email" id="email" placeholder="<?= lang('enter_email_here') ?>" class="sb-input" required />
        </div>

        <button type="submit" id="get-new-password" class="sb-btn-primary w-full">
            <?= lang('regenerate_password') ?>
        </button>

        <p class="text-center">
            <a href="<?= site_url('login') ?>" class="text-sm text-accent hover:text-accent-600 transition-colors">
                <?= lang('go_to_login') ?>
            </a>
        </p>
    </form>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('recovery-form');
    var messageEl = document.getElementById('recovery-message');
    var submitBtn = document.getElementById('get-new-password');

    function showMessage(text, isError) {
        messageEl.textContent = text;
        messageEl.className = 'mb-4 rounded-lg px-4 py-3 text-sm';
        if (isError) {
            messageEl.classList.add('bg-red-50', 'dark:bg-red-900/30', 'border', 'border-red-200', 'dark:border-red-800', 'text-red-700', 'dark:text-red-400');
        } else {
            messageEl.classList.add('bg-green-50', 'dark:bg-green-900/30', 'border', 'border-green-200', 'dark:border-green-800', 'text-green-700', 'dark:text-green-400');
        }
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        var username = document.getElementById('username').value.trim();
        var email = document.getElementById('email').value.trim();

        if (!username || !email) {
            showMessage((window.__slotbuddy_lang && window.__slotbuddy_lang.fields_are_required) || 'All fields are required.', true);
            return;
        }

        messageEl.className = 'hidden mb-4 rounded-lg px-4 py-3 text-sm';
        submitBtn.disabled = true;

        try {
            var baseUrl = ((window.__slotbuddy_vars && window.__slotbuddy_vars.base_url) || '/').replace(/\/$/, '');
            var csrfToken = (window.__slotbuddy_vars && window.__slotbuddy_vars.csrf_token) || '';

            var response = await fetch(baseUrl + '/recovery/perform', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'csrf_token=' + encodeURIComponent(csrfToken)
                    + '&username=' + encodeURIComponent(username)
                    + '&email=' + encodeURIComponent(email),
            });

            var result = await response.json();

            if (result.success) {
                showMessage((window.__slotbuddy_lang && window.__slotbuddy_lang.new_password_sent_with_email) || 'A new password has been sent to your email.', false);
            } else {
                showMessage((window.__slotbuddy_lang && window.__slotbuddy_lang.recovery_failed) || 'Please enter a valid username and email address to get a new password.', true);
            }
        } catch (error) {
            showMessage((window.__slotbuddy_lang && window.__slotbuddy_lang.recovery_failed) || 'The operation failed. Please try again.', true);
        } finally {
            submitBtn.disabled = false;
        }
    });
});
</script>

<?php end_section('scripts'); ?>
