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

class Migration_Add_ldap_dn_column_to_users_table extends SB_Migration
{
    /**
     * Upgrade method.
     */
    public function up(): void
    {
        if (!$this->db->field_exists('ldap_dn', 'users')) {
            $fields = [
                'ldap_dn' => [
                    'type' => 'TEXT',
                    'null' => true,
                    'after' => 'is_private',
                ],
            ];

            $this->dbforge->add_column('users', $fields);
        }
    }

    /**
     * Downgrade method.
     */
    public function down(): void
    {
        if ($this->db->field_exists('ldap_dn', 'users')) {
            $this->drop_column('users', 'ldap_dn');
        }
    }
}
