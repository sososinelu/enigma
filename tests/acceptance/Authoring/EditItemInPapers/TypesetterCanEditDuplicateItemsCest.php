<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class TypesetterCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$typeSetter);
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
     * @param PaperStep $P
     * @throws Exception
     */
    public function TypesetterCanEditItemFromPaperEditInStatusTypesettingTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$editItemInPaperButton);
        $P->waitThenClick(PaperPage::$modalActionButton);

        $P->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->makeChangeAndSaveItem();
        $I->waitForElement(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }
    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function TypesetterCantEditItemWhenInAnotherPaperFromPaperEditInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['itemids'][1];
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
    public function TypesetterCanEditReadOnlyItemFromPaperEditInStatusTypesettingTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);
        $I->waitThenClick(ItemPage::$editItemButton);
        $P->waitThenClick(PaperPage::$modalActionButton);

        $P->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);

        $I->makeChangeAndSaveItem();
        $I->waitForElement(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }
    /**
     * @param PaperStep $P
     * @throws Exception
     *
     */
    public function TypesetterCantEditReadOnlyItemWhenInAnotherPaperFromPaperEditInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['itemids'][1];
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
     * @skip
     *
     * Failing - https://www.pivotaltracker.com/story/show/166585047
     */
    public function TypesetterCantEditItemDirectlyFromUrlWhenInOtherPaperTest(ItemStep $I) {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['itemids'][1];

        $I->editItemWithPaperId($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function TypesetterCantEditReadOnlyItemFromReadOnlyPaperInStatusTypesettingTest(PaperStep $P)
    {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['paperid'];

        $P->openPaperInReadOnly($paperId);
        $P->cantSeeElement(PaperPage::$binocularsButton);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     *
     */
    public function TypesetterCanReplaceReadOnlyItemWhenInOtherPaperFromPaperEditInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$typesetterMaths['typesettingPaperMultipleItems']['itemids'][1];
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
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeElement(ItemPage::$duplicatedFrom);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function TypesetterCanReplaceItemWhenInOtherPaperFromPaperEditInStatusTypesettingTest(PaperStep $P) {
        $paperId = ItemPaperData::$typesetterMaths['typesettingPaperOneItem']['paperid'];
        $itemId = ItemPaperData::$typesetterMaths['typesettingPaperOneItem']['itemids'][0];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$editItemInPaperButton);

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->see(ItemPage::$noEditItem, ItemPage::$dynamicModal);
        $P->see(ItemPage::$replaceItem, ItemPage::$dynamicModal);

        $P->click(PaperPage::$createDuplicateButtonText, ItemPage::$dynamicModal);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->seeElement(ItemPage::$duplicatedFrom);
    }
}
