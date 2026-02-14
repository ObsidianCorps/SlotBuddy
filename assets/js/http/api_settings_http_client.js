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
 * API Settings HTTP client.
 *
 * This module implements the API settings related HTTP requests.
 */
App.Http.ApiSettings = (function () {
    /**
     * Save API settings.
     *
     * @param {Object} apiSettings
     *
     * @return {Object}
     */
    function save(apiSettings) {
        const url = App.Utils.Url.siteUrl('api_settings/save');

        const data = {
            csrf_token: vars('csrf_token'),
            api_settings: apiSettings,
        };

        return $.post(url, data);
    }

    return {
        save,
    };
})();
