<?php
use Page\Login as LoginPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Item\ViewItemContent;
use Step\Acceptance\Item\Item as ItemStep;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item;
use Page\Data\ItemPaperData;

class ItemReviewerCanSeeItemCest 
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


    public function ItemReviewerSeeInReadonlyItemTest(ViewItemContent $I, ItemStep $IOpen)
    {
        $I->wantTo('see all fields in my item in readonly');
        $I->amGoingTo('open one of my items to review');
        $itemId = ItemPaperData::$reviewItem['itemid'];
        $IOpen->openItemInReadOnly($itemId);

        $I->expectTo('see correct tabs for readonly');
        $I->ViewAllNonRestrictedItemTabsInReadonly();

        $I->expectTo('not see tracking');
        $I->cantSeeElement(Item::$trackingTab);

        $I->expectTo('not see duplicate or edit button');
        $I->cantSeeElement(Item::$editItemButton);
        $I->cantSeeElement(Item::$duplicateButton);

        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkScheme('Answer key');
        $I->seeInAdditionalDocuments('There are no additional documents for this item.');
        $I->seeInPreview('MCQ in review');
        $I->seeInSyllabus('Maths A-levels default', true, 'Logarithm', false);
        $I->seeInNotes('Add note');
        $I->seeInInformation('ATAB-100', 'Itemsetter Maths', 'Objective answer MCQ', 'Comprehension', ['Please review']);
    }
}
