<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Util\Debug;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class Acceptance extends \Codeception\Module
{
    public function _failed(\Codeception\TestInterface $test, $fail)
    {

        Debug::debug('Closing any browser popups.');
        (new \AcceptanceTester(new \Codeception\Scenario($test)))->closePopup();

        Debug::debug('something went wrong, cleaning sessions.');
        (new \AcceptanceTester(new \Codeception\Scenario($test)))->clearSession();
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
}
