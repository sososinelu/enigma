<?php

use Data\FlightsData;
use Step\SkyScanner as SkyScannerStep;
use Selectors\SkyScanner as SkyScannerSelector;

class SearchFlightsCest
{
    public function _before(SkyScannerStep $I)
    {
        $I->amOnPage('/');
        $I->waitForElement(SkyScannerSelector::$origin, 10);
    }

    public function _after(SkyScannerStep $I)
    {
        $I->deleteAllCookies();
    }

    /*
        RUN:
        ./vendor/bin/codecept run tests/acceptance/SkyScanner/SearchFlightsCest.php
    */

    public function skyScanner(SkyScannerStep $I)
    {
        $I->waitThenClick(SkyScannerSelector::$cookiePolicyAccept, 10);

        $I->fillHomepageSearchForm(FlightsData::$airports[0], FlightsData::$destinations_1[0]);
        $I->wait(10);
    }

}
