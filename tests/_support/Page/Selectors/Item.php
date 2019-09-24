<?php
namespace Page\Selectors;

class Item
{
    /**
     * Include url of current page
     * Edit: /author/item/edit
     */
    public static $createURL = '/author/item/create';
    public static $editURL = '/author/item/edit';
    public static $readOnlyURL = '/author/item';
    public static $downloadImageZipURL = '/export/image-zip/'; // plus id and /item
    public static $downloadWordDocURL = '/export/docx/'; // plus id and /item
    public static $downloadQtiItemURL = '/export/qti/item/'; 
    public static $downloadQtiCheckValidURL = '/export/qti/check-valid/'; // plus id and /item

    public static $titleInput = '//*[@id="headingText"]';

    /**
     * Tabs
    */
    public static $itemContentTab          = 'a[href="#item-content"]';
    public static $previewTab              = 'a[href="#item-preview"]';
    public static $markSchemeTab           = 'a[href="#mark-scheme"]';
    public static $additionalDocumentsTab  = 'a[href="#additionalDocuments"]';
    public static $informationTab          = 'a[href="#information"]';
    public static $syllabusTab             = 'a[href="#mapping"]';
    public static $trackingTab             = 'a[href="#tracking"]';
    public static $notesTab                = 'a[href="#notes"]';

    /**
     * Status Lozenge
     */
    public static $ItemBankStatusLabel = "//span[@class='ng-binding approved-tag'][contains(.,'Approved')]"; //Status for Item Only
    public static $ChangeStatusLabel = "//span[@class='ng-binding rejected-tag'][contains(.,'Change')]";
    public static $ReviewedStatusLabel = "//span[@class='ng-binding draft-tag'][contains(.,'Reviewed')]";
    public static $ReviewStatusLabel = "//span[@class='ng-binding draft-tag'][contains(.,'Review')]";
    public static $ArchivedStatusLabel = "//span[@class='ng-binding approved-tag'][contains(.,'Archived')]";
    public static $RejectedStatusLabel = "//span[@class='ng-binding rejected-tag'][contains(.,'Rejected')]";
    public static $PreTestStatusLabel = "//span[@class='ng-binding approved-tag'][contains(.,'Pre-test')]";

    /**
     * Buttons
     */
    public static $saveDraftItemButton        = '#saveDraftBtn';
    public static $saveButton                 = '//*[@id="saveDraftBtn"]';
    public static $submitForReviewButton      = '#createEditSubmitBtn';
    public static $firstReviewer              = 'ul#reviewers-box li:nth-of-type(1) label';
    public static $reviewer                   = 'ul#reviewers-box li label';
    public static $submitChooseReviewerButton = "//button[@id='chooseReviewersSubmitBtn']"; // In reviewer modal
    public static $editItemButton             = '#item-edit-button';
    public static $saveItemButton             = '#approverOrAssetSaveBtn';
    public static $cancelButton               = '#item-edit-cancel';
    public static $cancelButtonText           = 'Cancel';
    public static $backButton                 = '//*[@id="back"]';
    public static $prevItemButton             = '#item-previous-button';
    public static $nextItemButton             = '#item-next-button';
    public static $downloadButton             = '#download-button';
    public static $duplicateButton            = '#duplicate-item-button';
	public static $duplicateItemModalButton   = '#duplicate-item-modal-button';
	public static $createDuplicateItemButton  = '#create-duplicate-item-button';
	public static $createDuplicateButton      = '#create-duplicate-button';
    public static $addItemToPaperButton       = '#toggle-add-remove-item';
    public static $removeItemFromPaperButton  = '#toggle-add-remove-item';
	public static $downloadOptionsButton      = '#download-options-button';
	public static $downloadFileButton         = '#download-file-button';
	public static $downloadOptionsCloseButton = '#download-options-close-button';
    public static $flashMessage               = '//*[@id="flash-msg"]/div';
    public static $errorPage                  = '.errorPage';
	public static $openItemInListButton    = '#open-item-button';

