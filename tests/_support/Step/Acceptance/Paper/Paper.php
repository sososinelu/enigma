<?php

namespace Step\Acceptance\Paper;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Paper as PaperPage;
use Page\Selectors\PaperSearchAdd as PaperSearchAdd;

class Paper extends \AcceptanceTester
{
    /**
     * Edit paper
     *
     * @param $paperId
     * @throws \Exception
     */
    public function editPaper($paperId)
    {
        $I = $this;
        $I->amOnPage(PaperPage::$editURL . '/' . $paperId);
    }

    /**
     * Open paper in readonly
     *
     * @param $paperId
     * @throws \Exception
     */
    public function openPaperInReadOnly($paperId)
    {
        $I = $this;
        $I->amOnPage(PaperPage::$readOnlyURL . '/' . $paperId);
    }

    /**
     * Create a new paper with supplied subject and qualification
     *
     * @param $subject
     * @param $qualification
     * @throws \Exception
     */
    public function create($subject, $qualification, $syllabus, $titleText)
    {
        $I = $this;
        $I->waitThenClick(AuthoringPage::$createButton);
        $I->waitThenClick(AuthoringPage::$createDropdownPaper);
        $I->waitThenClick(AuthoringPage::$subjectSelect);
        $subjectSelection = sprintf(AuthoringPage::$subjectQualificationSelectPattern, $subject);
        $I->waitThenClick($subjectSelection);
        $I->waitThenClick(AuthoringPage::$qualificationSelect);
        $qualificationSelection = sprintf(AuthoringPage::$subjectQualificationSelectPattern, $qualification);
        $I->waitThenClick($qualificationSelection);
        $I->waitThenClick(AuthoringPage::$syllabusSelect);
        $SyllabusSelection = sprintf(AuthoringPage::$subjectQualificationSelectPattern, $syllabus);
        $I->waitThenClick($SyllabusSelection);
        $I->waitThenClick(AuthoringPage::$subjectQualificationCreateButton);
        $I->wait(2);
        $I->canSeeInCurrentUrl(PaperPage::$createURL);
        $I->waitThenClick(PaperPage::$title);
        $I->fillField(PaperPage::$title, $titleText);
        $I->waitThenClick(PaperPage::$saveButton);
        $I->wait(2);
        $I->canSeeInCurrentUrl(PaperPage::$editURL);
    }

    public function AddItem($searchForText, $selectStatus)
    {
        $I = $this;
        $I->click(PaperPage::$addItemModalButton);
        $I->FillField(PaperSearchAdd::$searchText, $searchForText); //Text to be searched
        $I->selectOption(PaperSearchAdd::$status, $selectStatus); //Status Selection from predefined
        $I->waitThenClick(PaperSearchAdd::$searchInAddItemButton);
        $I->waitForElementClickable(PaperSearchAdd::$magnifyButton);
        $I->click(PaperSearchAdd::$checkBox);
        $I->waitThenClick(PaperSearchAdd::$includeInPaper);
        $I->waitForText(PaperSearchAdd::$itemText,30);
        $I->waitThenClick(PaperSearchAdd::$closeSearchItem);
    }

    public function SetMetaData()
    {
        $I = $this;
        $I->FillField(PaperPage::$paperNumber,'1337');
        $I->selectOption(PaperPage::$sessionDay,"1");
        $I->selectOption(PaperPage::$sessionMonth,"May");
        $I->selectOption(PaperPage::$sessionYear,"2018");
        $I->FillField(PaperPage::$paperText,"Automation");
    }
    
}
