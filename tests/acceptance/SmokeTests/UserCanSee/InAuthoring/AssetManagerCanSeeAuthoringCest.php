<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;
use Step\Acceptance\Authoring\ItemPaperList as ListStep;

class AssetManagerCanSeeAuthoringCest 
{

    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$assetManager);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$assetManager['email']);
    }

    public function AssetManagerSeePredefinedSearchesTest(SearchStep $I)
    {
        $I->wantTo('see my asset work predefined search, but no other');
        $I->seeAssetManagersPredefinedSearches();

        // Note that if actioned is removed for asset manager, then this bit can be removed, too. 
        $I->waitForElementClickable(AuthoringPage::$actioned);
        $I->click(AuthoringPage::$actioned);
        // Remove above
        
        $I->expectTo('not see any other predefined searches');
        $I->cantSeeItemSettersPredefinedSearches();
        $I->cantSeeItemReviewersPredefinedSearches();
        $I->cantSeeItemApproversPredefinedSearches();
        $I->cantSeeAnyPaperPredefinedSearches();        

    }

    public function AssetManagerSeeMyAssetWorkListTest(ListStep $I)
    {
        $I->wantTo('see my asset work items list when I have logged in');
 
        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyAssetWorkItemsCorrectHeaders();

        $I->expect('url to include filter on My asset work'); //Default for asset manager
        $I->seeCurrentUrlEquals(AuthoringPage::$myAssetWorkUrl);

 
        $I->expectTo('see asset details for first item');
        $I->click(AuthoringPage::$firstBitOfFirstRowInList);
        $I->waitForElement(AuthoringPage::$assetListHeader);
        $I->canSee('Asset status');
        $I->canSee('Copyright cleared');
        $I->canSee('Requested date');
    }
}
