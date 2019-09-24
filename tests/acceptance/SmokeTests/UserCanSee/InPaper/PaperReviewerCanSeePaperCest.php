<?php
use Page\Login as LoginPage;
use Step\Acceptance\Login as LoginStep;
use Step\Acceptance\Paper\ViewPaperContent;
use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper;

class PaperReviewerCanSeePaperCest 
{
    public function _before(LoginStep $I)
    {
        $I->login(LoginPage::$paperReviewer);
        $I->waitForElement(AuthoringPage::$authoringList, 30);

    }

    public function _after(LoginStep $I)
    {
        $I->clearSession(LoginPage::$paperReviewer['email']);
    }


    public function PaperReviewerSeeMyPaperTest(ViewPaperContent $I)
    {
        $I->wantTo("see all fields in the paper I'm reviwing");
        $I->amGoingTo('open my paper'); 
        $I->amOnPage("/author/paper/59c20f23807b8367a80e3cc4");

        $I->expectTo('see all tabs I have access to');
        $I->seeAllNonRestrictedPaperTabsInReadonly();

        $I->expectTo('not see tracking');
        $I->cantSeePaperApproverSpecificTabs();

        $I->expectTo('see prev and next buttons submit and duplicate buttons');
        $I->canSeeElement(Paper::$prevPaperButton);
        $I->canSeeElement(Paper::$nextPaperButton);

        $I->expectTo('not see edit, save submit and duplicate buttons');
        $I->cantSeeElement(Paper::$editPaperButton);
        $I->cantSeeElement(Paper::$saveDraftButton);
        $I->cantSeeElement(Paper::$submitForReviewButton);
        $I->cantSeeElement(Paper::$duplicateButton);

        $I->expect('I can go between tabs and see information on those tabs');
        $I->seeInMarkSchemeReadonly('Review');
        $I->seeInAdditionalDocuments('There are no additional documents for this paper.');
        $I->seeInPreview('for Paper in review with single item', true);
        $I->seeInSyllabus('Maths', 'A-levels', 'Maths A-levels default');
        $I->seeInComposition('Mean difficulty');
        // $I->seeInNotes('Add note'); // Hidden
        $I->seeInInformation('100-038-165', 'Papersetter Maths', 'Review');
    }

}
