<?php

use Page\Data\DownloadItemData;
use Step\Acceptance\Download\Item as DownloadItemStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;


class ItemApproverCanDownloadCest
{
	/**
	 * _before
	 *
	 * @param LoginStep $I
	 * @throws Exception
	 */
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$itemApproverGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	/**
	 * _after
	 *
	 * @param LoginStep $I
	 * @throws Exception
	 */
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$itemApproverGeneral['email']);
	}
	
	/**
	 * ItemApproverCanDownloadReview
	 *
	 * @param DownloadItemStep $I
	 * @throws Exception
	 */
	public function ItemApproverCanDownloadReview(DownloadItemStep $I)
	{
		$item = DownloadItemData::$reviewItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Review');
		$I->waitForElementClickable(ItemPage::$downloadButton);
		$I->click(ItemPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($item['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-item-' . $item['workflowId'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
		$I->click(ItemPage::$downloadOptionsCloseButton);
	}
	
	/**
	 * ItemApproverCanDownloadReviewed
	 *
	 * @param DownloadItemStep $I
	 * @throws Exception
	 */
	public function ItemApproverCanDownloadReviewed(DownloadItemStep $I)
	{
		$item = DownloadItemData::$reviewedItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Reviewed');
		$I->waitForElementClickable(ItemPage::$downloadButton);
		$I->click(ItemPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($item['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-item-' . $item['workflowId'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
		$I->click(ItemPage::$downloadOptionsCloseButton);
	}
	
	/**
	 * ItemApproverCanDownloadApproved
	 *
	 * @param DownloadItemStep $I
	 * @throws Exception
	 */
	public function ItemApproverCanDownloadApproved(DownloadItemStep $I)
	{
		$item = DownloadItemData::$approvedItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Approved');
		$I->waitForElementClickable(ItemPage::$downloadButton);
		$I->click(ItemPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($item['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-item-' . $item['workflowId'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
		$I->click(ItemPage::$downloadOptionsCloseButton);
	}
	
	/**
	 * ItemApproverCanDownloadPreTest
	 *
	 * @param DownloadItemStep $I
	 * @throws Exception
	 */
	public function ItemApproverCanDownloadPreTest(DownloadItemStep $I)
	{
		$item = DownloadItemData::$pretestItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Pre-test');
		$I->waitForElementClickable(ItemPage::$downloadButton);
		$I->click(ItemPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($item['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-item-' . $item['workflowId'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
		$I->click(ItemPage::$downloadOptionsCloseButton);
	}
	
	/**
	 * ItemApproverCanDownloadArchived
	 *
	 * @param DownloadItemStep $I
	 * @throws Exception
	 */
	public function ItemApproverCanDownloadArchived(DownloadItemStep $I)
	{
		$item = DownloadItemData::$archivedItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']);
		$I->canSee('Archived');
		$I->waitForElementClickable(ItemPage::$downloadButton);
		$I->click(ItemPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($item['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-item-' . $item['workflowId'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
		$I->click(ItemPage::$downloadOptionsCloseButton);
	}
	
	/**
	 * ItemApproverCanDownloadRejected
	 *
	 * @param DownloadItemStep $I
	 * @throws Exception
	 */
	public function ItemApproverCanDownloadRejected(DownloadItemStep $I)
	{
		$item = DownloadItemData::$rejectedItem;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($item['workflowId']); // Check Rejected Item
		$I->canSee('Rejected');
		$I->waitForElementClickable(ItemPage::$downloadButton);
		$I->click(ItemPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($item['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-item-' . $item['workflowId'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $item['id'] . '.zip');
		$I->click(ItemPage::$downloadOptionsCloseButton);
	}
}
