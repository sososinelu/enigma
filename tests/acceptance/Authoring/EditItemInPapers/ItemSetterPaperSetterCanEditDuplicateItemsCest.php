<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

use Step\Acceptance\Paper\Paper as PaperStep;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class ItemSetterPaperSetterCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemSetterPaperSetter);
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
    public function ItemPaperSetterCanEditDraftItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['itemDraftNotInPaper']['itemid'];

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
    public function ItemPaperSetterCanEditDraftItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['itemDraftInOnePaper']['itemid'];

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
    public function ItemPaperSetterCanEditDraftItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['itemDraftInTwoPapers']['itemid'];

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
    public function ItemPaperSetterCanEditChangeItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['itemChangeNotInPaper']['itemid'];

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
    public function ItemPaperSetterCanEditChangeItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['itemChangeInOnePaper']['itemid'];

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
    public function ItemPaperSetterCanEditChangeItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['itemChangeInTwoPapers']['itemid'];

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
    public function ItemPaperSetterCanEditItemFromDraftPaperInEditTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
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
    public function ItemPaperSetterCantEditItemFromDraftPaperInEditWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['itemids'][1];
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
    public function ItemPaperSetterCanEditReadOnlyItemFromDraftPaperInEditTest(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->waitThenClick(ItemPage::$editItemButton);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->makeChangeAndSaveDraftItem();

        // due to potential for redirect after saving,
        // ignore re-direct and open the item manually
        $I->openItemInReadOnly($itemId);
        $I->waitForElementVisible(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemPaperSetterCantEditReadOnlyItemFromDraftPaperInEditWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['itemids'][1];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab);

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
     * @skip
     *
     * Failing - https://www.pivotaltracker.com/story/show/166585047
     */
    public function ItemPaperSetterCantEditItemDirectlyFromUrlWhenInOtherPaperTest(ItemStep $I) {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['itemids'][1];

        $I->editItemWithPaperId($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemPaperSetterCantEditReadOnlyItemFromReadOnlyDraftPaperTest(PaperStep $P)
    {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['paperid'];

        $P->openPaperInReadOnly($paperId);
        $P->cantSeeElement(PaperPage::$binocularsButton);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemPaperSetterCanReplaceReadOnlyItemFromDraftPaperInEditWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithMultipleDraftItems']['itemids'][1];
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
    public function ItemPaperSetterCanReplaceItemFromDraftPaperInEditWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithDraftItem']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['paperDraftWithDraftItem']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $P->waitForReload();

        $P->seeElement(ItemPage::$duplicatedFrom);
    }
}
