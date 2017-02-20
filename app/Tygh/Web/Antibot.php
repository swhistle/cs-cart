<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

namespace Tygh\Web;

use Tygh\Web\Antibot\IAntibotDriver;

/**
 * Class Antibot provides a service for spam&abuse filtering of HTTP requests.
 *
 * @package Tygh\Web
 */
class Antibot
{
    const SKIP_REQUEST_VALIDATION_SESSION_FLAG_NAME = 'image_verification_ok';

    /**
     * @var Session Current session instance
     */
    protected $session;

    /**
     * @var array Application settings
     */
    protected $settings;

    /**
     * @var bool Whether antibot validation is set up and enabled
     */
    protected $is_enabled = false;

    /**
     * @var IAntibotDriver Antibot driver instance
     */
    protected $driver;

    /**
     * Antibot constructor.
     *
     * @param Session $session  Current session instance
     * @param array   $settings Application settings
     */
    public function __construct(Session $session, array $settings)
    {
        $this->session = $session;
        $this->settings = $settings;
    }

    /**
     * @return IAntibotDriver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param IAntibotDriver $driver
     */
    public function setDriver(IAntibotDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Enables antibot form validation
     */
    public function enable()
    {
        $this->is_enabled = true;
    }

    /**
     * Disables antibot form validation
     */
    public function disable()
    {
        $this->is_enabled = false;
    }

    /**
     * @return bool Whether antibot validation is set up and enabled
     */
    public function isEnabled()
    {
        return $this->is_enabled;
    }

    /**
     * @return bool Whether current session needs antibot validation
     */
    public function isValidationRequiredForSession()
    {
        return $this->is_enabled
            && $this->driver->isSetUp()
            && !($this->session['auth']['user_id'] && $this->settings['Image_verification']['hide_if_logged'] == 'Y')
            && !($this->settings['Image_verification']['hide_after_validation'] == 'Y' && !empty($this->session[static::SKIP_REQUEST_VALIDATION_SESSION_FLAG_NAME]));
    }

    /**
     * Lookups settings to ensure given scenario needs antibot validation.
     *
     * @param string $scenario Validation scenario like "checkout" or "register".
     *
     * @return bool Whether given scenario needs antibot validation
     */
    public function isValidationRequiredForScenario($scenario)
    {
        return $this->is_enabled
            && $this->driver->isSetUp()
            && isset($this->settings['Image_verification']['use_for'][$scenario])
            && $this->settings['Image_verification']['use_for'][$scenario] == 'Y';
    }

    /**
     * Checks whether validation is needed and performs HTTP request validation by given scenario.
     *
     * @param string $scenario          Validation scenario like "checkout" or "register".
     * @param array  $http_request_data HTTP POST request data.
     *
     * @return bool True if validation is required and passed, false if it is not required or not passed
     */
    public function validateHttpRequestByScenario($scenario, array $http_request_data)
    {
        if ($this->isValidationRequiredForSession() && $this->isValidationRequiredForScenario($scenario)) {

            $result = $this->driver->validateHttpRequest($http_request_data);

            // Skip verification after the first successful one
            if ($result && $this->settings['Image_verification']['hide_after_validation'] == 'Y') {
                $this->session[static::SKIP_REQUEST_VALIDATION_SESSION_FLAG_NAME] = true;
            }

            return $result;
        }

        return true;
    }
}
