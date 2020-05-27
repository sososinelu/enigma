<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Util\Debug;

class Acceptance extends \Codeception\Module
{
    public function _failed(\Codeception\TestInterface $test, $fail)
    {
        Debug::debug('Closing any browser popups.');
        (new \AcceptanceTester(new \Codeception\Scenario($test)))->closePopup();
    }

    /**
     * Helper to get the current URL
     *
     * @return string
     * @throws \Codeception\Exception\ModuleException
     */
    public function getCurrentUrl()
    {
        return $this->getModule('WebDriver')->_getCurrentUri();
    }

    /**
     * Helper to delete all cookies
     */
    public function deleteAllCookies()
    {
        $this->getModule('WebDriver')->webDriver->manage()->deleteAllCookies();
    }

    /**
     * Helper to send keystrokes from the keyboard, simulates actual keyboard input
     *
     * @param [type] $keys
     * @return void
     */
    public function sendKeys($keys)
    {
        $this->getModule('WebDriver')->webDriver->getKeyboard()->sendKeys($keys);
    }
}
