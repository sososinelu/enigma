<?php
namespace Page\Selectors;

class Paper
{
    /**
     * Include url of current page
     * Edit: /author/paper/edit
     */
    public static $url = '/author/paper/';
    public static $createURL = '/author/paper/create';
    public static $editURL = '/author/paper/edit';
    public static $readOnlyURL = '/author/paper';
    public static $downloadImageZipURL = '/export/image-zip/'; // plus id and /paper
    public static $downloadWordDocURL = '/export/docx/'; // plus id and /paper
    public static $downloadExcelURL = '/stats/paper/export-item-usage?paper_id=';
    public static $downloadQtiPaperURL = '/export/qti/paper/';
    public static $downloadQtiCheckValidURL = '/export/qti/check-valid/'; // plus id and /paper

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */
    public static $title = "//input[@name='title']";
    public static $saveText = "Your paper has successfully saved.";
    public static $paperNumber = "//input[contains(@ng-model,'number')]";
    public static $sessionDay = "//select[@ng-model='session_date_day']";
    public static $sessionMonth = "//select[@ng-model='session_date_month']";
    public static $sessionYear = "//select[@ng-model='session_date_year']";
    public static $paperText = "//input[@name='papertext']";
    public static $reviewer = "//label[contains(.,'PaperReviewer Maths')]";
    public static $submitReviewer = "//button[@ng-click='defaultSubmit()']";
    public static $reviewText = "Your paper was successfully submitted for review.";

    /**
     * Tabs
     */
    public static $itemSelectionTab = 'a[href="#item-selection"]';
    public static $itemOrderingTab = 'a[href="#ordering"]';
    public static $previewTab = 'a[href="#paper-preview"]';
    public static $markSchemeTab = 'a[href="#markscheme"]';
    public static $markSchemeReadOnlyTab = 'a[href="#mark-scheme"]';
    public static $additionalDocumentsTab = 'a[href="#additionalDocuments"]';
    public static $informationTab = 'a[href="#information"]';
    public static $syllabusTab = 'a[href="#summary"]';
    public static $compositionEditTab = 'a[href="#marks"]';
    public static $compositionTab = 'a[href="#composition"]';
    public static $trackingTab = 'a[href="#tracking"]';
    public static $notesTab = 'a[href="#notes"]';
    public static $proofsTab = 'a[href="#proofs"]';

    /**
     * Status Losange
     */
    public static $ExamReadyStatusLabel = "//span[@class='ng-binding approved-tag'][contains(.,'Exam ready')]"; //Status for Paper Only
    public static $ChangeStatusLabel = "//span[@class='ng-binding rejected-tag'][contains(.,'Change')]";
    public static $ReviewedStatusLabel = "//span[@class='ng-binding draft-tag'][contains(.,'Reviewed')]";
    public static $ReviewStatusLabel = "//span[@class='ng-binding draft-tag'][contains(.,'Review')]";
    public static $ArchivedStatusLabel = "//span[@class='ng-binding approved-tag'][contains(.,'Archived')]";
    public static $RejectedStatusLabel = "//span[@class='ng-binding rejected-tag'][contains(.,'Rejected')]";
    public static $PreTestStatusLabel = "//span[@class='ng-binding approved-tag'][contains(.,'Pre-test')]";

    /**
     * Buttons
     */
    public static $saveDraftButton = 'input[value="Save draft"]';
    public static $submitForReviewButton = 'input[value="Submit for review"]';
    public static $duplicateButton = '#duplicate-paper-button';
    public static $duplicatePaperDuplicateButton = '#duplicate-paper-duplicate-button';
    public static $filterOnItemtypeButton = 'select[id="filterItemType"]';
    public static $searchButton = '#search-button';
    public static $filterOnBloomsButton = 'select[id="filterBlooms"]';
    public static $editPaperButton = '#paper-edit';
    public static $editItemInPaperButton = 'button.edit-ordering-button';
    public static $viewItemInPaperButton      = 'button.view-ordering-button';
    public static $binocularsButton           = '.paper-binoculars';
    public static $saveButton                 = '//input[@ng-click="savePaper()"]';
    public static $cancelButton               = '#paper-edit-cancel';
    public static $cancelButtonText           = 'Cancel';
    public static $createDuplicateButtonText  = 'Create duplicate';
    public static $prevPaperButton            = '#paper-previous-button';
    public static $nextPaperButton            = '#paper-next-button';
    public static $downloadButton             = '#download-button';
	public static $downloadOptionsCloseButton = '#download-options-close-button';
    public static $downloadOptionsButton      = '#download-options-button';
	public static $downloadFileButton         = '#download-file-button';
    public static $uploadButton               = '#upload-button';
    public static $excelUploadButton          = '#excel-upload-button';
    public static $uploadImportCloseButton    = '#upload-import-close-button';
	public static $uploadImportButton         = '#upload-import-button';
    public static $publishToPlayerButton      = '#publish-button';
    public static $chooseResponseButton       = '.approval-control > .select2';
    public static $closeReviewButton          = '#select2-approver-actions-results ul li:nth-of-type(1)';
    public static $recommendApproveButton     = '#select2-approver-actions-results ul li:nth-of-type(1)';
    public static $recommendRejectButton = '#select2-approver-actions-results ul li:nth-of-type(1)';
    public static $recommendChangeButton = '#select2-approver-actions-results ul li:nth-of-type(1)';
    public static $confirmActionButton = '#approver-actions-btn';
    public static $reviewCommentButton = '#paper-review-comment-note';
    public static $binocularsButtonByLocation = "(//i[@class='fas fa-binoculars paper-binoculars selector'])[%s]"; //Jen has used a better way, but at the moment is not in GM code. Therefore the hack.
    public static $openButtonButton = "(//a[@id='open-item-button'])[1]";
    public static $submitReviewButton = "//input[@value='Submit for review']";
    public static $closeSearchItemButton = "//button[@ng-click='clearItems()']";
    public static $addItemModalButton = "//button[@ng-click='addItemModal()']";
    public static $searchTextButton = "//input[@id='searchTextSearch']";
    public static $savePaperButton = "//input[@ng-click='savePaper()']";
    public static $modalActionButton = "//button[@ng-click='modalAction(button.action, button.context)']";

