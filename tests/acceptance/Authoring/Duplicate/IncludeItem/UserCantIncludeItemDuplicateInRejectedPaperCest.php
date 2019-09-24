<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

class UserCantIncludeItemDuplicateInRejectedPaperCest
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
     * @throws Exception
     */
    public function UserCantDuplicateApprovedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['items'][3];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCantDuplicatePretestItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['items'][4];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCantDuplicateArchiveItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['items'][5];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCantDuplicateRejectedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['rejectedPaperAllSharedItems']['items'][6];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
    }
}