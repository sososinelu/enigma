<?php

use Page\Data\DownloadItemData;
use Step\Acceptance\Download\Item as DownloadItemStep;
use Step\Acceptance\Download\Roles as DownloadRoleStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class ItemApproverCantDownloadWhenDownloadRoleNotSetCest
{
	
	public function _before(LoginStep $I, DownloadRoleStep $downloadRole)
	{
		$downloadRole->deleteDownloadRole('AB_ITEM_APPROVER');
		$I->login(LoginPage::$itemApproverGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I, DownloadRoleStep $downloadRole)
	{
		$downloadRole->addDownloadRole('AB_ITEM_APPROVER');
		$I->clearSession(LoginPage::$itemApproverGeneral['email']);
	}
	
	public function ItemApproverCantDownloadReviewWhenDownloadRoleNotSet(DownloadItemStep $I)
	{
		$item = DownloadItemData::$reviewItem;
		$I->wantTo('item approver cannot download - review');
		$I->cannotSeeDownloadButtonOnReadonlyPage($item['workflowId'], 'Review'); // Check Review Item
		$I->cannotDownloadWord($item['workflowId']);
		$I->cannotDownloadQTI($item['workflowId']);
		$I->cannotDownloadImageZip($item['workflowId']);
	}
	
	public function ItemApproverCantDownloadReviewedWhenDownloadRoleNotSet(DownloadItemStep $I)
	{
		$item = DownloadItemData::$reviewedItem;
		$I->wantTo('item approver cannot download - reviewed');
		$I->cannotSeeDownloadButtonOnPageAndEditPage($item['workflowId'], 'Reviewed'); // Check Reviewed Item
		$I->cannotDownloadWord($item['workflowId']);
		$I->cannotDownloadQTI($item['workflowId']);
		$I->cannotDownloadImageZip($item['workflowId']);
	}
	
	public function ItemApproverCantDownloadApprovedWhenDownloadRoleNotSet(DownloadItemStep $I)
	{
		$item = DownloadItemData::$approvedItem;
		$I->wantTo('item approver cannot download - approved');
		$I->cannotSeeDownloadButtonOnPageAndEditPage($item['workflowId'], 'Approved'); // Check Approved Item
		$I->cannotDownloadWord($item['workflowId']);
		$I->cannotDownloadQTI($item['workflowId']);
		$I->cannotDownloadImageZip($item['workflowId']);
	}
	
	public function ItemApproverCantDownloadPreTestWhenDownloadRoleNotSet(DownloadItemStep $I)
	{
		$item = DownloadItemData::$pretestItem;
		$I->wantTo('item approver cannot download - pre-test');
		$I->cannotSeeDownloadButtonOnReadonlyPage($item['workflowId'], 'Pre-test'); // Check Pre-test Item
		$I->cannotDownloadWord($item['workflowId']);
		$I->cannotDownloadQTI($item['workflowId']);
		$I->cannotDownloadImageZip($item['workflowId']);
	}
	
	public function ItemApproverCantDownloadArchivedWhenDownloadRoleNotSet(DownloadItemStep $I)
	{
		$item = DownloadItemData::$archivedItem;
		$I->wantTo('item approver cannot download - archived');
		$I->cannotSeeDownloadButtonOnReadonlyPage($item['workflowId'], 'Archived'); // Check Archived Item
		$I->cannotDownloadWord($item['workflowId']);
		$I->cannotDownloadQTI($item['workflowId']);
		$I->cannotDownloadImageZip($item['workflowId']);
	}
	
	public function ItemApproverCantDownloadRejectedWhenDownloadRoleNotSet(DownloadItemStep $I)
	{
		$item = DownloadItemData::$rejectedItem;
		$I->wantTo('item approver cannot download - rejected');
		$I->cannotSeeDownloadButtonOnReadonlyPage($item['workflowId'], 'Rejected'); // Check Rejected Item
		$I->cannotDownloadWord($item['workflowId']);
		$I->cannotDownloadQTI($item['workflowId']);
		$I->cannotDownloadImageZip($item['workflowId']);
	}
	
}
