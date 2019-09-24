<?php

use Page\Data\DownloadPaperData;
use Step\Acceptance\Download\Paper as DownloadPaperStep;
use Step\Acceptance\Download\Roles as DownloadRoleStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;

class TypesetterCantDownloadWhenDownloadRoleNotSetCest
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
		$downloadRole->deleteDownloadRole('AB_TYPESETTER');
		$I->login(LoginPage::$typesetterGeneral);
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
		$downloadRole->addDownloadRole('AB_TYPESETTER');
		$I->clearSession(LoginPage::$typesetterGeneral['email']);
	}
	
	/**
	 * TypesetterCantDownloadTypesettingWhenDownloadRoleNotSetCest
	 *
	 * @param DownloadPaperStep $I
	 */
	public function TypesetterCantDownloadTypesettingPaperWhenDownloadRoleNotSetCest(DownloadPaperStep $I)
	{
		$paper = DownloadPaperData::$typesettingPaperWithoutProofs;
		$I->wantTo('typesetter cannot download - typesetting');
		$I->cannotSeeDownloadButtonOnPage($paper['workflowId']);
		$I->canSee('Typesetting');
		$I->wait(1);
		$I->cannotDownloadWord($paper['workflowId']);
		$I->cannotDownloadQTI($paper['workflowId']);
		$I->cannotDownloadImageZip($paper['workflowId']);
		$I->cannotDownloadExcel($paper['workflowId']);
	}
}
