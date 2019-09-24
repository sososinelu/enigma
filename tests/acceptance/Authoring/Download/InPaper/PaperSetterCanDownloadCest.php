<?php
use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper as PaperPage;

class PaperSetterCanDownloadCest
{
	/**
	 * _before
	 *
	 * @param LoginStep $I
	 * @throws Exception
	 */
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$paperSetterGeneral);
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
		$I->clearSession(LoginPage::$paperSetterGeneral['email']);
	}
	
	/**
	 * PaperSetterCanDownloadDraftExcelOnly
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperSetterCanDownloadDraftExcelOnly(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$draftPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnEditPage($paper['workflowId']);
		$I->canSee('Draft');
		$I->canDownloadOnlyExcel($paper['workflowId']);
		$I->click(PaperPage::$downloadOptionsCloseButton); // Close modal
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
	}
}
