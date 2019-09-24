<?php
use Page\Login as LoginPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\ViewPaperContent;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper;

class PaperSetterCanSeePaperCest 
{
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$paperSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);

    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$paperSetter['email']);
    }


    public function PaperSetterSeeInDraftPaperTest(ViewPaperContent $I)
    {
        $I->wantTo('see all fields in my draft paper');
        $I->amGoingTo('open one of my draft papers');
        $I->amOnPage("/author/paper/edit/59f75804a26fc51ad0007bdf");

        $I->expectTo('see all tabs I have access to');
        $I->seeAllPaperTabsInEdit();

        $I->expectTo('not see tracking');
        $I->cantSeePaperApproverSpecificTabs();

        $I->expectTo('see draft, submit and duplicate buttons'); 
        $I->canSeeElement(Paper::$saveDraftButton);
        $I->canSeeElement(Paper::$submitForReviewButton);
        $I->canSeeElement(Paper::$duplicateButton);

        $I->expectTo('not see edit, prev and next buttons');
        $I->cantSeeElement(Paper::$editPaperButton);
        $I->cantSeeElement(Paper::$prevPaperButton);
        $I->cantSeeElement(Paper::$nextPaperButton);

        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkScheme('Reviewed');
        $I->seeInAdditionalDocuments('Add document');
        $I->seeInAdditionalDocuments('There are no additional documents for this paper.');
        $I->seeInPreview('Reviewed item for Draft paper');
        $I->seeInSyllabus('Maths', 'A-levels', 'Maths A-levels default');
        $I->seeInItems('Difficulty');
        $I->seeInNotes('Add note');
        $I->seeInInformation('100-038-656', 'Papersetter Maths', 'Draft');
    }
}
