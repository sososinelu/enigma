<?php

use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper as PaperPage;

class PaperApproverCanDownloadCest
{
	/**
	 * _before
	 *
	 * @param LoginStep $I
	 * @throws Exception
	 */
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$paperApproverGeneral);
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
		$I->clearSession(LoginPage::$paperApproverGeneral['email']);
	}
	
	/**
	 * PaperApproverCanDownloadReview
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 */
	public function PaperApproverCanDownloadReview(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Review');
		$I->waitForElementClickable(PaperPage::$downloadButton);
		$I->click(PaperPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-paper-' . $paper['id'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $paper['id'] . '.zip');
		$I->downloadExcel();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
		$I->click(PaperPage::$downloadOptionsCloseButton);
	}
	
	public function PaperApproverCannotUploadReview(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewPaper;
		$I->cannotSeeUploadButtonOnPage($paper['workflowId']);
		$I->canSee('Review');
	}
	
	/**
	 * PaperApproverCanDownloadReviewed
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 */
	public function PaperApproverCanDownloadReviewed(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewedPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Reviewed');
		$I->waitForElementClickable(PaperPage::$downloadButton);
		$I->click(PaperPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-paper-' . $paper['id'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $paper['id'] . '.zip');
		$I->downloadExcel();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
		$I->click(PaperPage::$downloadOptionsCloseButton);
	}
	
	public function PaperApproverCannotUploadReviewed(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewedPaper;
		$I->cannotSeeUploadButtonOnPage($paper['workflowId']);
		$I->canSee('Reviewed');
	}
	
	/**
	 * PaperApproverCanDownloadTypesetting
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 */
	public function PaperApproverCanDownloadTypesetting(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$typesettingPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Typesetting');
		$I->waitForElementClickable(PaperPage::$downloadButton);
		$I->click(PaperPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-paper-' . $paper['id'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $paper['id'] . '.zip');
		$I->downloadExcel();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
		$I->click(PaperPage::$downloadOptionsCloseButton);
	}
	
	public function PaperApproverCanUploadTypesetting(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$typesettingPaper;
		$I->canSeeUploadButtonOnPage($paper['workflowId']);
		$I->canSee('Typesetting');
		$I->waitForElementClickable(PaperPage::$uploadButton);
		$I->click(PaperPage::$uploadButton);
		$I->attachFile('#ngf-excel-upload-button', 'uploads/' . str_replace(' ','-',strtolower($paper['title'])) . '-' . $paper['id'] .'.xlsx');
		$I->waitForElementClickable(PaperPage::$uploadImportButton);
		$I->click(PaperPage::$uploadImportButton);
		$I->waitForElementClickable(PaperPage::$uploadImportCloseButton);
		$I->click(PaperPage::$uploadImportCloseButton);
	}
	
	/**
	 * PaperApproverCanDownloadPreTest
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 */
	public function PaperApproverCanDownloadPreTest(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$pretestPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Pre-test');
		$I->waitForElementClickable(PaperPage::$downloadButton);
		$I->click(PaperPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-paper-' . $paper['id'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $paper['id'] . '.zip');
		$I->downloadExcel();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
		$I->click(PaperPage::$downloadOptionsCloseButton);
	}
	
	public function PaperApproverCanUploadPreTest(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$pretestPaper;
		$I->canSeeUploadButtonOnPage($paper['workflowId']);
		$I->canSee('Pre-test');
		$I->waitForElementClickable(PaperPage::$uploadButton);
		$I->click(PaperPage::$uploadButton);
		$I->attachFile('#ngf-excel-upload-button', 'uploads/' . str_replace(' ','-',strtolower($paper['title'])) . '-' . $paper['id'] .'.xlsx');
		$I->waitForElementClickable(PaperPage::$uploadImportButton);
		$I->click(PaperPage::$uploadImportButton);
		$I->waitForElementClickable(PaperPage::$uploadImportCloseButton);
		$I->click(PaperPage::$uploadImportCloseButton);
	}
	
	/**
	 * PaperApproverCanDownloadArchived
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 */
	public function PaperApproverCanDownloadArchived(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$archivedPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Archived');
		$I->waitForElementClickable(PaperPage::$downloadButton);
		$I->click(PaperPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-paper-' . $paper['id'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $paper['id'] . '.zip');
		$I->downloadExcel();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
		$I->click(PaperPage::$downloadOptionsCloseButton);
	}
	
	/**
	 * PaperApproverCanUploadArchived
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 * Not upload button currently
	 * @skip
	 */
	public function PaperApproverCanUploadArchived(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$archivedPaper;
		$I->canSeeUploadButtonOnPage($paper['workflowId']);
		$I->canSee('Archived');
		$I->waitForElementClickable(PaperPage::$uploadButton);
		$I->click(PaperPage::$uploadButton);
		$I->attachFile('#ngf-excel-upload-button', 'uploads/' . str_replace(' ','-',strtolower($paper['title'])) . '-' . $paper['id'] .'.xlsx');
		$I->waitForElementClickable(PaperPage::$uploadImportButton);
		$I->click(PaperPage::$uploadImportButton);
		$I->waitForElementClickable(PaperPage::$uploadImportCloseButton);
		$I->click(PaperPage::$uploadImportCloseButton);
	}
	
	/**
	 * PaperApproverCanDownloadRejected
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 */
	public function PaperApproverCanDownloadRejected(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$rejectedPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Rejected');
		$I->waitForElementClickable(PaperPage::$downloadButton);
		$I->click(PaperPage::$downloadButton);
		$I->wait(1);
		$I->downloadWord();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.docx');
		$I->downloadQTI();
		$I->checkFileExistsWithRetries($downloadDirectory. 'qti-paper-' . $paper['id'] . '.zip');
		$I->downloadImageZip();
		$I->checkFileExistsWithRetries($downloadDirectory. $paper['id'] . '.zip');
		$I->downloadExcel();
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
		$I->click(PaperPage::$downloadOptionsCloseButton);
	}
	
	/**
	 * PaperApproverCanUploadRejected
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 * Currently no upload button
	 * @skip
	 */
	public function PaperApproverCanUploadRejected(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$rejectedPaper;
		$I->canSeeUploadButtonOnPage($paper['workflowId']);
		$I->canSee('Rejected');
		$I->waitForElementClickable(PaperPage::$uploadButton);
		$I->click(PaperPage::$uploadButton);
		$I->attachFile('#ngf-excel-upload-button', 'uploads/' . str_replace(' ','-',strtolower($paper['title'])) . '-' . $paper['id'] .'.xlsx');
		$I->waitForElementClickable(PaperPage::$uploadImportButton);
		$I->click(PaperPage::$uploadImportButton);
		$I->waitForElementClickable(PaperPage::$uploadImportCloseButton);
		$I->click(PaperPage::$uploadImportCloseButton);
	}
	
	/**
	 * PaperApproverCantDownloadChange
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadChange(DownloadPaperStep $I)
	{
		$workflowId = DownloadPaperData::$changePaper['workflowId']; // Change Item
		$I->wantTo('paper approver cannot download - change');
		$I->cannotSeeDownloadButtonOnPage($workflowId);
		$I->canSee('Change');
	}
	
	public function PaperApproverCannotUploadChange(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$changePaper;
		$I->cannotSeeUploadButtonOnPage($paper['workflowId']);
		$I->canSee('Change');
	}
}

