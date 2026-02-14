/* ----------------------------------------------------------------------------
 * SlotBuddy - Online Appointment Scheduler
 *
 * @package     SlotBuddy
 * @author      SlotBuddy Contributors
 * @copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://github.com/ppa/SlotBuddy
 * @since       v1.5.0
 * ---------------------------------------------------------------------------- */

/**
 * Localization HTTP client.
 *
 * This module implements the account related HTTP requests.
 */
App.Http.Localization = (function () {
    /**
     * Change language.
     *
     * @param {String} language
     */
    function changeLanguage(language) {
        const url = App.Utils.Url.siteUrl('localization/change_language');

        const data = {
            csrf_token: vars('csrf_token'),
            language,
        };

        return $.post(url, data);
    }

    return {
        changeLanguage,
    };
})();
