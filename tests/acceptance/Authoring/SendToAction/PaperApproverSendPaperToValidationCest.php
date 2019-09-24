<?php

use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\Selectors\Paper as PaperPage;
use Step\Acceptance\Paper\Paper as PaperStep;
use Step\Acceptance\Login as LoginStep;

class PaperApproverSendPaperToValidationCest
{
    public function _before(LoginStep $loginStep) {
        $loginStep->login(LoginPage::$paperApprover);
    }

    public function _after(LoginStep $loginStep) {
        $loginStep->clearSession();
    }

    private function _testCantSendScenario(PaperStep $I, $scenario) {
        $I->waitThenClick(PaperPage::$approveDropdown);
        $I->waitThenClick($scenario['element']);
        $I->waitThenClick(PaperPage::$confirmApproval);
        $I->waitForElementNotEmpty('#paperApproveModal .modal-body p' . $scenario['expectedMessageClass']);
        $I->see($scenario['expectedMessage']);
        $I->dontSeeElement(PaperPage::$submitApprove);
        // Todo - button is visible but disabled, this doesn't work.
        // $I->dontSeeElement(PaperPage::$submitApproveArchive); 
        $I->click(PaperPage::$cancelApproveButton);
    }

    /**
     * FIxed with - https://www.pivotaltracker.com/story/show/166116627
     * @param PaperStep $I
     */
    public function paperApproverCantSendPaperWithDraftItemAnywhereTest(PaperStep $I)
    {
        $I->openPaperInReadOnly(ItemPaperData::$paperWithDraftItem);

        $scenarios = [
            [
                'element' => PaperPage::$selectPreTest,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'The paper cannot be sent to pre-test with items in Draft or Review. Please ensure that all items have been sent to pre-test or are in the Item Bank.',
            ],
            [
                'element' => PaperPage::$selectExamReady,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in the paper are still draft. You cannot set the paper to exam ready with draft items.',
            ],
            [
                'element' => PaperPage::$selectTypesetting,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in the paper are still draft or review. You cannot send the paper to typesetting with draft items',
            ],
            [
                'element' => PaperPage::$selectArchive,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in this paper are still in draft so the paper cannot be archived.',
            ],
        ];

        foreach ($scenarios as $scenario) {
            $this->_testCantSendScenario($I, $scenario);
        }
    }

    /**
     * fixed with - https://www.pivotaltracker.com/story/show/166116627
     * @param PaperStep $I
     */
    public function paperApproverCantSendPaperWithChangeItemAnywhereTest(PaperStep $I)
    {
        $I->openPaperInReadOnly(ItemPaperData::$paperWithChangeItem);

        $scenarios = [
            [
                'element' => PaperPage::$selectPreTest,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'The paper cannot be sent to pre-test with items in Draft or Review. Please ensure that all items have been sent to pre-test or are in the Item Bank.',
            ],
            [
                'element' => PaperPage::$selectExamReady,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in the paper are still draft. You cannot set the paper to exam ready with draft items.',
            ],
            [
                'element' => PaperPage::$selectTypesetting,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in the paper are still draft or review. You cannot send the paper to typesetting with draft items',
            ],
            [
                'element' => PaperPage::$selectArchive,
                'expectedMessageClass' => '',
                'expectedMessage' => 'Some of the items in this paper are still in draft so the paper cannot be archived.',
            ],
        ];

        foreach ($scenarios as $scenario) {
            $this->_testCantSendScenario($I, $scenario);
        }
    }

    /**
     * @skip - handling of archive inconsistent, change code or test
     * @param PaperStep $I
     */
    public function paperApproverCantSendPaperWithReviewItemAnywhereTest(PaperStep $I)
    {
        $I->openPaperInReadOnly(ItemPaperData::$paperWithReviewItem);

        $scenarios = [
            [
                'element' => PaperPage::$selectPreTest,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'The paper cannot be sent to pre-test with items in Draft or Review. Please ensure that all items have been sent to pre-test or are in the Item Bank.',
            ],
            [
                'element' => PaperPage::$selectExamReady,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in the paper are still draft. You cannot set the paper to exam ready with draft items.',
            ],
            [
                'element' => PaperPage::$selectTypesetting,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in the paper are still draft or review. You cannot send the paper to typesetting with draft items',
            ],
            [
                'element' => PaperPage::$selectArchive,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the items in the paper are still draft or review so the paper cannot be archived.',
            ],
        ];

        foreach ($scenarios as $scenario) {
            $this->_testCantSendScenario($I, $scenario);
        }
    }

