<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

class ItemSetterPaperSetterCanIncludeItemDuplicateInDraftPaperCest
{
    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$itemSetterPaperSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _after(LoginStep $I)
    {
        $I->clearSession();
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemSetterPaperSetterCanIncludeDuplicateDraftItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['paperid'];
        $item = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['items'][0];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->wait(0.5); // To make sure item has been included before opening paper

        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     * @skip https://www.pivotaltracker.com/story/show/166762383
     * Items in state change are missing duplicate button 
     */
    public function ItemSetterPaperSetterCanIncludeDuplicateChangeItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['paperid'];
        $item = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['items'][1];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->wait(0.5); // To make sure item has been included before opening paper

        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }


    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemSetterPaperSetterCanIncludeDuplicateDraftItemInEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['paperid'];
        $item = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['items'][2];
        $duplicateTitle = $item['name'] . ' [duplicate] 2';
        $I->editItemWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 10);
        $I->click(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);

        $I->clearField(ItemPage::$duplicateItemTitleId);
        $I->wait(0.5); // To make sure complete title is entered
        $I->fillField(ItemPage::$duplicateItemTitleId, $duplicateTitle);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->wait(0.5); // To make sure item has been included before opening paper

        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($duplicateTitle);
    }


    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     * 
     * @skip https://www.pivotaltracker.com/story/show/166762383
     * Items in state change are missing duplicate button 
     */
    public function ItemSetterPaperSetterCanIncludeDuplicateChangeItemInEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['paperid'];
        $item = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperOwnDraftAndChangeItems']['items'][3];
        $duplicateTitle = $item['name'] . ' [duplicate] 2';
        $I->editItemWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);

        $I->clearField(ItemPage::$duplicateItemTitleId);
        $I->wait(0.5); // To make sure complete title is entered
        $I->fillField(ItemPage::$duplicateItemTitleId, $duplicateTitle);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
		$I->waitThenClick(ItemPage::$cancelButton);
        $I->wait(0.5); // To make sure item is back to readonly before opening paper

        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($duplicateTitle);
    }
}