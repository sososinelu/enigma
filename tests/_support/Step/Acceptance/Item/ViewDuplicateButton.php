<?php
namespace Step\Acceptance\Item;

use Page\Selectors\Item as ItemPage;

class ViewDuplicateButton extends \AcceptanceTester
{
	public function canSeeDuplicateButtonOnPage($page) {
		$I = $this;
		$I->amOnPage($page);
		$I->expectTo('see duplicate button on ' . $page);
		$I->waitThenClick(ItemPage::$openItemInListButton);
		$I->waitForElement(ItemPage::$duplicateButton);
	}
	
	public function cannotSeeDuplicateButtonOnPage($page) {
		$I = $this;
		$I->expectTo('not see duplicate button on ' . $page);
		$I->amOnPage($page);
		$I->waitForElement(ItemPage::$informationTab);
		$I->dontSeeElement(ItemPage::$duplicateButton);
	}
	
	public function createDuplicate() {
		$I = $this;
		$I->waitThenClick(ItemPage::$duplicateButton);
		$I->waitThenClick(ItemPage::$duplicateItemModalButton);
		$I->waitForText('Item created successfully', 20);
	}
	
}
