<?php
namespace Step\Acceptance\Item;

use Page\Selectors\Item;

class ViewItemContent extends \AcceptanceTester
{
    /**
     * Steps between Item tabs that should be available to all users
     * that can view the item in readonly, irrespective of item state
     */
    public function viewAllNonRestrictedItemTabsInReadonly()
    {
        $I = $this;
        $I->waitForElement(Item::$previewTab);
        $I->waitForElement(Item::$markSchemeTab);
        $I->waitForElement(Item::$additionalDocumentsTab);
        $I->waitForElement(Item::$informationTab);
        $I->waitForElement(Item::$syllabusTab);
        $I->waitForElement(Item::$notesTab);
        $I->cantSee(Item::$itemContentTab); // Should only be visible in edit
    }

    /**
     * Steps between Item tabs that should be available to all users
     * that can view the item in edit, irrespective of item state
     */
    public function viewAllItemTabsInEdit()
    {
        $I = $this;
        $I->waitForElement(Item::$itemContentTab);
        $I->waitForElement(Item::$previewTab); 
        $I->waitForElement(Item::$markSchemeTab);
        $I->waitForElement(Item::$additionalDocumentsTab);
        $I->waitForElement(Item::$informationTab);
        $I->waitForElement(Item::$syllabusTab);
        $I->waitForElement(Item::$notesTab);
    }

    /**
     * Goes to item tabs that are available to item approver
     * but not all other users
     */
    public function viewItemApproverSpecificTabs()
    { 
        $I = $this;
        $I->waitForElement(Item::$trackingTab);
    }
    
    /**
     * See passed text in item content tab
     *
     * @param string $text
     */
    public function seeInItemContent($text)
    {
        $I = $this;
        $I->waitForElementClickable(Item::$itemContentTab);
        $I->click(Item::$itemContentTab);
        $I->waitForText($text);    
    }

    /**
     * See passed text in preview tab
     *
     * @param string $text
     */
    public function seeInPreview($text)
    {
        $I = $this;
        $I->waitForElementClickable(Item::$previewTab);
        $I->click(Item::$previewTab);
        $I->canSee($text);
    }

    /**
     * See passed text in mark scheme tab
     *
     * @param string $text
     */
    public function seeInMarkScheme($text)
    {
        $I = $this;
        $I->waitForElementClickable(Item::$markSchemeTab);
        $I->click(Item::$markSchemeTab);
        $I->waitForText($text);    
    }

    /**
     * See passed text in additional documents tab
     *
     * @param string $text
     */
    public function seeInAdditionalDocuments($text)
    {
        $I = $this;
        $I->waitForElementClickable(Item::$additionalDocumentsTab);
        $I->click(Item::$additionalDocumentsTab);
        $I->waitForText($text);
    }

    /**
     * Check passed variables in information tab
     *
     * @param string $gm_uid
     * @param string $author
     * @param string $questionType
     * @param string $blooms
     * @param array $other
     */
    public function seeInInformation($gm_uid, $author, $questionType, $blooms=null, $other = [])
    {
        $I = $this;
        $I->waitForElementClickable(Item::$informationTab);
        $I->click(Item::$informationTab);
        $I->canSee($gm_uid); // improve so correct fields are checked
        $I->canSee($author);
        $I->canSee($questionType);
        if(isset($blooms)){
            $I->canSee($blooms);
        }  
        foreach($other as $i) {
            $I->canSee($i);    
        }
    }

    /**
     * Check passed variables in syllabus tab
     *
     * @param string $syllabusName
     * @param string $mapped
     * @param string $mappedTo
     * @param boolean $canEditSyllabus
     */
    public function seeInSyllabus($syllabusName, $mapped = null, $mappedTo = null, $canEditSyllabus = false)
    {
        $I = $this;
        $I->waitForElementClickable(Item::$syllabusTab);
        $I->click(Item::$syllabusTab); 
        $I->waitForText($syllabusName); // improve so correct fields are checked
        if(isset($mapped)) {
            if($mapped) 
                $I->canSee('Mapped'); 
            else
                $I->canSee('Not mapped');
            }
        if(isset($mappedTo)) {
            $I->canSee($mappedTo);
        }
        if($canEditSyllabus){
            $I->waitForElement(Item::$mapToSyllabusButton);
        }
        else {
            $I->cantSee(Item::$mapToSyllabusButton);
        }
    }

    /**
     * See passed text in notes tab
     *
     * @param string $text
     */
    public function seeInNotes($text = 'Add note')
    {
        $I = $this;
        $I->waitForElementClickable(Item::$notesTab);
        $I->click(Item::$notesTab);
        $I->canSee($text);   
    }

    /**
     * See passed text in tracking tab
     *
     * @param array $text
     */
    public function seeInTracking($text = [])
    {
        $I = $this;
        $I->waitForElementClickable(Item::$trackingTab);
        $I->click(Item::$trackingTab);
        foreach($text as $i) {
            $I->waitForText($i);    
        }
    }
}