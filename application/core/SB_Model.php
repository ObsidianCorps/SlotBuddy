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
 * SlotBuddy model.
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
class SB_Model extends CI_Model
{
    /**
     * @var array
     */
    protected array $casts = [];

    /**
     * SB_Model constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get a specific field value from the database.
     *
     * @param string $field Name of the value to be returned.
     * @param int $record_id Record ID.
     *
     * @return string Returns the selected record value from the database.
     *
     * @throws InvalidArgumentException
     *
     * @deprecated Since 1.5
     */
    public function get_value(string $field, int $record_id): string
    {
        if (method_exists($this, 'value')) {
            return $this->value($field, $record_id);
        }

        throw new RuntimeException('The "get_value" is not defined in model: ', __CLASS__);
    }

    /**
     * Get a specific record from the database.
     *
     * @param int $record_id The ID of the record to be returned.
     *
     * @return array Returns an array with the record data.
     *
     * @throws InvalidArgumentException
     *
     * @deprecated Since 1.5
     */
    public function get_row(int $record_id): array
    {
        if (method_exists($this, 'find')) {
            return $this->find($record_id);
        }

        throw new RuntimeException('The "get_row" is not defined in model: ', __CLASS__);
    }

    /**
     * Get all records that match the provided criteria.
     *
     * param array|string $where Where conditions
     * @param int|null $limit Record limit.
     * @param int|null $offset Record offset.
     * @param string|null $order_by Order by.
     *
     * @return array Returns an array of records.
     */
    public function get_batch($where = null, ?int $limit = null, ?int $offset = null, ?string $order_by = null): array
    {
        return $this->get($where, $limit, $offset, $order_by);
    }

    /**
     * Save (insert or update) a record.
     *
     * @param array $record Associative array with the record data.
     *
     * @return int Returns the record ID.
     *
     * @throws InvalidArgumentException
     */
    public function add(array $record): int
    {
        return $this->save($record);
    }

    /**
     * Easily cast fields to the correct data type.
     *
     * The integrated MySQL library will return all values as strings, something that can easily becoming problematic,
     * especially when comparing database values.
     *
     * @param array $record Record data.
     */
    public function cast(array &$record)
    {
        foreach ($this->casts as $attribute => $cast) {
            if (!isset($record[$attribute])) {
                continue;
            }

            switch ($cast) {
                case 'integer':
                    $record[$attribute] = (int) $record[$attribute];
                    break;

                case 'float':
                    $record[$attribute] = (float) $record[$attribute];
                    break;

                case 'boolean':
                    $record[$attribute] = (bool) $record[$attribute];
                    break;

                case 'string':
                    $record[$attribute] = (string) $record[$attribute];
                    break;

                default:
                    throw new RuntimeException('Unsupported cast type provided: ' . $cast);
            }
        }
    }

    /**
     * Only keep the requested fields of the provided record.
     *
     * @param array $record Record data (single or multiple records).
     * @param array $fields Requested field names.
     */
    public function only(array &$record, array $fields)
    {
        if (is_assoc($record)) {
            $record = array_fields($record, $fields);
        } else {
            foreach ($record as &$record_item) {
                $record_item = array_fields($record_item, $fields);
            }
        }
    }

    /**
     * Ensure a field exists in an array by using its value or NULL.
     *
     * @param array $record Record data (single or multiple records).
     * @param array $fields Requested field names.
     */
    public function optional(array &$record, array $fields)
    {
        if (is_assoc($record)) {
            foreach ($fields as $field => $default) {
                $record[$field] = $record[$field] ?? null ?: $default;
            }
        } else {
            foreach ($record as &$record_item) {
                foreach ($fields as $field => $default) {
                    $record_item[$field] = $record_item[$field] ?? null ?: $default;
                }
            }
        }
    }

    /**
     * Get the DB field name based on an API field name.
     *
     * @param string $api_field API resource key.
     *
     * @return string|null Returns the column field or null if non found.
     */
    public function db_field(string $api_field): ?string
    {
        return $this->api_resource[$api_field] ?? null;
    }

    /**
     * Get a SQL expression for full-name concatenation that works on both MySQL and SQLite.
     *
     * @return string
     */
    protected function full_name_expr(): string
    {
        if ($this->db->dbdriver === 'sqlite3') {
            return "first_name || ' ' || last_name";
        }

        return 'CONCAT_WS(" ", first_name, last_name)';
    }

    /**
     * Escape the order by statements in order to avoid SQL injection issues
     *
     * @param string $order_by
     *
     * @return string
     */
    function quote_order_by(string $order_by): string
    {
        $parts = explode(',', $order_by);
        $quoted_parts = [];

        foreach ($parts as $part) {
            $tokens = preg_split('/\s+/', trim($part));
            $column = array_shift($tokens); // first token is column
            $direction = strtoupper($tokens[0] ?? ''); // optional ASC/DESC

            // Add backticks (or quotes) around column name
            $column = '`' . str_replace('`', '', $column) . '`';

            if ($direction === 'ASC' || $direction === 'DESC') {
                $quoted_parts[] = $column . ' ' . $direction;
            } else {
                $quoted_parts[] = $column;
            }
        }

        return implode(', ', $quoted_parts);
    }
}
