<?php

namespace Helper;

use ApiTester;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{

    public function _failed(\Codeception\TestInterface $test, $fail)
    {
        (new \ApiTester(new \Codeception\Scenario($test)))->clearSession();
    }
}
