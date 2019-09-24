<?php

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

class UserCantIncludeItemDuplicateInTypesettingPaperCest
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
     * @skip https://www.pivotaltracker.com/story/show/166766184
     * user who is typesetter and item setter can actually duplicate paper and include duplicate in paper
     */
    public function UserCantDuplicateReviewedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['items'][0];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);

    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip https://www.pivotaltracker.com/story/show/166766184
     * user who is typesetter and item setter can actually duplicate paper and include duplicate in paper
     */
    public function UserCantDuplicateApprovedItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['items'][1];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);

    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip https://www.pivotaltracker.com/story/show/166766184
     * user who is typesetter and item setter can actually duplicate paper and include duplicate in paper
     */
    public function UserCantDuplicatePretestItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['items'][2];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     * @skip https://www.pivotaltracker.com/story/show/166766184
     * user who is typesetter and item setter can actually duplicate paper and include duplicate in paper
     */
    public function UserCantDuplicateArchiveItemInItemReadOnly(ItemStep $I)
    {
        $paperId = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['paperid'];
        $item = ItemPaperData::$allGeneralMaths['typesettingPaperAllSharedItems']['items'][3];
        $I->openItemInReadOnlyWithPaperId($item['id'], $paperId);
        $I->waitForElementVisible(ItemPage::$previewTab, 5);
        $I->waitThenClick(ItemPage::$duplicateButton);
        $I->waitForElementVisible(ItemPage::$duplicateItemModal);
        $I->dontSee(ItemPage::$duplicateIncludeInPaper, ItemPage::$duplicateItemModal);
    }
}