<?php
namespace Step\Acceptance\Item;

use Page\Selectors\Item as ItemPage;
use Page\Selectors\SyllabusMapping as SyllabusMappingPage;

class ItemMapping extends \AcceptanceTester
{

    /** 
     * From an open syllabus mapping page, this function maps to first objective
     * and saves the mapping.
     * This automatically closes mapping and should result in item page is visible
     * Todo: sometimes it gets stuck, not sure why
    */
    public function mapToSyllabus()
    {
        $I = $this;
        $I->waitThenClick(ItemPage::$syllabusTab);
        $I->waitForReload(function ($I) {
            $I->click(ItemPage::$mapToSyllabusButton);
        }, 30);
        $I->seeInCurrentUrl('/syllabus/map');
        $I->waitThenClick(SyllabusMappingPage::$firstSyllabusObjective);
        $I->waitForReload(function($I) {
            $I->waitThenClick(SyllabusMappingPage::$saveSyllabusMappingButton);
        });
    }

}