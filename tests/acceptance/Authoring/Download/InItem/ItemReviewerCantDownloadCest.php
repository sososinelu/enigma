<?php

use Page\Data\DownloadItemData;
use Step\Acceptance\Download\Item as DownloadItemStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class ItemReviewerCantDownloadCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$itemReviewerGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$itemReviewerGeneral['email']);
	}
	
	public function ItemReviewerCantDownloadItemInReview(DownloadItemStep $I)
	{
		$workflowId = DownloadItemData::$reviewItem['workflowId']; // Review Item
		$I->wantTo('item reviewer cannot download - review');
		$I->cannotSeeDownloadButtonOnReadonlyPage($workflowId, 'Review');		
	}
}
