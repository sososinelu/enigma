<?php
use Page\Login as LoginPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Item\ViewItemContent;
use Step\Acceptance\Item\Item as ItemStep;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item;
use Page\Data\ItemPaperData;

class ItemSetterCanSeeItemCest 
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


    public function ItemSetterSeeInDraftItemTest(ViewItemContent $I, ItemStep $IOpen)
    {
        $I->wantTo('see all fields in my draft item');
        $I->amGoingTo('open one of my draft items');
        $itemId = ItemPaperData::$draftItem['itemid'];
        $IOpen->editItem($itemId);

        $I->expectTo('see all tabs I have access to');
        $I->viewAllItemTabsInEdit();

        $I->expectTo('not see tracking');
        $I->cantSeeElement(Item::$trackingTab);

        $I->expectTo('see draft, submit and duplicate buttons');
        $I->canSeeElement(Item::$saveDraftItemButton);
        $I->canSeeElement(Item::$submitForReviewButton);
        $I->canSeeElement(Item::$duplicateButton);
        
        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkScheme('Type of mark scheme');
        $I->seeInMarkScheme('Free text here');
        $I->seeInAdditionalDocuments('Add document');
        $I->seeInAdditionalDocuments('There are no additional documents for this item.');
        $I->seeInPreview('but ready for review');
        $I->seeInSyllabus('Maths A-levels default', true, 'Algebra', true);
        $I->seeInItemContent('Total marks');
        $I->seeInNotes('Add note');
        $I->seeInInformation('ATAB-100', 'Itemsetter Maths', 'Short answer', 'Evaluation', ['Facility']);
    }
}
