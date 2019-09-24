<?php

use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Download\Roles as DownloadRoleStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class PaperApproverCantDownloadWhenDownloadRoleNotSetCest
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
		$downloadRole->deleteDownloadRole('AB_PAPER_APPROVER');
		$I->login(LoginPage::$paperApproverGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	/**
	 * _after
	 *
	 * @param LoginStep        $I
	 * @param DownloadRoleStep $downloadRole
	 * @throws Exception
	 */
	public function _after(LoginStep $I, DownloadRoleStep $downloadRole)
	{
		$downloadRole->addDownloadRole('AB_PAPER_APPROVER');
		$I->clearSession(LoginPage::$paperApproverGeneral['email']);
	}
	
	/**
	 * PaperApproverCantDownloadReviewWhenDownloadRoleNotSet
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadReviewWhenDownloadRoleNotSet(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewPaper;
		$I->wantTo('paper approver cannot download - review');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Review');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
	
	/**
	 * PaperApproverCantDownloadReviewedWhenDownloadRoleNotSet
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadReviewedWhenDownloadRoleNotSet(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$reviewedPaper;
		$I->wantTo('paper approver cannot download - reviewed');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Reviewed');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
	
	/**
	 * PaperApproverCantDownloadTypesettingWhenDownloadRoleNotSet
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadTypesettingWhenDownloadRoleNotSet(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$typesettingPaperWithoutProofs;
		$I->wantTo('paper approver cannot download - typesetting');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Typesetting');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
	
	/**
	 * PaperApproverCantDownloadPreTestWhenDownloadRoleNotSet
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadPreTestWhenDownloadRoleNotSet(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$pretestPaper;
		$I->wantTo('paper approver cannot download - pre-test');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Pre-test');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
	
	/**
	 * PaperApproverCantDownloadArchivedWhenDownloadRoleNotSet
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadArchivedWhenDownloadRoleNotSet(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$archivedPaper;
		$I->wantTo('paper approver cannot download - archived');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Archived');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
	
	/**
	 * PaperApproverCantDownloadRejectedWhenDownloadRoleNotSet
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadRejectedWhenDownloadRoleNotSet(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$rejectedPaper;
		$I->wantTo('paper approver cannot download - rejected');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Rejected');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
	
	/**
	 * PaperApproverCantDownloadChangeWhenDownloadRoleNotSet
	 *
	 * @param DownloadPaperStep $I
	 */
	public function PaperApproverCantDownloadChangeWhenDownloadRoleNotSet(DownloadPaperStep $I)
	{
		$workflowId = DownloadPaperData::$changePaper['workflowId'];
		$I->wantTo('paper approver cannot download - change');
		$I->cannotSeeDownloadButtonOnPage($workflowId);
		$I->canSee('Change');
		$I->wait(1);
		$I->cannotDownloadWord($workflowId);
		$I->cannotDownloadQTI($workflowId);
		$I->cannotDownloadImageZip($workflowId);
		$I->cannotDownloadExcel($workflowId);
	}
}
