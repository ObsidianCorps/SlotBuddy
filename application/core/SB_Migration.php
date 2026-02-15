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

require_once BASEPATH . 'libraries/Migration.php';

/**
 * SlotBuddy migration.
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
class SB_Migration extends CI_Migration
{
    /**
     * Get the current migration version.
     *
     * @return int
     */
    public function current_version(): int
    {
        return $this->_get_version();
    }

    /**
     * Create a database table, stripping MySQL-specific attributes on SQLite.
     *
     * @param string $table Table name.
     * @param bool $if_not_exists Whether to add IF NOT EXISTS.
     * @param array $attributes Table attributes (e.g. ['engine' => 'InnoDB']).
     *
     * @return bool
     */
    protected function create_table(string $table, bool $if_not_exists = false, array $attributes = []): bool
    {
        if ($this->db->dbdriver === 'sqlite3') {
            $attributes = [];
        }

        return $this->dbforge->create_table($table, $if_not_exists, $attributes);
    }

    /**
     * Modify a table column, skipped on SQLite (uses type affinity, so column type changes are no-ops).
     *
     * @param string $table Table name.
     * @param array $fields Column definitions.
     *
     * @return bool
     */
    protected function modify_column(string $table, array $fields): bool
    {
        if ($this->db->dbdriver === 'sqlite3') {
            return TRUE;
        }

        return $this->dbforge->modify_column($table, $fields);
    }

    /**
     * Drop a table column, skipped on SQLite (CI3's SQLite3 forge doesn't support it).
     *
     * @param string $table Table name.
     * @param string $column Column name.
     *
     * @return bool
     */
    protected function drop_column(string $table, string $column): bool
    {
        if ($this->db->dbdriver === 'sqlite3') {
            return TRUE;
        }

        return $this->dbforge->drop_column($table, $column);
    }

    /**
     * Execute a raw SQL query, skipping FK-related ALTER TABLE statements on SQLite.
     *
     * SQLite does not support ALTER TABLE ADD/DROP FOREIGN KEY. Since all raw queries
     * in migrations are FK operations, this method safely skips them on SQLite while
     * running them normally on MySQL.
     *
     * @param string $sql Raw SQL query.
     *
     * @return mixed Query result or TRUE if skipped.
     */
    protected function execute(string $sql)
    {
        if ($this->db->dbdriver === 'sqlite3') {
            return TRUE;
        }

        return $this->db->query($sql);
    }
}
