<?php
namespace Page\Selectors;

class Authoring
{
    public static $baseURL = '/authoring';

    public static $listOpenItemButton = '//*[@id="open-item-button"]';

    public static $createButton = '//*[@id="create-entity-dropdown"]';
    public static $createDropdownItem = '//*[@id="create-item"]';
    public static $createDropdownPaper = '//*[@id="create-paper"]';
    public static $createDropdownPaperAuto = '//*[@id="create-paper-auto"]';

    public static $subjectSelect = '//div[contains(@class, "select2")][contains(@ng-model, "selectedSubject.selected")]';
    public static $qualificationSelect = '//div[contains(@class, "select2")][contains(@ng-model, "selectedQualification.selected")]';
    public static $syllabusSelect = '//div[@id="selectedSyllabus"]';
    public static $subjectQualificationCreateButton = '//*[@id="set-subject-qualification"]/div/div/div[3]/button';
    public static $subjectQualificationSelectPattern = '//div[@class=\'ng-binding ng-scope\'][contains(.,"%s")]';

    /**
     * Predefined searches, their urls and their counts
    */
    public static $actioned                = '#actioned-toggle';

    public static $myAuthoringItems        = '#drafts-items';
    public static $myAuthoringPapers       = '#drafts-papers';
    public static $myChangeItems           = '#changes-items';
    public static $myChangePapers          = '#changes-papers';
    public static $myReviewingItems        = '#reviewing-items';
    public static $myReviewingPapers       = '#reviewing-papers';
    public static $myAssetWork             = '#my-asset-work-items';
    public static $myTeamsReviewingItems   = '#teams-reviewing-items';
    public static $myTeamsReviewingPapers  = '#teams-reviewing-papers';
    public static $approvingItems          = '#approving-items';
    public static $approvingPapers         = '#approving-papers';
    public static $typesettingPapers       = '#typesetting-papers';
    public static $itemBankItems           = '#item-bank-items';
    public static $preTestItems            = '#pre-test-items';
    public static $preTestPapers           = '#pre-test-papers';
    public static $archiveItems            = '#archive-items';
    public static $archivePapers           = '#archive-papers';
    public static $examReadyPapers         = '#exam-ready-papers';
    public static $changeRequestsItems     = '#change-requests-items';
    public static $changeRequestsPapers    = '#change-requests-papers';
    public static $rejectionsItems         = '#rejections-items';
    public static $rejectionsPapers        = '#rejections-papers';

    // Predefined searches URLs

    public static $myAuthoringItemsUrl        = '/authoring#/items?filter=drafts';
    public static $myAuthoringPapersUrl       = '/authoring#/papers?filter=drafts';
    public static $myChangeItemsUrl           = '/authoring#/items?filter=changes';
    public static $myChangePapersUrl          = '/authoring#/papers?filter=changes';
    public static $myReviewingItemsUrl        = '/authoring#/items?filter=reviewing';
    public static $myReviewingPapersUrl       = '/authoring#/papers?filter=reviewing';
    public static $myAssetWorkUrl             = '/authoring#/items?filter=my-asset-work';
    public static $myTeamsReviewingItemsUrl   = '/authoring#/items?filter=teams-reviewing';
    public static $myTeamsReviewingPapersUrl  = '/authoring#/papers?filter=teams-reviewing';
    public static $approvingItemsUrl          = '/authoring#/items?filter=approving';
    public static $approvingPapersUrl         = '/authoring#/papers?filter=approving';
    public static $typesettingPapersUrl       = '/authoring#/papers?filter=typesetting';
    public static $itemBankItemsUrl           = '/authoring#/items?filter=item-bank';
    public static $preTestItemsUrl            = '/authoring#/items?filter=pre-test';
    public static $preTestPapersUrl           = '/authoring#/papers?filter=pre-test';
    public static $archiveItemsUrl            = '/authoring#/items?filter=archive';
    public static $archivePapersUrl           = '/authoring#/papers?filter=archive';
    public static $examReadyPapersUrl         = '/authoring#/papers?filter=exam-ready';
    public static $changeRequestsItemsUrl     = '/authoring#/items?filter=change-requests';
    public static $changeRequestsPapersUrl    = '/authoring#/papers?filter=change-requests';
    public static $rejectionsItemsUrl         = '/authoring#/items?filter=rejections';
    public static $rejectionsPapersUrl        = '/authoring#/papers?filter=rejections';

    // Predefined searches counts
    
    public static $draftCount              = '#drafts-count';
    public static $changesRequestedCount   = '#changes-count';
    public static $reviewingCount          = '#reviewing-count';
    public static $myAssetWorkCount        = '#my-asset-work-count';
    public static $approvingCount          = '#approving-count';
    public static $typesettingCount        = '#typesetting-count';
    public static $teamsReviewingCount     = '#teams-reviewing-count';
    public static $itemBankCount           = '#item-bank-count';
    public static $pretestCount            = '#pre-test-count';
    public static $archiveCount            = '#archive-count';
    public static $examReadyCount          = '#exam-ready-count';
    public static $changeRequestsCount     = '#change-requests-count';
    public static $rejectionsCount         = '#rejections-count';

    public static $selectItems             = '#authoring-btn-items';
    public static $itemsCount              = '#item-count'; // Currently same as for papers
    public static $selectPapers            = '#authoring-btn-papers';
    public static $papersCount             = '#item-count'; // Currently same as for items

    /**
     * List with items or papers on main authoring page
    */
    
    public static $authoringList           = '#list-scroll';
    public static $authoringListHead       = '//div[@id="list-scroll"]/table/thead';
    // public static $authoringListHead       = '//*[@id="list-scroll"]/table/thead';
    public static $firstRowInList          = '//*[@id="list-scroll"]/table/tbody/tr[1]';
    public static $firstBitOfFirstRowInList = '//*[@id="list-scroll"]/table/tbody/tr[1]/td[1]';
    public static $lookingGlassInList      = 'div[class="search-item-preview link-button"]';
    public static $actionedToggleButton		= '#actioned-toggle';
    public static $rejectionsHeaderButton 	= '#rejections-header';
	public static $openItemInListButton    = '#open-item-button';
    
    // Asset details (per item)
    public static $assetListHeader         	= '.asset-header-row';



}
