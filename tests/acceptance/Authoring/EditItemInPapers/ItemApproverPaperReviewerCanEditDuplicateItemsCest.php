<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class ItemApproverPaperReviewerCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemApproverPaperReviewer);
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
    public function ItemApproverPaperReviewerCanEditReadOnlyItemInStatusReviewedInNoPaperTest(ItemStep $I) {
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
    public function ItemApproverPaperReviewerCantEditReadOnlyItemInStatusReviewedInOnePaperTest(ItemStep $I) {
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
    public function ItemApproverPaperReviewerCantEditReadOnlyItemInStatusReviewedInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$reviewedItemInMultiplePapers['itemid'];

        $I->openItemInReadOnly($itemId);
        $I->waitThenClick(ItemPage::$editItemButton);

        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->see(ItemPage::$noEditMultiplePaperDuplicateItem, ItemPage::$dynamicModal);
        $I->click(ItemPage::$cancelButtonText, ItemPage::$dynamicModal);
    }

    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function ItemApproverPaperReviewerCantEditReadOnlyItemFromReadOnlyPaperInStatusReviewTest (PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperReviewerMaths['reviewPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperReviewerMaths['reviewPaperMultipleItems']['itemids'][0];
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
    public function ItemApproverPaperReviewerCantEditReadOnlyItemWhenInOtherPaperFromReadOnlyPaperInStatusReviewTest (PaperStep $P) {
        $paperId = ItemPaperData::$itemApproverPaperReviewerMaths['reviewPaperMultipleItems']['paperid'];
        $itemId = ItemPaperData::$itemApproverPaperReviewerMaths['reviewPaperMultipleItems']['itemids'][1];
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
     * @param ItemStep $I
     * @throws Exception
     */
    public function ItemApproverPaperReviewerCantEditItemDirectFromUrlWithReadOnlyFlagTest(ItemStep $I)
    {
        $paperId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['paperid'];
        $itemId = ItemPaperData::$itemSetterPaperReviewerMaths['paperReviewMultipleDraftChangeItems']['itemids'][0];

        $I->editItemWithPaperIdInReadOnly($itemId, $paperId);
        $I->canSeeElement(ItemPage::$errorPage);
    }
}
