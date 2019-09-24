<?php
namespace Step\Acceptance\Authoring;

use Page\Selectors\Authoring as AuthoringPage;

class PredefinedSearches extends \AcceptanceTester
{
    /** 
     * selectPredefinedSearch can only be used when the search is visible without clicking Actioned
     * selectPredefinedSearchInActioned includes a click on actioned 
     * (which will close Actioned if it was already open)
     * 
     * @param string    $search is the search selector, preferably use format AuthoringPage::$myReviewingItems
    */
    
    public function selectPredefinedSearch($search)
    {
        $I = $this;
        $I->waitForElementClickable(AuthoringPage::$actioned); // To make sure it has been loaded
        $I->waitThenClick($search);
        $I->wait(2); // To make sure that old search is no longer there       
    }

    public function selectPredefinedSearchInActioned($search)
    {
        $I = $this;
        $I->waitThenClick(AuthoringPage::$actioned);    // Toggle actioned first
        $I->waitThenClick($search);
        $I->wait(2); // To make sure that old search is no longer there       
    }

    
    /** 
     * Functions below check that Predefined searches for each user role exist as expected
     * The can't see functions checks that the predefined searches for a specific role can't be seen
     * Note that specific handling is needed for setters/approvers and typseetters because they can see part of each other's searches
    */

    public function seeItemSettersPredefinedSearches()
    {
        $I = $this;
        $I->expectTo('see only Draft and Change items to start with');
        $I->waitForElement(AuthoringPage::$myAuthoringItems);
        $I->waitForElement(AuthoringPage::$myChangeItems);
    
        $I->expectTo('not yet see rejected items');
        $I->wait(0.2);
        $I->cantSeeElement(AuthoringPage::$rejectionsItems); //Not visible before Actioned pressed
    
        $I->expectTo('see more searches under actioned');
        $I->waitThenClick(AuthoringPage::$actioned);
        $I->waitForElement(AuthoringPage::$rejectionsItems);     
    }

