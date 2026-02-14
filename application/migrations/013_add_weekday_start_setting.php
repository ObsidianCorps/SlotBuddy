<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * SlotBuddy - Online Appointment Scheduler
 *
 * @package     SlotBuddy
 * @author      SlotBuddy Contributors
 * @copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://github.com/ppa/SlotBuddy
 * @since       v1.3.2
 * ---------------------------------------------------------------------------- */

class Migration_Add_weekday_start_setting extends SB_Migration
{
    /**
     * Upgrade method.
     */
    public function up(): void
    {
        if (!$this->db->get_where('settings', ['name' => 'first_weekday'])->num_rows()) {
            $this->db->insert('settings', [
                'name' => 'first_weekday',
                'value' => 'sunday',
            ]);
        }
    }

    /**
     * Downgrade method.
     */
    public function down(): void
    {
        if ($this->db->get_where('settings', ['name' => 'first_weekday'])->num_rows()) {
            $this->db->delete('settings', ['name' => 'first_weekday']);
        }
    }
}
