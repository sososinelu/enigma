<?php
namespace Step\Api;
use Page\Selectors\Paper;
use Page\Selectors\Item;

class download extends \ApiTester
{
    public function canDownloadItemsAllFormats($itemIds, $ignoreImageZip=false)
    {
        $I = $this;
        $I->canDownloadItemsToWord($itemIds);
        $I->canDownloadItemsToQTI($itemIds);
        // Only items with images can download to image zip, 
        // other will fail even if access rights are ok
        if(!$ignoreImageZip){
            $I->canDownloadImagesInItemsToImageZip($itemIds);
        }
    }

    public function cannotDownloadItemsAnyFormats($itemIds, $ignoreImageZip=false)
    {
        $I = $this;
        $I->cannotDownloadItemsToWord($itemIds);
        $I->cannotDownloadItemsToQTI($itemIds);
        // Only items with images can download to image zip, 
        // other will fail even if access rights are ok
        if(!$ignoreImageZip){
            $I->cannotDownloadImagesInItemsToImageZip($itemIds);
        }
    }

    public function canDownloadItemsToWord($itemIds)
    {
        $I = $this;
        foreach($itemIds as $itemId) {
            $I->sendGET(Item::$downloadWordDocURL.$itemId.'/item');
            $I->canSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function canDownloadItemsToQTI($itemIds)
    {
        $I = $this;
        foreach($itemIds as $itemId) {
            $I->sendGET(Item::$downloadQtiItemURL.$itemId);
            $I->canSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function canDownloadImagesInItemsToImageZip($itemIds)
    {
        $I = $this;
        foreach($itemIds as $itemId) {
            $I->sendGET(Item::$downloadImageZipURL.$itemId.'/item');
            $I->canSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function cannotDownloadItemsToWord($itemIds)
    {
        $I = $this;
        foreach($itemIds as $itemId) {
            $I->sendGET(Item::$downloadWordDocURL.$itemId.'/item');
            $I->cantSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function cannotDownloadItemsToQTI($itemIds)
    {
        $I = $this;
        foreach($itemIds as $itemId) {
            $I->sendGET(Item::$downloadQtiItemURL.$itemId);
            $I->cantSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function cannotDownloadImagesInItemsToImageZip($itemIds)
    {
        $I = $this;
        foreach($itemIds as $itemId) {
            $I->sendGET(Item::$downloadImageZipURL.$itemId.'/item');
            $I->cantSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function canDownloadPapersAllFormats($paperIds, $ignoreImageZip=false)
    {
        $I = $this;
        $I->canDownloadPapersToExcel($paperIds);
        $I->canDownloadPapersToWord($paperIds);
        $I->canDownloadPapersToQti($paperIds);
        if(!$ignoreImageZip){
            $I->canDownloadImagesInPapersToImageZip($paperIds);
        }
    }

    public function cannotDownloadPapersAnyFormat($paperIds, $ignoreImageZip=false)
    {
        $I = $this;
        $I->cannotDownloadPapersToExcel($paperIds);
        $I->cannotDownloadPapersToWord($paperIds);
        $I->cannotDownloadPapersToQti($paperIds);
        if(!$ignoreImageZip){
            $I->cannotDownloadImagesInPapersToImageZip($paperIds);
        }
    }

    public function canDownloadPapersToExcel($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
            $I->sendGET(Paper::$downloadExcelURL.$paperId);
            $I->canSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function canDownloadImagesInPapersToImageZip($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
        $I->sendGET(Paper::$downloadImageZipURL.$paperId.'/paper');
        $I->canSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function canDownloadPapersToWord($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
            $I->sendGET(Paper::$downloadWordDocURL.$paperId.'/paper');
            $I->canSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function canDownloadPapersToQti($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
            $I->sendGET(Paper::$downloadQtiPaperURL.$paperId);
            $I->canSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function cannotDownloadPapersToExcel($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
            $I->sendGET(Paper::$downloadExcelURL.$paperId);
            $I->cantSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function cannotDownloadImagesInPapersToImageZip($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
        $I->sendGET(Paper::$downloadImageZipURL.$paperId.'/paper');
        $I->cantSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function cannotDownloadPapersToWord($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
            $I->sendGET(Paper::$downloadWordDocURL.$paperId.'/paper');
            $I->cantSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }

    public function cannotDownloadPapersToQti($paperIds)
    {
        $I = $this;
        foreach($paperIds as $paperId) {
            $I->sendGET(Paper::$downloadQtiPaperURL.$paperId);
            $I->cantSeeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        }
    }
}