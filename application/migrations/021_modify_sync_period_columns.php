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

class Migration_Modify_sync_period_columns extends SB_Migration
{
    /**
     * Upgrade method.
     */
    public function up(): void
    {
        $fields = [
            'sync_past_days' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
                'default' => '30',
            ],
            'sync_future_days' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
                'default' => '90',
            ],
        ];

        $this->dbforge->modify_column('user_settings', $fields);

        $this->db->update(
            'user_settings',
            [
                'sync_past_days' => '30',
            ],
            [
                'sync_past_days' => '5',
            ],
        );

        $this->db->update(
            'user_settings',
            [
                'sync_future_days' => '90',
            ],
            [
                'sync_future_days' => '5',
            ],
        );
    }

    /**
     * Downgrade method.
     */
    public function down(): void
    {
        $fields = [
            'sync_past_days' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
                'default' => '5',
            ],
            'sync_future_days' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => true,
                'default' => '5',
            ],
        ];

        $this->dbforge->modify_column('user_settings', $fields);

        $this->db->update(
            'user_settings',
            [
                'sync_past_days' => '5',
            ],
            [
                'sync_past_days' => '30',
            ],
        );

        $this->db->update(
            'user_settings',
            [
                'sync_future_days' => '5',
            ],
            [
                'sync_future_days' => '90',
            ],
        );
    }
}
