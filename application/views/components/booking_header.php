<?php
/**
 * Local variables.
 *
 * @var string $company_name
 */
?>

<div class="flex items-center gap-4 mb-6">
    <img src="<?= vars('company_logo') ?: base_url('assets/img/logo.png') ?>"
         alt="logo"
         class="h-12 w-12 rounded-lg object-contain">

    <div class="min-w-0">
        <h1 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
            <?= e($company_name) ?>
        </h1>
        <p id="display-booking-selection" class="text-sm text-gray-500 dark:text-gray-400 truncate">
            <?= lang('service') ?> &middot; <?= lang('provider') ?>
        </p>
    </div>
</div>

<!-- Step indicator -->
<div id="booking-steps" class="flex items-center gap-2 mb-6">
    <button id="step-1" class="book-step flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-colors bg-accent text-white" data-tippy-content="<?= lang('service_and_provider') ?>">
        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-white/20 text-[10px] font-bold">1</span>
        <span class="hidden sm:inline"><?= lang('service_and_provider') ?></span>
    </button>
    <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <button id="step-2" class="book-step flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-colors bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400" data-tippy-content="<?= lang('appointment_date_and_time') ?>">
        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-gray-300 dark:bg-gray-600 text-[10px] font-bold">2</span>
        <span class="hidden sm:inline"><?= lang('appointment_date_and_time') ?></span>
    </button>
    <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <button id="step-3" class="book-step flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-colors bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400" data-tippy-content="<?= lang('customer_information') ?>">
        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-gray-300 dark:bg-gray-600 text-[10px] font-bold">3</span>
        <span class="hidden sm:inline"><?= lang('customer_information') ?></span>
    </button>
    <svg class="w-4 h-4 text-gray-300 dark:text-gray-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <button id="step-4" class="book-step flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-colors bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400" data-tippy-content="<?= lang('appointment_confirmation') ?>">
        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-gray-300 dark:bg-gray-600 text-[10px] font-bold">4</span>
        <span class="hidden sm:inline"><?= lang('confirm') ?></span>
    </button>
</div>
