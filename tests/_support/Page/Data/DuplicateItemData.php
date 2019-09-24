<?php
namespace Page\Data;

class DuplicateItemData
{
	public static $draftItem = ['workflowId' => '5cd97db406ee2f4b277ba4c4'];
	public static $draftItemSetterApprover = ['workflowId' => '5cc9561406ee2fbf1f55bcd5'];
	public static $reviewedItem = [
		'workflowId' => '5cc97bf606ee2fd27b5938fe',
		'title'	=> 'Reviewed item download data',
		'id'	=> '100-070-394'
	];

	public static $reviewItem = [
		'workflowId' => '59fe2bfda26fc53ad8005e89',
		'title'	=> 'Review item download data',
		'id'	=> '100-038-670'
	];
	
	public static $rejectedItem = [
		'workflowId' => '59fe30d2a26fc53ad8005e95',
		'title' => 'Rejected item for rejected paper',
		'id'	=> 'ATAB-100-044-524'
	];
	
	public static $approvedItem = [
		'workflowId' => '5cc9b20706ee2fe16f413673',
		'title' => 'Approved item download data',
		'id'	=> '100-070-398'
	];
	
	public static $pretestItem = [
		'workflowId' => '5ccb08ca06ee2f0c7c453228',
		'title'	=> 'Pre-test item download data',
		'id'	=> '100-070-419'
	];
	
	public static $archivedItem = [
		'workflowId' => '5cd1640706ee2f25d0335717',
		'title' => 'Archived item download data',
		'id'	=> '100-070-433'
	];
	
}
