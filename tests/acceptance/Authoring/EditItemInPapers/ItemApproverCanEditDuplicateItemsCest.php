<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;

class ItemApproverCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemApprover);
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
    public function ItemApproverCanEditReadOnlyItemInStatusReviewedInNoPaperTest(ItemStep $I) {
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
    public function ItemApproverCantEditReadOnlyItemInStatusReviewedInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$reviewedItemInOnePaper['itemid'];

        $I->openItemInReadOnly($itemId);
        $I->waitThenClick(ItemPage::$editItemButton);

        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->see(ItemPage::$noEditDirectDuplicateItem, ItemPage::$dynamicModal);
        $I->click(ItemPage::$cancelButtonText, ItemPage::$dynamicModal);
    }
    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function ItemApproverCantEditReadOnlyItemInStatusReviewedInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$reviewedItemInMultiplePapers['itemid'];

        $I->openItemInReadOnly($itemId);
        $I->waitThenClick(ItemPage::$editItemButton);

        $I->waitForElementVisible(ItemPage::$dynamicModal);
        $I->see(ItemPage::$noEditMultiplePaperDuplicateItem, ItemPage::$dynamicModal);
        $I->click(ItemPage::$cancelButtonText, ItemPage::$dynamicModal);
    }
}
