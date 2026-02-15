<?php
/**
 * Local variables.
 *
 * @var array $roles
 */
?>

<div id="ldap-import-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" data-dismiss="modal"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?= lang('import') ?></h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl" data-dismiss="modal">&times;</button>
            </div>

            <div class="p-4">
                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-ldap-dn">
                        <?= lang('ldap_dn') ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input id="ldap-import-ldap-dn" class="sb-input required" maxlength="256">
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-role-slug">
                        <?= lang('role') ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <select id="ldap-import-role-slug" class="sb-input required">
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role['slug'] ?>">
                                <?= $role['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-first-name">
                        <?= lang('first_name') ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input id="ldap-import-first-name" class="sb-input required" maxlength="256">
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-last-name">
                        <?= lang('last_name') ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input id="ldap-import-last-name" class="sb-input required" maxlength="256">
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-email">
                        <?= lang('email') ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input id="ldap-import-email" class="sb-input required" max="512">
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-phone-number">
                        <?= lang('phone_number') ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input id="ldap-import-phone-number" class="sb-input required" max="128">
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-username">
                        <?= lang('username') ?>
                    </label>
                    <input id="ldap-import-username" class="sb-input" maxlength="256">
                </div>

                <div class="mb-3">
                    <label class="sb-label" for="ldap-import-password">
                        <?= lang('password') ?>
                    </label>
                    <input type="password" id="ldap-import-password" class="sb-input"
                           maxlength="512" autocomplete="new-password">
                </div>
            </div>

            <div class="flex justify-end gap-3 p-4 border-t border-gray-200 dark:border-gray-700">
                <button class="sb-btn-secondary" data-dismiss="modal">
                    <?= lang('cancel') ?>
                </button>
                <button id="ldap-import-save" class="sb-btn-primary">
                    <i class="fas fa-check-square mr-2"></i>
                    <?= lang('save') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php section('scripts'); ?>

<script src="<?= asset_url('assets/js/components/ldap_import_modal.js') ?>"></script>

<?php end_section('scripts'); ?>
