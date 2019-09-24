<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class ItemSetterPaperReviewerCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemSetterPaperReviewer);
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
    public function ItemSetterPaperReviewerCanEditDraftItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['itemDraftNotInPaper']['itemid'];

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
    public function ItemSetterPaperReviewerCanEditDraftItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['itemDraftInOnePaper']['itemid'];

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
    public function ItemSetterPaperReviewerCanEditDraftItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['itemDraftInTwoPapers']['itemid'];

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
    public function ItemSetterPaperReviewerCanEditChangeItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['itemChangeNotInPaper']['itemid'];

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
    public function ItemSetterPaperReviewerCanEditChangeItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['itemChangeInOnePaper']['itemid'];

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
    public function ItemSetterPaperReviewerCanEditChangeItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['itemChangeInTwoPapers']['itemid'];

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
     * @skip
     *
     * Failing - https://www.pivotaltracker.com/story/show/166585047
     */
    public function ItemSetterPaperReviewerCantEditReadOnlyItemFromReadOnlyPaperInStatusReviewTest(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['itemids'][0];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->openPaperInReadOnly($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$binocularsButton);
        $P->waitForElementVisible(ItemPage::$previewTab);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId . '&paper-read-only=true');
        $P->waitThenClick(ItemPage::$editItemButton);

        // TODO - check correct message is displayed in modal (#165762238)

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);

        $I->editItemWithPaperIdInReadOnly($itemId, $paperId);
        $I->wait(10);
        $I->canSeeElement(ItemPage::$errorPage);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip
     *
     * Failing - https://www.pivotaltracker.com/story/show/166585047
     */
    public function ItemSetterPaperReviewerCantEditItemDirectFromUrlWithReadOnlyFlagTest(ItemStep $I)
    {
        $paperId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['itemids'][0];

        $I->editItemWithPaperIdInReadOnly($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     * @skip
     *
     * Failing - https://www.pivotaltracker.com/story/show/166585047
     */
    public function ItemSetterPaperReviewerCantEditReadOnlyItemFromReadOnlyPaperInStatusReviewWhenInOtherPaperTest(ItemStep $I, PaperStep $P) {
        $paperId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['itemids'][2];
        $itemIdSelector = '#item-workflow-' . $itemId;

        $P->openPaperInReadOnly($paperId);
        $P->waitThenClick($itemIdSelector . ' ' . PaperPage::$binocularsButton);
        $P->waitForElementVisible(ItemPage::$previewTab);

        $P->seeCurrentUrlEquals(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId . '&paper-read-only=true');
        $I->waitThenClick(ItemPage::$editItemButton);

        // TODO - check correct message is displayed in modal (#165762238)

        $P->waitForElementVisible(ItemPage::$dynamicModal);
        $P->click(PaperPage::$cancelButtonText, ItemPage::$dynamicModal);

        $I->editItemWithPaperIdInReadOnly($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }
}
