<?php
namespace Step\Acceptance\Download;

use Page\Selectors\Item as ItemPage;

class Item extends \AcceptanceTester
{
	
	/**
	 * canSeeDownloadButtonOnPage
	 *
	 * @param $workflowId
	 * @param $type
	 */
	public function canSeeDownloadButtonOnPage($workflowId) {
		$I = $this;
		$I->amOnPage('/author/item/' . $workflowId);
		$I->expectTo('see download button on ' . $workflowId);
		$I->wait(2);
		$I->canSeeElement(ItemPage::$downloadButton);
	}
	
	/**
	 * cannotSeeDownloadButtonOnPageAndEditPage
	 *
	 * @param $workflowId
	 * @param $type
	 */
	public function cannotSeeDownloadButtonOnPageAndEditPage($workflowId, $statusType) {
		$I = $this;
		$I->cannotSeeDownloadButtonOnReadonlyPage($workflowId, $statusType);
		$I->cannotSeeDownloadButtonOnEditPage($workflowId, $statusType);
	}
	
	/**
	 * cannotSeeDownloadButtonOnReadonlyPage
	 *
	 * @param $workflowId
	 * @param $type
	 */
	public function cannotSeeDownloadButtonOnReadonlyPage($workflowId, $statusType) {
		$I = $this;
		$I->amOnPage('/author/item/' . $workflowId);
		$I->expectTo('not see download button on readonly for ' . $workflowId);
		$I->wait(2);
		$I->canSee($statusType);
		$I->cantSeeElement(ItemPage::$downloadButton);
	}
	
	/**
	 * cannotSeeDownloadButtonOnEditPage
	 *
	 * @param $workflowId
	 * @param $type
	 */
	public function cannotSeeDownloadButtonOnEditPage($workflowId, $statusType) {
		$I = $this;
		$I->amOnPage('/author/item/edit/' . $workflowId);
		$I->expectTo('not see download button on edit for' . $workflowId);
		$I->wait(2);
		$I->canSee($statusType);
		$I->cantSeeElement(ItemPage::$downloadButton);
	}
	
	/**
	 * canDownloadWord
	 *
	 * @throws \Exception
	 */
	public function downloadWord() {
		$I = $this;
		$I->selectOption(ItemPage::$downloadOptionsButton, 'Microsoft Word');
		$I->waitForElementClickable(ItemPage::$downloadFileButton, 3);
		$I->click(ItemPage::$downloadFileButton);
	}
	
	/**
	 * canDownloadQTI
	 *
	 * @throws \Exception
	 */
	public function downloadQTI() {
		$I = $this;
		$I->selectOption(ItemPage::$downloadOptionsButton, 'QTI package');
		$I->waitForElementClickable(ItemPage::$downloadFileButton, 3);
		$I->click(ItemPage::$downloadFileButton);
	}
	
	/**
	 * canDownloadImageZip
	 *
	 * @throws \Exception
	 */
	public function downloadImageZip() {
		$I = $this;
		$I->selectOption(ItemPage::$downloadOptionsButton, 'Image zip file');
		$I->waitForElementClickable(ItemPage::$downloadFileButton, 3);
		$I->click(ItemPage::$downloadFileButton);
	}
	
	/**
	 * cannotDownloadWord
	 *
	 * @param $workflowId
	 */
	public function cannotDownloadWord($workflowId) {
		$I = $this;
		$url = '/export/docx/' . $workflowId . '/item?mark_scheme=false&notes=false&template=false';
		$I->amOnPage($url);
		$I->canSee('Error 401 - Unauthorised');
	}
	
	/**
	 * cannotDownloadQTI
	 *
	 * @param $workflowId
	 */
	public function cannotDownloadQTI($workflowId) {
		$I = $this;
		$url = '/export/qti/item/' . $workflowId . '?mark_scheme=false&notes=false&template=false&version=2.1';
		$I->amOnPage($url);
		$I->canSee('Access denied');
	}
	
	/**
	 * cannotDownloadImageZip
	 *
	 * @param $workflowId
	 */
	public function cannotDownloadImageZip($workflowId) {
		$I = $this;
		$url = '/export/image-zip/' . $workflowId . '/item?mark_scheme=false&notes=false&template=false';
		$I->amOnPage($url);
		$I->canSee('Error 401 - Unauthorised');
	}
	
	/**
	 * CanDownloadImageOnly
	 *
	 * @param $workflowId
	 * @throws \Exception
	 */
	public function canDownloadImageOnly($workflowId)
	{
		$I = $this;
		$I->waitForElementClickable(ItemPage::$downloadButton);
		$I->click(ItemPage::$downloadButton);
		$I->wait(1);
		$I->selectOption('#download-options-button', 'Image zip file');
		$I->cantSee('Microsoft Word');
		$I->cantSee('QTI package');
		$I->downloadImageZip();
		$I->click(ItemPage::$downloadOptionsCloseButton); // Close modal
	}
}
