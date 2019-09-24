<?php

use Step\Acceptance\Item\ItemActions as ItemActionsStep;
use Step\Acceptance\Item\ItemMapping as ItemMappingStep;
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Page\Selectors\Item as ItemPage;
use Page\Selectors\AssetModals as AssetModalsPage;

class DragAndDropCest
{
    private static $mathsSubjectId = '59c0cfff807b83273a775653';
    private static $aLevelQualificationId = '59c0cfff807b83273a775654';

    public function _before(LoginStep $I) {
        $I->login(LoginPage::$all);
    }

    public function _after(LoginStep $I) {
        $I->clearSession(LoginPage::$all['email']);
    }

    public function createTextDragAndDrop(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Text drag and drop');
        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addDragAndDropQuestion(0, 'Text', 'Image');

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->seeElement(ItemPage::$imageInFreeTextMarkScheme);

        $I->waitThenClick(ItemPage::$previewTab);
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
        }
        for ($j = 6; $j < strlen($alphabet); $j++) {
            $I->dontSee($alphabet[$j], ItemPage::$dragAndDropAnswerLetter);
        }

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();

        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->wait(1);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
            $I->see(sprintf('Draggable answer %d', $i + 1));
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the mark scheme');

        $itemActionsStep->closeReview();

        $I->seeInCurrentUrl('/author/item/' . $itemId);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$editItemButton);
        });
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, 0));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, 0), 'This is an edited Automation Test');
        $I->click('body'); // removes tinymce bar
        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(ItemPage::$markSchemeFieldFreeText, 'This is the edited mark scheme');
        $I->wait(1);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$saveItemButton, 30);
        });

        $I->canSeeInCurrentUrl('/author/item/' . $itemId);
        $I->wait(5);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->wait(1);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
            $I->see(sprintf('Draggable answer %d', $i + 1));
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    public function createImageDragAndDrop(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Image drag and drop');
        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addDragAndDropQuestion(0, 'Image', 'Image');

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->seeElement(ItemPage::$imageInFreeTextMarkScheme);

        $I->waitThenClick(ItemPage::$previewTab);
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
        }
        for ($j = 6; $j < strlen($alphabet); $j++) {
            $I->dontSee($alphabet[$j], ItemPage::$dragAndDropAnswerLetter);
        }

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();

        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->wait(1);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the mark scheme');

        $itemActionsStep->closeReview();

        $I->seeInCurrentUrl('/author/item/' . $itemId);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$editItemButton);
        });
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, 0));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, 0), 'This is an edited Automation Test');
        $I->click('body'); // removes tinymce bar
        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(ItemPage::$markSchemeFieldFreeText, 'This is the edited mark scheme');
        $I->wait(1);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$saveItemButton, 30);
        });

        $I->canSeeInCurrentUrl('/author/item/' . $itemId);
        $I->wait(5);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->wait(1);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    public function createTextDragAndDropWithAssetBrief(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Text drag and drop with asset brief');
        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addDragAndDropQuestion(0, 'Text', 'Brief');

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->seeElement(ItemPage::$imageInFreeTextMarkScheme);

        $I->waitThenClick(ItemPage::$previewTab);
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
        }
        for ($j = 6; $j < strlen($alphabet); $j++) {
            $I->dontSee($alphabet[$j], ItemPage::$dragAndDropAnswerLetter);
        }

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();

        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->wait(1);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the mark scheme');

        // Approve the asset here
        $I->click(ItemPage::$previewTab);
        $I->click(ItemPage::$assetManagerDropdownToggle);
        $I->waitThenClick(ItemPage::$assetManagerDropdownMenuViewBriefMenuItem);
        $I->waitForElementVisible(AssetModalsPage::$assetBriefModalBody);
        $I->see('This is an asset brief');
        $I->waitThenClick(AssetModalsPage::$viewAssetBriefFulfilBriefButton);
        $I->wait(1);
        $I->selectOption(AssetModalsPage::$finalAssetTypeSelector, 'Picture');
        $I->attachFile(AssetModalsPage::$finalAssetFileInput, 'lionchu.png');
        $I->fillField(AssetModalsPage::$finalAssetDescription, 'This is a cat mixed with a pokemon');
        $I->waitForReload(function ($I) {
            $I->waitThenClick(AssetModalsPage::$finalAssetSaveOrUpdateButton);
        });

        $itemActionsStep->closeReview();

        $I->seeInCurrentUrl('/author/item/' . $itemId);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$editItemButton);
        });
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, 0));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, 0), 'This is an edited Automation Test');
        $I->click('body'); // removes tinymce bar

        $I->wait(5);
        for ($i = 1; $i <= 4; $i++) {
            // This just creates four boxes next to each other, [startX, startY, endX, endY]
            $coord = [max(1, ($i - 1) * 100), 1, $i * 100, 100];
            $I->click(sprintf(ItemPage::$dragAndDropAnswerEditDropTargetButton, 0, $i));
            $I->dragSelect(ItemPage::$dragAndDropPromptCanvas, $coord[0], $coord[1], $coord[2], $coord[3]);
            $I->click(sprintf(ItemPage::$dragAndDropAnswerFinishEditingDropTargetButton, 0));
        }

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(ItemPage::$markSchemeFieldFreeText, 'This is the edited mark scheme');
        $I->wait(1);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$saveItemButton, 30);
        });

        $I->canSeeInCurrentUrl('/author/item/' . $itemId);
        $I->wait(5);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->wait(1);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 4; $i++) {
            $I->see($alphabet[$i], ItemPage::$dragAndDropAnswerLetter);
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }
}