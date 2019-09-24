<?php

use Page\Selectors\Paper;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Data\ItemPaperData;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\ViewDuplicateButton;

class PaperSetterCanDuplicatePaperCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$paperSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$paperSetter['email']);
	}
	
	public function PaperSetterCanDuplicateRejectedPaper(ViewDuplicateButton $I) {
		$paper = ItemPaperData::$rejectedPaper;
		$I->canSeeDuplicateButtonOnPage(Paper::$readOnlyURL . '/' . $paper['paperid']);
		$I->createDuplicate();
	}
}
