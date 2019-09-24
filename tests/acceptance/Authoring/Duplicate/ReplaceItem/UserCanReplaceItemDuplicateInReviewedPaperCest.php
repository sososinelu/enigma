<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

class UserCanReplaceItemDuplicateInReviewedPaperCest
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
        $I->clearSession();
    }

    /**
     * @param PaperStep $I
     * @throws Exception
     */
    public function UserCanReplaceDraftItemDuplicateInReviewedPaper(PaperStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][0];
        $I->editPaper($paperId);
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);
        $I->editPaper($paperId);
        // i can see the default duplicated item name
        $I->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $I->dontSee($itemIdSelector);
    }

    /**
     * @param PaperStep $I
     * @throws Exception
     */
    public function UserCanReplaceChangeItemDuplicateInReviewedPaper(PaperStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][1];
        $I->editPaper($paperId);
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);
        $I->editPaper($paperId);
        // i can see the default duplicated item name
        $I->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $I->dontSee($itemIdSelector);
    }

    /**
     * @param PaperStep $I
     * @throws Exception
     */
    public function UserCanReplaceReviewedItemDuplicateInReviewedPaper(PaperStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][2];
        $I->editPaper($paperId);
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);
        $I->editPaper($paperId);
        // i can see the default duplicated item name
        $I->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $I->dontSee($itemIdSelector);
    }

    /**
     * @param PaperStep $I
     * @throws Exception
     */
    public function UserCanReplaceApprovedItemDuplicateInReviewedPaper(PaperStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][3];
        $I->editPaper($paperId);
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);
        $I->editPaper($paperId);
        // i can see the default duplicated item name
        $I->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $I->dontSee($itemIdSelector);
    }

    /**
     * @param PaperStep $I
     * @throws Exception
     */
    public function UserCanReplacePreTestItemDuplicateInReviewedPaper(PaperStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][4];
        $I->editPaper($paperId);
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);
        $I->editPaper($paperId);
        // i can see the default duplicated item name
        $I->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $I->dontSee($itemIdSelector);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanReplaceDraftItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][7];
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->wait(20);
        $I->waitThenClick(ItemPage::$editItemButton, 5);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);

        // open paper
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $P->dontSee($itemIdSelector);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanReplaceChangeItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][8];
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$editItemButton, 5);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);

        // open paper
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $P->dontSee($itemIdSelector);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanReplaceReviewedItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][9];
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$editItemButton, 5);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);

        // open paper
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $P->dontSee($itemIdSelector);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanReplaceApprovedItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][10];
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$editItemButton, 5);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);

        // open paper
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $P->dontSee($itemIdSelector);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanReplacePretestItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewedPaperAllSharedItems']['items'][11];
        $itemIdSelector = '#item-workflow-' . $item['id'];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$editItemButton, 5);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);

        // open paper
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate] ');
        // i can't see the original item box
        $P->dontSee($itemIdSelector);
    }
}