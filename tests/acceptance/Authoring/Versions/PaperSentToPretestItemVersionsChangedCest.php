<?php

use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Data\ItemPaperData as ItemPaperData;
use Page\Selectors\Paper as PaperPage;
use Page\Selectors\Item as ItemPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Step\Acceptance\Paper\PaperActions as PaperActStep;
use Step\Acceptance\Item\ItemActions as ItemActStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;


class PaperSentToPretestItemVersionsChangedCest
{
    public function _before(LoginStep $I)
    {
        // Login as user with all permissions
        $I->login(LoginPage::$all);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$all['email']);
    }

    /** 
    * Start test with a paper in state Reviewed that has at least one item in pretest and one item in item bank.
    * Send paper to pretest
    * Verify that paper status and version is changed
    * From paper, click on binoculars to view pretest item
    * Verify that correct version of item is visible and that state is pretest
    * Go to newest version of item and verify that state is pretest
    * Then go from paper to item that was in item in item bank
    * Verify that correct version is shown and state is pretest
    *  Go to newest version of item and verify that state is Approved.
    */

    public function sendPaperToPreTestWithItsItems(PaperStep $I, PaperActStep $IactPaper, ItemActStep $IactItem, SearchStep $ISearch)
    {
        $I->wantTo('Verify that sending a paper to prestest also affect included items');
        $I->amGoingTo('open one of my reviewed papers');
        $itemId = ItemPaperData::$paperToPretestWithItemInItemBankAndItemInPretest;
        $I->amOnPage("/author/paper/" . $itemId);

        $I->expectTo('be able to send paper to preTest');
        $IactPaper->checkStatus('Reviewed');
        $IactPaper->sendTo(PaperPage::$selectPreTest);
        $IactPaper->checkStatus('PreTest');
        $IactPaper->checkVersion('1.0', PaperPage::$paperVersionText);

        $I->expectTo('verify that the paper item is in status preTest');
        $I->waitThenClick(sprintf(PaperPage::$binocularsButtonByLocation, 1)); //This function needs to be changed to Jens way of accessing Binoculars
        $IactItem->checkStatus('PreTest'); //Verify Status of Item
        $IactItem->checkVersion('1.0'); //Verify Version of Item
        $I->waitForText("This is the version of the item used in this paper. A new version has been created for use elsewhere");

        $I->expectTo('verify that the first item latest version is in status preTest');
        $IactItem->selectVersion('latest');
        $IactItem->checkStatus('PreTest'); //Verify Status of Item
        $IactItem->checkVersion('latest');
        $I->waitForText("This version of the item is not used in the paper. Any changes made will not be reflected in the paper");

        $I->amOnPage("/author/paper/" . $itemId);

        $I->expectTo('verify that the paper item is in status preTest');
        $I->waitThenClick(sprintf(PaperPage::$binocularsButtonByLocation, 2)); //This function needs to be changed to Jens way of accessing Binoculars
        $IactItem->checkStatus('PreTest'); //Verify Status of Item
        $IactItem->checkVersion('1.0'); //Verify Version of Item
        $I->waitForText("This is the version of the item used in this paper. A new version has been created for use elsewhere");

        $I->expectTo('verify that the first item latest version is in status Approved');
        $IactItem->selectVersion('latest');
        $IactItem->checkStatus('Item Bank'); //Verify Status of Item
        $IactItem->checkVersion('latest');
        $I->waitForText("This version of the item is not used in the paper. Any changes made will not be reflected in the paper");

    }
}
