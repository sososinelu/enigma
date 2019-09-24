<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;
use Step\Acceptance\Authoring\ItemPaperList as ListStep;

class PaperSetterCanSeeAuthoringCest 
{

    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$paperSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$paperSetter['email']);
    }


    public function PaperSetterSeePredefinedSearchesTest(SearchStep $I)
    {
        $I->wantTo('see paper setters predefined searches, but no other');
        $I->seePaperSettersPredefinedSearches();

        $I->expectTo('not see any other predefined searches');
        $I->cantSeePaperReviewersPredefinedSearches();
        $I->cantSeePaperApproversPredefinedSearches(true);
        $I->cantSeeAnyItemPredefinedSearches();        
    }

    public function PaperSetterSeeDraftListTest(ListStep $I)
    {
        $I->wantTo('see my draft papers list when I have logged in');

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyDraftPapersCorrectHeaders();

        $I->expect('url to include filter on draft papers'); // Default for paper setter
        $I->seeCurrentUrlEquals(AuthoringPage::$myAuthoringPapersUrl);
    }

    public function PaperSetterCanSeeChangeList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my change papers list when I click on predefined search');
        $ISearch->selectPredefinedSearch(AuthoringPage::$myChangePapers);

        $I->expect('url to include filter on my change papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$myChangePapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyChangePapersCorrectHeaders();
    }

    public function PaperSetterCanSeeRejectedList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my rejected papers list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$rejectionsPapers);

        $I->expect('url to include filter on my rejected papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$rejectionsPapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeRejectionsPapersCorrectHeaders();
    }

}
