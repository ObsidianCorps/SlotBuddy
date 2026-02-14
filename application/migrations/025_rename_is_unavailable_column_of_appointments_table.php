<?php defined('BASEPATH') or exit('No direct script access allowed');

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

class Migration_Rename_is_unavailable_column_of_appointments_table extends SB_Migration
{
    /**
     * Upgrade method.
     */
    public function up(): void
    {
        if ($this->db->field_exists('is_unavailable', 'appointments')) {
            $fields = [
                'is_unavailable' => [
                    'name' => 'is_unavailability',
                    'type' => 'TINYINT',
                    'constraint' => '4',
                    'default' => '0',
                ],
            ];

            $this->dbforge->modify_column('appointments', $fields);
        }
    }

    /**
     * Downgrade method.
     */
    public function down(): void
    {
        if ($this->db->field_exists('is_unavailability', 'appointments')) {
            $fields = [
                'is_unavailability' => [
                    'name' => 'is_unavailable',
                    'type' => 'TINYINT',
                    'constraint' => '4',
                    'default' => '0',
                ],
            ];

            $this->dbforge->modify_column('appointments', $fields);
        }
    }
}
