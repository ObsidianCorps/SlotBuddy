<?php
/**
 * Local variables.
 *
 * @var bool $display_login_button
 */
?>

<div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200 dark:border-gray-800">
    <span id="select-language" class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400 cursor-pointer hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
        <?= ucfirst(config('language')) ?>
    </span>

    <?php if ($display_login_button): ?>
        <a class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400 hover:text-accent transition-colors"
           href="<?= session('user_id') ? site_url('calendar') : site_url('login') ?>">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
            <?= session('user_id') ? lang('backend_section') : lang('login') ?>
        </a>
    <?php endif; ?>
</div>
