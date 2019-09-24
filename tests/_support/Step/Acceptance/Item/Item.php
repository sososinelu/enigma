<?php

namespace Step\Acceptance\Item;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Selectors\AssetModals as AssetModalsPage;

class Item extends \AcceptanceTester
{
    /**
     * Create a new item with supplied subject and qualification
     *
     * @param $subject
     * @param $qualification
     * @param $title
     * @throws \Exception
     */
    public function create($subject, $qualification, $title)
    {
        $I = $this;
        $I->waitThenClick(AuthoringPage::$createButton, 30);
        $I->waitThenClick(AuthoringPage::$createDropdownItem, 30);
        $I->fillSubjectQualificationModal($subject, $qualification);
        $I->waitForReload(function($I) {
            $I->waitThenClick(AuthoringPage::$subjectQualificationCreateButton);
        });
        $I->canSeeInCurrentUrl(ItemPage::$createURL);
        $I->waitForElementClickable(ItemPage::$titleInput);
        $I->fillField(ItemPage::$titleInput, $title);
        $I->waitForReload(function ($I) {
            $I->waitThenClick(ItemPage::$saveButton, 30);
        });
        $I->canSeeInCurrentUrl(ItemPage::$editURL);
    }

    /**
     * Fills in subject/qualification modal
     *
     * @param string $subject
     * @param string $qualification
     * @param string $syllabus
     * @throws \Exception
     */
    public function fillSubjectQualificationModal($subject, $qualification, $syllabus = null)
    {
        $I = $this;
        $I->waitThenClick(AuthoringPage::$subjectSelect);
        $subjectSelection = sprintf(AuthoringPage::$subjectQualificationSelectPattern, $subject);
        $I->waitThenClick($subjectSelection);
        $I->wait(1);
        $I->waitThenClick(AuthoringPage::$qualificationSelect);
        $qualificationSelection = sprintf(AuthoringPage::$subjectQualificationSelectPattern, $qualification);
        $I->waitThenClick($qualificationSelection);
        $I->wait(1);
        if($syllabus){
            $I->waitThenClick(AuthoringPage::$syllabusSelect);
            $syllabusSelection = sprintf(AuthoringPage::$subjectQualificationSelectPattern, $syllabus);
            $I->waitThenClick($syllabusSelection);
            $I->wait(1);    
        }
    }

    /**
     * Create an item without having to select s/q manually
     * @param string $subject
     * @param string $qualification
     * @param string $title
     * @param bool $save
     * @throws \Exception
     */
    public function quickCreateItem($subject = '59c0cfff807b83273a775653', $qualification = '59c0cfff807b83273a775654', $title = 'Automated testing item', $save = true)
    {
        $I = $this;
        $I->amOnPage(sprintf('/author/item/create?subject=%s&qualification=%s', $subject, $qualification));
        $I->waitForElementClickable(ItemPage::$titleInput);
        $I->fillField(ItemPage::$titleInput, $title);
        if ($save) {
            $I->waitForReload(function ($I) {
                $I->waitThenClick(ItemPage::$saveButton, 30);
            });
            $I->canSeeInCurrentUrl(ItemPage::$editURL);
        }
    }

    /**
     * Edit item
     *
     * @param $itemId
     * @throws \Exception
     */
    public function editItem($itemId)
    {
        $I = $this;
        $I->amOnPage(ItemPage::$editURL . '/' . $itemId);
    }

    /**
     * Edit item (from paper)
     *
     * @param $itemId
     * @param $paperId
     */
    public function editItemWithPaperId($itemId, $paperId)
    {
        $I = $this;
        $I->amOnPage(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId);
    }

    /**
     * Edit item (from paper)
     *
     * @param $itemId
     * @param $paperId
     */
    public function editItemWithPaperIdInReadOnly($itemId, $paperId)
    {
        $I = $this;
        $I->amOnPage(ItemPage::$editURL . '/' . $itemId . '?paper_ref=' . $paperId . '&paper-read-only=true');
    }

    /**
     * View item
     *
     * @param $itemId
     * @throws \Exception
     */
    public function openItemInReadOnly($itemId)
    {
        $I = $this;
        $I->amOnPage(ItemPage::$readOnlyURL . '/' . $itemId);
    }

    /**
     * Edit an item & save it
     *
     * @throws \Exception
     */
    public function makeChangeAndSaveItem() {
        $I = $this;
        $I->waitForElementClickable(ItemPage::$duration,30);
        $I->setMetaData('143');
        $I->waitThenClick(ItemPage::$saveItemButton);
    }

