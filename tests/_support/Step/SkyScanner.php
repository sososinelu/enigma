<?php

namespace Step;

use Page\Selectors\SkyScanner as SkyScannerSelector;


class SkyScanner extends \AcceptanceTester
{
    // Fill the form on the Homepage
    public function fillHomepageSearchForm($origin)
    {
        $I = $this;
        // Fill origin
        $I->fillField(SkyScannerSelector::$origin, $origin);
        // Fill destination
        $I->fillField(SkyScannerSelector::$origin, $origin);
        // Select depart date

        // Select return date

        // Select travellers

        // Click Search flights

    }
}