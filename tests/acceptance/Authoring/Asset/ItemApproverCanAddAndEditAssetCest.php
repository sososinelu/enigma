<?php
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class ItemApproverCanAddAndEditAssetCest
{
    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$itemApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    /**
     * @param LoginStep $I
     * @throws Exception
     */
    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$itemApprover['email']);
    }

    public function itemApproverCanAddAssetBriefTest(ItemStep $I)
    {
        $itemId = ItemPaperData::$reviewedItemAssets['itemid'];
        $I->editItem($itemId);

        /**
         *  Add to question block
         */
        $I->addAsset('Brief',sprintf(ItemPage::$contentBlockText, 0));
        $I->addAsset('Brief',sprintf(ItemPage::$contentBlockText, 0));
        $I->addAsset('Brief',sprintf(ItemPage::$contentBlockText, 0), 1, 'lionchu.png');

        /**
         *  Add content block
         */
        $I->addContentBlockToItem();
        $I->addAsset('Brief',sprintf(ItemPage::$contentBlockText, 1), 2, 'lionchu.png');
        $I->addAsset('Brief',sprintf(ItemPage::$contentBlockText, 1), 2);
        $I->itemGoBackWithoutSaving();
    }

    public function itemApproverCanAddAssetTest(ItemStep $I)
    {
        $itemId = ItemPaperData::$reviewedItemAssets['itemid'];
        $I->editItem($itemId);

        /**
         *  Add to question block
         */
        $I->addAsset('Picture', sprintf(ItemPage::$contentBlockText, 0), 1, 'lionchu.png');
        $I->addAsset('Picture', sprintf(ItemPage::$contentBlockText, 0), 1, 'A.png');
        $I->addAsset('Picture', sprintf(ItemPage::$contentBlockText, 0), 1, 'B.png');

        /**
         *  Add content block
         */
        $I->addContentBlockToItem();
        $I->addAsset('Picture', sprintf(ItemPage::$contentBlockText, 1), 2, 'lionchu.png');
        $I->addAsset('Picture', sprintf(ItemPage::$contentBlockText, 1), 2, 'C.png');
        $I->itemGoBackWithoutSaving();
    }

    public function itemApproverCanAddAudioAssetTest(ItemStep $I)
    {
        $itemId = ItemPaperData::$reviewedItemAssets['itemid'];
        $I->editItem($itemId);

        /**
         *  Add to question block
         */
        $I->addAsset('Audio', sprintf(ItemPage::$contentBlockText, 0), 1, 'audio-asset.mp3');

        /**
         *  Add content block
         */
        $I->addContentBlockToItem();
        $I->addAsset('Audio', sprintf(ItemPage::$contentBlockText, 1), 2, 'audio-asset.mp3');
        $I->itemGoBackWithoutSaving();
    }

        /**
        * @skip - can't get video to work
         */
    public function itemApproverCanAddVideoAssetTest(ItemStep $I)
    {
        $itemId = ItemPaperData::$reviewedItemAssets['itemid'];
        $I->editItem($itemId);

        /**
         *  Add to question block
         */
        $I->addAsset('Video', sprintf(ItemPage::$contentBlockText, 0), 1, 'video-asset.mp4');

        /**
         *  Add content block
         */
        $I->addContentBlockToItem();
        $I->addAsset('Video', sprintf(ItemPage::$contentBlockText, 1), 2, 'video-asset.mp4');
        $I->itemGoBackWithoutSaving();
    }

    public function itemApproverCanAddAssetsInMcqAnswerTest(ItemStep $I)
    {
        $itemId = ItemPaperData::$reviewedItemAssets['itemid'];
        $I->editItem($itemId);
        $I->addAssetInMcqAnswer();
        $I->checkAssetInMarkSchemeTab();
        $I->itemGoBackWithoutSaving();
    }

    public function itemApproverCanAddAssetInFreeTextMarkSchemeTest(ItemStep $I)
    {
        $itemId = ItemPaperData::$reviewedItemAssets['itemid'];
        $I->editItem($itemId);
        $I->addAssetInMarkSchemeTab(); // Free text
        $I->itemGoBackWithoutSaving();
    }

    public function itemApproverCanAddAssetInTabularMarkSchemeTest(ItemStep $I)
    {
        $itemId = ItemPaperData::$reviewedItemAssets['itemid'];
        $I->editItem($itemId);
        $I->addAssetInMarkSchemeTab('tabular'); // Tabular
        $I->itemGoBackWithoutSaving();
    }
}