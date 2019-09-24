<?php

use Page\Login as LoginPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Authoring\AdvancedSearch as AdvancedSearchStep;

class AdvancedItemSearchCest
{
    public function _before(LoginStep $loginStep, AdvancedSearchStep $I)
    {
        $loginStep->login(LoginPage::$astAllRoles);
        $I->waitThenClick('#toggle-search-label');
        $I->clearAllFilters();
    }

    public function _after(LoginStep $loginStep)
    {
        $loginStep->clearSession(LoginPage::$astAllRoles['email']);
    }

    public function checkAllAdvancedFiltersAreSetAfterSearching(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Author', null, 'AST Setter');
        $I->setAdvancedFilterValue('Content has been pre-tested', 'is included');
        $I->setAdvancedFilterValue('Digitised Content', 'is included');
        $I->setAdvancedFilterValue('Item ID', null, '100-100-100');
        $I->setAdvancedFilterValue('Review Cycle Name', 'is', 'John Smith');
        $I->setAdvancedFilterValue('Exclude items used at least', null, [1, 5]);
        $I->setAdvancedFilterValue('Total marks', null, [5, 10]);
        $I->setAdvancedFilterValue('Duration', null, [1, 5]);
        $I->setAdvancedFilterValue('Items with assets', 'are only included');
        $I->setAdvancedFilterValue('Asset type', 'is', 'Audio');
        $I->setAdvancedFilterValue('Anchor items', 'are only included');

        $I->waitThenClick('#searchButton');
        $I->wait(3);
        $I->see('Author is AST Setter');
        $I->see('Content has been pre-tested is included');
        $I->see('Digitised Content is included');
        $I->see('Item ID is 100-100-100');
        $I->see('Review Cycle Name is John Smith');
        $I->see('Exclude items used at least 1 times in last 5 years');
        $I->see('Total marks is between 5 and 10');
        $I->see('Duration is between 1 and 5');
        $I->see('Items with assets are only included');
        $I->see('Asset type is Audio');
        $I->see('Anchor items are only included');

        $I->see('You don\'t have anything to view');
    }

    public function searchUsingAuthorFilter(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Author', null, 'AST Setter');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item authored by AST Setter');
    }

    public function searchForItemsWhichHaveBeenPretested(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Content has been pre-tested', 'is only shown');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 5);
        $I->see('Item which has been pretested');
        $I->clearAllFilters();
        $I->setAdvancedFilterValue('Content has been pre-tested', 'is included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-631');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which has been pretested');
        $I->clearAllFilters();
        $I->setAdvancedFilterValue('Content has been pre-tested', 'is not included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-631');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
    }

    public function searchForItemInCustomReviewCycleName(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Review Cycle Name', 'is', 'Geoff');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item in review cycle "Geoff"');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Review Cycle Name', 'is', 'Jeff');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Review Cycle Name', 'is', 'Geoff');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-634');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item in review cycle "Geoff"');
    }

    public function searchForItemWithTotalMarks(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Total marks', null, [15, 20]);
        $I->waitThenClick('#searchButton');
        $I->waitForText('2 items', 10);
        $I->see('Item with 15 marks');
        $I->see('Item with 17 marks');
        $I->dontSee('Item with 5 marks');
        $I->dontSee('Item with 25 marks');
    }

    public function searchForItemWithDuration(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Duration', null, [15, 20]);
        $I->waitThenClick('#searchButton');
        $I->waitForText('2 items', 10);
        $I->see('Item with duration of 15 minutes');
        $I->see('Item with duration of 17 minutes');
        $I->dontSee('Item with duration of 5 minutes');
        $I->dontSee('Item with duration of 25 minutes');
    }

    public function searchForItemsWithAssets(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Items with assets', 'are only included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-666');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Items with assets', 'are only included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-661');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('1 item');
        $I->see('Item with an asset of type Diagram');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Items with assets', 'are not included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-661');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Items with assets', 'are not included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-666');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item with no asset');
    }

    public function searchForAssetType(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Asset type', 'is', 'Diagram');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-661');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item with an asset of type Diagram');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Asset type', 'is not', 'Diagram');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-661');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Asset type', 'is', 'Audio');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-661');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Asset type', 'is', 'Diagram');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-666');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();
    }

    /**
     * @param AdvancedSearchStep $I
     * @throws Exception
     */
    public function searchForAnchorItems(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Anchor items', 'are only included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-672');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Anchor items', 'are only included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-669');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which is an anchor');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Anchor items', 'are not included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-669');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Anchor items', 'are not included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-672');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which is not an anchor');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Anchor items', 'are included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-672');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which is not an anchor');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Anchor items', 'are included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-669');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which is an anchor');
    }

    public function searchForDigitisedContent(AdvancedSearchStep $I)
    {
        $I->setAdvancedFilterValue('Digitised Content', 'is included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-699');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which has been digitised');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Digitised Content', 'is not included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-699');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Digitised Content', 'is only shown');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-699');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which has been digitised');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Digitised Content', 'is included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-731');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which has not been digitised');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Digitised Content', 'is not included');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-731');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item which has not been digitised');
        $I->clearAllFilters();

        $I->setAdvancedFilterValue('Digitised Content', 'is only shown');
        $I->setAdvancedFilterValue('Item ID', null, '100-068-709');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
    }

    /**
     * @param AdvancedSearchStep $I
     * @throws Exception
     */
    public function runSearchWithFacilitySlider(AdvancedSearchStep $I)
    {
        $I->setSliderValue('Facility', 0.1, 0.6);
        $I->setAdvancedFilterValue('Item ID', null, '100-068-712');
        $I->waitThenClick('#searchButton');
        $I->waitForText('1 item', 10);
        $I->see('Item with facility of 0.5');
        $I->clearAllFilters();

        $I->setSliderValue('Facility', 0.1, 0.6);
        $I->setAdvancedFilterValue('Item ID', null, '100-068-715');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();

        $I->setSliderValue('Facility', 0.1, 0.6);
        $I->setAdvancedFilterValue('Item ID', null, '100-068-718');
        $I->waitThenClick('#searchButton');
        $I->waitForText('You don\'t have anything to view', 10);
        $I->clearAllFilters();
    }
}