    /**
     * Assets
     */
    public static $assetModal                            = '#modalAssetFinal';
    public static $assetBriefModal                       = '#modalAssetBrief';
    public static $finalAssetInModal                     = "#modalAssetFinal img[src^='/image/final']";
    public static $audioAssetInModal                     = "#modalAssetFinal audio[src^='/audio/final']";
    public static $videoAssetInModal                     = "#modalAssetFinal video[src^='/video/final']";
    public static $assetBriefNoImageInModal              = "#modalAssetBrief img[src^='/images/asset-requested']";
    public static $assetBriefWithImageInModal            = "#modalAssetBrief img[src^='/image/brief']";
    public static $assetBriefImageHolder                 = "#modalAssetBrief .image-holder";
    public static $finalAssetOnPage                      = "img.%s.workflow-%s[src^='/image/final']";
    public static $audioAssetOnPage                      = "audio.%s.workflow-%s";
    public static $videoAssetOnPage                      = "video.%s.workflow-%s";
    public static $assetBriefNoImageOnPage               = "img.%s.workflow-%s[src^='/images/asset-requested']";
    public static $assetBriefWithImageOnPage             = "img.%s.workflow-%s[src^='/image/brief']";
    public static $cancelfinalAssetModalButton           = '//*[@id="modalAssetFinal"]/div/div/div[2]/div[2]/button';
    public static $cancelAssetBriefModalButton           = '//*[@id="modalAssetBrief"]/div/div/div[2]/div[2]/button';
    public static $assetDropdown                         = ".asset-menu-container a.asset-menu-overlay[data-workflow-id='%s']";
    public static $viewAsset                             = ".asset-dropdown-menu a.view-asset-modal[data-workflow-id='%s']";
    public static $viewAssetBrief                        = ".asset-dropdown-menu a.view-brief-modal[data-workflow-id='%s']";
    public static $assetBriefModalText                   = "#asset-brief-description";
    public static $mcqAnswerAsset                        = ".mcq-answer-content img.workflow-%s";

