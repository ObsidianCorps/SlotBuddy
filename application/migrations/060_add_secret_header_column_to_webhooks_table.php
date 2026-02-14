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

class Migration_Add_secret_header_column_to_webhooks_table extends SB_Migration
{
    /**
     * Upgrade method.
     */
    public function up(): void
    {
        if (!$this->db->field_exists('secret_header', 'webhooks')) {
            $fields = [
                'secret_header' => [
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'default' => 'X-Ea-Token',
                    'after' => 'actions',
                ],
            ];

            $this->dbforge->add_column('webhooks', $fields);
        }
    }

    /**
     * Downgrade method.
     */
    public function down(): void
    {
        if ($this->db->field_exists('secret_header', 'webhooks')) {
            $this->dbforge->drop_column('webhooks', 'secret_header');
        }
    }
}
