<?php

use Page\Data\DuplicateItemData;
use Page\Selectors\Item;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Item\ViewDuplicateButton;

class ItemApproverCantSeeDuplicateButtonCest
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
	 * ItemApproverInReadonlyItemDontSeeDuplicateArchivedButton
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemApproverInReadonlyItemDontSeeDuplicateArchivedButton(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$archivedItem;
		$I->cannotSeeDuplicateButtonOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	/**
	 * ItemApproverInReadonlyItemDontSeeDuplicatePreTestButton
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemApproverInReadonlyItemDontSeeDuplicatePreTestButton(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$pretestItem;
		$I->cannotSeeDuplicateButtonOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
	/**
	 * ItemApproverInReadonlyItemDontSeeDuplicateRejectedButton
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemApproverInReadonlyItemDontSeeDuplicateRejectedButton(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$rejectedItem;
		$I->cannotSeeDuplicateButtonOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
	}
	
}
