<?php

use Page\Data\AssetData;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item;
use Step\Acceptance\Asset\HandleAsset as AssetStep;
use Step\Acceptance\Login as LoginStep;

class ItemApproverCanManageAssetCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$itemApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$itemApprover['email']);
	}
	
	public function ItemApproverCanRequestAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemBrief2;
		$I->requestAsset(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCanRequestChangeAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewedItemChangeRequest;
		$I->requestChange(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCanApproveAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewedItemApproveRequest;
		$I->approveAsset(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCanFulfilAssetBriefTestInReadonlyItemTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemBrief3;
		$I->canFulfilAssetBrief(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCanEditAssetInReadonlyItemTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemAsset;
		$I->canEditAsset(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCanReplaceAssetInReadonlyItemTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemAsset;
		$I->canReplaceAsset(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCanSetCopyrightClearedTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemAsset;
		$I->canSetCopyrightCleared(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCanOnlyEditCopyrightsInApprovedAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemApprovedNoCopyrightAsset2;
		$I->canSetCopyrightCleared(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	public function ItemApproverCantEditCompletedAssetTest(AssetStep $I)
	{
		$item = AssetData::$reviewItemApprovedAsset;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->waitThenClick(Item::$assetManagerDropdownToggle);
		$I->waitForText('View asset');
		$I->click('View asset');
		$I->waitForElementVisible(Item::$assetModal);
		$I->expectTo('not see an update button for the asset');
		$I->cantSee('Update');
	}
}
