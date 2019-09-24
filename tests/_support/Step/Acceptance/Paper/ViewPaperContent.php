<?php
namespace Step\Acceptance\Paper;

use Page\Selectors\Paper;

class ViewPaperContent extends \AcceptanceTester
{
    /**
     * Steps between paper tabs that should be available to all users
     * that can view the paper in readonly, irrespective of item state
     */
    public function seeAllNonRestrictedPaperTabsInReadonly()
    {
        $I = $this;
        $I->waitForElement(Paper::$previewTab);
        $I->waitForElement(Paper::$markSchemeReadOnlyTab);
        $I->waitForElement(Paper::$additionalDocumentsTab);
        $I->waitForElement(Paper::$informationTab);
        $I->waitForElement(Paper::$syllabusTab);
        $I->waitForElement(Paper::$compositionTab);
        // $I->canSee(Paper::$notes); // Hidden in some cases, fix so that can be handled
        $I->cantSee(Paper::$itemOrderingTab); // Should only be visible in edit
    }

    /**
     * Steps between paper tabs that should be available to all users
     * that can view the paper in edit, irrespective of paper state
     */
    public function seeAllPaperTabsInEdit()
    {
        $I = $this;
        $I->waitForElement(Paper::$itemOrderingTab);
        $I->waitForElement(Paper::$previewTab);
        $I->waitForElement(Paper::$markSchemeTab);
        $I->waitForElement(Paper::$additionalDocumentsTab);
        $I->waitForElement(Paper::$informationTab);
        $I->waitForElement(Paper::$syllabusTab);
        $I->waitForElement(Paper::$compositionEditTab);
        $I->waitForElement(Paper::$notesTab);
    }

    public function seePaperProofsTabs()
    {
        $I = $this;
        $I->waitForElement(Paper::$proofsTab);
    }

    public function cantSeePaperProofsTabs()
    {
        $I = $this;
        $I->cantSee(Paper::$proofsTab);
    }

    /**
     * This function goes to paper tabs that are available to paper approver
     * but not all other users.
     */
    public function seePaperApproverSpecificTabs()
    {
        $I = $this;
        $I->canSee(Paper::$trackingTab); // Often hidden
    }

    /**
     * This function goes to paper tabs that are available to paper approver
     * but not all other users.
     */
    public function cantSeePaperApproverSpecificTabs()
    {
        $I = $this;
        $I->cantSee(Paper::$trackingTab);
    }

    public function seeInItems($text)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$itemOrderingTab);
        $I->click(Paper::$itemOrderingTab);
        $I->waitForText($text);
    }

    public function seeInPreview($text, $readOnly=false)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$previewTab);
        $I->click(Paper::$previewTab);
        if($readOnly)
        {
            $I->waitForElement(Paper::$binocularsButton);
        }
        $I->canSee($text);
    }

    public function seeInMarkScheme($text)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$markSchemeTab);
        $I->click(Paper::$markSchemeTab);
        $I->waitForText($text);
    }

    public function seeInMarkSchemeReadonly($text)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$markSchemeReadOnlyTab);
        $I->click(Paper::$markSchemeReadOnlyTab);
        $I->waitForText($text);
    }

    public function seeInAdditionalDocuments($text)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$additionalDocumentsTab);
        $I->click(Paper::$additionalDocumentsTab);
        $I->waitForText($text);
    }

    public function seeInInformation($gm_uid, $author, $paperStatus)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$informationTab);
        $I->click(Paper::$informationTab);
        $I->canSee($gm_uid); // improve so correct fields are checked
        $I->canSee($author);
        $I->canSee($paperStatus);
    }

    public function seeInSyllabus($subject, $qualification, $syllabusName, $YearOfFirstAssessment=null)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$syllabusTab);
        $I->click(Paper::$syllabusTab);
        $I->waitForText($syllabusName); // improve so correct fields are checked
        $I->canSee($subject); // improve so correct fields are checked
        $I->canSee($qualification); // improve so correct fields are checked
        if(isset($YearOfFirstAssessment))
        {
            $I->canSee($YearOfFirstAssessment); // improve so correct fields are checked
        }
    }

    public function seeInComposition($text)
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$compositionTab);
        $I->click(Paper::$compositionTab);
        $I->waitForText('Paper level statistics');
        $I->canSee($text);
    }

    public function seeInNotes($text = 'Add note')
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$notesTab);
        $I->click(Paper::$notesTab);
        $I->waitForText($text);
    }

    public function seeInTracking($text = [])
    {
        $I = $this;
        $I->waitForElementClickable(Paper::$trackingTab);
        $I->click(Paper::$trackingTab);
        foreach($text as $i) {
            $I->waitForText($i);
        }
    }


}