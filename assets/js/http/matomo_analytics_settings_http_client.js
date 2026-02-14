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
 * Matomo Analytics Settings HTTP client.
 *
 * This module implements the Matomo Analytics settings related HTTP requests.
 */
App.Http.MatomoAnalyticsSettings = (function () {
    /**
     * Save Matomo Analytics settings.
     *
     * @param {Object} matomoAnalyticsSettings
     *
     * @return {Object}
     */
    function save(matomoAnalyticsSettings) {
        const url = App.Utils.Url.siteUrl('matomo_analytics_settings/save');

        const data = {
            csrf_token: vars('csrf_token'),
            matomo_analytics_settings: matomoAnalyticsSettings,
        };

        return $.post(url, data);
    }

    return {
        save,
    };
})();