    /** 
     * @param bool $isItemApprover
     * Set to true if user is itemApprover to make sure that rejections items are still visible
    */
    public function cantSeeItemSettersPredefinedSearches($isItemApprover=false)
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$myAuthoringItems);
        $I->cantSeeElement(AuthoringPage::$myChangeItems);
        if(!$isItemApprover) // If user is item approver, this should still be visible
        {
            $I->cantSeeElement(AuthoringPage::$rejectionsItems); 
        }
    }


    public function seeItemReviewersPredefinedSearches()
    {
        $I = $this;
        $I->expectTo('see only my reviewing items');
        $I->waitForElement(AuthoringPage::$myReviewingItems);    
    }

    public function cantSeeItemReviewersPredefinedSearches()
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$myReviewingItems);    
    }

    public function seeAssetManagersPredefinedSearches()
    {
        $I = $this;
        $I->waitForElement(AuthoringPage::$myAssetWork);
    }

    public function cantSeeAssetManagersPredefinedSearches()
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$myAssetWork);
    }

    public function seeItemApproversPredefinedSearches()
    {
        $I = $this;
        $I->waitForElement(AuthoringPage::$approvingItems);
        $I->waitForElement(AuthoringPage::$myTeamsReviewingItems);

        $I->expectTo('not yet see items in item bank');
        $I->wait(0.2);
        $I->cantSeeElement(AuthoringPage::$itemBankItems); //Not visible before Actioned pressed

        $I->expectTo('see more searches under actioned');
        $I->waitThenClick(AuthoringPage::$actioned);
        $I->waitForElement(AuthoringPage::$itemBankItems);
        $I->waitForElement(AuthoringPage::$preTestItems);
        $I->waitForElement(AuthoringPage::$archiveItems);
        $I->waitForElement(AuthoringPage::$changeRequestsItems);
        $I->waitForElement(AuthoringPage::$rejectionsItems); 
    }

    /** 
     * @param bool $isItemSetter
     * Set to true if user is itemSetter to make sure that rejections items are still visible
    */
    public function cantSeeItemApproversPredefinedSearches($isItemSetter=false)
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$approvingItems);
        $I->cantSeeElement(AuthoringPage::$myTeamsReviewingItems);
    
        $I->cantSeeElement(AuthoringPage::$itemBankItems);
        $I->cantSeeElement(AuthoringPage::$preTestItems);
        $I->cantSeeElement(AuthoringPage::$archiveItems);
        $I->cantSeeElement(AuthoringPage::$changeRequestsItems);    
        if(!$isItemSetter) // If user is item setter, then this should still be visible
        {
            $I->cantSeeElement(AuthoringPage::$rejectionsItems); 
        }
    }

    public function cantSeeAnyItemPredefinedSearches()
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$myAuthoringItems);
        $I->cantSeeElement(AuthoringPage::$myChangeItems);
        $I->cantSeeElement(AuthoringPage::$myReviewingItems);
        $I->cantSeeElement(AuthoringPage::$myAssetWork);
        $I->cantSeeElement(AuthoringPage::$approvingItems);
        $I->cantSeeElement(AuthoringPage::$myTeamsReviewingItems);
    
        $I->cantSeeElement(AuthoringPage::$itemBankItems);
        $I->cantSeeElement(AuthoringPage::$preTestItems);
        $I->cantSeeElement(AuthoringPage::$archiveItems);
        $I->cantSeeElement(AuthoringPage::$changeRequestsItems);
        $I->cantSeeElement(AuthoringPage::$rejectionsItems);     
    }

    public function seePaperSettersPredefinedSearches()
    {
        $I = $this;
        $I->expectTo('see only Draft and Change Papers to start with');
        $I->waitForElement(AuthoringPage::$myAuthoringPapers);
        $I->waitForElement(AuthoringPage::$myChangePapers);
    
        $I->expectTo('not yet see rejected Papers');
        $I->wait(0.2);
        $I->cantSeeElement(AuthoringPage::$rejectionsPapers); //Not visible before Actioned pressed
    
        $I->expectTo('see more searches under actioned');
        $I->waitThenClick(AuthoringPage::$actioned);
        $I->waitForElement(AuthoringPage::$rejectionsPapers);     
    }

    /** 
     * @param bool $isPaperApprover
     * Set to true if user is itemApprover to make sure that rejections items are still visible
    */
    public function cantSeePaperSettersPredefinedSearches($isPaperApprover=false)
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$myAuthoringPapers);
        $I->cantSeeElement(AuthoringPage::$myChangePapers);
        if(!$isPaperApprover) // If user is paper approver, this should still be visible
        {
            $I->cantSeeElement(AuthoringPage::$rejectionsPapers); 
        }
    }

    public function seePaperReviewersPredefinedSearches()
    {
        $I = $this;
        $I->expectTo('see only my reviewing Papers');
        $I->waitForElement(AuthoringPage::$myReviewingPapers);    
    }

    public function cantSeePaperReviewersPredefinedSearches()
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$myReviewingPapers);    
    }

    public function seeTypesettersPredefinedSearches()
    {
        $I = $this;
        $I->waitForElement(AuthoringPage::$typesettingPapers);
        
        $I->expectTo('not yet see Papers in Examready');
        $I->wait(0.2);
        $I->cantSeeElement(AuthoringPage::$examReadyPapers); //Not visible before Actioned pressed

        $I->expectTo('see more searches under actioned');
        $I->waitThenClick(AuthoringPage::$actioned);
        $I->waitForElement(AuthoringPage::$examReadyPapers);
    }

    public function seePaperApproversPredefinedSearches()
    {
        $I = $this;
        $I->waitForElement(AuthoringPage::$approvingPapers);
        $I->waitForElement(AuthoringPage::$typesettingPapers);
        $I->waitForElement(AuthoringPage::$myTeamsReviewingPapers);

        $I->expectTo('not yet see Papers in Examready');
        $I->wait(0.2);
        $I->cantSeeElement(AuthoringPage::$examReadyPapers); //Not visible before Actioned pressed

        $I->expectTo('see more searches under actioned');
        $I->waitThenClick(AuthoringPage::$actioned);
        $I->waitForElement(AuthoringPage::$examReadyPapers);
        $I->waitForElement(AuthoringPage::$preTestPapers);
        $I->waitForElement(AuthoringPage::$archivePapers);
        $I->waitForElement(AuthoringPage::$changeRequestsPapers);
        $I->waitForElement(AuthoringPage::$rejectionsPapers); 
    }

    /** 
     * @param bool $isPaperSetter
     * Set to true if user is PaperSetter to make sure that rejections items are still visible
     * @param bool $isTypesetter
     * Set to true if user is Typesetter to make sure that typesetting and examready papers are still visible
    */
    public function cantSeePaperApproversPredefinedSearches($isPaperSetter=false, $isTypesetter=false)
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$approvingPapers);
        $I->cantSeeElement(AuthoringPage::$myTeamsReviewingPapers);
    
        $I->cantSeeElement(AuthoringPage::$preTestPapers);
        $I->cantSeeElement(AuthoringPage::$archivePapers);
        $I->cantSeeElement(AuthoringPage::$changeRequestsPapers);    
        if(!$isTypesetter) // If user is typesetter, then these should still be visible
        {
            $I->cantSeeElement(AuthoringPage::$typesettingPapers);
            $I->cantSeeElement(AuthoringPage::$examReadyPapers);
        }
        if(!$isPaperSetter) // If user is paper setter, then this should still be visible
        {
            $I->cantSeeElement(AuthoringPage::$rejectionsPapers); 
        }
    }

    public function cantSeeAnyPaperPredefinedSearches()
    {
        $I = $this;
        $I->cantSeeElement(AuthoringPage::$myAuthoringPapers);
        $I->cantSeeElement(AuthoringPage::$myChangePapers);
        $I->cantSeeElement(AuthoringPage::$myReviewingPapers);
        $I->cantSeeElement(AuthoringPage::$approvingPapers);
        $I->cantSeeElement(AuthoringPage::$typesettingPapers);
        $I->cantSeeElement(AuthoringPage::$myTeamsReviewingPapers);
    
        $I->cantSeeElement(AuthoringPage::$preTestPapers);
        $I->cantSeeElement(AuthoringPage::$archivePapers);
        $I->cantSeeElement(AuthoringPage::$examReadyPapers);
        $I->cantSeeElement(AuthoringPage::$changeRequestsPapers);
        $I->cantSeeElement(AuthoringPage::$rejectionsPapers);    
    }

}