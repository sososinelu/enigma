<?php

use Page\Data\DuplicatePaperData;
use Page\Selectors\Paper;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\ViewDuplicateButton;

class PaperSetterApproverCanDuplicatePaperCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$paperSetterPaperApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$paperSetterPaperApprover['email']);
	}
	
	public function PaperSetterApproverCanDuplicateExamreadyPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$reviewedPaper;
		$I->canSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
		$I->createDuplicate();
	}
	
	public function PaperSetterApproverCanDuplicatePreTestPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$pretestPaper;
		$I->canSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
		$I->createDuplicate();
	}
	
	public function PaperSetterApproverCanDuplicateArchivedPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$archivedPaper;
		$I->canSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
		$I->createDuplicate();
	}
	
	public function PaperSetterApproverCanDuplicateRejectedPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$rejectedPaper;
		$I->canSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
		$I->createDuplicate();
	}
	
	public function PaperSetterApproverCanDuplicateTypesettingPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$typesettingPaper;
		$I->canSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
		$I->createDuplicate();
	}
}
