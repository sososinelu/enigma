<?php

use Step\Acceptance\Item\Item as ItemStep;
use Step\Acceptance\Login as LoginStep;

use Page\Selectors\Authoring as AuthoringPage;
use Page\Selectors\Item as ItemPage;
use Page\Data\ItemPaperData;
use Page\Login as LoginPage;
use Page\SpecialCharacters;

class SpecialCharactersCest
{
    /**
     * @param ItemStep $I
     * @param LoginStep $loginStep
     * @throws Exception
     */
    public function _before(ItemStep $I, LoginStep $loginStep)
    {
        $loginStep->login(LoginPage::$itemSetterPaperSetter);
        $I->waitForElement(AuthoringPage::$authoringList, 30);
    }

    /**
     * @param $loginStep $loginStep
     * @throws Exception
     */
    public function _after(LoginStep $loginStep)
    {
        $loginStep->clearSession();
    }

    /**
     * @param ItemStep $I
     * @throws Exception
     */
    public function UserCanAddSpecialCharactersInQuestionBlock(ItemStep $I) {
        $itemId = ItemPaperData::$itemSetterPaperSetterMaths['itemDraftNotInPaper']['itemid'];

        $I->editItem($itemId);
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, 0));
        $I->clearField(sprintf(ItemPage::$questionBlockTextField, 0));

        $I->waitThenClick(sprintf(ItemPage::$questionBlockTextField, 0));

        foreach (SpecialCharacters::$latin as $item) {
            $I->waitThenClick(ItemPage::$specialCharactersButton);
            $I->waitThenClick(sprintf(ItemPage::$specialCharacterByTitle, $item['title']));
        }
        foreach (SpecialCharacters::greek() as $item) {
            $I->waitThenClick(ItemPage::$specialCharactersButton);
            $I->waitThenClick(sprintf(ItemPage::$specialCharactersTab, 1));
            $I->waitThenClick(sprintf(ItemPage::$specialCharacterByTitle, $item['title']));
        }
        foreach (SpecialCharacters::$punctuation as $item) {
            $I->waitThenClick(ItemPage::$specialCharactersButton);
            $I->waitThenClick(sprintf(ItemPage::$specialCharactersTab, 2));
            $I->waitThenClick(sprintf(ItemPage::$specialCharacterByTitle, $item['title']));
        }
        foreach (SpecialCharacters::$maths as $item) {
            $I->waitThenClick(ItemPage::$specialCharactersButton);
            $I->waitThenClick(sprintf(ItemPage::$specialCharactersTab, 3));
            $I->waitThenClick(sprintf(ItemPage::$specialCharacterByTitle, $item['title']));
        }
        foreach (SpecialCharacters::$currency as $item) {
            $I->waitThenClick(ItemPage::$specialCharactersButton);
            $I->waitThenClick(sprintf(ItemPage::$specialCharactersTab, 4));
            $I->waitThenClick(sprintf(ItemPage::$specialCharacterByTitle, $item['title']));
        }
        foreach (SpecialCharacters::other() as $item) {
            $I->waitThenClick(ItemPage::$specialCharactersButton);
            $I->waitThenClick(sprintf(ItemPage::$specialCharactersTab, 5));
            $I->waitThenClick(sprintf(ItemPage::$specialCharacterByTitle, $item['title']));
        }

        // there's no element to wait for - but need to let tinyMCE catch up
        $I->wait(1);

        $I->waitThenClick(ItemPage::$saveDraftItemButton);
        $I->waitForElement(sprintf(ItemPage::$questionBlockTextField, 0));

        $I->wait(1);

        foreach (SpecialCharacters::$latin as $item) {
            $I->expect('to see following character in edit: ' . $item['title']);
            $I->canSee($item['value'], sprintf(ItemPage::$questionBlockTextField, 0));
        }
        foreach (SpecialCharacters::greek() as $item) {
            $I->expect('to see following character in edit: ' . $item['title']);
            $I->canSee($item['value'], sprintf(ItemPage::$questionBlockTextField, 0));
        }
        foreach (SpecialCharacters::$punctuation as $item) {
            $I->expect('to see following character in edit: ' . $item['title']);
            $I->canSee($item['value'], sprintf(ItemPage::$questionBlockTextField, 0));
        }
        foreach (SpecialCharacters::$maths as $item) {
            $I->expect('to see following character in edit: ' . $item['title']);
            $I->canSee($item['value'], sprintf(ItemPage::$questionBlockTextField, 0));
        }
        foreach (SpecialCharacters::$currency as $item) {
            $I->expect('to see following character in edit: ' . $item['title']);
            $I->canSee($item['value'], sprintf(ItemPage::$questionBlockTextField, 0));
        }
        foreach (SpecialCharacters::other() as $item) {
            $I->expect('to see following character in edit: ' . $item['title']);
            $I->canSee($item['value'], sprintf(ItemPage::$questionBlockTextField, 0));
        }

        $I->waitThenClick(ItemPage::$previewTab);

        foreach (SpecialCharacters::$latin as $item) {
            $I->expect('to see following character in preview: ' . $item['title']);
            $I->canSee($item['value'], ItemPage::$itemContainerPreview);
        }
        foreach (SpecialCharacters::greek() as $item) {
            $I->expect('to see following character in preview: ' . $item['title']);
            $I->canSee($item['value'], ItemPage::$itemContainerPreview);
        }
        foreach (SpecialCharacters::$punctuation as $item) {
            $I->expect('to see following character in preview: ' . $item['title']);
            $I->canSee($item['value'], ItemPage::$itemContainerPreview);
        }
        foreach (SpecialCharacters::$maths as $item) {
            $I->expect('to see following character in preview: ' . $item['title']);
            $I->canSee($item['value'], ItemPage::$itemContainerPreview);
        }
        foreach (SpecialCharacters::$currency as $item) {
            $I->expect('to see following character in preview: ' . $item['title']);
            $I->canSee($item['value'], ItemPage::$itemContainerPreview);
        }
        foreach (SpecialCharacters::other() as $item) {
            $I->expect('to see following character in preview: ' . $item['title']);
            $I->canSee($item['value'], ItemPage::$itemContainerPreview);
        }
    }
}
