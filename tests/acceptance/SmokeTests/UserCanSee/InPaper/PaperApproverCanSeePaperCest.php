<?php
use Page\Login as LoginPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\ViewPaperContent;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper;

class PaperApproverCanSeePaperCest 
{
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$paperApprover);
        $I->waitForElement(AuthoringPage::$authoringList, 30);

    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$paperApprover['email']);
    }


    public function PaperApproverSeeInReadonlyReviewedPaperTest(ViewPaperContent $I)
    {
        $I->wantTo('see all fields in the paper');
        $I->amGoingTo('open a reviewed paper in readonly');
        $I->amOnPage("/author/paper/59c18e50807b835f7565c9e4");
        $I->expectTo('see all tabs I have access to');
        $I->seeAllNonRestrictedPaperTabsInReadonly();
        $I->expectTo('see edit, prev and next buttons submit and duplicate buttons');
        $I->canSeeElement(Paper::$editPaperButton);
        $I->canSeeElement(Paper::$prevPaperButton);
        $I->canSeeElement(Paper::$nextPaperButton);

        $I->expectTo('not see submit and duplicate buttons');
        $I->cantSeeElement(Paper::$saveDraftButton);
        $I->cantSeeElement(Paper::$submitForReviewButton);
        $I->cantSeeElement(Paper::$duplicateButton);

        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkSchemeReadonly('Reviewed');
        $I->seeInAdditionalDocuments('There are no additional documents for this paper.');
        $I->seeInPreview('Paper ready to be approved', true);
        $I->seeInSyllabus('Maths', 'A-levels', 'Maths A-levels default');
        $I->seeInComposition('Mean difficulty');
        $I->seeInInformation('100-038-161', 'Papersetter Maths', 'Review');
    }

    public function PaperApproverSeeInEditReviewedPaperTest(ViewPaperContent $I)
    {
        $I->wantTo('see all fields in a reviewed paper in edit mode');
        $I->amGoingTo('open one of my draft papers');
        $I->amOnPage("/author/paper/edit/59c18e50807b835f7565c9e4");

        $I->expectTo('see all tabs I have access to');
        $I->seeAllPaperTabsInEdit();

        $I->expectTo('see save and cancel buttons');
        $I->canSeeElement(Paper::$saveButton);
        // $I->canSeeElement(Paper::$cancel); // Doesn't work due to bad ids

        $I->expectTo('not see edit, prev and next and duplicate buttons');
        $I->cantSeeElement(Paper::$editPaperButton);
        $I->cantSeeElement(Paper::$prevPaperButton);
        $I->cantSeeElement(Paper::$nextPaperButton);
        // $I->cantSeeElement(Paper::$duplicate); // Doesn't work due to bad ids

        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkScheme('Reviewed');
        $I->seeInAdditionalDocuments('Add document');
        $I->seeInAdditionalDocuments('There are no additional documents for this paper.');
        $I->seeInPreview('Paper content block');
        $I->seeInSyllabus('Maths', 'A-level', 'Maths A-levels default', '2017');
        $I->seeInItems('Discrimination');
        $I->seeInNotes('Add note');
        $I->seeInInformation('100-038-161', 'PaperSetter Maths', 'Reviewed');
    }
}
