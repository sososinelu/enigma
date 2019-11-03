<?php

class SearchFlightsCest
{

    public function skyScanner(AcceptanceTester $I)
    {
        $I->amOnPage("");
        $I->wait(10);
    }

}