    /**
     * Review
     */
    public static $reviewDropdown = "(//*[@id='select2-approver-actions-container'])[1]";
    public static $recommendApprove     = "//*[contains(text(), 'approve') and contains(@id, 'select2-approver-actions-result')]";
    public static $recommendChange      = "//*[contains(text(), 'change') and contains(@id, 'select2-approver-actions-result')]";
    public static $recommendReject      = "//*[contains(text(), 'reject') and contains(@id, 'select2-approver-actions-result')]";
    public static $closeReview          = "//*[contains(text(), 'Close') and contains(@id, 'select2-approver-actions-result')]";
    public static $confirmReview = "//button[@ng-click='showPaperReviewModal()']";
    public static $submitReview = "//a[contains(@ng-click,'reviewRecommend()')]";
    public static $textArea = "//textarea[@placeholder='(Optional)']";
    public static $confirmReviewButton = "(//button[@class='btn btn-primary min-width'][contains(.,'Save')])[1]";
    public static $textConfirmText =  "You have recommended this paper for approval.";

    /**
     * Approval
     */
    public static $approveDropdown = "(//*[@id='select2-approver-actions-container'])[2]";
    public static $selectTypesetting = "//*[contains(@id,'select2-approver-actions-result-')][contains(.,'Send to typesetting')]";
    public static $selectPreTest = "//*[contains(@id,'select2-approver-actions-result-')][contains(.,'Send to pre-test')]";
    public static $selectExamReady = "//*[contains(@id,'select2-approver-actions-result-')][contains(.,'Set as exam ready')]";
    public static $selectArchive = "//*[contains(@id,'select2-approver-actions-result-')][contains(.,'Send to archive')]";
    public static $selectNewCycle = "//*[contains(@id,'select2-approver-actions-result-')][contains(.,'Submit to new cycle')]";
    public static $selectChanges = "//*[contains(@id,'select2-approver-actions-result-')][contains(.,'Request changes')]";
    public static $selectReject = "//*[contains(@id,'select2-approver-actions-result-')][contains(.,'Reject')]";
    public static $confirmApproval = "//button[@ng-click='popApproveModal(approveAction)']";
    public static $submitApprove = "//button[@ng-hide='approveData.modal.stop']";
    public static $submitApproveArchive = "//*[@class='btn btn-primary min-width'][contains(.,'OK')]";
    public static $cancelApproveButton = '#paperApproveModal button.close';
    public static $statusExamReady = "//span[@class='approved-tag ng-scope'][contains(.,'Exam ready')]"; //Exam Ready Status
    public static $statusPreTest = "//span[@class='ng-binding ng-scope approved-tag'][contains(.,'Pre-test')]"; //PreTest Status
    public static $statusTypesetting = "//span[@class='ng-binding ng-scope typesetting-tag']"; //Typesetting Status
    public static $statusArchive = "//span[@class='ng-binding ng-scope approved-tag'][contains(.,'Archived')]"; //Archive Status
    public static $setItemsToArchive = "//input[@ng-model='approveData.archiveItems']";
    public static $textAreaReviewed = "textarea.ng-binding";

    /**
     * Versions
     */
    public static $paperVersionText = "//select/option[contains(text(), '%s')]";
    public static $paperVersionArray = "//select/option[contains(@value, '/author')]['%s']";
    public static $paperVersionLatest = "(//select/option[contains(@value, '/author')]['%s'])[1]";

    /**
     * New Cycle
     */
    public static $cycleName = "//input[@name='cycle_name']";
    public static $setCycle = "//select[@name='review_stage']";
    public static $selectReviewer = "//label[contains(.,'PaperReviewer Maths')]"; //Reviewing
    public static $settingDropdown = "//span[@id='select2-author-container']"; //Setting Dropdown
    public static $settingSelectSetter = "//li[contains(.,'PaperSetter Maths')]"; //Setting Select
    public static $notesText = "//textarea[@name='notes']";
    public static $submitButton = "//button[@ng-click='submitForm()']";

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }
}
