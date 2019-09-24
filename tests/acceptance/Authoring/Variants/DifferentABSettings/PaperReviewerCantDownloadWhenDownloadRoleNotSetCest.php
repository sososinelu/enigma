<?php

use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Download\Roles as DownloadRoleStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class PaperReviewerCantDownloadWhenDownloadRoleNotSetCest
{
	
	/**
	 * _before
	 *
	 * @param LoginStep        $I
	 * @param DownloadRoleStep $downloadRole
	 * @throws Exception
	 */
	public function _before(LoginStep $I, DownloadRoleStep $downloadRole)
	{
		$downloadRole->deleteDownloadRole('AB_PAPER_REVIEWER');
		$I->login(LoginPage::$paperReviewerGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	/**
	 * _after
	 *
	 * @param LoginStep        $I
	 * @param DownloadRoleStep $downloadRole
	 */
	public function _after(LoginStep $I, DownloadRoleStep $downloadRole)
	{
		$downloadRole->addDownloadRole('AB_PAPER_REVIEWER');
		$I->clearSession(LoginPage::$paperReviewerGeneral['email']);
	}
	
	/**
	 * PaperReviewerCantDownloadReviewWhenDownloadRoleNotSetCest
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperReviewerCantDownloadReviewWhenDownloadRoleNotSetCest(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewPaper;
		$I->wantTo('paper reviewer cannot download - review');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Review');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
}
