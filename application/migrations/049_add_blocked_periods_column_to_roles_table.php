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

class Migration_Add_blocked_periods_column_to_roles_table extends SB_Migration
{
    /**
     * Upgrade method.
     */
    public function up(): void
    {
        if (!$this->db->field_exists('blocked_periods', 'roles')) {
            $fields = [
                'blocked_periods' => [
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => true,
                ],
            ];

            $this->dbforge->add_column('roles', $fields);

            $this->db->update('roles', ['blocked_periods' => '15'], ['slug' => 'admin']);

            $this->db->update('roles', ['blocked_periods' => '0'], ['slug !=' => 'admin']);
        }
    }

    /**
     * Downgrade method.
     */
    public function down(): void
    {
        if ($this->db->field_exists('blocked_periods', 'roles')) {
            $this->drop_column('roles', 'blocked_periods');
        }
    }
}
