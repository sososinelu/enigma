<?php

namespace Step;

use Selectors\SkyScanner as SkyScannerSelector;


class SkyScanner extends \AcceptanceTester
{
    // Fill the form on the Homepage
    public function fillHomepageSearchForm($origin, $destination)
    {
        $I = $this;
        // Fill origin
        $I->fillField(SkyScannerSelector::$origin, $origin);

        $I->wait(2);
        // Fill destination
        $I->fillField(SkyScannerSelector::$destination, $destination);



        // Select cheapest month
        $I->waitThenClick(SkyScannerSelector::$departDateDropdown);
        $I->waitThenClick(SkyScannerSelector::$departDateWholeMonth);
        $I->wait(2);
        $I->waitThenClick(SkyScannerSelector::$departDateCheapestMonth);

        $I->wait(2);

        // Select travellers dropdown
        $I->waitThenClick(SkyScannerSelector::$travellersDropdown);

        // Increase travellers to 2
        $I->waitThenClick(SkyScannerSelector::$travellersDropdownIncrease);

        $I->wait(2);

        // Close travellers dropdown
        $I->waitThenClick(SkyScannerSelector::$closeTravellersDropdown);

        $I->wait(2);

        // Click Search flights
        $I->waitThenClick(SkyScannerSelector::$flightsSearch);
    }
}