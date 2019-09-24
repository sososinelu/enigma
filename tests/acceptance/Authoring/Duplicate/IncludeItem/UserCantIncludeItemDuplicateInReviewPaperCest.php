<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

class UserCantIncludeItemDuplicateInReviewPaperCest
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
    public function UserCantDuplicateDraftItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['items'][0];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);

    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip https://www.pivotaltracker.com/story/show/166762383
     * Items in state change are missing duplicate button 
     */
    public function UserCantDuplicateChangeItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['items'][0];
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
    public function UserCantDuplicateReviewedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['items'][0];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);

    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip https://www.pivotaltracker.com/story/show/166762383
     * Items in state change are missing duplicate button 
     */
    public function UserCantDuplicateApprovedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['items'][1];
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
        $paperId = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['items'][2];
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
        $paperId = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['items'][3];
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
        $paperId = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['reviewPaperAllSharedItems']['items'][3];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
    }
}