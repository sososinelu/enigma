<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;
use Step\Acceptance\Authoring\ItemPaperList as ListStep;

class ItemReviewerCanSeeAuthoringCest 
{

    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$itemReviewer);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$itemReviewer['email']);
    }


    public function ItemReviewerSeePredefinedSearchesTest(SearchStep $I)
    {
        $I->wantTo('see item reviewers predefined searches, but no other');
        $I->seeItemReviewersPredefinedSearches();

        // Note that if actioned is removed for reviewer, then this bit can be removed, too. 
        $I->waitForElementClickable(AuthoringPage::$actioned);
        $I->click(AuthoringPage::$actioned);
        // Remove above
        
        $I->expectTo('not see any other predefined searches');
        $I->cantSeeItemSettersPredefinedSearches();
        $I->cantSeeItemApproversPredefinedSearches();
        $I->cantSeeAssetManagersPredefinedSearches();
        $I->cantSeeAnyPaperPredefinedSearches();        
    }

    public function ItemReviewerSeeMyReviewingItemsListTest(ListStep $I)
    {
        $I->wantTo('see my review items list when I have logged in');

        $I->expectTo('see at least one item in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyReviewItemsCorrectHeaders();

        $I->expect('url to include filter on my reviewing items'); //Default for item reviewer
        $I->seeCurrentUrlEquals(AuthoringPage::$myReviewingItemsUrl);
    }
}
