<?php extend('layouts/account_layout'); ?>

<?php section('content'); ?>

<h3><?= lang('log_out') ?></h3>

<p>
    <small>
        <?= lang('logout_success') ?>
    </small>
</p>

<div class="flex justify-between my-5">
    <a href="<?= site_url('login') ?>" class="sb-btn-secondary">
        <i class="fas fa-wrench mr-2"></i>
        <?= lang('backend_section') ?>
    </a>

    <a href="<?= site_url() ?>" class="sb-btn-primary">
        <i class="fas fa-calendar-alt mr-2"></i>
        <?= lang('book_appointment_title') ?>
    </a>
</div>

<?php end_section('content'); ?>


