<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * SlotBuddy - Online Appointment Scheduler
 *
 * @package     SlotBuddy
 * @author      SlotBuddy Contributors
 * @copyright   Copyright (c) Alex Tselegidis, SlotBuddy Contributors
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://github.com/ppa/SlotBuddy
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Captcha controller.
 *
 * Handles the captcha operations.
 *
 * @package Controllers
 */
class Captcha extends SB_Controller
{
    /**
     * Class Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->library('captcha_builder');
    }

    /**
     * Make a request to this method to get a captcha image.
     */
    public function index(): void
    {
        $this->captcha_builder->setDistortion(true);
        $this->captcha_builder->setMaxBehindLines(1);
        $this->captcha_builder->setMaxFrontLines(1);
        $this->captcha_builder->setBackgroundColor(255, 255, 255);
        $this->captcha_builder->build();
        session(['captcha_phrase' => $this->captcha_builder->getPhrase()]);
        header('Content-type: image/jpeg');
        $this->captcha_builder->output();
    }
}
