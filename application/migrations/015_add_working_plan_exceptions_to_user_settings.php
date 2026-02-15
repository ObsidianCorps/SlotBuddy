<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * SlotBuddy - Online Appointment Scheduler
 *
 * @package     SlotBuddy
 * @author      SlotBuddy Contributors
 * @copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://github.com/ppa/SlotBuddy
 * @since       v1.2.0
 * ---------------------------------------------------------------------------- */

class Migration_Add_working_plan_exceptions_to_user_settings extends SB_Migration
{
    /**
     * Upgrade method.
     */
    public function up(): void
    {
        if (!$this->db->field_exists('working_plan_exceptions', 'user_settings')) {
            $fields = [
                'working_plan_exceptions' => [
                    'type' => 'TEXT',
                    'null' => true,
                    'after' => 'working_plan',
                ],
            ];

            $this->dbforge->add_column('user_settings', $fields);
        }
    }

    /**
     * Downgrade method.
     */
    public function down(): void
    {
        if ($this->db->field_exists('working_plan_exceptions', 'user_settings')) {
            $this->drop_column('user_settings', 'working_plan_exceptions');
        }
    }
}
