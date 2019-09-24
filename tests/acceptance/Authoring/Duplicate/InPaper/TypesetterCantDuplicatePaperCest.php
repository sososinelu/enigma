<?php

use Page\Data\DuplicatePaperData;
use Page\Selectors\Paper;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\ViewDuplicateButton;

class TypesetterCantDuplicatePaperCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$typeSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$typeSetter['email']);
	}
	
	public function TypesetterCannotDuplicateExamreadyPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$examreadyPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
	
	public function TypesetterCannotDuplicateTypesettingPaper(ViewDuplicateButton $I) {
		$paper = DuplicatePaperData::$typesettingPaper;
		$I->cannotSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['workflowId']);
	}
}
