<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Selectors\Paper as PaperPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Step\Acceptance\Login as LoginStep;

class UserCanIncludeItemDuplicateInReviewedPaperCest
{
    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$allGeneral);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$allGeneral['email']);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateDraftItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['items'][0];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     *
     * @skip https://www.pivotaltracker.com/story/show/166762383
     * Items in state change are missing duplicate button 
     */
    public function UserCanIncludeDuplicateChangeItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['items'][1];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateReviewedItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['items'][2];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateApprovedItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['items'][3];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicatePretestItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['items'][4];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateArchiveItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['items'][5];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCanIncludeDuplicateRejectedItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['anotherReviewedPaperAllSharedItems']['items'][6];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->wait(0.2);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateDraftItemInItemEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['items'][0];
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
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($duplicateTitle);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     * @skip https://www.pivotaltracker.com/story/show/166762383
     * Items in state change are missing duplicate button 
     */
    public function UserCanIncludeDuplicateChangeItemInItemEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['items'][1];
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
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($duplicateTitle);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateReviewedItemInItemEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['items'][3];
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
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $I->waitThenClick(ItemPage::$cancelButton);
        $I->wait(0.5);
        $P->editPaper($paperId);
        // Verify that duplicated item is included in paper
        $P->see($duplicateTitle);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateApprovedItemInItemEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['items'][4];
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
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $I->waitThenClick(ItemPage::$cancelButton);
        $I->wait(0.5); 
        $P->editPaper($paperId);
        $P->waitForElementVisible(PaperPage::$previewTab);
        // Verify that duplicated item is included in paper
        $P->waitForText($duplicateTitle);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicatePretestItemInItemEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperNoSharedItems']['items'][5];
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
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
		$I->waitThenClick(ItemPage::$cancelButton);
        $I->wait(0.5); 
        $P->editPaper($paperId);
        $P->waitForElementVisible(PaperPage::$previewTab);
        // Verify that duplicated item is included in paper
        $P->waitForText($duplicateTitle);
    }

// Note that there are no tests for Archive and Rejected Item in edit, because they are not editable.

}