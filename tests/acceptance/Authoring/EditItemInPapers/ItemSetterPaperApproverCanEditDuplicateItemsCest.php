<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class ItemSetterPaperApproverCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemSetterPaperApprover);
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
    public function ItemSetterPaperApproverCanEditDraftItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['itemDraftNotInPaper']['itemid'];

        $I->editItem($itemId);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveDraftItem();

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
    public function ItemSetterPaperApproverCanEditDraftItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['itemDraftInOnePaper']['itemid'];

        $I->editItem($itemId);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveDraftItem();

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
    public function ItemSetterPaperApproverCanEditDraftItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['itemDraftInTwoPapers']['itemid'];

        $I->editItem($itemId);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveDraftItem();

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
    public function ItemSetterPaperApproverCanEditChangeItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['itemChangeNotInPaper']['itemid'];

        $I->editItem($itemId);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveDraftItem();

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
    public function ItemSetterPaperApproverCanEditChangeItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['itemChangeInOnePaper']['itemid'];

        $I->editItem($itemId);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveDraftItem();

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
    public function ItemSetterPaperApproverCanEditChangeItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['itemChangeInTwoPapers']['itemid'];

        $I->editItem($itemId);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveDraftItem();

        // due to potential for redirect after saving,
        // ignore re-direct and open the item manually
        $I->openItemInReadOnly($itemId);
        $I->waitForElement(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemSetterPaperApproverCanEditItemFromPaperInStatusReviewedInEditTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab);

        $P->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->makeChangeAndSaveDraftItem();

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
    public function ItemSetterPaperApproverCantEditItemFromPaperEditInStatusReviewedWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['itemids'][1];
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
    public function ItemSetterPaperApproverCanEditReadOnlyItemFromPaperEditInStatusReviewedTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);
        $I->waitThenClick(ItemPage::$editItemButton);

        $P->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->makeChangeAndSaveDraftItem();

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
    public function ItemSetterPaperApproverCantEditReadOnlyItemWhenInOtherPaperFromPaperEditInStatusReviewedTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['itemids'][1];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab);
 
        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);
        $P->waitThenClick(ItemPage::$editItemButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemSetterPaperApproverCantEditReadOnlyItemFromReadOnlyPaperInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][2];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->openPaperInReadOnly($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$binocularsButton);
        $P->waitForReload();

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId . '&paper-read-only=true');
        $P->waitThenClick(ItemPage::$editItemButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        // TODO check for modal message

        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemSetterPaperApproverCantEditReadOnlyItemWhenInOtherPaperFromReadOnlyPaperInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][3];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->openPaperInReadOnly($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$binocularsButton);
        $P->waitForElementVisible(ItemPage::$previewTab);
        $P->waitThenClick(ItemPage::$editItemButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        // TODO check for modal message

        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip
     *
     * Failing - https://www.pivotaltracker.com/story/show/166585047
     */
    public function ItemSetterPaperApproverCantEditItemDirectlyFromUrlWhenInOtherPaperTest(ItemStep $I) {
        $paperId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['itemids'][1];

        $I->editItemWithPaperId($itemId, $paperId);
        $I->waitForElementVisible(ItemPage::$dynamicModal);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemSetterPaperApproverCanReplaceReadOnlyItemFromPaperEditInStatusReviewedWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['itemids'][1];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab);

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
    public function ItemSetterPaperApproverCanReplaceItemFromPaperEditInStatusReviewedWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperApproverMaths['paperReviewedMultipleChangeDraftItems']['itemids'][3];
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
