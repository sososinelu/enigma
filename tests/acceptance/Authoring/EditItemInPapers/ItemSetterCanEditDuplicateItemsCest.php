<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;

class ItemSetterCanEditDuplicateItemsCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemSetter);
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
    public function ItemPaperSetterCanEditDraftItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterMaths['itemDraftNotInPaper']['itemid'];

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
    public function ItemPaperSetterCanEditDraftItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterMaths['itemDraftInOnePaper']['itemid'];

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
    public function ItemPaperSetterCanEditDraftItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterMaths['itemDraftInTwoPapers']['itemid'];

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
    public function ItemPaperSetterCanEditChangeItemInNoPaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterMaths['itemChangeNotInPaper']['itemid'];

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
    public function ItemPaperSetterCanEditChangeItemInOnePaperTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterMaths['itemChangeInOnePaper']['itemid'];

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
    public function ItemPaperSetterCanEditChangeItemInTwoPapersTest(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterMaths['itemChangeInTwoPapers']['itemid'];

        $I->editItem($itemId);
        $I->seeCurrentUrlEquals(ItemPage::$editURL . '/' . $itemId);
        $I->makeChangeAndSaveDraftItem();

        // due to potential for redirect after saving,
        // ignore re-direct and open the item manually
        $I->openItemInReadOnly($itemId);
        $I->waitForElement(ItemPage::$durationReadOnly,30);
        $I->see(ItemPage::$newDurationValue, ItemPage::$durationReadOnly);
    }
}
