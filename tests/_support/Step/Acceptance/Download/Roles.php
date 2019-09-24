<?php
namespace Step\Acceptance\Download;

use Helper\Database;

class Roles extends \AcceptanceTester
{
	/**
	 * deleteDownloadRole
	 *
	 * @param $role
	 */
	public function deleteDownloadRole($role)
	{
		$db = new Database($this->scenario);
		$db->deleteDownloadRole($role);
	}

	/**
	 * addDownloadRole
	 *
	 * @param $role
	 */
	public function addDownloadRole($role)
	{
		$db = new Database($this->scenario);
		$db->addDownloadRole($role);
	}

}