    /**
     * Edit an item & save it
     *
     * @throws \Exception
     */
    public function makeChangeAndSaveDraftItem() {
        $I = $this;
        $I->waitForElementClickable(ItemPage::$duration,30);
        $I->setMetaData('143');
        $I->waitThenClick(ItemPage::$saveDraftItemButton);
    }

    /**
     * View item (from paper)
     *
     * @param $itemId
     * @param $paperId
     */
    public function openItemInReadOnlyWithPaperId($itemId, $paperId)
    {
        $I = $this;
        $I->amOnPage(ItemPage::$readOnlyURL . '/' . $itemId . '?paper_ref=' . $paperId);
    }

    /**
     * Add a multiple choice question to the item and save it
     *
     * @param int $questionCount - the number of question or content blocks already existing on the page (used in selectors)
     * @param int $answerCount
     * @param int $marks
     * @param int $correctAnswer
     * @param bool $hideLetters
     * @throws \Exception
     */
    public function addMCQQuestion($questionCount = 0, $answerCount = 4, $marks = 1, $correctAnswer = 0, $hideLetters = false)
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$addQuestionBlock, 30);
        $I->waitForElement(ItemPage::$questionType);
        $I->selectOption(ItemPage::$questionType, "Objective answer MCQ");
        if ($hideLetters) {
            $I->checkOption(ItemPage::$addQuestionBlockMcqHideLetters);
        }
        $I->waitThenClick(ItemPage::$confirmAddQuestion, 30);
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, $questionCount));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, $questionCount), 'This is an Automation Test');
        for ($counter = 1; $counter <= $answerCount; $counter++) {
            if ($counter > 4) {
                $I->waitThenClick(sprintf(ItemPage::$questionBlockMcqAddAnswer, $questionCount));
            }
            $I->waitForElement(sprintf(ItemPage::$questionBlockMcqAnswerField, $questionCount, $counter));
            $I->fillField(
                sprintf(ItemPage::$questionBlockMcqAnswerField, $questionCount,  $counter),
                sprintf('Answer number %d', $counter)
            );
        }
        if ($correctAnswer > 0 && $correctAnswer <= $answerCount) {
            $I->waitThenClick(sprintf(ItemPage::$questionBlockMcqCorrectAnswerTickbox, $questionCount, $correctAnswer));
        }
        $I->wait(1);
        $I->waitForElement(ItemPage::$mcqMaxMarkInput);
        $I->fillField(ItemPage::$mcqMaxMarkInput,(string)$marks);
        $I->waitThenClick(ItemPage::$saveButton, 30);
        $I->wait(2);
        $I->canSeeInCurrentUrl(ItemPage::$editURL);
    }

    /**
     * Add a multiple choice question to the item and save it
     *
     * @param int $questionCount
     * @param int $marks
     * @param bool $removeAnswerLines
     * @param bool $labelBefore
     * @param bool $labelAfter
     * @param string $width (full, half-left, half-right)
     * @throws \Exception
     */
    public function addShortAnswerQuestion($questionCount = 0, $marks = 1, $removeAnswerLines = false, $labelBefore = false, $labelAfter = false, $width = 'full')
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$addQuestionBlock, 30);
        $I->waitForElement(ItemPage::$questionType);
        $I->selectOption(ItemPage::$questionType, "Short answer");
        if ($removeAnswerLines) {
            $I->checkOption(ItemPage::$addQuestionBlockShortAnswerRemoveAnswerLines);
            $labelBefore = $labelAfter = false;
        } else {
            switch ($width) {
                case 'full':
                    $I->click(ItemPage::$addQuestionBlockShortAnswerAlignmentDefault);
                    break;
                case 'left':
                    $I->click(ItemPage::$addQuestionBlockShortAnswerAlignmentLeft);
                    break;
                case 'right':
                    $I->click(ItemPage::$addQuestionBlockShortAnswerAlignmentRight);
                    break;
            }

            if ($labelBefore !== false) {
                $I->checkOption(ItemPage::$addQuestionBlockShortAnswerLabelStart);
            }

            if ($labelAfter !== false) {
                $I->checkOption(ItemPage::$addQuestionBlockShortAnswerLabelEnd);
            }
        }

        $I->waitThenClick(ItemPage::$confirmAddQuestion, 30);
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, $questionCount));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, $questionCount), 'This is an Automation Test');

        if ($labelBefore !== false) {
            $I->fillField(sprintf(ItemPage::$shortAnswerLabelBefore, $questionCount, 1), $labelBefore);
        }

        if ($labelAfter !== false) {
            $I->fillField(sprintf(ItemPage::$shortAnswerLabelAfter, $questionCount, 1), $labelAfter);
        }

        $I->wait(1);
        $I->waitForElement(ItemPage::$mcqMaxMarkInput);
        $I->fillField(ItemPage::$mcqMaxMarkInput,(string)$marks);
        $I->waitThenClick(ItemPage::$saveButton, 30);
        $I->wait(2);
        $I->canSeeInCurrentUrl(ItemPage::$editURL);
    }

    /**
     * Add an extended answer question to the item and save it
     *
     * @param int $questionCount
     * @param int $marks
     * @param bool $removeAnswerLines
     * @throws \Exception
     */
    public function addExtendedAnswerQuestion($questionCount = 0, $marks = 1, $removeAnswerLines = false)
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$addQuestionBlock, 30);
        $I->waitForElement(ItemPage::$questionType);
        $I->selectOption(ItemPage::$questionType, "Extended answer");
        if ($removeAnswerLines) {
            $I->checkOption(ItemPage::$addQuestionBlockExtendedAnswerRemoveAnswerLines);
        }

        $I->waitThenClick(ItemPage::$confirmAddQuestion, 30);
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, $questionCount));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, $questionCount), 'This is an Automation Test');

        $I->wait(1);
        $I->waitForElement(ItemPage::$mcqMaxMarkInput);
        $I->fillField(ItemPage::$mcqMaxMarkInput,(string)$marks);
        $I->waitThenClick(ItemPage::$saveButton, 30);
        $I->wait(2);
        $I->canSeeInCurrentUrl(ItemPage::$editURL);
    }

    /**
     * Add a fitb question to the item and save it
     *
     * @param int $questionCount
     * @param int $marks
     * @param string $type
     * @throws \Exception
     */
    public function addFillInTheBlankQuestion($questionCount = 0, $marks = 1, $type = 'select')
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$addQuestionBlock, 30);
        $I->waitForElement(ItemPage::$questionType);
        $I->selectOption(ItemPage::$questionType, "Fill in the blank");
        switch($type) {
            case 'select':
                $I->click(ItemPage::$addQuestionBlockFitbSelect);
                break;
            case 'free_text':
                $I->click(ItemPage::$addQuestionBlockFitbFreeText);
                break;
        }

        $I->waitThenClick(ItemPage::$confirmAddQuestion, 30);
        $I->wait(1);
        $I->waitForElement(ItemPage::$mcqMaxMarkInput);
        $I->fillField(ItemPage::$mcqMaxMarkInput,(string)$marks);
        $I->waitThenClick(ItemPage::$saveButton, 30);
        $I->wait(2);
        $I->canSeeInCurrentUrl(ItemPage::$editURL);
    }

    /**
     * Add a drag and drop with text question to the item and save it
     *
     * @param int $questionCount
     * @param string $responseType
     * @param string $promptType
     * @param int $marks
     * @throws \Exception
     */
    public function addDragAndDropQuestion($questionCount = 0, $responseType = 'Text', $promptType = 'Image', $marks = 1)
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$addQuestionBlock, 30);
        $I->waitForElement(ItemPage::$questionType);
        $I->selectOption(ItemPage::$questionType, "Drag and drop");
        $I->selectOption(ItemPage::$dragAndDropResponseType, $responseType);
        $I->waitThenClick(ItemPage::$confirmAddQuestion, 30);
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, $questionCount));
        $I->wait(0.2);
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, $questionCount), 'This is an Automation Test');
        $I->wait(0.2);

        if ($promptType === 'Image') {
            $I->click(ItemPage::$dragAndDropPromptAssetMenuDropdown);
            $I->waitThenClick(ItemPage::$dragAndDropPromptAssetMenuAddAssetMenuItem);
            $I->selectOption(AssetModalsPage::$finalAssetTypeSelector, 'Picture');
            $I->attachFile(AssetModalsPage::$finalAssetFileInput, 'lionchu.png');
            $I->fillField(AssetModalsPage::$finalAssetDescription, 'This is a cat mixed with a pokemon');
            $I->waitThenClick(AssetModalsPage::$finalAssetSaveOrUpdateButton);
            $I->waitForElementNotVisible(AssetModalsPage::$finalAssetModal);
            $I->wait(10);
        } elseif ($promptType === 'Brief') {
            $I->click(ItemPage::$dragAndDropPromptAssetMenuDropdown);
            $I->waitThenClick(ItemPage::$dragAndDropPromptAssetMenuAddAssetBriefMenuItem);
            $I->waitForElement(AssetModalsPage::$assetBriefDescription, 30);
            $I->fillField(AssetModalsPage::$assetBriefDescription, 'This is an asset brief');
            $I->waitThenClick(AssetModalsPage::$assetBriefInsertButton);
            $I->waitForElementNotVisible(AssetModalsPage::$assetBriefModal);
        }
        $targetImages = ['A', 'B', 'C', 'D'];
        for ($i = 1; $i <= 4; $i++) {
            if ($promptType === 'Image') {
                // This just creates four boxes next to each other, [startX, startY, endX, endY]
                $coord = [max(1, ($i - 1) * 100), 1, $i * 100, 100];
                $I->click(sprintf(ItemPage::$dragAndDropAnswerEditDropTargetButton, $questionCount, $i));
                $I->dragSelect(ItemPage::$dragAndDropPromptCanvas, $coord[0], $coord[1], $coord[2], $coord[3]);
                $I->click(sprintf(ItemPage::$dragAndDropAnswerFinishEditingDropTargetButton, $questionCount));
            }
            switch($responseType) {
                case 'Text':
                    $I->fillField(sprintf(ItemPage::$dragAndDropAnswerTextInputField, $i), sprintf('Draggable answer %d', $i));
                    break;
                case 'Image':
                    $I->waitThenClick(sprintf(ItemPage::$dragAndDropAnswerAssetMenuDropdown, $i));
                    $I->waitThenClick(sprintf(ItemPage::$dragAndDropAnswerAssetMenuAddAssetMenuItem, $i));
                    $I->selectOption(AssetModalsPage::$finalAssetTypeSelector, 'Picture');
                    $I->attachFile(AssetModalsPage::$finalAssetFileInput, $targetImages[$i - 1] . '.png');
                    $I->fillField(AssetModalsPage::$finalAssetDescription, sprintf('This is a target image for answer %d', $i));
                    $I->waitThenClick(AssetModalsPage::$finalAssetSaveOrUpdateButton);
                    $I->waitForElementNotVisible(AssetModalsPage::$finalAssetModal);
                    $I->wait(1);
                    break;
            }
        }

        $I->wait(1);
        $I->waitForElement(ItemPage::$mcqMaxMarkInput);
        $I->fillField(ItemPage::$mcqMaxMarkInput,(string)$marks);
        $I->waitThenClick(ItemPage::$saveButton, 30);
        $I->wait(2);
        $I->canSeeInCurrentUrl(ItemPage::$editURL);
    }

    /**
     * Set some meta data for an item
     * @param $itemBlooms
     * @param $itemDuration
     */
    public function setMetaData($itemDuration = false, $itemBlooms = false)
    {
        $duration = $itemDuration ? $itemDuration : '13';
        $blooms = $itemBlooms ? $itemBlooms : 'Knowledge';

        $I = $this;
        $I->clearField(ItemPage::$duration);
        $I->wait(0.5);
        $I->fillField(ItemPage::$duration, $duration);
        $I->selectOption(ItemPage::$blooms, $blooms);
    }

    /**
     * Add content block to item
     *
     * @return void
     */
    public function addContentBlockToItem()
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$addContentDropdown);
        $I->waitThenClick(ItemPage::$addContentBlock);
    }

    /**
     * Add asset brief
     *
     * @param string $block
     * @param integer $tinyMceInstance
     * @param string $file
     * @return void
     */
    public function addAsset($type, $block, $tinyMceInstance = 1, $file = '')
    {
        $I = $this;
        // Select text area
        $I->waitThenClick($block);
         // Select tinymce asset button
        $I->waitThenClick(sprintf(ItemPage::$tinyMceAssetButton, $tinyMceInstance));

        switch ($type) {
            case 'Brief':
                // Select tinymce add asset brief button
                $I->wait(0.2); // To avoid clicking on fulfil brief
                $I->waitThenClick(sprintf(ItemPage::$tinyMceAddBriefButton, $tinyMceInstance));
                $I->waitForElement(AssetModalsPage::$assetBriefDescription);
                $I->fillField(AssetModalsPage::$assetBriefDescription, 'This is an Automation Test');
                if($file) {
                    $I->attachFile(AssetModalsPage::$assetBriefFileInput, $file);
                }
                $I->waitThenClick(AssetModalsPage::$assetBriefInsertButton);
                $I->waitForElementNotVisible(AssetModalsPage::$assetBriefModal);
                break;
            case 'Picture':
            case 'Audio':
            case 'Video':
                // Select tinymce add asset button
                $I->waitThenClick(sprintf(ItemPage::$tinyMceAddAssetButton, $tinyMceInstance));
                $I->selectOption(AssetModalsPage::$finalAssetTypeSelector, $type);
                $I->attachFile(AssetModalsPage::$finalAssetFileInput, $file);
                $I->fillField(AssetModalsPage::$finalAssetDescription, 'This is the asset description.');
                $I->waitThenClick(AssetModalsPage::$finalAssetSaveOrUpdateButton);
                $I->waitForElementNotVisible(AssetModalsPage::$finalAssetModal);
                break;
        }
    }

    /**
     * Add asset in MCQ answer
     */
    public function addAssetInMcqAnswer()
    {
        $I = $this;

        $questionCount = 0;

        // Add assets to mcq answers
        for ($counter = 1; $counter <= 4; $counter++) {
            $I->waitForElement(sprintf(ItemPage::$questionBlockMcqAnswerField, $questionCount, $counter));

            switch ($counter) {
                case 1:
                    $I->addAsset('Brief', sprintf(ItemPage::$questionBlockMcqAnswerField, $questionCount, $counter), $counter);
                    $I->addAsset('Brief', sprintf(ItemPage::$questionBlockMcqAnswerField, $questionCount, $counter), $counter, 'lionchu.png');
                    break;
                case 2:
                    $I->addAsset('Picture', sprintf(ItemPage::$questionBlockMcqAnswerField, $questionCount, $counter), $counter, 'A.png');

                    $I->wait(3);
                    $I->waitThenClick(sprintf(ItemPage::$questionBlockMcqCorrectAnswerTickbox, $questionCount, $counter));
                    break;
            }
        }
    }

    /**
     * Add asset in mark scheme tab
     */
    public function addAssetInMarkSchemeTab($markScheme = 'ftext')
    {
        $I = $this;
        // Free text
        $option = '/option[2]';
        $field = ItemPage::$markSchemeFieldFreeText;

        if($markScheme == 'tabular') {
            // Tabular
            $option = '/option[3]';
            $field = ItemPage::$markSchemeFieldTabular;
        }

        // Change to mark scheme tab
        $I->waitThenClick(ItemPage::$markSchemeTab);

        // Change mark scheme type
        $I->waitThenClick(ItemPage::$markSchemeType);
        $I->wait(0.2);
        $I->waitThenClick(ItemPage::$markSchemeType.$option);

        $I->addAsset('Brief', $field, 1);
        $I->addAsset('Audio', $field, 1, 'audio-asset.mp3');
        $I->addAsset('Picture', $field, 1, 'A.png');
    }

    /**
     * Check asset in mark scheme tab
     */
    public function checkAssetInMarkSchemeTab()
    {
        $I = $this;
        // Change to mark scheme tab
        $I->waitThenClick(ItemPage::$markSchemeTab);
        // Change to free text
        $I->waitThenClick(ItemPage::$markSchemeType);
        $I->wait(0.5);
        $I->waitThenClick(ItemPage::$markSchemeType.'/option[2]');
        // Check for image in free text
        $I->waitForElement(ItemPage::$imageInFreeTextMarkScheme);
        $I->seeElement(ItemPage::$imageInFreeTextMarkScheme);
        // Change to tabular
        $I->waitThenClick(ItemPage::$markSchemeType);
        $I->wait(0.5);
        $I->waitThenClick(ItemPage::$markSchemeType.'/option[3]');
        // Check for image in tabular
        $I->waitForElement(ItemPage::$imageInTabularMarkScheme);
        $I->seeElement(ItemPage::$imageInTabularMarkScheme);
    }

    /**
     * Item go back without saving
     */
    public function itemGoBackWithoutSaving()
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$backButton);
        $I->closePopup();
        $I->waitForElement(AuthoringPage::$listOpenItemButton);
    }
}
