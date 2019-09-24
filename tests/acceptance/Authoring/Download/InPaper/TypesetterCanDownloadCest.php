<?php
use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper as PaperPage;

class TypesetterCanDownloadCest
{
	/**
	 * _before
	 *
	 * @param LoginStep $I
	 * @throws Exception
	 */
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$typesetterGeneral);
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
		$I->clearSession(LoginPage::$typesetterGeneral['email']);
	}
	
	/**
	 * TypeSetterCanDownloadRejected
	 *
	 * @param DownloadPaperStep $I
	 * @throws Exception
	 */
	public function TypeSetterCanDownloadRejected(DownloadPaperStep $I) {
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
}
