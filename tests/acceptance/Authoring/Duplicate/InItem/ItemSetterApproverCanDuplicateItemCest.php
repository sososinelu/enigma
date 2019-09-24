<?php

use Page\Data\DuplicateItemData;
use Page\Selectors\Item;
use Page\Login as LoginPage;
use Page\Selectors\Authoring as AuthoringPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Item\ViewDuplicateButton;
use Step\Acceptance\Item\Item as ItemStep;

class ItemSetterApproverCanDuplicateItemCest
{
	public function _before(LoginStep $I)
	{
		$I->login(LoginPage::$itemSetterItemApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
	}
	
	public function _after(LoginStep $I)
	{
		$I->clearSession(LoginPage::$itemSetterItemApprover['email']);
	}
	
	/**
	 * ItemSetterApproverCanDuplicateDraftItem
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemSetterApproverCanDuplicateDraftItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$draftItemSetterApprover;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}
	
	/**
	 * ItemSetterApproverCanDuplicateApprovedItem
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemSetterApproverCanDuplicateApprovedItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$approvedItem;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}
	
	/**
	 * ItemSetterApproverCanDuplicateApprovedEditItem
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemSetterApproverCanDuplicateApprovedEditItem(ViewDuplicateButton $I, ItemStep $C)
	{
		$item = DuplicateItemData::$approvedItem;
		$I->amOnPage(Item::$editURL . '/' . $item['workflowId']);
		$I->createDuplicate();
		$C->waitThenClick(Item::$cancelButton);
	}
	
	/**
	 * ItemSetterApproverCanDuplicatePreTestItem
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemSetterApproverCanDuplicatePreTestItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$pretestItem;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}
	
	/**
	 * ItemSetterApproverCanDuplicateArchivedItem
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemSetterApproverCanDuplicateArchivedItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$archivedItem;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}
	
	/**
	 * ItemSetterApproverCanDuplicateRejectedItem
	 *
	 * @param ViewDuplicateButton $I
	 */
	public function ItemSetterApproverCanDuplicateRejectedItem(ViewDuplicateButton $I)
	{
		$item = DuplicateItemData::$rejectedItem;
		$I->amOnPage(Item::$readOnlyURL . '/' . $item['workflowId']);
		$I->createDuplicate();
	}
}
