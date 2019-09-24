<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper as PaperPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Step\Acceptance\Paper\PaperActions as ActionStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;

class CompletePaperWorkflowCest
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
     * This is a smoke test to check that a user can create a paper
     * put it through review and finally send it to the exam ready
     * If that doesn't work, then the release needs fixing
    */
    public function createReviewApproveItemSmokeTest(PaperStep $I, ActionStep $Iact, SearchStep $ISearch)
    {
        $I->wantTo('Create, review and approve a paper');
        $I->create('Maths', 'A-level', 'Maths A-levels default', 'Automated Smoke Test');
        $I->AddItem('automation','Approved');
        $I->SetMetaData();
        $Iact->SubmitForReview([LoginPage::$all]); //Submit to myself only
        $I->waitForText("Your paper was successfully submitted for review.",30);

        $I->expectTo('find the paper at the top of my reviewing list');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$myReviewingPapers);
        $I->waitThenClick(AuthoringPage::$openItemInListButton);

        $I->expectTo('end the review with my recommendation');
        $Iact->recommend('Approve', 'Done by Automation.');
        $I->waitForText("You have recommended this paper for approval.");

        $I->expectTo('find the item at the top of my approving items');
        $I->amOnPage('/');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$approvingPapers);
        $I->waitThenClick(AuthoringPage::$openItemInListButton);

        $I->expectTo('be able to send paper to exam ready');
        $Iact->sendTo(PaperPage::$selectExamReady);
        $Iact->checkStatus('Exam Ready');

    }

}
