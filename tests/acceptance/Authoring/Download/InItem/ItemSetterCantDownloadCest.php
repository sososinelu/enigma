<?php

use Page\Data\DownloadItemData;
use Step\Acceptance\Download\Item as DownloadItemStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class ItemSetterCantDownloadCest
{
	
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$itemSetterGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$itemSetterGeneral['email']);
	}
	
	public function ItemSetterCantDownloadDraft(DownloadItemStep $I)
	{
		$workflowId = DownloadItemData::$draftItem['workflowId']; // Draft Item
		$I->wantTo('item setter cannot download - draft');
		$I->cannotSeeDownloadButtonOnEditPage($workflowId, 'Draft'); // Check Draft Item
	}
	
	public function ItemSetterCantDownloadChange(DownloadItemStep $I)
	{
		$workflowId = DownloadItemData::$changeItem['workflowId']; // Change Item
		$I->wantTo('item setter cannot download - change');
		$I->cannotSeeDownloadButtonOnEditPage($workflowId, 'Change'); // Check Change Item
	}
}
