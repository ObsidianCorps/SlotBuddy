<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Online Appointment Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) Alex Tselegidis
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://easyappointments.org
 * @since       v1.4.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments input.
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
 *
 * @property string $raw_input_stream
 */
class SB_Input extends CI_Input
{
    /**
     * Fetch an item from JSON data.
     *
     * @param string|null $index Index for item to be fetched from the JSON payload.
     * @param bool|false $xss_clean Whether to apply XSS filtering
     *
     * @return mixed
     */
    public function json(?string $index = null, bool $xss_clean = false): mixed
    {
        /** @var SB_Controller $CI */
        $CI = &get_instance();

        if (strpos((string) $CI->input->get_request_header('Content-Type'), 'application/json') === false) {
            return null;
        }

        $input_stream = $CI->input->raw_input_stream;

        if (empty($input_stream)) {
            return null;
        }

        $payload = json_decode($input_stream, true);

        if ($xss_clean) {
            foreach ($payload as $name => $value) {
                $payload[$name] = $CI->security->xss_clean($value);
            }
        }

        if (empty($index)) {
            return $payload;
        }

        return $payload[$index] ?? null;
    }
}
