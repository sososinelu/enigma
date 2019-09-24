<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

class UserCantReplaceItemDuplicateInPretestPaperCest
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
        $I->clearSession();
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCantReplaceApprovedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['pretestPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['pretestPaperAllSharedItems']['items'][3];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$editItemButton);
        $I->dontSee(PaperPage::$createDuplicateButtonText);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCantReplacePretestItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['pretestPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['pretestPaperAllSharedItems']['items'][4];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$editItemButton);
        $I->dontSee(PaperPage::$createDuplicateButtonText);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCantReplaceArchiveItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['approvedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['approvedPaperAllSharedItems']['items'][5];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->dontSee(ItemPage::$editItemButton);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCantReplaceRejectedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['approvedPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['approvedPaperAllSharedItems']['items'][6];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->dontSee(ItemPage::$editItemButton);
    }
}