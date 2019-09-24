<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;
use Step\Acceptance\Authoring\ItemPaperList as ListStep;

class ItemApproverCanSeeAuthoringCest 
{

    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$itemApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$itemApprover['email']);
    }


    public function ItemApproverSeePredefinedSearchesTest(SearchStep $I)
    {
        $I->wantTo('see item approvers predefined searches, but no other');
        $I->seeItemApproversPredefinedSearches();

        $I->expectTo('not see any other predefined searches');
        $I->cantSeeItemSettersPredefinedSearches(true); // Exception for rejected items
        $I->cantSeeItemReviewersPredefinedSearches();
        $I->cantSeeAssetManagersPredefinedSearches();
        $I->cantSeeAnyPaperPredefinedSearches();       
    }

    public function ItemApproverSeeApprovingListTest(ListStep $I)
    {
        $I->wantTo('see my approving items list when I have logged in');

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeApprovingItemsCorrectHeaders();

        $I->expect('url to include filter on approving items'); // Default for item setter
        $I->seeCurrentUrlEquals(AuthoringPage::$approvingItemsUrl);
    }

    public function ItemApproverCanSeeMyTeamsReviewingList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my teams reviewing list when I click on predefined search');
        $ISearch->selectPredefinedSearch(AuthoringPage::$myTeamsReviewingItems);

        $I->expect('url to include filter on my teams reviewing items');
        $I->seeCurrentUrlEquals(AuthoringPage::$myTeamsReviewingItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyTeamsReviewingItemsCorrectHeaders();
    }

    public function ItemApproverCanSeeItemBankList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my item bank items list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$itemBankItems);

        $I->expect('url to include filter on my reviewing items');
        $I->seeCurrentUrlEquals(AuthoringPage::$itemBankItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeItemBankItemsCorrectHeaders();
    }

    public function ItemApproverCanSeePretestItemsList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see pretest items list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$preTestItems);

        $I->expect('url to include filter on pretest items');
        $I->seeCurrentUrlEquals(AuthoringPage::$preTestItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seePretestItemsCorrectHeaders();
    }

    public function ItemApproverCanSeeArchiveItemList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see archived items list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$archiveItems);

        $I->expect('url to include filter on my reviewing items');
        $I->seeCurrentUrlEquals(AuthoringPage::$archiveItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeArchiveItemsCorrectHeaders();
    }

    public function ItemApproverCanSeeChangeRequestItemsList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my change request items list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$changeRequestsItems);

        $I->expect('url to include filter on my reviewing items');
        $I->seeCurrentUrlEquals(AuthoringPage::$changeRequestsItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeChangeRequestsItemsCorrectHeaders();
    }

    public function ItemApproverCanSeeRejectionsList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my rejected items list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$rejectionsItems);

        $I->expect('url to include filter on my reviewing items');
        $I->seeCurrentUrlEquals(AuthoringPage::$rejectionsItemsUrl);

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeRejectionsItemsCorrectHeaders();
    }
}
