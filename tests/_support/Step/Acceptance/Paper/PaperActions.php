<?php
namespace Step\Acceptance\Paper;

use Codeception\Util\Locator;
use Page\Selectors\Paper as PaperPage;

class PaperActions extends \AcceptanceTester
{
    /** 
     * Submit for review to assigned reviewers
     * $reviewers is an array of users
    */
    public function submitForReview($reviewers)
    {
        $I = $this;
        $I->waitThenClick(PaperPage::$submitForReviewButton);
        foreach ($reviewers as $reviewer) {
            $I->waitThenClick(Locator::contains('label', $reviewer['name'])); 
        }
        $I->waitThenClick(PaperPage::$submitReviewer);
        $I->wait(3);
    }

    /** 
     * For a paper reviewer to make recommendations 
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
                $I->selectRecommendation(PaperPage::$recommendApprove);
                break;
            case "Change":
                $I->selectRecommendation(PaperPage::$recommendChange);
                break;
            case "Reject":
                $I->selectRecommendation(PaperPage::$recommendReject);
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
        $I->selectRecommendation(PaperPage::$closeReview);
        $I->confirmRecommendation();
    }

    public function selectRecommendation($recommendation)
    {
        $I = $this;
        $I->waitThenClick(PaperPage::$reviewDropdown);

        // $recommendationOption=Locator::contains('option', $recommendation);    

        $I->waitThenClick($recommendation);
        $I->waitThenClick(PaperPage::$confirmReview);
    }
    
    public function confirmRecommendation($comment=null)
    {
        $I = $this;
        $I->waitForElementClickable(PaperPage::$confirmReviewButton);
        if(isset($comment))
        {
            $I->waitForElementClickable(PaperPage::$textArea,10);
            $I->fillField(PaperPage::$textArea, $comment);
        }
        $I->click(PaperPage::$confirmReviewButton);
    }

    /** 
     * For items in state Reviewed and later
    */

    /** 
     * Handles straightforward sending of papers to various states.
     * @param string $destinationSelector, for example PaperPage::$selectExamReady
     * Can handle Send to item-bank/pre-test/archive and rejct, request change
     * example of $destinationSelector: PaperPage::$SelectPreTest
     * @param string $comment Optional comment
    */
    public function sendTo($destinationSelector, $comment=null)
    {
        $I = $this;
        $I->selectSendTo($destinationSelector);
        $I->confirmSendTo($comment);
    }

    /** 
     * Handles sending Papers to new cycle
     * @param string $cycleDestination ['Setting', 'Reviewing', 'Approving']
     * @param string $cycleName
     * @param string $comment Optional comment
     * To do Add param user array to select setter or reviewers to send to
     * - currently it selects a default setter/reviewer
    */
    public function sendToNewCycleSetting($cycleDestination='Approver', $cycleName='Automation cycle', $comment='Back to setter')
    {
        $I = $this;
        $I->selectSendTo(PaperPage::$SelectCycle);
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
        $I->selectOption(PaperPage::$setCycle,'Setting');
        $I->waitThenClick(PaperPage::$settingDropdown);
        $I->waitThenClick(PaperPage::$settingSelectSetter);    
    }

    public function selectReviewerForNewCycle()
    {
        $I = $this;
        $I->selectOption(PaperPage::$setCycle,'Reviewing');
        $I->waitThenClick(PaperPage::$selectReviewer);
    }

    public function selectApprovingForNewCycle()
    {
        $I = $this;
        $I->selectOption(PaperPage::$setCycle,'Approving');
    }

    public function confirmNewCycleSetting($cycleName='Automation cycle', $comment=null)
    {
        $I = $this;
        $I->fillField(PaperPage::$cycleName, cycleName);
        if(isset($comment))
        {
            $I->fillField(PaperPage::$notesText, $comment);
        }

        $I->waitThenClick(PaperPage::$confirmApproval);
        $I->wait(3);
    }
    
    public function selectSendTo($destinationSelector)
    {
        $I = $this;
        $I->waitThenClick(PaperPage::$approveDropdown);
        $I->waitThenClick($destinationSelector);
        $I->waitThenClick(PaperPage::$confirmApproval);
        $I->wait(1);
    }

    public function confirmSendTo($comment=null)
    {
        $I = $this;
        if(isset($comment))
        {
            $I->waitForElementClickable(PaperPage::$TextArea,10);
            $I->fillField(PaperPage::$TextArea, $comment);
        }
        $I->waitThenClick(PaperPage::$submitApprove);
        $I->wait(1);
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
            $I->waitForElementVisible(PaperPage::$ExamReadyStatusLabel);
                break;
            case "Item Bank":
            $I->waitForElementVisible(PaperPage::$ItemBankStatusLabel);
                break;
            case "Reviwed":
            $I->waitForElementVisible(PaperPage::$ReviewedStatusLabel);
                break;
            case "Review":
            $I->waitForElementVisible(PaperPage::$ReviewStatusLabel);
                break;
            case "PreTest":
            $I->waitForElementVisible(PaperPage::$PreTestStatusLabel);
                break;
            case "Typesetting":
            $I->waitForElementVisible(PaperPage::$TypesettingStatusLabel);
                break;
            case "Archive":
            $I->waitForElementVisible(PaperPage::$ArchivedStatusLabel);
                break;
            case "Reject":
            $I->waitForElementVisible(PaperPage::$RejectedStatusLabel);
                break;
        }
    }

    public function checkVersion($checkVersion)
    {
        $I = $this;
        if($checkVersion == 'latest'){
            $I->waitForElementVisible(PaperPage::$paperVersionLatest);
        }else{
            $I->waitForElementVisible(sprintf(PaperPage::$paperVersionText, $checkVersion));
        }
    }

    public function selectVersion($version)
    {
        $I = $this;
        if($version == 'latest') {
            $selectedVersion = sprintf(PaperPage::$paperVersionArray, '1');
            $I->waitThenClick($selectedVersion);
        }else{
            $selectedVersion = sprintf(PaperPage::$paperVersionText, $version);
            $I->waitThenClick($selectedVersion);
        }
        $I->wait(1);
    }
    
}