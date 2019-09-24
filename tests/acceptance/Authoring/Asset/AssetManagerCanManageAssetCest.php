<?php

use Page\Data\AssetData;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Asset\HandleAsset as AssetStep;

class AssetManagerCanManageAssetCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$assetManagerGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$assetManagerGeneral['email']);
	}
	
	public function AssetManagerCanFulfilAssetBriefTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemBrief;
		$I->canFulfilAssetBrief(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function AssetManagerCanEditAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemAsset;
		$I->canEditAsset(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function AssetManagerCanReplaceAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemAsset;
		$I->canReplaceAsset(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function AssetManagerCanSetCopyrightClearedTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemAsset;
		$I->canSetCopyrightCleared(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function AssetManagerCanOnlyEditCopyrightsInApprovedAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemApprovedNoCopyrightAsset;
		$I->canSetCopyrightCleared(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function AssetManagerCantEditCompletedAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemApprovedAsset;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->canSee('Access denied');
	}
}
