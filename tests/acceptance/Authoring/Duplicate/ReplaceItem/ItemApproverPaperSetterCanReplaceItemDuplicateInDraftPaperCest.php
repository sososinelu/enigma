<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Login as LoginPage;
use Step\Acceptance\Paper\Paper as PaperStep;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Page\Data\ItemPaperData;
use Page\Selectors\Paper as PaperPage;

class ItemApproverPaperSetterCanReplaceItemDuplicateInDraftPaperCest
{
    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$itemApproverPaperSetter);
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
    public function ItemApproverPaperSetterCanReplaceReviewedItemDuplicateInDraftPaper(PaperStep $I)
    {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['reviewedPaperWithSharedItems']['paperid'];
        $reviewedItem = ItemPaperData::$itemApproverPaperSetterMaths['reviewedPaperWithSharedItems']['items'][0];
        $I->editPaper($paperId);
        $itemIdSelector = '#item-workflow-' . $reviewedItem['id'];
        $I->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);
		$I->waitThenClick(ItemPage::$cancelButton);

        $I->editPaper($paperId);
        // i can see the default duplicated item name
        $I->see($reviewedItem['name'] . ' [duplicate] ');
        // i can't see the original item box
        $I->dontSee($itemIdSelector);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCanReplaceReviewedItemDuplicateInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['reviewedPaperWithSharedItems']['paperid'];
        $reviewedItem = ItemPaperData::$itemApproverPaperSetterMaths['reviewedPaperWithSharedItems']['items'][1];
        $itemIdSelector = '#item-workflow-' . $reviewedItem['id'];
        $I->openItemInReadOnlyWithPaperId($reviewedItem['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab);
        $I->waitThenClick(ItemPage::$editItemButton, 5);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);
		$I->waitThenClick(ItemPage::$cancelButton);

        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($reviewedItem['name'] . ' [duplicate] ');
        // i can't see the original item box
        $P->dontSee($itemIdSelector);
    }
}
