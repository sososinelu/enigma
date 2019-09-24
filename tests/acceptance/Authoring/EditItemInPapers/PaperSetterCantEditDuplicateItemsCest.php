<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;

class PaperSetterCantEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$paperSetter);
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
     * @param PaperStep $P
     * @throws Exception
     */
    public function PaperSetterCantEditItemFromDraftPaperEditTest(PaperStep $P) {
        $paperId = ItemPaperData::$draftPaper['paperid'];
        $itemId = ItemPaperData::$draftPaper['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->cantSeeElement($itemIdSelector . ' ' . PaperPage::$editItemInPaperButton);
    }
    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function PaperSetterCantEditReadOnlyItemFromDraftPaperEditTest(PaperStep $P) {
        $paperId = ItemPaperData::$draftPaper['paperid'];
        $itemId = ItemPaperData::$draftPaper['itemids'][0];
        $itemIdSelector = '#item-workflow-'.$itemId;

        $P->editPaper($paperId);
        $P->waitThenClick($itemIdSelector . ' ' .  PaperPage::$viewItemInPaperButton);
        $P->waitForElementVisible(ItemPage::$previewTab, 5);

        $P->cantSeeElement(ItemPage::$editItemButton);
    }
    /**
     * @param PaperStep $P
     * @throws Exception
     */
    public function PaperSetterCantEditReadOnlyItemFromDraftPaperInReadOnlyTest(PaperStep $P) {
        $paperId = ItemPaperData::$draftPaper['paperid'];

        $P->openPaperInReadOnly($paperId);
        $P->cantSeeElement(PaperPage::$binocularsButton);
    }
}
