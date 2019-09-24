<?php
namespace Step\Acceptance\Item;

use Codeception\Util\Locator;
use Page\Selectors\Item as ItemPage;

class ItemActions extends \AcceptanceTester
{
    /**
     * Submit for review to assigned reviewers
     * $reviewers is an array of users, if not passed the first reviewer will be selected
     * @param $reviewers
     * @throws \Exception
     */
    public function submitForReview(array $reviewers = null)
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$submitForReviewButton);
        if ($reviewers !== null) {
            foreach ($reviewers as $reviewer) {
                $I->waitThenClick(Locator::contains(ItemPage::$reviewer, $reviewer['name']));
            }
        } else {
            $I->waitThenClick(ItemPage::$firstReviewer);
        }
        $I->waitForReload(function($I) {
            $I->waitThenClick(ItemPage::$submitChooseReviewerButton);
        });
    }

    /**
     * For an item reviewer to make recommendations
     * Adding a review comment is optional
     * @param string $recommendationType ('Approve', 'Change' or 'Reject')
     * @param string $comment (optional)
     *
    */
    public function recommend($recommendationType='Approve', $comment=null)
    {
        $I = $this;
        switch ($recommendationType) {
            case "Approve":
                $I->selectRecommendation(ItemPage::$recommendApprove);
                break;
            case "Change":
                $I->selectRecommendation(ItemPage::$recommendChange);
                break;
            case "Reject":
                $I->selectRecommendation(ItemPage::$recommendReject);
                break;
        }
        $I->confirmRecommendation($comment);
    }

    /**
     * For an item approver to close a review for an item
     *
    */
    public function closeReview()
    {
        $I = $this;
        $I->selectRecommendation(ItemPage::$closeReview);
        $I->see('Close review stage');
        $I->see('Are you sure you want to close reviewing for this item and remove it from reviewing lists?');
        $I->waitForReload(function ($I) {
           $I->waitThenClick(ItemPage::$modalCloseReviewsYesButton);
        });
    }

    public function selectRecommendation($recommendation)
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$reviewDropdown);

        // $recommendationOption=Locator::contains('option', $recommendation);

        $I->waitThenClick($recommendation);
        $I->waitThenClick(ItemPage::$confirmReviewChoiseButton);
    }

    public function confirmRecommendation($comment=null)
    {
        $I = $this;
        $I->waitForElementClickable(ItemPage::$submitReviewButton);
        if(isset($comment))
        {
            $I->waitForElementClickable(ItemPage::$textArea,10);
            $I->fillField(ItemPage::$textArea, $comment);
        }
        $I->waitForReload(function ($I) {
            $I->click(ItemPage::$submitReviewButton);
        });
    }

    /**
     * For items in state Reviewed and later
    */

    /**
     * Handles straightforward sending of items to various states.
     * @param string $destinationSelector, for example ItemPage::$selectItemBank
     * Can handle Send to item-bank/pre-test/archive and rejct, request change
     * example of $destinationSelector: ItemPage::$SelectPreTest
     * @param string $comment Optional comment
    */
    public function sendTo($destinationSelector, $comment=null)
    {
        $I = $this;
        $I->selectSendTo($destinationSelector);
        $I->confirmSendTo($comment);
    }

    /**
     * Handles sending item to new cycle
     * @param string $cycleDestination ['Setting', 'Reviewing', 'Approving']
     * @param string $cycleName
     * @param string $comment Optional comment
     * To do Add param user array to select setter or reviewers to send to
     * - currently it selects a default setter/reviewer
    */
    public function sendToNewCycleSetting($cycleDestination='Approver', $cycleName='Automation cycle', $comment='Back to setter')
    {
        $I = $this;
        $I->selectSendTo(ItemPage::$SelectCycle);
        switch ($cycleDestination) {
            case "Setting":
                $I->selectSetterForNewCycle();
                break;
            case "Reviewing":
                $I->selectReviewerForNewCycle();
                break;
            case "Approving":
                $I->selectApprovingForNewCycle();
                break;
        }
        $I->confirmNewCycle($cycleName, $comment);
    }

    public function selectSetterForNewCycle()
    {
        $I = $this;
        $I->selectOption(ItemPage::$setCycle,'Setting');
        $I->waitThenClick(ItemPage::$settingDropdown);
        $I->waitThenClick(ItemPage::$settingSelectSetter);
    }

    public function selectReviewerForNewCycle()
    {
        $I = $this;
        $I->selectOption(ItemPage::$setCycle,'Reviewing');
        $I->waitThenClick(ItemPage::$selectReviewer);
    }

    public function selectApprovingForNewCycle()
    {
        $I = $this;
        $I->selectOption(ItemPage::$setCycle,'Approving');
    }

    public function confirmNewCycleSetting($cycleName='Automation cycle', $comment=null)
    {
        $I = $this;
        $I->fillField(ItemPage::$cycleName, cycleName);
        if(isset($comment))
        {
            $I->fillField(ItemPage::$notesText, $comment);
        }

        $I->waitThenClick(ItemPage::$submitApproveButton);
        $I->wait(3);
    }

    public function selectSendTo($destinationSelector)
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$approveDropdown);
        $I->waitThenClick($destinationSelector);
        $I->waitThenClick(ItemPage::$confirmActionChoiseButton);
    }

    public function confirmSendTo($comment=null)
    {
        $I = $this;
        if(isset($comment))
        {
            $I->waitForElementClickable(ItemPage::$TextArea,10);
            $I->fillField(ItemPage::$TextArea, $comment);
        }
        $I->waitThenClick(ItemPage::$submitApproveButton);
        $I->wait(3);
    }

    /**
     * $statusName Should be named as one of the Following: Exam Ready, Item Bank, Reviewed, Review, PreTest, Typesetting, Archive, Reject
     * @param [type] $statusName
     * @return void
     */
    public function checkStatus($statusName)
    {
        $I = $this;
        switch ($statusName) {
            case "Exam Ready":
            $I->waitForElementVisible(ItemPage::$ExamReadyStatusLabel);
                break;
            case "Item Bank":
            $I->waitForElementVisible(ItemPage::$ItemBankStatusLabel);
                break;
            case "Reviwed":
            $I->waitForElementVisible(ItemPage::$ReviewedStatusLabel);
                break;
            case "Review":
            $I->waitForElementVisible(ItemPage::$ReviewStatusLabel);
                break;
            case "PreTest":
            $I->waitForElementVisible(ItemPage::$PreTestStatusLabel);
                break;
            case "Typesetting":
            $I->waitForElementVisible(ItemPage::$TypesettingStatusLabel);
                break;
            case "Archive":
            $I->waitForElementVisible(ItemPage::$ArchivedStatusLabel);
                break;
            case "Reject":
            $I->waitForElementVisible(ItemPage::$RejectedStatusLabel);
                break;
        }
    }

    public function checkVersion($checkVersion)
    {
        $I = $this;
        if($checkVersion == 'latest'){
            $I->waitForElementVisible(ItemPage::$itemVersionLatestCheck);
        }else{
            $I->waitForElementVisible(sprintf(ItemPage::$itemVersionText, $checkVersion));
        }
    }

    public function selectVersion($version)
    {
        $I = $this;
        if($version == 'latest') {
            $I->waitThenClick(ItemPage::$itemVersionBox);
            $I->waitThenClick(ItemPage::$itemVersionLatest);
        }else{
            $selectedVersion = sprintf(ItemPage::$itemVersionText, $version);
            $I->waitThenClick(ItemPage::$itemVersionBox);
            $I->waitThenClick($selectedVersion);
        }
        $I->wait(1);
    }

}