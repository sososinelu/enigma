<?php
namespace Step\Acceptance\Authoring;

use Page\Selectors\Authoring as AuthoringPage;

class ItemPaperList extends \AcceptanceTester
{
    /** 
     * This function verifies that there is at least one item or paper in the list
    */
    public function seeIsSomethingInList()
    {
        $I = $this;
        $I->waitForElement(AuthoringPage::$firstRowInList);
        $I->waitForElement(AuthoringPage::$lookingGlassInList);
    }

    /** 
     * Functions below verifies that headers are as expected for each predefined list
     * They also check that headers that shouldn't be there are missing
    */

    public function seeMyDraftItemsCorrectHeaders()
    {
        $I = $this;
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Status', AuthoringPage::$authoringListHead);
        $I->canSee('modified', AuthoringPage::$authoringListHead);

        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeMyChangeItemsCorrectHeaders()
    {
        $I = $this;
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Status', AuthoringPage::$authoringListHead);
        $I->canSee('modified', AuthoringPage::$authoringListHead);

        // $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); // Bug?
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeMyReviewItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->canSee('Submitted date', AuthoringPage::$authoringListHead);    

        $I->expectTo('not see incorrect headers');
        $I->cantSee('Status', AuthoringPage::$authoringListHead);
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeMyAssetWorkItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status', AuthoringPage::$authoringListHead);
        $I->canSee('modified', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeApprovingItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        // $I->cantSee('Status', AuthoringPage::$authoringListHead); // Picks up "Status changed"
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeMyTeamsReviewingItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Submitted date', 10, AuthoringPage::$authoringListHead); // Changed compared to previous
        $I->canSee('Title', AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Recommendations', AuthoringPage::$authoringListHead); //Bug!

        $I->expectTo('not see incorrect headers');
        $I->cantSee('Status', AuthoringPage::$authoringListHead);
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeItemBankItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('modified', 10, AuthoringPage::$authoringListHead); // Changed compared to previous
        $I->canSee('Title', AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        $I->cantSee('Status', AuthoringPage::$authoringListHead);
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seePretestItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        // $I->cantSee('Status', AuthoringPage::$authoringListHead); // Picks up "Status changed"
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seeArchiveItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        // $I->cantSee('Status', AuthoringPage::$authoringListHead); // Picks up "Status changed"
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seeChangeRequestsItemsCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Date requested', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Title', AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status', AuthoringPage::$authoringListHead);
        $I->canSee('Recommendations', AuthoringPage::$authoringListHead); 

        $I->expectTo('not see incorrect headers');
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seeRejectionsItemsCorrectHeaders()
    {
        $I = $this;
        $I->waitForText('rejected', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Title', AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);

        $I->cantSee('Status', AuthoringPage::$authoringListHead);
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
    }

    public function seeMyDraftPapersCorrectHeaders()
    {
        $I = $this;
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Status', AuthoringPage::$authoringListHead);
        $I->canSee('modified', AuthoringPage::$authoringListHead);

        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeMyChangePapersCorrectHeaders()
    {
        $I = $this;
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Status', AuthoringPage::$authoringListHead);
        $I->canSee('modified', AuthoringPage::$authoringListHead);

        // $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); // Bug?
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeMyReviewPapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->canSee('Submitted date', AuthoringPage::$authoringListHead);    

        $I->expectTo('not see incorrect headers');
        $I->cantSee('Status', AuthoringPage::$authoringListHead);
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeApprovingPapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        // $I->cantSee('Status', AuthoringPage::$authoringListHead); // Picks up "Status changed"
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeTypesettingPapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead); 

        $I->expectTo('not see incorrect headers');
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead);
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeMyTeamsReviewingPapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Submitted date', 10, AuthoringPage::$authoringListHead); // Changed compared to previous
        $I->canSee('Title', AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Recommendations', AuthoringPage::$authoringListHead); //Bug!

        $I->expectTo('not see incorrect headers');
        $I->cantSee('Status', AuthoringPage::$authoringListHead);
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('Date rejected', AuthoringPage::$authoringListHead);
    }

    public function seeExamReadyPapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead); // Changed compared to previous
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        // $I->cantSee('Status', AuthoringPage::$authoringListHead); // Picking up "Status changed"
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seePretestPapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        // $I->cantSee('Status', AuthoringPage::$authoringListHead); // Picks up "Status changed"
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seeArchivePapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Title', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status changed', AuthoringPage::$authoringListHead);

        $I->expectTo('not see incorrect headers');
        // $I->cantSee('Status', AuthoringPage::$authoringListHead); // Picks up "Status changed"
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seeChangeRequestsPapersCorrectHeaders()
    {
        $I = $this;
        $I->expectTo('see authoring list with correct headers');
        $I->waitForText('Date requested', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Title', AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);
        $I->canSee('Status', AuthoringPage::$authoringListHead);
        $I->canSee('Recommendations', AuthoringPage::$authoringListHead); 

        $I->expectTo('not see incorrect headers');
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('rejected', AuthoringPage::$authoringListHead);
    }

    public function seeRejectionsPapersCorrectHeaders()
    {
        $I = $this;
        $I->waitForText('rejected', 10, AuthoringPage::$authoringListHead);
        $I->canSee('Title', AuthoringPage::$authoringListHead);
        $I->canSee('Subject', AuthoringPage::$authoringListHead);
        $I->canSee('Qualification', AuthoringPage::$authoringListHead);
        $I->canSee('Author', AuthoringPage::$authoringListHead);

        $I->cantSee('Status', AuthoringPage::$authoringListHead);
        $I->cantSee('Recommendations', AuthoringPage::$authoringListHead); 
        $I->cantSee('My recommendation', AuthoringPage::$authoringListHead);
        $I->cantSee('modified', AuthoringPage::$authoringListHead);
        $I->cantSee('Submitted date', AuthoringPage::$authoringListHead);
        $I->cantSee('Status changed', AuthoringPage::$authoringListHead);
        $I->cantSee('Date requested', AuthoringPage::$authoringListHead);
    }
}