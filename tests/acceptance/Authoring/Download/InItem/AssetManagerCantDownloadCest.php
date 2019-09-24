<?php

use Page\Data\DownloadItemData;
use Step\Acceptance\Download\Item as DownloadItemStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class AssetManagerCantDownloadCest
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
	
	/**
	 * AssetManagerCanDownloadImageZipOnlyReviewed
	 *
	 * @param LoginStep        $loginStep
	 * @param DownloadItemStep $I
	 */
	public function AssetManagerCanDownloadImageZipOnlyReviewed(DownloadItemStep $I)
	{
		$item = DownloadItemData::$reviewedItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Reviewed');
		$I->canDownloadImageOnly($item['workflowId']);
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
	}
	
	/**
	 * AssetManagerCanDownloadImageZipOnlyReview
	 *
	 * @param LoginStep        $loginStep
	 * @param DownloadItemStep $I
	 */
	public function AssetManagerCanDownloadImageZipOnlyReview(DownloadItemStep $I)
	{
		$item = DownloadItemData::$reviewItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Review');
		$I->canDownloadImageOnly($item['workflowId']);
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
	}
	
	/**
	 * AssetManagerCanDownloadImageZipOnlyApproved
	 *
	 * @param DownloadItemStep $I
	 */
	public function AssetManagerCanDownloadImageZipOnlyApproved(DownloadItemStep $I)
	{
		$item = DownloadItemData::$approvedItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Approved');
		$I->canDownloadImageOnly($item['workflowId']);
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
	}
	
	/**
	 * AssetManagerCanDownloadImageZipOnlyPreTest
	 *
	 * @param DownloadItemStep $I
	 */
	public function AssetManagerCanDownloadImageZipOnlyPreTest(DownloadItemStep $I)
	{
		$item = DownloadItemData::$pretestItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Pre-test');
		$I->canDownloadImageOnly($item['workflowId']);
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
	}
	
}
