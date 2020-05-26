<?php

use Data\FlightsData;

class SearchFlightsCest
{

    public function skyScanner(AcceptanceTester $I)
    {
        /*
            RUN:
            ./vendor/bin/codecept run tests/acceptance/SkyScanner/SearchFlightsCest.php
        */

        $I->amOnPage("");
        $I->wait(10);
    }

}
