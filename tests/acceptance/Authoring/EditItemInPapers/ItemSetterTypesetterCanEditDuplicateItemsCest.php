<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class ItemSetterTypesetterCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemSetterTypesetter);
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
    public function ItemSetterTypesetterCanEditDraftItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['itemDraftNotInPaper']['itemid'];

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
    public function ItemSetterTypesetterCanEditDraftItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['itemDraftInOnePaper']['itemid'];

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
    public function ItemSetterTypesetterCanEditDraftItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['itemDraftInTwoPapers']['itemid'];

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
    public function ItemSetterTypesetterCanEditChangeItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['itemChangeNotInPaper']['itemid'];

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
    public function ItemSetterTypesetterCanEditChangeItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['itemChangeInOnePaper']['itemid'];

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
    public function ItemSetterTypesetterCanEditChangeItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['itemChangeInTwoPapers']['itemid'];

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
    public function ItemSetterTypesetterCanEditItemFromPaperInEditInStatusTypesettingTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][0];
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
    public function ItemSetterTypesetterCantEditItemFromPaperInEditInStatusTypesettingWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][1];
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
    public function ItemSetterTypesetterCanEditReadOnlyItemFromPaperEditInStatusTypesettingTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][0];
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
    public function ItemSetterTypesetterCantEditReadOnlyItemWhenInOtherPaperTestFromPaperInEditInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][1];
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
    public function ItemSetterTypesetterCantEditItemFromReadOnlyPaperInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->openPaperInReadOnly($paperId);
        $P->cantSeeElement($itemIdSelector . ' ' . PaperPage::$binocularsButton);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip
     *
     * Failing - https://www.pivotaltracker.com/story/show/166585047
     */
    public function ItemPaperTypesetterCantEditItemDirectlyFromUrlWhenInOtherPaperTest(ItemStep $I) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][1];

        $I->editItemWithPaperId($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemSetterTypesetterCanReplaceReadOnlyItemFromPaperInEditInStatusTypesettingWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingMultipleChangeItems']['itemids'][1];
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
     * @skip TODO - fails because item is no longer in two papers
     */
    public function ItemSetterTypesetterCanReplaceItemFromPaperInEditInStatusTypesettingWhenInOtherPaperTest(PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingTwoChangeItem']['paperid'];
        $itemId = ItemPaperData::$itemSetterTypesetterMaths['paperTypesettingTwoChangeItem']['itemids'][0];
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
