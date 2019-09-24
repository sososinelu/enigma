<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class ItemApproverPaperApproverCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemApproverPaperApprover);
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
    public function ItemPaperApproverCanEditReadOnlyItemInStatusReviewedInNoPaperTest(ItemStep $I) {
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
    public function ItemPaperApproverCantEditReadOnlyItemInStatusReviewedInOnePaperTest(ItemStep $I) {
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
    public function ItemPaperApproverCantEditReadOnlyItemInStatusReviewedInTwoPapersTest(ItemStep $I) {
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
    public function ItemPaperApproverCanEditItemFromPaperEditInStatusReviewedTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][0];
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
    public function ItemPaperApproverCantEditItemWhenInAnotherPaperFromPaperEditInStatusReviewedTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][1];
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
    public function ItemPaperApproverCanEditReadOnlyItemFromPaperEditInStatusReviewedTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$viewItemInPaperButton);

        $I->waitForElementVisible(ItemPage::$previewTab, 5);
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
    public function ItemPaperApproverCantEditReadOnlyItemWhenInAnotherPaperFromPaperEditInStatusReviewedTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][1];
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
    public function ItemPaperApproverCantEditItemDirectlyFromUrlWhenInOtherPaperTest(ItemStep $I) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][1];

        $I->editItemWithPaperId($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemPaperApproverCanEditReadOnlyItemFromReadOnlyPaperInStatusReviewedTest (PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->openPaperInReadOnly($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$binocularsButton);
        $P->waitForElementVisible(ItemPage::$previewTab);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId . '&paper-read-only=true');
        $P->waitThenClick(ItemPage::$editItemButton);
        $P->waitForElementVisible(ItemPage::$itemContentTab);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemPaperApproverCantEditReadOnlyItemWhenInOtherPaperFromReadOnlyPaperInStatusReviewedTest (PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][1];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->openPaperInReadOnly($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$binocularsButton);
        $P->waitForElementVisible(ItemPage::$previewTab);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId . '&paper-read-only=true');
        $P->waitThenClick(ItemPage::$editItemButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        // TODO check wording in modal

        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemPaperApproverCanReplaceReadOnlyItemWhenInOtherPaperFromPaperEditInStatusReviewedTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperMultipleItems']['itemids'][1];
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
    public function ItemPaperApproverCanReplaceItemWhenInOtherPaperFromPaperEditInStatusReviewedTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperOneItem']['paperid'];
        $itemId = ItemPaperData::$itemPaperApproverMaths['reviewedPaperOneItem']['itemids'][0];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->wait(0.2);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$editItemInPaperButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $P->waitForReload();

        $P->seeElement(ItemPage::$duplicatedFrom);
    }
}
