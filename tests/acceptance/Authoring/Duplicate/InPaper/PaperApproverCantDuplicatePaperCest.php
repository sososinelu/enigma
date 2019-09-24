<?php

use Page\Data\DuplicatePaperData;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\ViewDuplicateButton;

class PaperApproverCannotDuplicatePaperCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$paperApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$paperApprover['email']);
	}
	
	public function PaperApproverCannotDuplicateReviewPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$reviewPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
	
	public function PaperApproverCannotDuplicateExamreadyPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$reviewedPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
	
	public function PaperApproverCannotDuplicatePreTestPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$pretestPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
	
	public function PaperApproverCannotDuplicateArchivedPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$archivedPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
	
	public function PaperApproverCannotDuplicateRejectedPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$rejectedPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
	
	public function PaperApproverCannotDuplicateTypesettingPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$typesettingPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
}
