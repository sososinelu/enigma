<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;
use Step\Acceptance\Authoring\ItemPaperList as ListStep;

class ItemSetterCanSeeAuthoringCest 
{

    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$itemSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$itemSetter['email']);
    }


    public function ItemSetterSeePredefinedSearchesTest(SearchStep $I)
    {
        $I->wantTo('see item setters predefined searches, but no other');
        $I->seeItemSettersPredefinedSearches();

        $I->expectTo('not see any other predefined searches');
        $I->cantSeeItemReviewersPredefinedSearches();
        $I->cantSeeItemApproversPredefinedSearches(true);
        $I->cantSeeAssetManagersPredefinedSearches();
        $I->cantSeeAnyPaperPredefinedSearches();        
    }

    public function ItemSetterSeeDraftListTest(ListStep $I)
    {
        $I->wantTo('see my draft items list when I have logged in');

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyDraftItemsCorrectHeaders();

        $I->expect('url to include filter on draft items'); // Default for item setter
        $I->seeCurrentUrlEquals(AuthoringPage::$myAuthoringItemsUrl);
    }

    public function ItemSetterCanSeeChangeList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my change items list when I click on predefined search');
        $ISearch->selectPredefinedSearch(AuthoringPage::$myChangeItems);

        $I->expect('url to include filter on my change items');
        $I->seeCurrentUrlEquals(AuthoringPage::$myChangeItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyChangeItemsCorrectHeaders();
    }

    public function ItemSetterCanSeeRejectionsList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my rejected items list when I click on predefined search');
        // Make sure actions is selected first
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$rejectionsItems);

        $I->expect('url to include filter on my rejected items');
        $I->seeCurrentUrlEquals(AuthoringPage::$rejectionsItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeRejectionsItemsCorrectHeaders();
    }

}
