<?php

namespace Step\Acceptance\Asset;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;

class HandleAsset extends \AcceptanceTester
{

    /**
     * Can view asset
     * @param $assetWorkflowId
     * @param $assetType
     * @throws \Exception
     */
    public function viewAssetModal($assetWorkflowId, $assetType)
    {
        $I = $this;
        $I->waitThenClick(sprintf(ItemPage::$assetDropdown, $assetWorkflowId));
        $I->waitThenClick(sprintf(ItemPage::$viewAsset, $assetWorkflowId));

        $I->waitForElementVisible(ItemPage::$assetModal);
        $I->waitForElementVisible($assetType);
        $I->canSeeElement($assetType);

        $I->waitThenClick(ItemPage::$cancelfinalAssetModalButton);
    }

    /**
     * Can view asset brief
     * @param $assetWorkflowId
     * @param $image - are we checking for placeholder image
     * @throws \Exception
     */
    public function viewAssetBriefModal($assetWorkflowId, $image = false)
    {
        $I = $this;
        $I->waitThenClick(sprintf(ItemPage::$assetDropdown, $assetWorkflowId));
        $I->waitThenClick(sprintf(ItemPage::$viewAssetBrief, $assetWorkflowId));

        $I->waitForElementVisible(ItemPage::$assetBriefModal);
        $I->waitForElementVisible(ItemPage::$assetBriefModalText);

        if ($image) {
            $I->waitForElementVisible(ItemPage::$assetBriefWithImageInModal);
        } else {
            $I->cantSeeElement(ItemPage::$assetBriefImageHolder);
        }

        $I->waitThenClick(ItemPage::$cancelAssetBriefModalButton);
    }

    /**
     * @param $type
     * @param $expectedClass
     * @param $assetWorkflowId
     */
    public function seeAssetOnPage($type, $expectedClass, $assetWorkflowId)
    {
        $I = $this;
        $I->waitForElementVisible(sprintf($type, $expectedClass, $assetWorkflowId));
    }

    /**
     * @param $type
     * @param $assetWorkflowId
     * @param $image
     * @throws \Exception
     */
    public function seeAssetBriefOnPage($type, $assetWorkflowId, $image = false)
    {
        $I = $this;

        if ($image) {
            $element = sprintf(ItemPage::$assetBriefWithImageOnPage, $type, $assetWorkflowId);
        } else {
            $element = sprintf(ItemPage::$assetBriefNoImageOnPage, $type, $assetWorkflowId);
        }

        $I->waitForElementVisible($element);
    }

	public function canOpenAsset($page)
	{
		$I = $this;
		$I->amOnPage($page);
		$I->waitThenClick(ItemPage::$assetManagerDropdownToggle);
		$I->waitForText('View asset');
		$I->click('View asset');
        $I->waitForElementVisible(ItemPage::$assetModal);
	}
	
	public function canEditAsset($page)
	{
		$I = $this;
		$I->canOpenAsset($page);
		$I->editAsset('We are editing the text of this asset');
	}
	
	public function canReplaceAsset($page)
	{
		$I = $this;
		$I->canOpenAsset($page);
		$I->replaceAsset('concerned_cat.jpg');
	}
	
	public function canSetCopyrightCleared($page)
	{
		$I = $this;
		$I->canOpenAsset($page);
		$I->copyrightClearAsset();
	}
	
	public function canOpenAssetBrief($page)
	{
		$I = $this;
		$I->wait(1);
		$I->amOnPage($page);
		$I->waitThenClick(ItemPage::$assetManagerDropdownToggle);
		$I->waitForText('View asset');
		$I->click('View asset');
		$I->waitForText('View asset brief');
	}
	
	public function canFulfilAssetBrief($page)
	{
		$I = $this;
		$I->canOpenAssetBrief($page);
		$I->waitForText('Fulfil brief');
		$I->waitThenClick('#modalAssetBrief .btn-primary');
		$I->replaceAsset('concerned_cat.jpg');
	}
	
	public function requestAsset($page)
	{
		$I = $this;
		$I->amOnPage($page);
		$I->waitThenClick(ItemPage::$assetManagerDropdownToggle);
		$I->waitThenClick('.asset-menu-container .request-asset-btn');
		$I->waitThenClick('.modal-footer .confirm-request-asset-btn');
		
	}
	
	public function requestChange($page)
	{
		$I = $this;
		$I->amOnPage($page);
		$I->waitThenClick(ItemPage::$assetManagerDropdownToggle);
		$I->waitThenClick('.asset-menu-container .asset-change-btn');
		$I->waitThenClick('.modal-footer .confirm-asset-change-btn');
	}
	
	public function approveAsset($page)
	{
		$I = $this;
		$I->amOnPage($page);
		$I->waitThenClick(ItemPage::$assetManagerDropdownToggle);
		$I->waitThenClick('.asset-menu-container .asset-approve-btn');
		$I->waitThenClick('.modal-footer .confirm-asset-approve-btn');
	}
	
	private function editAsset($text)
	{
		$I = $this;
		$I->waitForText('Type of asset');
		$I->fillField(ItemPage::$textAreaAssetDescription, $text);
		$I->waitThenClick(ItemPage::$insertAssetButton);
		$I->waitForElementNotVisible(ItemPage::$assetModal);
	}
	
	private function copyrightClearAsset()
	{
		$I = $this;
		$I->waitThenClick(ItemPage::$assetClearedButton);
		$I->waitThenClick(ItemPage::$insertAssetButton);
		$I->waitForElementNotVisible(ItemPage::$assetModal);
	}
	
	private function replaceAsset($image)
	{
		$I = $this;
		$I->waitForElement(ItemPage::$selectTypeAsset);
		$I->selectOption(ItemPage::$selectTypeAsset, 'Picture');
		$I->attachFile(ItemPage::$attachFile, $image);
		$I->fillField(ItemPage::$textAreaAssetDescription, 'This is a very concerned cat');
		$I->waitThenClick(ItemPage::$insertAssetButton);
		$I->waitForElementNotVisible(ItemPage::$assetModal);
	}
}