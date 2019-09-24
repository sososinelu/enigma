<?php

use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Download\Roles as DownloadRoleStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class PaperSetterCantDownloadWhenDownloadRoleNotSetCest
{
	
	public function _before(LoginStep $I, DownloadRoleStep $downloadRole)
	{
		$downloadRole->deleteDownloadRole('AB_PAPER_SETTER');
		$I->login(LoginPage::$paperSetterGeneral);
		$I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I, DownloadRoleStep $downloadRole)
	{
		$downloadRole->addDownloadRole('AB_PAPER_REVIEWER');
		$I->clearSession(LoginPage::$paperSetterGeneral['email']);
	}
	
	public function PaperSetterCantDownloadDraftWhenDownloadRoleNotSet(DownloadPaperStep $I) {
		$paper = DownloadPaperData::$draftPaper;
		$I->wantTo('paper setter cannot download - draft');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Draft');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		// $I->cannotDownloadImageZip($paper['workflowId']); Get other error message than default	
		$I->cannotDownloadExcel($paper['workflowId']);
	}
}
