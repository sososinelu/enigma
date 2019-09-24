<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class ItemApproverPaperSetterCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemApproverPaperSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    /**
     * @param $loginStep $loginStep
     * @throws Exception
     */
    public function _after(LoginStep $loginStep)
    {
        $loginStep->clearSession();
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function ItemApproverPaperSetterCanEditReadOnlyItemInStatusReviewedInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$reviewedItemInNoPaper['itemid'];

        $I->openItemInReadOnly($itemId);
        $I->waitThenClick(ItemPage::$editItemButton);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveItem();

        // due to potential for redirect after saving,
        // ignore re-direct and open the item manually
        $I->openItemInReadOnly($itemId);
        $I->waitForElement(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }
    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function ItemApproverPaperSetterCantEditReadOnlyItemInStatusReviewedInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$reviewedItemInOnePaper['itemid'];

        $I->openItemInReadOnly($itemId);
        $I->waitThenClick(ItemPage::$editItemButton);

        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->see(ItemPage::$duplicateItemWithLink, ItemPage::$dynamicModal);
        $I->click(ItemPage::$cancelButtonText, ItemPage::$dynamicModal);
    }
    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function ItemApproverPaperSetterCantEditReadOnlyItemInStatusReviewedInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$reviewedItemInMultiplePapers['itemid'];

        $I->openItemInReadOnly($itemId);
        $I->waitThenClick(ItemPage::$editItemButton);

        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->see(ItemPage::$noEditMultiplePaperDuplicateItem, ItemPage::$dynamicModal);
        $I->click(ItemPage::$cancelButtonText, ItemPage::$dynamicModal);
    }
    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCanEditItemFromDraftPaperInEditTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $P->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->makeChangeAndSaveItem();

        // due to potential for redirect after saving,
        // ignore re-direct and open the item manually
        $I->openItemInReadOnly($itemId);
        $I->waitForElement(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }
    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCantEditItemWhenInAnotherPaperFromDraftPaperInEditTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['itemids'][1];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);
    }
    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCanEditReadOnlyItemFromDraftPaperInEditTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);
        $I->waitThenClick(ItemPage::$editItemButton);

        $P->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->makeChangeAndSaveItem();

        // due to potential for redirect after saving,
        // ignore re-direct and open the item manually
        $I->openItemInReadOnly($itemId);
        $I->waitForElement(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }
    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCantEditReadOnlyItemWhenInAnotherPaperFromDraftPaperInEditTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['itemids'][1];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);
        $P->waitThenClick(ItemPage::$editItemButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     *
     */
    public function ItemApproverPaperSetterCantEditItemDirectlyFromUrlWhenInOtherPaperTest(ItemStep $I) {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['itemids'][1];

        $I->editItemWithPaperId($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCantEditReadOnlyItemFromReadOnlyDraftPaperTest(PaperStep $P)
    {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['paperid'];

        $P->openPaperInReadOnly($paperId);
        $P->cantSeeElement(PaperPage::$binocularsButton);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCanReplaceReadOnlyItemWhenInOtherPaperFromDraftPaperInEditTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperMultipleItems']['itemids'][1];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);
        $P->waitThenClick(ItemPage::$editItemButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $P->waitForReload();

        $P->seeElement(ItemPage::$duplicatedFrom);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperSetterCanReplaceItemWhenInOtherPaperFromDraftPaperInEditTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperOneItem']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperSetterMaths['draftPaperOneItem']['itemids'][0];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$editItemInPaperButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $P->waitForReload();

        $P->seeElement(ItemPage::$duplicatedFrom);
    }
}
