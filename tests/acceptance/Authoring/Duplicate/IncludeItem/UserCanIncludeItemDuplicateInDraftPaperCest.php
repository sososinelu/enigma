<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\Paper as PaperStep;

class UserCanIncludeItemDuplicateInDraftPaperCest
{
    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$allGeneral);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$allGeneral['email']);
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception
     */
    public function UserCanIncludeDuplicateReviewedItemInItemReadOnly(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['draftPaperReviewedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['draftPaperReviewedItems']['items'][0];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }

    /**
     * @param ItemStep $I
     * @param PaperStep $P
     * @throws Exception 
     * 
     */
    public function UserCanIncludeDuplicateReviewedItemInItemEdit(ItemStep $I, PaperStep $P)
    {
        $paperId = ItemPaperData::$allGeneralMaths['draftPaperReviewedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['draftPaperReviewedItems']['items'][1];

        $I->editItemWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->see(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);

        $I->checkOption(ItemPage::$duplicateIncludeInPaper);
        $I->wait(0.2);
        $I->click(ItemPage::$duplicateModalButtonText, ItemPage::$duplicateItemModal);
        $I->waitForElementNotVisible(ItemPage::$duplicateItemModal);
        $I->waitThenClick(ItemPage::$cancelButton);
        $I->wait(0.5);
        $P->editPaper($paperId);
        // i can see the default duplicated item name
        $P->see($item['name'] . ' [duplicate]');
    }
}