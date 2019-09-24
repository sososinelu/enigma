<?php

use Page\Data\DuplicateItemData;
use Page\Selectors\Item;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Item\ViewDuplicateButton;

class ItemSetterCanDuplicateItemCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$itemSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$itemSetter['email']);
	}
	
	public function ItemSetterCanDuplicateDraftItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$draftItem;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}

	public function ItemSetterCanDuplicateDraftEditItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$draftItem;
		$I->amOnPage(Item::$editURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}
	
	public function ItemSetterCanDuplicateRejectedItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$rejectedItem;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}
	
}
