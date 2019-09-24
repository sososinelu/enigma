<?php
use Page\Login as LoginPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Item\ViewItemContent;
use Step\Acceptance\Item\Item as ItemStep;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item;
use Page\Data\ItemPaperData;

class ItemApproverCanSeeItemCest 
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


    public function ItemApproverSeeInReadonlyItemTest(ViewItemContent $I, ItemStep $IOpen)
    {
        $I->wantTo('see all fields in my reviewed item in readonly');
        $I->amGoingTo('open one of my reviewed items');
        $itemId = ItemPaperData::$reviewedItem['itemid'];
        $IOpen->openItemInReadOnly($itemId);

        $I->expectTo('see correct tabs for readonly');
        $I->viewAllNonRestrictedItemTabsInReadonly();
        $I->viewItemApproverSpecificTabs();

        $I->expectTo('see edit button');
        $I->canSeeElement(Item::$editItemButton);

        $I->expectTo('not see duplicate button');
        $I->cantSeeElement(Item::$duplicateButton);

        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkScheme('Version 0.1');
        $I->seeInAdditionalDocuments('There are no additional documents for this item.');
        $I->seeInPreview('This is version 0.1');
        $I->seeInSyllabus('Maths A-levels default', true, 'Trigonometry', true);
        $I->seeInTracking(['Reviewing (Cycle to setter)', 'ItemReviewer Maths', 'Approved', 'Viewed', 'All General']);
        $I->seeInNotes('Add note');
        $I->seeInInformation('ATAB-100', 'Itemsetter Maths', 'Short answer', 'Evaluation', ['Cycle to setter', 'Please review']);
    }

    public function ItemApproverSeeInEditItemTest(ViewItemContent $I, ItemStep $IOpen)
    {
        $I->wantTo('see all fields in my reviewed item in edit');
        $I->amGoingTo('open one of my reviewed items');
        $itemId = ItemPaperData::$reviewedItem['itemid'];
        $IOpen->editItem($itemId);
  
        $I->expectTo('see that item is locked');
        $I->waitForText('This item is locked');

        $I->expectTo('see correct tabs for edit');
        $I->viewAllItemTabsInEdit();

        $I->expectTo('see save and cancel button');
        $I->canSeeElement(Item::$saveItemButton);
        $I->canSeeElement(Item::$cancelButton);

        $I->expectTo('not see duplicate button');
        $I->cantSeeElement(Item::$duplicateButton);

        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkScheme('Type of mark scheme');
        $I->seeInMarkScheme('Version 0.1');
        $I->seeInAdditionalDocuments('Add document');
        $I->seeInAdditionalDocuments('There are no additional documents for this item.');
        $I->seeInPreview('This is version 0.1');
        $I->seeInSyllabus('Maths A-levels default', true, 'Trigonometry', true);
        $I->seeInItemContent('This is version 0.1');
        $I->seeInNotes('Add note');
        $I->seeInInformation('ATAB-100', 'Itemsetter Maths', 'Short answer', 'Evaluation', ['Facility']);
    }
}