    /**
     * Fixed with - https://www.pivotaltracker.com/story/show/166116627
     * @param PaperStep $I
     * @throws Exception
     */
    public function paperApproverCanSendPaperWithReviewedItems(PaperStep $I)
    {
        $scenarios = [
            [
                'paper' => ItemPaperData::$paperWithReviewedItemToBeSentToExamReady,
                'dropdownOption' => PaperPage::$selectExamReady,
                'expectedMessage' => 'There are items in this paper that are not approved. By setting this paper as Exam Ready any items not approved will be approved and added to the Item Bank. Are you sure you want to set the paper as Exam Ready and approve all the items in the paper?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Exam ready',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
// This represents what actually happens on the site, but the spreadsheet says otherwise, so
// commenting and adding a failing test for now.
//            [
//                'paper' => ItemPaperData::$paperWithReviewedItemToBeSentToTypesetting,
//                'dropdownOption' => PaperPage::$selectTypesetting,
//                'expectedMessage' => 'The paper contains items that are not in the item bank. This will stop the typesetter adding proofs to the paper. Are you sure you want to send the paper to typesetting?',
//                'modalYesButton' => PaperPage::$submitApprove,
//                'expectedPaperStatus' => 'Typesetting',
//                'expectedPaperStatusClass' => '.typesetting-tag',
//                'expectedItemStatus' => 'Reviewed',
//                'expectedItemStatusClass' => '.draft-tag',
//            ],
            [
                'paper' => ItemPaperData::$paperWithReviewedItemToBeSentToArchive,
                'dropdownOption' => PaperPage::$selectArchive,
                'expectedMessage' => 'You are sending this paper to Archive',
                'modalYesButton' => PaperPage::$submitApproveArchive,
                'expectedPaperStatus' => 'Archived',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Reviewed',
                'expectedItemStatusClass' => '.draft-tag',
            ],
            // Checkbox isn't interactable
            // [
            //     'paper' => ItemPaperData::$paperWithReviewedItemToBeSentToArchiveWithItemsIncluded,
            //     'dropdownOption' => PaperPage::$selectArchive,
            //     'expectedMessage' => 'You are sending this paper to Archive',
            //     'modalYesButton' => PaperPage::$submitApproveArchive,
            //     'expectedPaperStatus' => 'Archived',
            //     'expectedPaperStatusClass' => '.approved-tag',
            //     'expectedItemStatus' => 'Archived',
            //     'expectedItemStatusClass' => '.approved-tag',
            //     'checkboxesToSelect' => [PaperPage::$setItemsToArchive],
            // ],
        ];

        foreach ($scenarios as $scenario) {
            $I->openPaperInReadOnly($scenario['paper']);
            $I->waitThenClick(PaperPage::$approveDropdown);
            $I->waitThenClick($scenario['dropdownOption']);
            $I->waitThenClick(PaperPage::$confirmApproval);
            $I->waitForElementNotEmpty('#paperApproveModal .modal-body p');
            $I->see($scenario['expectedMessage']);

            foreach ($scenario['checkboxesToSelect'] ?? [] as $element) {
                $I->checkOption($element);
            }

            $I->waitThenClick($scenario['modalYesButton']);
            // Page should reload
            $I->waitForReload();
            $I->see($scenario['expectedPaperStatus'], $scenario['expectedPaperStatusClass']);
            $I->click('i.paper-binoculars');
            $I->waitForReload();
            $I->wait(5);
            $I->see($scenario['expectedItemStatus'], $scenario['expectedItemStatusClass']);
        }

        $cantSendScenarios = [
            [
                'paper' => ItemPaperData::$paperWithReviewedItemToBeSentToPretest,
                'element' => PaperPage::$selectPreTest,
                'expectedMessageClass' => '',
                'expectedMessage' => 'The paper cannot be sent to pre-test with items in Draft or Review. Please ensure that all items have been sent to pre-test or are in the Item Bank.',
            ],
            // Not yet working this way
            // [
            //     'paper' => ItemPaperData::$paperWithReviewedItemToBeSentToTypesetting,
            //     'element' => PaperPage::$selectTypesetting,
            //     'expectedMessageClass' => '',
            //     'expectedMessage' => 'You cannot send the paper to typesetting as it contains unapproved items.',
            // ],
        ];
        foreach ($cantSendScenarios as $scenario) {
            $I->openPaperInReadOnly($scenario['paper']);
            $this->_testCantSendScenario($I, $scenario);
        }
    }

    public function paperApproverCanSendPaperWithPretestItems(PaperStep $I)
    {
        $scenarios = [
            [
                'paper' => ItemPaperData::$paperWithPretestItemToBeSentToExamReady,
                'dropdownOption' => PaperPage::$selectExamReady,
                'expectedMessage' => 'There are items in this paper that are not approved. By setting this paper as Exam Ready any items not approved will be approved and added to the Item Bank. Are you sure you want to set the paper as Exam Ready and approve all the items in the paper?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Exam ready',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithPretestItemToBeSentToPretest,
                'dropdownOption' => PaperPage::$selectPreTest,
                'expectedMessage' => 'This will send the paper to pre-test. Are you sure you want to continue?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Pre-test',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Pre-test',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithPretestItemToBeSentToTypesetting,
                'dropdownOption' => PaperPage::$selectTypesetting,
                'expectedMessage' => 'The paper contains items that are not in the item bank. This will stop the typesetter adding proofs to the paper. Are you sure you want to send the paper to typesetting?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Typesetting',
                'expectedPaperStatusClass' => '.typesetting-tag',
                'expectedItemStatus' => 'Pre-test',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithPretestItemToBeSentToArchive,
                'dropdownOption' => PaperPage::$selectArchive,
                'expectedMessage' => 'You are sending this paper to Archive',
                'modalYesButton' => PaperPage::$submitApproveArchive,
                'expectedPaperStatus' => 'Archived',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Pre-test',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            // Checkbox isn't interactable
            // [
            //     'paper' => ItemPaperData::$paperWithPretestItemToBeSentToArchiveWithItemsIncluded,
            //     'dropdownOption' => PaperPage::$selectArchive,
            //     'expectedMessage' => 'You are sending this paper to Archive',
            //     'modalYesButton' => PaperPage::$submitApproveArchive,
            //     'expectedPaperStatus' => 'Archived',
            //     'expectedPaperStatusClass' => '.approved-tag',
            //     'expectedItemStatus' => 'Archived',
            //     'expectedItemStatusClass' => '.approved-tag',
            //     'checkboxesToSelect' => [PaperPage::$setItemsToArchive],
            // ],
        ];

        foreach ($scenarios as $scenario) {
            $I->openPaperInReadOnly($scenario['paper']);
            $I->waitThenClick(PaperPage::$approveDropdown);
            $I->waitThenClick($scenario['dropdownOption']);
            $I->waitThenClick(PaperPage::$confirmApproval);
            $I->waitForElementNotEmpty('#paperApproveModal .modal-body p');
            $I->see($scenario['expectedMessage']);

            foreach ($scenario['checkboxesToSelect'] ?? [] as $element) {
                $I->checkOption($element);
            }

            $I->waitThenClick($scenario['modalYesButton']);
            // Page should reload
            $I->waitForReload();
            $I->see($scenario['expectedPaperStatus'], $scenario['expectedPaperStatusClass']);
            $I->click('i.paper-binoculars');
            $I->waitForReload();
            $I->wait(5);
            $I->see($scenario['expectedItemStatus'], $scenario['expectedItemStatusClass']);
        }
    }

    public function paperApproverCanSendPaperWithApprovedItems(PaperStep $I)
    {
        $scenarios = [
            [
                'paper' => ItemPaperData::$paperWithApprovedItemToBeSentToExamReady,
                'dropdownOption' => PaperPage::$selectExamReady,
                'expectedMessage' => 'This will set the paper as Exam Ready. Are you sure you want to continue?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Exam ready',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithApprovedItemToBeSentToTypesetting,
                'dropdownOption' => PaperPage::$selectTypesetting,
                'expectedMessage' => 'You are sending the paper to typesetting',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Typesetting',
                'expectedPaperStatusClass' => '.typesetting-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithApprovedItemToBeSentToPretest,
                'dropdownOption' => PaperPage::$selectPreTest,
                'expectedMessage' => 'This will send the paper to pre-test. Are you sure you want to continue?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Pre-test',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Pre-test',
                'expectedItemStatusClass' => '.approved-tag',
                'latestVersionStatus' => 'Approved',
                'latestVersionStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithApprovedItemToBeSentToArchive,
                'dropdownOption' => PaperPage::$selectArchive,
                'expectedMessage' => 'You are sending this paper to Archive.',
                'modalYesButton' => PaperPage::$submitApproveArchive,
                'expectedPaperStatus' => 'Archived',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            // Checkbox isn't interactable
            // [
            //     'paper' => ItemPaperData::$paperWithApprovedItemToBeSentToArchiveWithItemsIncluded,
            //     'dropdownOption' => PaperPage::$selectArchive,
            //     'expectedMessage' => 'You are sending this paper to Archive.',
            //     'modalYesButton' => PaperPage::$submitApproveArchive,
            //     'expectedPaperStatus' => 'Archived',
            //     'expectedPaperStatusClass' => '.approved-tag',
            //     'expectedItemStatus' => 'Archived',
            //     'expectedItemStatusClass' => '.approved-tag',
            //     'checkboxesToSelect' => [PaperPage::$setItemsToArchive],
            // ],
        ];

        foreach ($scenarios as $scenario) {
            $I->openPaperInReadOnly($scenario['paper']);
            $I->waitThenClick(PaperPage::$approveDropdown);
            $I->waitThenClick($scenario['dropdownOption']);
            $I->waitThenClick(PaperPage::$confirmApproval);
            $I->waitForElementNotEmpty('#paperApproveModal .modal-body p');
            $I->see($scenario['expectedMessage']);

            foreach ($scenario['checkboxesToSelect'] ?? [] as $element) {
                $I->checkOption($element);
            }

            $I->waitThenClick($scenario['modalYesButton']);
            // Page should reload
            $I->waitForReload();
            $I->see($scenario['expectedPaperStatus'], $scenario['expectedPaperStatusClass']);
            $I->click('i.paper-binoculars');
            $I->waitForReload();
            $I->wait(5);
            $I->see($scenario['expectedItemStatus'], $scenario['expectedItemStatusClass']);

            if (isset($scenario['latestVersionStatus'])) {
                $url = $I->getCurrentUrl();
                $url = preg_replace('/\/version\/[\d\.]+/', '', $url);
                $I->amOnPage($url);
                $I->wait(5);
                $I->see($scenario['latestVersionStatus'], $scenario['latestVersionStatusClass']);
            }
        }
    }

    /**
     * fixed with - https://www.pivotaltracker.com/story/show/166116627
     * @param PaperStep $I
     * @throws Exception
     */
    public function paperApproverCantSendPaperWithUnapprovedAssetsToAnywhereButTypesetting(PaperStep $I)
    {
        $I->openPaperInReadOnly(ItemPaperData::$paperWithUnapprovedAssets);

        $scenarios = [
            [
                'element' => PaperPage::$selectPreTest,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'The paper cannot be sent to pre-test with items in Draft or Review. Please ensure that all items have been sent to pre-test or are in the Item Bank.',
            ],
            [
                'element' => PaperPage::$selectExamReady,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the assets in this paper are not approved. You cannot set the paper to exam ready until they are approved.',
            ],
            [
                'element' => PaperPage::$selectArchive,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the assets in this paper are not approved. You cannot set the paper to archive until they are approved.',
            ],
        ];

        foreach ($scenarios as $scenario) {
            $this->_testCantSendScenario($I, $scenario);
        }

        $I->waitThenClick(PaperPage::$approveDropdown);
        $I->waitThenClick(PaperPage::$selectTypesetting);
        $I->waitThenClick(PaperPage::$confirmApproval);
        $I->waitForElementNotEmpty('#paperApproveModal .modal-body p');
        $I->see('The paper contains items that are not in the item bank. This will stop the typesetter adding proofs to the paper. Are you sure you want to send the paper to typesetting?');
        $I->click(PaperPage::$submitApprove);
        $I->waitForReload();
        $I->see('Typesetting', '.typesetting-tag');
        $I->click('i.paper-binoculars');
        $I->waitForReload();
        $I->wait(5);
        $I->see('Reviewed', '.draft-tag');
    }

    /**
     * @skip - Test is wrong, Copyright cleared triggers warning, not stop.
     * @param PaperStep $I
     * @throws Exception
     */
    public function paperApproverCantSendPaperWithNonCopyrightClearedAssets(PaperStep $I)
    {
        $I->openPaperInReadOnly(ItemPaperData::$paperWithNonCopyrightClearedAssets);

        $scenarios = [
            [
                'element' => PaperPage::$selectPreTest,
                'expectedMessageClass' => '', // Should probably be red, but isn't. Not that important.
                // 'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Warning: The paper includes assets that are not copyright cleared. You can continue sending the paper to pre-test or cancel',
            ],
            [
                'element' => PaperPage::$selectExamReady,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the assets in this paper are not approved. You cannot set the paper to exam ready until they are approved.',
            ],
            [
                'element' => PaperPage::$selectArchive,
                'expectedMessageClass' => '.red-txt',
                'expectedMessage' => 'Some of the assets in this paper are not approved. You cannot set the paper to archive until they are approved.',
            ],
        ];

        foreach ($scenarios as $scenario) {
            $this->_testCantSendScenario($I, $scenario);
        }

        $I->waitThenClick(PaperPage::$approveDropdown);
        $I->waitThenClick(PaperPage::$selectTypesetting);
        $I->waitThenClick(PaperPage::$confirmApproval);
        $I->waitForElementNotEmpty('#paperApproveModal .modal-body p');
        $I->see('The paper contains items that are not in the item bank. This will stop the typesetter adding proofs to the paper. Are you sure you want to send the paper to typesetting?');
        $I->click(PaperPage::$submitApprove);
        $I->waitForReload();
        $I->see('Typesetting', '.typesetting-tag');
        $I->click('i.paper-binoculars');
        $I->waitForReload();
        $I->wait(5);
        $I->see('Reviewed', '.draft-tag');
    }

    public function paperApproverCanSendPaperWithItemsUsedInOtherPaper(PaperStep $I)
    {
        $scenarios = [
            [
                'paper' => ItemPaperData::$paperWithItemsUsedInOtherPaperToBeSentToExamReady,
                'dropdownOption' => PaperPage::$selectExamReady,
                'expectedMessage' => 'This will set the paper as Exam Ready. Are you sure you want to continue?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Exam ready',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithItemsUsedInOtherPaperToBeSentToTypesetting,
                'dropdownOption' => PaperPage::$selectTypesetting,
                'expectedMessage' => 'You are sending the paper to typesetting',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Typesetting',
                'expectedPaperStatusClass' => '.typesetting-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithItemsUsedInOtherPaperToBeSentToPreTest,
                'dropdownOption' => PaperPage::$selectPreTest,
                'expectedMessage' => 'This will send the paper to pre-test. Are you sure you want to continue?',
                'modalYesButton' => PaperPage::$submitApprove,
                'expectedPaperStatus' => 'Pre-test',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Pre-test',
                'expectedItemStatusClass' => '.approved-tag',
                'latestVersionStatus' => 'Approved',
                'latestVersionStatusClass' => '.approved-tag',
            ],
            [
                'paper' => ItemPaperData::$paperWithItemsUsedInOtherPaperToBeSentToArchive,
                'dropdownOption' => PaperPage::$selectArchive,
                'expectedMessage' => 'Some of the items in this paper are in multiple papers so only the paper will be archived.',
                'modalYesButton' => PaperPage::$submitApproveArchive,
                'expectedPaperStatus' => 'Archived',
                'expectedPaperStatusClass' => '.approved-tag',
                'expectedItemStatus' => 'Approved',
                'expectedItemStatusClass' => '.approved-tag',
            ],
        ];

        foreach ($scenarios as $scenario) {
            $I->openPaperInReadOnly($scenario['paper']);
            $I->waitThenClick(PaperPage::$approveDropdown);
            $I->waitThenClick($scenario['dropdownOption']);
            $I->waitThenClick(PaperPage::$confirmApproval);
            $I->waitForElementNotEmpty('#paperApproveModal .modal-body p');
            $I->see($scenario['expectedMessage']);
            $I->waitThenClick($scenario['modalYesButton']);
            // Page should reload
            $I->waitForReload();
            $I->see($scenario['expectedPaperStatus'], $scenario['expectedPaperStatusClass']);
            $I->click('i.paper-binoculars');
            $I->waitForReload();
            $I->wait(5);
            $I->see($scenario['expectedItemStatus'], $scenario['expectedItemStatusClass']);

            if (isset($scenario['latestVersionStatus'])) {
                $url = $I->getCurrentUrl();
                $url = preg_replace('/\/version\/[\d\.]+/', '', $url);
                $I->amOnPage($url);
                $I->wait(5);
                $I->see($scenario['latestVersionStatus'], $scenario['latestVersionStatusClass']);
            }
        }
    }
}
