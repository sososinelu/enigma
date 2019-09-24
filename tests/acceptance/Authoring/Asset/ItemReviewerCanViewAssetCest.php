<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Asset\HandleAsset as AssetStep;
use Step\Acceptance\Login as LoginStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;

class ItemReviewerCanViewAssetCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemReviewer);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    /**
     * @param $loginStep $loginStep
     * @throws Exception
     */
    public function _after(LoginStep $loginStep)
    {
        $loginStep->clearSession(LoginPage::$itemReviewer['email']);
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewAssetBriefTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];

        $I->openItemInReadOnly($itemid);
        $I->wait(5);

        // Content block
        $A->viewAssetBriefModal($assets['assetBriefContentBlockWithoutImage']);
        $A->viewAssetBriefModal($assets['assetBriefContentBlockWithImage'], true);

        // Question block
        $A->viewAssetBriefModal($assets['assetBriefQuestionBlockWithoutImage']);
        $A->viewAssetBriefModal($assets['assetBriefQuestionBlockWithImage'], true);
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewAssetTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];

        $I->openItemInReadOnly($itemid);

        $A->viewAssetModal($assets['finalAssetContentBlock'], ItemPage::$finalAssetInModal);
        $A->viewAssetModal($assets['finalAssetQuestionBlock'], ItemPage::$finalAssetInModal);
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewAudioAssetTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];

        $I->openItemInReadOnly($itemid);

        $A->viewAssetModal($assets['audioAssetContentBlock'], ItemPage::$audioAssetInModal);
        $A->viewAssetModal($assets['audioAssetQuestionBlock'], ItemPage::$audioAssetInModal);
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewVideoAssetTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];

        $I->openItemInReadOnly($itemid);

        $A->viewAssetModal($assets['videoAssetContentBlock'], ItemPage::$videoAssetInModal);
        $A->viewAssetModal($assets['videoAssetQuestionBlock'], ItemPage::$videoAssetInModal);
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewAssetInMcqAnswerTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];

        $I->openItemInReadOnly($itemid);

        $A->viewAssetModal($assets['finalAssetMcqAnswerA'], ItemPage::$finalAssetInModal);
        $A->viewAssetBriefModal($assets['assetBriefWithImageMcqAnswerA'], true);
        $A->viewAssetBriefModal($assets['assetBriefWithoutImageMcqAnswerA']);
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewCorrectMcqAnswerAssetInMarkSchemeTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];
        $I->openItemInReadOnly($itemid);

        // Markscheme
        $A->waitThenClick(ItemPage::$markSchemeTab);

        $A->waitForElementVisible(sprintf(ItemPage::$mcqAnswerAsset, $assets['finalAssetMcqCorrectAnswer']));

        $A->seeElement(sprintf(ItemPage::$mcqAnswerAsset, $assets['finalAssetMcqCorrectAnswer']));
        $A->seeElement(sprintf(ItemPage::$mcqAnswerAsset, $assets['assetBriefWithoutImageMcqCorrect']));
        $A->seeElement(sprintf(ItemPage::$mcqAnswerAsset, $assets['assetBriefWithImageMcqCorrect']));
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewAssetInFreeTextMarkSchemeTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];

        $I->openItemInReadOnly($itemid);

        // Markscheme
        $A->waitThenClick(ItemPage::$markSchemeTab);
        $A->viewAssetBriefModal($assets['assetBriefMarkSchemeWithImage'], true);
        $A->viewAssetBriefModal($assets['assetBriefMarkSchemeWithoutImage']);

        $A->viewAssetModal($assets['finalAssetMarkScheme'], ItemPage::$finalAssetInModal);
        $A->viewAssetModal($assets['videoAssetMarkScheme'], ItemPage::$videoAssetInModal);
        $A->viewAssetModal($assets['audioAssetMarkScheme'], ItemPage::$audioAssetInModal);
    }

    /**
     * @param ItemStep $I
     * @param AssetStep $A
     * @throws Exception
     */
    public function ItemReviewerCanViewAssetInTabularMarkSchemeTest(ItemStep $I, AssetStep $A)
    {
        $itemid = ItemPaperData::$reviewItemWAssetTabularMarkScheme['itemid'];
        $assets = ItemPaperData::$reviewItemWAssetTabularMarkScheme['asset_workflowids'];

        $I->openItemInReadOnly($itemid);

        // Markscheme
        $A->waitThenClick(ItemPage::$markSchemeTab);
        $A->viewAssetBriefModal($assets['assetBriefMarkSchemeWithImage'], true);
        $A->viewAssetBriefModal($assets['assetBriefMarkSchemeWithoutImage']);

        $A->viewAssetModal($assets['finalAssetMarkScheme'], ItemPage::$finalAssetInModal);
        $A->viewAssetModal($assets['videoAssetMarkScheme'], ItemPage::$videoAssetInModal);
        $A->viewAssetModal($assets['audioAssetMarkScheme'], ItemPage::$audioAssetInModal);
    }
}