    /**
     * Question and content blocks
    */
    public static $addQuestionBlock = '//*[@id="add-item-btn"]/a';
    public static $addContentDropdown = '//div[@id="add-item-btn"]//button[@id="item-dropdown"]';
    public static $addContentBlock = '//*[@id="add-item-btn"]//div[contains(@class,"dropdown-menu")]//a[2]';
    public static $questionType = '//*[@id="addResponseType"]';
    public static $confirmAddQuestion = '//*[@id="modalAddResponse"]/div/div/div[3]/a[1]';
    public static $addQuestionBlockMcqHideLetters = '#hideletters';
    public static $addQuestionBlockExtendedAnswerRemoveAnswerLines = '#removeextendedanswerlines';
    public static $addQuestionBlockShortAnswerRemoveAnswerLines = '#removeshortanswerlines';
    public static $addQuestionBlockShortAnswerAlignmentDefault = '#short_answer_alignment_default';
    public static $addQuestionBlockShortAnswerAlignmentLeft = '#short_answer_alignment_left';
    public static $addQuestionBlockShortAnswerAlignmentRight = '#short_answer_alignment_right';
    public static $addQuestionBlockShortAnswerLabelStart = '#label_start';
    public static $addQuestionBlockShortAnswerLabelEnd = '#label_right';
    public static $addQuestionBlockFitbSelect = '#fitb_type_select';
    public static $addQuestionBlockFitbFreeText = '#fitb_type_text';
    public static $dragAndDropResponseType = '#element_type';
    public static $dragAndDropPromptAssetMenuDropdown = '.dad-placeholder';
    public static $dragAndDropPromptAssetMenuAddAssetMenuItem = '//div[contains(@class, "drag-and-drop-container")]//div[contains(@class, "mce-menu-item")][contains(., "Add asset")]';
    public static $dragAndDropPromptAssetMenuAddAssetBriefMenuItem = '//div[contains(@class, "drag-and-drop-container")]//div[contains(@class, "mce-menu-item")][contains(., "Add brief")]';
    public static $dragAndDropAnswerEditDropTargetButton = '(//div[@id="composite-%d"]//div[contains(@class, "drop-target-row")]//button[contains(., "Edit drop target")])[%d]';
    public static $dragAndDropAnswerFinishEditingDropTargetButton = '(//div[@id="composite-%d"]//div[contains(@class, "drop-target-row")]//button[contains(., "Finish")])[1]';
    public static $dragAndDropPromptCanvas = '(//*[@class="canvas-container"])[1]';
    public static $dragAndDropAnswerTextInputField = '(//div[@class="drop-target-input"]//div[contains(@id, "ui-tinymce")])[%d]';
    public static $dragAndDropAnswerAssetMenuDropdown = '//div[contains(@class, "drop-target-row")][%d]//a[contains(@class, "add-image")]';
    public static $dragAndDropAnswerAssetMenuAddAssetMenuItem = '//div[contains(@class, "drop-target-row")][%d]//div[contains(@class, "dnd-menu")]//a[contains(., "Add asset")]';
    public static $dragAndDropAnswerLetter = 'div.optionletter';
    public static $imageInFreeTextMarkScheme = '.freetext-container img';
    public static $imageInTabularMarkScheme = '.ms-tabular img';
    public static $questionBlockTextField = '//div[contains(@data-comp-item-index,"%d")]';
    public static $questionBlockMcqAnswerField = '(//div[contains(@id, "composite-%d")]//div[@ng-focus="setCurrentAnswer(answer.letter);"])[%d]';
    public static $questionBlockMcqCorrectAnswerTickbox = '(//div[contains(@id, "composite-%d")]//label[@class="fa-lg lgtBlue"])[%d]';
    public static $questionBlockMcqAddAnswer = '//div[contains(@id, "composite-%d")]//a[contains(@class, "mcq-add-row")]';
    public static $mcqFirstCorrectAnswerCheckbox = '(//label[@class="fa-lg lgtBlue"])[1]';
    public static $mcqMaxMarkInput = '//input[contains(@ng-model,"comp_item.max_mark")]';
    public static $extendedAnswerLines = '//div[contains(@id, "composite-%d")]//div[contains(@class, "extended-answer-lines")]//hr';
    public static $extendedAnswerLinesReadOnly = '//div[contains(@class, "extended-answer-lines")]//hr';
    public static $extendedAnswerLineCount = '//div[contains(@id, "composite-%d")]//input[contains(@class, "ea-lines")]';
    public static $shortAnswerLines = '//div[contains(@id, "composite-%d")]//div[contains(@class, "short-answer-lines")]//hr';
    public static $shortAnswerLinesReadOnly = '//div[contains(@class, "short-answer-container")]//hr';
    public static $shortAnswerLinesWithLabels = '//div[contains(@id, "composite-%d")]//div[contains(@class, "short-answer-lines")]//div[contains(@class, "label-line")]';
    public static $shortAnswerLinesWithLabelsReadOnly = '//div[contains(@class, "short-answer-container")]//div[contains(@class, "label-line")]';
    public static $shortAnswerLinesWithLabelsReadOnlyLeftLabel = '//div[contains(@class, "short-answer-container")]//div[contains(@class, "label-line")]//div[contains(@class, "left")]';
    public static $shortAnswerLinesWithLabelsReadOnlyRightLabel = '//div[contains(@class, "short-answer-container")]//div[contains(@class, "label-line")]//div[contains(@class, "right")]';
    public static $shortAnswerAddLine = '//div[contains(@id, "composite-%d")]//a[contains(@class, "add-line")]';
    public static $shortAnswerDeleteLine = '//div[contains(@id, "composite-%d")]//a[contains(@class, "delete-line")]';
    public static $shortAnswerLabelBefore = '(//div[contains(@id, "composite-%d")]//div[contains(@class, "label-line")]//div[contains(@class, "left")]//div[contains(@class, "edit-label")])[%d]';
    public static $shortAnswerLabelAfter = '(//div[contains(@id, "composite-%d")]//div[contains(@class, "label-line")]//div[contains(@class, "right")]//div[contains(@class, "edit-label")])[%d]';
    public static $fitbInsertBlankButton = 'div.mce-insert-blank-btn';
    public static $fitbCorrectAnswerRadio = '(//td[contains(@class, "blank-option-column")]//input[contains(@type, "radio")])[%d]';
    public static $fitbSelectAnswerText = '(//div[contains(@id, "modalInsertBlank")]//input[contains(@name, "parameters")])[%d]';
    public static $fitbSelectAddAnswer = '//div[contains(@id, "modalInsertBlank")]//span[contains(@class, "add-button")]';
    public static $fitbInsertBlankConfirmButton = '//div[contains(@id, "modalInsertBlank")]//button[contains(@ng-click, "insertBlank()")]';
    public static $markSchemeFieldFreeText = '//div[contains(@class, "ms-freetext")]//div[contains(@class, "markSchemeEditor")]';
    public static $markSchemeFieldTabular = '//div[contains(@class, "ms-tabular")]//div[contains(@class, "markSchemeEditor")]';
    public static $itemContainerPreview = '.item-container-preview';
    public static $contentBlockText = '//*[@id="composite-%d"]//div[contains(@class,"contenteditor")]';
    public static $markSchemeType = '//*[@id="mark-scheme"]//select';

    /**
     * TinyMCE
     */
    public static $specialCharactersButton = '.mce-insert-symbol-btn';
    public static $specialCharacterByTitle = "#modalInsertSpecialCharacters a[title='%s']";
    public static $specialCharactersTab    = "#modalInsertSpecialCharacters a[href='#charmap-%s']";
    public static $tinyMceAssetButton = "(//i[contains(@class,'mce-i-image')])[%d]";
    public static $tinyMceAddBriefButton = "(//div[contains(@class,'mce-brief')])[%d]";
    public static $tinyMceAddAssetButton = "(//div[contains(@class,'mce-asset')])[%d]";

