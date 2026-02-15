<?php extend('layouts/message_layout'); ?>

<?php section('content'); ?>

<div>
    <img id="success-icon" class="mt-0 mb-5 mx-auto" src="<?= base_url('assets/img/success.png') ?>" alt="success"/>
</div>

<div class="mb-5">
    <h4 class="mb-5 text-gray-900 dark:text-white"><?= lang('appointment_registered') ?></h4>

    <p class="text-gray-700 dark:text-gray-300">
        <?= lang('appointment_details_was_sent_to_you') ?>
    </p>

    <p class="mb-5 text-gray-500 dark:text-gray-400">
        <small>
            <?= lang('check_spam_folder') ?>
        </small>
    </p>

    <a href="<?= site_url() ?>" class="sb-btn-primary inline-block">
        <i class="fas fa-calendar-alt mr-2"></i>
        <?= lang('go_to_booking_page') ?>
    </a>

    <a href="<?= vars('add_to_google_url') ?>" id="add-to-google-calendar" class="sb-btn-primary inline-block" target="_blank">
        <i class="fas fa-plus mr-2"></i>
        <?= lang('add_to_google_calendar') ?>
    </a>
</div>

<?php end_section('content'); ?>

<?php section('scripts'); ?>

<?php component('google_analytics_script', ['google_analytics_code' => vars('google_analytics_code')]); ?>
<?php component('matomo_analytics_script', [
    'matomo_analytics_url' => vars('matomo_analytics_url'),
    'matomo_analytics_site_id' => vars('matomo_analytics_site_id'),
]); ?>

<?php end_section('scripts'); ?>
