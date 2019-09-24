<?php

use Page\Data\DuplicateItemData;
use Page\Selectors\Item;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

class ItemApproverCanEditDuplicateWhenItemInPaperCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$itemApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$itemApprover['email']);
	}
	
	/**
	 * ItemApproverCanDuplicateWhenItemInPaper
	 *
	 * @param ItemStep\Item $I
	 * @throws Exception
	 */
	public function ItemApproverCanDuplicateWhenItemInPaper(ItemStep\Item $I)
	{
		// Log onto GradeMaker as an Item Setter
		$item = DuplicateItemData::$reviewedItem;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->waitThenClick(Item::$editItemButton);
		$I->waitForText('This item is in a paper and so cannot be edited directly');
		$I->waitThenClick(Item::$createDuplicateItemButton);
	}
}
