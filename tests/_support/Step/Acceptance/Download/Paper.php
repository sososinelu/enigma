<?php
namespace Step\Acceptance\Download;

use Page\Selectors\Paper as PaperPage;

class Paper extends \AcceptanceTester
{
	public function canSeeDownloadButtonOnPage($workflowId) {
		$I = $this;
		$I->amOnPage('/author/paper/' . $workflowId);
		$I->expectTo('see download button on ' . $workflowId);
		$I->wait(2);
		$I->canSeeElement(PaperPage::$downloadButton);
	}
	
	public function canSeeUploadButtonOnPage($workflowId) {
		$I = $this;
		$I->amOnPage('/author/paper/' . $workflowId);
		$I->expectTo('see upload button on ' . $workflowId);
		$I->wait(2);
		$I->canSeeElement(PaperPage::$uploadButton);
	}
	
	public function cannotSeeUploadButtonOnPage($workflowId) {
		$I = $this;
		$I->amOnPage('/author/paper/' . $workflowId);
		$I->expectTo('not see upload button on ' . $workflowId);
		$I->wait(2);
		$I->cantSeeElement(PaperPage::$uploadButton);
	}
	
	public function canSeeDownloadButtonOnEditPage($workflowId) {
		$I = $this;
		$I->amOnPage('/author/paper/edit/' . $workflowId);
		$I->expectTo('see download button on ' . $workflowId);
		$I->wait(2);
		$I->canSeeElement(PaperPage::$downloadButton);
	}
	
	public function cannotSeeDownloadButtonOnPage($workflowId) {
		$I = $this;
		$I->amOnPage('/author/paper/' . $workflowId);
		$I->expectTo('not see download button on ' . $workflowId);
		$I->wait(2);
		$I->cantSeeElement(PaperPage::$downloadButton);
	}
	
	public function downloadWord() {
		$I = $this;
		$I->selectOption(PaperPage::$downloadOptionsButton, 'Microsoft Word');
		$I->waitForElementClickable(PaperPage::$downloadFileButton, 3);
		$I->click(PaperPage::$downloadFileButton);
	}
	
	public function downloadQTI() {
		$I = $this;
		$I->selectOption(PaperPage::$downloadOptionsButton, 'QTI package');
		$I->waitForElementClickable(PaperPage::$downloadFileButton, 3);
		$I->click(PaperPage::$downloadFileButton);
	}
	
	public function downloadImageZip() {
		$I = $this;
		$I->selectOption(PaperPage::$downloadOptionsButton, 'Image zip file');
		$I->waitForElementClickable(PaperPage::$downloadFileButton, 3);
		$I->click(PaperPage::$downloadFileButton);
	}
	
	public function downloadExcel() {
		$I = $this;
		$I->selectOption(PaperPage::$downloadOptionsButton, 'Excel (Paper statistics)');
		$I->waitForElementClickable(PaperPage::$downloadFileButton, 3);
		$I->click(PaperPage::$downloadFileButton);
	}
	
	public function cannotDownloadWord($workflowId) {
		$I = $this;
		$url = '/export/docx/' . $workflowId . '/paper?mark_scheme=false&notes=false&template=false';
		$I->amOnPage($url);
		$I->canSee('Error 401 - Unauthorised');
	}
	
	public function cannotDownloadQTI($workflowId) {
		$I = $this;
		$url = '/export/qti/paper/' . $workflowId . '?mark_scheme=false&notes=false&template=false&version=2.1';
		$I->amOnPage($url);
		$I->canSee('Access denied');
	}
	
	public function cannotDownloadImageZip($workflowId) {
		$I = $this;
		$url = '/export/image-zip/' . $workflowId . '/paper?mark_scheme=false&notes=false&template=false';
		$I->amOnPage($url);
		$I->canSee('Error 401 - Unauthorised');
	}
	
	public function cannotDownloadExcel($workflowId) {
		$I = $this;
		$url = '/stats/paper/export-item-usage?paper_id=' . $workflowId;
		$I->amOnPage($url);
		$I->canSee('Access denied');
	}
	
	public function canDownloadOnlyExcel($workflowId)
	{
		$I = $this;
		$I->waitForElementClickable(PaperPage::$downloadButton);
		$I->click(PaperPage::$downloadButton);
		$I->wait(1);
		$I->selectOption(PaperPage::$downloadOptionsButton, 'Excel (Paper statistics)');
		$I->cantSee('Microsoft Word');
		$I->cantSee('QTI package');
		$I->cantSee('Image zip file');
		$I->downloadExcel($workflowId);
	}
}
