<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * SlotBuddy - Online Appointment Scheduler
 *
 * @package     SlotBuddy
 * @author      SlotBuddy Contributors
 * @copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://github.com/ppa/SlotBuddy
 * @since       v1.4.0
 * ---------------------------------------------------------------------------- */

/**
 * SlotBuddy security.
 *
 * @property SB_Benchmark $benchmark
 * @property SB_Cache $cache
 * @property SB_Calendar $calendar
 * @property SB_Config $config
 * @property SB_DB_forge $dbforge
 * @property SB_DB_query_builder $db
 * @property SB_DB_utility $dbutil
 * @property SB_Email $email
 * @property SB_Encrypt $encrypt
 * @property SB_Encryption $encryption
 * @property SB_Exceptions $exceptions
 * @property SB_Hooks $hooks
 * @property SB_Input $input
 * @property SB_Lang $lang
 * @property SB_Loader $load
 * @property SB_Log $log
 * @property SB_Migration $migration
 * @property SB_Output $output
 * @property SB_Profiler $profiler
 * @property SB_Router $router
 * @property SB_Security $security
 * @property SB_Session $session
 * @property SB_Upload $upload
 * @property SB_URI $uri
 */
class SB_Security extends CI_Security
{
    /**
     * CSRF Verify
     *
     * @return    CI_Security
     */
    public function csrf_verify()
    {
        // If it's not a POST request we will set the CSRF cookie
        if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
            return $this->csrf_set_cookie();
        }

        // Check if URI has been whitelisted from CSRF checks
        if ($exclude_uris = config_item('csrf_exclude_uris')) {
            $uri = load_class('URI', 'core');
            foreach ($exclude_uris as $excluded) {
                if (preg_match('#^' . $excluded . '$#i' . (UTF8_ENABLED ? 'u' : ''), $uri->uri_string())) {
                    return $this;
                }
            }
        }

        // Check CSRF token validity, but don't error on mismatch just yet - we'll want to regenerate
        $csrf_token = $_POST[$this->_csrf_token_name] ?? ($_SERVER['HTTP_X_CSRF'] ?? null);

        $valid =
            isset($csrf_token, $_COOKIE[$this->_csrf_cookie_name]) &&
            is_string($csrf_token) &&
            is_string($_COOKIE[$this->_csrf_cookie_name]) &&
            hash_equals($csrf_token, $_COOKIE[$this->_csrf_cookie_name]);

        // We kill this since we're done, and we don't want to pollute the _POST array
        unset($_POST[$this->_csrf_token_name]);

        // Regenerate on every submission?
        if (config_item('csrf_regenerate')) {
            // Nothing should last forever
            unset($_COOKIE[$this->_csrf_cookie_name]);
            $this->_csrf_hash = null;
        }

        $this->_csrf_set_hash();
        $this->csrf_set_cookie();

        if ($valid !== true) {
            $this->csrf_show_error();
        }

        log_message('info', 'CSRF token verified');
        return $this;
    }
}
