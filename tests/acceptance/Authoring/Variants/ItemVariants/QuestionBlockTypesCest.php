<?php
use Step\Acceptance\Login as LoginStep;
use Page\Login as LoginPage;
use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Item\ItemMapping as ItemMappingStep;
use Step\Acceptance\Item\ItemActions as ItemActionsStep;
use Page\Selectors\Item as ItemPage;

class QuestionBlockTypesCest
{
    private static $mathsSubjectId = '59c0cfff807b83273a775653';
    private static $aLevelQualificationId = '59c0cfff807b83273a775654';

    public function _before(LoginStep $I) {
        $I->login(LoginPage::$all);
    }

    public function _after(LoginStep $I) {
        $I->clearSession(LoginPage::$all['email']);
    }

    public function createVerticalMcqWithSixAnswersAndLettersShownAndAnswerOptionsShown(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Vertical MCQ with six answers, letters shown, and answer options shown');
        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addMCQQuestion(0, 6, 1, 1);

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->see('Answer number 1');

        $I->waitThenClick(ItemPage::$previewTab);
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 6; $i++) {
            $I->see($alphabet[$i], 'div.optionletter');
        }
        for ($j = 6; $j < strlen($alphabet); $j++) {
            $I->dontSee($alphabet[$j], 'div.optionletter');
        }

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();
        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 6; $i++) {
            $I->see($alphabet[$i], '.optioncheck');
            $I->see(sprintf('Answer number %d', $i + 1));
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the mark scheme');
        $I->see('Answer key: A - Answer number 1');

        $itemActionsStep->closeReview();

        $I->seeInCurrentUrl('/author/item/' . $itemId);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$editItemButton);
        });
        $I->waitThenClick(sprintf(ItemPage::$questionBlockMcqCorrectAnswerTickbox, 0, 3));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, 0), 'This is an edited Automation Test');
        $I->click('body'); // removes tinymce bar
        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(ItemPage::$markSchemeFieldFreeText, 'This is the edited mark scheme');
        $I->see('Answer key: C - Answer number 3');

        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$saveItemButton, 30);
        });

        $I->canSeeInCurrentUrl('/author/item/' . $itemId);
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 6; $i++) {
            $I->see($alphabet[$i], '.optioncheck');
            $I->see(sprintf('Answer number %d', $i + 1));
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
        $I->see('Answer key: C - Answer number 3');
    }

    public function createVerticalMcqWithSixAnswersAndLettersHiddenAndAnswerOptionsShown(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Vertical MCQ with six answers, letters hidden, and answer options shown');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addMCQQuestion(0, 6, 1, 1, true);

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->see('Answer number 1');

        $I->waitThenClick(ItemPage::$previewTab);
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($j = 0; $j < strlen($alphabet); $j++) {
            $I->dontSee($alphabet[$j], 'div.optionletter');
        }

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();
        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < strlen($alphabet); $i++) {
            $I->dontSee($alphabet[$i], '.optioncheck');
            if ($i <= 5) {
                $I->see(sprintf('Answer number %d', $i + 1));
            }
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the mark scheme');
        $I->see('Answer key: A - Answer number 1');

        $itemActionsStep->closeReview();

        $I->seeInCurrentUrl('/author/item/' . $itemId);
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$editItemButton);
        });
        $I->waitThenClick(sprintf(ItemPage::$questionBlockMcqCorrectAnswerTickbox, 0, 3));
        $I->fillField(sprintf(ItemPage::$questionBlockTextField, 0), 'This is an edited Automation Test');
        $I->click('body'); // removes tinymce bar
        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(ItemPage::$markSchemeFieldFreeText, 'This is the edited mark scheme');
        $I->see('Answer key: C - Answer number 3');

        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$saveItemButton, 30);
        });

        $I->canSeeInCurrentUrl('/author/item/' . $itemId);
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        for ($i = 0; $i < 6; $i++) {
            $I->dontSee($alphabet[$i], '.optioncheck');
            $I->see(sprintf('Answer number %d', $i + 1));
        }
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
        $I->see('Answer key: C - Answer number 3');
    }

    public function createShortAnswerQuestionWithAnswerLinesNoLabelsAndFullWidth(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Short answer with answer lines, no labels, and full width');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addShortAnswerQuestion(0, 1);

        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLines, 0), 2);
        $I->click(sprintf(ItemPage::$shortAnswerAddLine, 0));
        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLines, 0), 3);
        $I->click(sprintf(ItemPage::$shortAnswerDeleteLine, 0));
        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLines, 0), 2);

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->waitThenClick(ItemPage::$saveButton, 30);
        $I->wait(2);
        $I->canSeeInCurrentUrl(ItemPage::$editURL);

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();
        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLinesReadOnly, 0), 2);
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
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
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    public function createShortAnswerQuestionWithNoAnswerLinesNoLabelsAndFullWidth(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Short answer with no answer lines, no labels, and full width');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addShortAnswerQuestion(0, 1, true);

        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLines, 0), 0);

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();

        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLinesReadOnly, 0), 0);
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
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
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    public function createShortAnswerQuestionWithAnswerLinesLabelsAndFullWidth(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Short answer with answer lines, labels, and full width');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addShortAnswerQuestion(0, 1, false, 'Left', 'Right');

        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLinesWithLabels, 0), 1);

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();
        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->seeNumberOfElements(sprintf(ItemPage::$shortAnswerLinesWithLabelsReadOnly, 0), 1);
        $I->see('Left', ItemPage::$shortAnswerLinesWithLabelsReadOnlyLeftLabel);
        $I->see('Right', ItemPage::$shortAnswerLinesWithLabelsReadOnlyRightLabel);
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
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
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    /**
     * @param ItemStep $I
     * @param ItemMappingStep $itemMappingStep
     * @param ItemActionsStep $itemActionsStep
     * @throws Exception
     */
    public function createExtendedAnswerQuestionWithAnswerLines(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Extended answer with answer lines, labels, and full width');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addExtendedAnswerQuestion(0, 1, false);

        $I->seeNumberOfElements(sprintf(ItemPage::$extendedAnswerLines, 0), 10);

        $I->fillField(sprintf(ItemPage::$extendedAnswerLineCount, 0), 15);
        $I->seeNumberOfElements(sprintf(ItemPage::$extendedAnswerLines, 0), 10);

        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->waitThenClick(ItemPage::$saveButton, 30);
        $I->wait(2);
        $I->canSeeInCurrentUrl(ItemPage::$editURL);

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();
        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->seeNumberOfElements(sprintf(ItemPage::$extendedAnswerLinesReadOnly, 0), 15);
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
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
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    public function createExtendedAnswerQuestionWithoutAnswerLines(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Extended answer with no answer lines, labels, and full width');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addExtendedAnswerQuestion(0, 1, true);

        $I->seeNumberOfElements(sprintf(ItemPage::$extendedAnswerLines, 0), 0);
        $I->waitThenClick(ItemPage::$markSchemeTab);
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();
        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->seeNumberOfElements(sprintf(ItemPage::$extendedAnswerLinesReadOnly, 0), 0);
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
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
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    public function createFillInTheBlankWithSelectFromAList(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Fill in the blank with select from a list');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addFillInTheBlankQuestion(0, 1, 'select');

        $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $webDriver) use ($I) {
            $elem = $webDriver->findElement(WebDriverBy::xpath(sprintf(ItemPage::$questionBlockTextField, 0)));
            $elem->sendKeys('This is an ');
            $I->click(ItemPage::$fitbInsertBlankButton);
            for ($i = 1; $i <= 4; $i++) {
                if ($i > 1) {
                    $I->click(ItemPage::$fitbSelectAddAnswer);
                }
                $I->fillField(sprintf(ItemPage::$fitbSelectAnswerText, $i), sprintf('Blank option %d', $i));
            }
            $I->click(sprintf(ItemPage::$fitbCorrectAnswerRadio, 1));
            $I->click(ItemPage::$fitbInsertBlankConfirmButton);
            $elem->sendKeys(WebDriverKeys::CONTROL . WebDriverKeys::END);
            $elem->sendKeys(' test');
        });
        $I->click('body');
        $I->wait(1);

        $I->click(ItemPage::$previewTab);
        $I->see('This is an   Blank option 1 / Blank option 2 / Blank option 3 / Blank option 4   test');

        $I->click(ItemPage::$markSchemeTab);
        $I->see('Blank option 1');
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();

        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->see('This is an   Blank option 1 / Blank option 2 / Blank option 3 / Blank option 4   test');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the mark scheme');
        $I->see('Blank option 1');

        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');

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
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }

    public function createFillInTheBlankWithFreeText(ItemStep $I, ItemMappingStep $itemMappingStep, ItemActionsStep $itemActionsStep)
    {
        $I->amOnPage('/authoring');
        $I->quickCreateItem(self::$mathsSubjectId, self::$aLevelQualificationId, 'Fill in the blank with select from a list');

        $itemId = $I->grabWorkflowIdFromCurrentUrl();
        $I->wait(4);
        $I->addFillInTheBlankQuestion(0, 1, 'free_text');

        $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $webDriver) use ($I) {
            $elem = $webDriver->findElement(WebDriverBy::xpath(sprintf(ItemPage::$questionBlockTextField, 0)));
            $elem->sendKeys('This is an ');
            $I->click(ItemPage::$fitbInsertBlankButton);
            $I->fillField(sprintf(ItemPage::$fitbSelectAnswerText, 1), 'Blank option 1');
            $I->click(ItemPage::$fitbInsertBlankConfirmButton);
            $elem->sendKeys(WebDriverKeys::CONTROL . WebDriverKeys::END);
            $elem->sendKeys(' test');
        });
        $I->click('body');
        $I->wait(1);

        $I->click(ItemPage::$previewTab);
        $I->see('This is an __________test');

        $I->click(ItemPage::$markSchemeTab);
        $I->see('Blank option 1');
        $I->waitForElement(sprintf(ItemPage::$markSchemeFieldFreeText, 1));
        $I->fillField(sprintf(ItemPage::$markSchemeFieldFreeText, 1), 'This is the mark scheme');
        $I->wait(1);

        $I->selectOption(ItemPage::$bloomsDropdown, 'Knowledge');
        $itemMappingStep->mapToSyllabus();
        $itemActionsStep->submitForReview();

        $I->amOnPage('/author/item/' . $itemId);

        $I->wait(5);
        $I->see('Review', '.draft-tag');
        $I->see('This is an __________test');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the mark scheme');
        $I->see('Blank option 1');

        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');

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
        $I->wait(2);
        $I->see('This is an edited Automation Test');
        $I->see('Reviewed', '.draft-tag');
        $I->click(ItemPage::$informationTab);
        $I->see('Please review this item and indicate your response.');
        $I->click(ItemPage::$markSchemeTab);
        $I->see('This is the edited mark scheme');
    }
}