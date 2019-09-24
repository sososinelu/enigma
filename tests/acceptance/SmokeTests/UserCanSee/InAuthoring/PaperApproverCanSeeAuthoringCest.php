<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;
use Step\Acceptance\Authoring\ItemPaperList as ListStep;

class PaperApproverCanSeeAuthoringCest 
{

    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$paperApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$paperApprover['email']);
    }


    public function PaperApproverSeePredefinedSearchesTest(SearchStep $I)
    {
        $I->wantTo('see paper approvers predefined searches, but no other');
        $I->seePaperApproversPredefinedSearches();

        $I->expectTo('not see any other predefined searches');
        $I->cantSeePaperSettersPredefinedSearches(true); // Exception for rejected papers
        $I->cantSeePaperReviewersPredefinedSearches();
        $I->cantSeeAnyItemPredefinedSearches();       
    }

    public function PaperApproverSeeApprovingListTest(ListStep $I)
    {
        $I->wantTo('see my approving paper list when I have logged in');

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeApprovingPapersCorrectHeaders();

        $I->expect('url to include filter on approving papers'); // Default for paper setter
        $I->seeCurrentUrlEquals(AuthoringPage::$approvingPapersUrl);
    }

    public function PaperApproverSeeTypesettingListTest(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see typesetting list when I click on predefined search');
        $ISearch->selectPredefinedSearch(AuthoringPage::$typesettingPapers);

        $I->expect('url to include filter on papers in typesetting');
        $I->seeCurrentUrlEquals(AuthoringPage::$typesettingPapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeTypesettingPapersCorrectHeaders();
    }

    public function PaperApproverCanSeeMyTeamsReviewingList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my teams reviewing list when I click on predefined search');
        $ISearch->selectPredefinedSearch(AuthoringPage::$myTeamsReviewingPapers);

        $I->expect('url to include filter on my teams reviewing papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$myTeamsReviewingPapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeMyTeamsReviewingPapersCorrectHeaders();
    }

    public function PaperApproverCanSeePretestPapersList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see pretest papers list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$preTestPapers);

        $I->expect('url to include filter on pretest papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$preTestPapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seePretestPapersCorrectHeaders();
    }

    public function PaperApproverCanSeeArchivePapersList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see archived papers list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$archivePapers);

        $I->expect('url to include filter on archived papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$archivePapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeArchivePapersCorrectHeaders();
    }

    public function PaperApproverCanSeeExamReadyPapersList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see exam ready papers list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$examReadyPapers);

        $I->expect('url to include filter on exam ready papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$examReadyPapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeExamReadyPapersCorrectHeaders();
    }

    public function PaperApproverCanSeeChangeRequestPapersList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see change requests papers list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$changeRequestsPapers);

        $I->expect('url to include filter on change requests papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$changeRequestsPapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeChangeRequestsPapersCorrectHeaders();
    }

    public function PaperApproverCanSeeRejectedList(SearchStep $ISearch, ListStep $I)
    {
        $I->wantTo('see my rejected papers list when I click on predefined search');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$rejectionsPapers);

        $I->expect('url to include filter on change requests papers');
        $I->seeCurrentUrlEquals(AuthoringPage::$rejectionsPapersUrl);

        $I->expectTo('see at least one paper in the list');
        $I->seeIsSomethingInList();
        
        $I->expectTo('see authoring list with correct headers, but not any other');
        $I->seeRejectionsPapersCorrectHeaders();
    }
}
