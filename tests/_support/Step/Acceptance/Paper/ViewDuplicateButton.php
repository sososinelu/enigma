<?php
namespace Step\Acceptance\Paper;

use Page\Selectors\Paper;
use Page\Selectors\Authoring as AuthoringPage;

class ViewDuplicateButton extends \AcceptanceTester
{
	public function canSeeDuplicateButtonOnPage($page) {
		$I = $this;
		$I->expectTo('see duplicate button on ' . $page);
		$I->amOnPage($page);
		$I->waitForElement(Paper::$duplicateButton);
	}
	
	public function cannotSeeDuplicateButtonOnPage($page) {
		$I = $this;
		$I->expectTo('not see duplicate button on ' . $page);
		$I->amOnPage($page);
		$I->waitForElement(Paper::$informationTab);
		$I->dontSeeElement(Paper::$duplicateButton);
	}
	
	public function createDuplicate() {
		$I = $this;
		$I->waitThenClick(Paper::$duplicateButton);
		$I->waitThenClick(Paper::$duplicatePaperDuplicateButton);
		$I->waitForText('Paper duplicated successfully');
	}
}
