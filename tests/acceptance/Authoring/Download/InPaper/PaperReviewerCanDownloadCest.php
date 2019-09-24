<?php
use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper as PaperPage;

class PaperReviewerCanDownloadCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$paperReviewerGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$paperReviewerGeneral['email']);
	}
	
	public function PaperReviewerCanDownloadReviewExcelOnly(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewPaper;
		$downloadDirectory = $_SERVER['HOME'] . '/Downloads/';
		$I->canSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Review');
		$I->canDownloadOnlyExcel($paper['workflowId']);
		$I->click(PaperPage::$downloadOptionsCloseButton); // Close modal
		$I->checkFileExistsWithRetries($downloadDirectory. str_replace(' ','-',strtolower($paper['title'])) . '*.xlsx');
	}
}
