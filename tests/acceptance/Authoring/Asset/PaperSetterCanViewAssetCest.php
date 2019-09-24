<?php

use Step\Acceptance\Asset\HandleAsset as AssetStep;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Paper\Paper as PaperStep;
use Step\Acceptance\Login as LoginStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Selectors\Paper as PaperPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;

class PaperSetterCanViewAssetCest
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
        $loginStep->clearSession(LoginPage::$paperSetter['email']);
    }

    /**
     * With and without image
     * @param PaperStep $P
     * @param AssetStep $A
     * @throws Exception
     */
    public function PaperSetterCanViewAssetBriefInPaperPreviewTest(PaperStep $P, AssetStep $A)
    {
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];
        $paperid = ItemPaperData::$draftPaperWithAssets['paperid'];

        $P->editPaper($paperid);
        $P->waitThenClick(PaperPage::$previewTab);

        // Content block
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefContentBlockWithoutImage']);
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefContentBlockWithImage'], true);

        // Question block
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefQuestionBlockWithoutImage']);
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefQuestionBlockWithImage'], true);
    }

    /**
     * @param PaperStep $P
     * @param AssetStep $A
     * @throws Exception
     */
    public function PaperSetterCanViewAssetInPaperPreviewTest(PaperStep $P, AssetStep $A)
    {
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];
        $paperid = ItemPaperData::$draftPaperWithAssets['paperid'];

        $P->editPaper($paperid);
        $P->waitThenClick(PaperPage::$previewTab);

        $A->seeAssetOnPage(ItemPage::$finalAssetOnPage, 'asset-final', $assets['finalAssetContentBlock']);
        $A->seeAssetOnPage(ItemPage::$finalAssetOnPage, 'asset-final', $assets['finalAssetQuestionBlock']);
    }

    /**
     * @param PaperStep $P
     * @param AssetStep $A
     * @throws Exception
     */
    public function PaperSetterCanViewAudioAssetInPaperPreviewTest(PaperStep $P, AssetStep $A)
    {
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];
        $paperid = ItemPaperData::$draftPaperWithAssets['paperid'];

        $P->editPaper($paperid);
        $P->waitThenClick(PaperPage::$previewTab);

        $A->seeAssetOnPage(ItemPage::$audioAssetOnPage, 'asset-final', $assets['audioAssetContentBlock']);
        $A->seeAssetOnPage(ItemPage::$audioAssetOnPage, 'asset-final', $assets['audioAssetQuestionBlock']);
    }

    /**
     * @skip - can't get video to work
     * @param PaperStep $P
     * @param AssetStep $A
     * @throws Exception
     */
    public function PaperSetterCanViewVideoAssetInPaperPreviewTest(PaperStep $P, AssetStep $A)
    {
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];
        $paperid = ItemPaperData::$draftPaperWithAssets['paperid'];

        $P->editPaper($paperid);
        $P->waitThenClick(PaperPage::$previewTab);

        $A->seeAssetOnPage(ItemPage::$videoAssetOnPage, 'asset-final', $assets['videoAssetContentBlock']);
        $A->seeAssetOnPage(ItemPage::$videoAssetOnPage, 'asset-final', $assets['videoAssetQuestionBlock']);
    }

    /**
     * - check can see asset brief, final asset and asset brief with image
     * @param PaperStep $P
     * @param AssetStep $A
     * @throws Exception
     */
    public function PaperSetterCanViewCorrectMcqAnswerAssetInMarkSchemeTest(PaperStep $P, AssetStep $A)
    {
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];
        $paperid = ItemPaperData::$draftPaperWithAssets['paperid'];

        $P->editPaper($paperid);

        // Markscheme
        $A->waitThenClick(PaperPage::$markSchemeTab);

        $A->waitForElementVisible(sprintf(ItemPage::$mcqAnswerAsset, $assets['finalAssetMcqCorrectAnswer']));

        $A->seeElement(sprintf(ItemPage::$mcqAnswerAsset, $assets['finalAssetMcqCorrectAnswer']));
        $A->seeElement(sprintf(ItemPage::$mcqAnswerAsset, $assets['assetBriefWithoutImageMcqCorrect']));
        $A->seeElement(sprintf(ItemPage::$mcqAnswerAsset, $assets['assetBriefWithImageMcqCorrect']));
    }

    /**
     * @param PaperStep $P
     * @param AssetStep $A
     * @throws Exception
     */
    public function PaperSetterCanViewAssetsInPaperTabularMarkSchemeTest(PaperStep $P, AssetStep $A)
    {
        $paperid = ItemPaperData::$draftPaperWithAssets['paperid'];
        $assets = ItemPaperData::$reviewItemWAssetTabularMarkScheme['asset_workflowids'];

        $P->editPaper($paperid);

        // Markscheme
        $A->waitThenClick(PaperPage::$markSchemeTab);
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefMarkSchemeWithImage'], true);
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefMarkSchemeWithoutImage']);

        $A->seeAssetOnPage(ItemPage::$finalAssetOnPage, 'asset-final', $assets['finalAssetMarkScheme']);
        $A->seeAssetOnPage(ItemPage::$videoAssetOnPage, 'asset-final', $assets['videoAssetMarkScheme']);
        $A->seeAssetOnPage(ItemPage::$audioAssetOnPage, 'asset-final', $assets['audioAssetMarkScheme']);
    }

    /**
     * @param PaperStep $P
     * @param AssetStep $A
     * @throws Exception
     */
    public function PaperSetterCanViewAssetInPaperFreeTextMarkSchemeTest(PaperStep $P, AssetStep $A)
    {
        $paperid = ItemPaperData::$draftPaperWithAssets['paperid'];
        $assets = ItemPaperData::$reviewItemWAssetFreeTextMarkScheme['asset_workflowids'];

        $P->editPaper($paperid);

        // Markscheme
        $A->waitThenClick(PaperPage::$markSchemeTab);
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefMarkSchemeWithImage'], true);
        $A->seeAssetBriefOnPage('asset-placeholder', $assets['assetBriefMarkSchemeWithoutImage']);

        $A->seeAssetOnPage(ItemPage::$finalAssetOnPage, 'asset-final', $assets['finalAssetMarkScheme']);
        $A->seeAssetOnPage(ItemPage::$videoAssetOnPage, 'asset-final', $assets['videoAssetMarkScheme']);
        $A->seeAssetOnPage(ItemPage::$audioAssetOnPage, 'asset-final', $assets['audioAssetMarkScheme']);
    }
}