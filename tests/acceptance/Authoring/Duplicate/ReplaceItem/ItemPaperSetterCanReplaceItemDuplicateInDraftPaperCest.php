<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Step\Acceptance\Login as LoginStep;
use Page\Data\ItemPaperData;
use Page\Selectors\Paper as PaperPage;

class ItemPaperSetterCanReplaceItemDuplicateInDraftPaperCest
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
     * @param PaperStep $I
     * @throws Exception
     */
    public function ItemPaperSetterCanReplaceDraftItemDuplicateInDraftPaper(PaperStep $I)
    {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperWithSharedItems']['paperid'];
        $draftItem = ItemPaperData::$itemSetterPaperSetterMaths['draftPaperWithSharedItems']['items'][0];
        $I->editPaper($paperId);
        $itemIdSelector = '#item-workflow-' . $draftItem['id'];
        $I->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $I->waitForElementVisible(ItemPage::$itemContentTab);

        $I->editPaper($paperId);
        // i can see the default duplicated item name
        $I->see($draftItem['name'] . ' [duplicate] ');
        // i can't see the original item box
        $I->dontSee($itemIdSelector);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemPaperSetterCanReplaceDraftItemDuplicateInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        // i believe this is currently failing
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['anotherDraftPaperWithSharedItems']['paperid'];
        $reviewedItem = ItemPaperData::$itemSetterPaperSetterMaths['anotherDraftPaperWithSharedItems']['items'][1];
        $itemIdSelector = '#item-workflow-' . $reviewedItem['id'];
        $I->openItemInReadOnlyWithPaperId($reviewedItem['id'], $paperId);
        $I->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $reviewedItem['id'] . '?paper_ref=' . $paperId);
        $I->waitThenClick(ItemPage::$editItemButton, 5);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);

        $I->waitForElementVisible(ItemPage::$itemContentTab);

        // open paper
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($reviewedItem['name'] . ' [duplicate] ');
        // i can't see the original item box
        $P->dontSee($itemIdSelector);
    }
}