    /**
     * Meta data
    */
    public static $duration             = "//input[@name='duration']";
    public static $durationReadOnly     = '//*[@id="item-duration-at"]';
    public static $bloomsDropdown       = "//select[@name='blooms_classification']";
    public static $blooms               = 'select[name="blooms_classification"]';
    public static $isScreenReaderReady  = 'div[name="is_screen_reader_ready"]';
    public static $newDurationValue     = '143';
    public static $duplicatedFrom       = '//*[@id="information"]/div/div[3]/div[1]/label';

    /**
     * Versions
     */
    public static $itemVersionBox = "(//span[contains(@class,'select2 select2-container select2-container--default') and contains(@dir, 'ltr')])[1]";
    public static $itemVersionLatest = "//span[@class='select2-results']//li[1]";
    public static $itemVersionLatestCheck = "(//span[contains(@class,'select2 select2-container select2-container--default') and contains(@dir, 'ltr')])[1]//span/span/span/span";
    public static $itemVersionText = "(//span[contains(@class,'select2 select2-container select2-container--default') and contains(@dir, 'ltr')])[1]//span/span/span/span[contains(text(),'%s')]";

    /**
     * View and trigger syllabus mapping (the rest is in SyllabusMapping)
    */
    public static $mapToSyllabusButton  = "//button[@id='mapbtn']";

    /**
     * Actions for items in review
    */
    public static $reviewDropdown       = "//span[@id='select2-reviewer-actions-container']";
    public static $recommendApprove     = '#select2-reviewer-actions-results ul li:nth-of-type(1)';
    public static $recommendChange      = '#select2-reviewer-actions-results ul li:nth-of-type(2)';
    public static $recommendReject      = '#select2-reviewer-actions-results ul li:nth-of-type(3)';
    public static $closeReview          = '#select2-reviewer-actions-results ul li:nth-last-child(1)';

    public static $confirmReviewChoiseButton  = '#reviewer-actions-btn';

    // In modal
    public static $textArea                 = "//textarea[@ng-model='approverInfo.comment']";
    public static $submitReviewButton       = "//a[contains(@ng-click,'reviewRecommend()')]";
	public static $modalCloseReviewsYesButton = '//div[@id="modalCloseReviews"]//div[contains(@class, "modal-footer")]//button[contains(., "Yes")]';
    public static $dynamicModal             = '#modalDirective';
    public static $selectTypeAsset          = '#modalAssetFinal select:nth-of-type(1)';
    public static $textAreaAssetDescription = '#modalAssetFinal textarea:nth-of-type(1)';
    public static $insertAssetButton        = '#modalAssetFinal .modal-footer .btn-primary';
    public static $assetClearedButton       = '#asset-cleared';
    public static $attachFile               = 'input[type="file"][name="assetFinal"]';

    /**
     * Actions for items after review
    */
    public static $approveDropdown = "//*[@id='select2-approver-actions-container']";
    public static $selectItemBank = "//*[contains(text(),'Send to Item Bank') and contains(@class,'select2-results__option')]";
    public static $selectPretest = "//*[contains(text(),'Send to pre-test') and contains(@class,'select2-results__option')]";
    public static $selectArchive = "//*[contains(text(),'Send to archive') and contains(@class,'select2-results__option')]";
    public static $selectNewCycle = "//*[contains(text(),'Submit to new cycle') and contains(@class,'select2-results__option')]";
    public static $selectChange = "//*[contains(text(),'Request changes') and contains(@class,'select2-results__option')]";
    public static $selectReject = "//*[contains(text(),'Reject') and contains(@class,'select2-results__option')]";

    public static $confirmActionChoiseButton = "//button[@ng-click='submitConfirmAction()']";
    public static $submitApproveButton = "//a[@ng-click='sendForApproval()']";

    /**
     * Actions for editing/viewing items in papers
     */
    public static $noEditItem = "This item is in another paper and so cannot be edited";
    public static $replaceItem = "You can replace this item with a duplicate that will be editable";
    public static $noEditDirectDuplicateItem = "This item is in a paper and so cannot be edited directly";
    public static $noEditMultiplePaperDuplicateItem = "This item is in more than one paper and so cannot be edited";
    public static $duplicateItemWithLink = "The item can be edited by opening the paper and editing the item from there";
    public static $assetManagerDropdownToggle = 'a.asset-menu-overlay';
    public static $assetManagerDropdownMenuViewBriefMenuItem = 'a.view-brief-modal';
    /**
     * Duplicate modals and text
     */
    public static $duplicateItemModal = "#duplicateItemModal";
    public static $duplicateIncludeInPaper = "Include the copy in this paper";
    public static $duplicateModalButtonText = "Duplicate";
    public static $duplicateItemTitleId = "#duplicateItemTitle";
}
