<?php
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Item\ItemActions as ActionStep;
use Step\Acceptance\Item\ItemMapping as MappingStep;
use Step\Acceptance\Authoring\PredefinedSearches as SearchStep;

class CompleteItemWorkflowCest
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
     * This is a smoke test to check that a user can create an item
     * put it through review and finally send it to the item bank
     * If that doesn't work, then the release needs fixing
    */
    public function createReviewApproveItemSmokeTest(ItemStep $I, MappingStep $Imap, ActionStep $Iact, SearchStep $ISearch)
    {
        $I->wantTo('Create, review and approve an item');
        $I->create('Maths', 'A-level', 'Automated Smoke Test');

        $I->addMCQQuestion(0, 4, 1, 2);
        $I->setMetaData();
        $Imap->mapToSyllabus();
        $Iact->submitForReview([LoginPage::$all]); // Submit to myself only
        $I->waitForText('Your item was successfully submitted for review.',30);

        $I->expectTo('find the item at the top of my reviewing items');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$myReviewingItems);
        $I->waitThenClick(ItemPage::$openItemInListButton);

        $I->expectTo('end the review with my recommendation');
        $Iact->recommend('Approve');

        $I->expectTo('find the item at the top of my approving items');
        $I->amOnPage('/');
        $ISearch->selectPredefinedSearchInActioned(AuthoringPage::$approvingItems);
        $I->waitThenClick(ItemPage::$openItemInListButton);

        $I->expectTo('be able to send item to item bank');
        $Iact->sendTo(ItemPage::$selectItemBank);
    }

}
