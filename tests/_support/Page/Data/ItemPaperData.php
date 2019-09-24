<?php

namespace Page\Data;

class ItemPaperData
{
    /**
     *
     * Item data
     *
     */

    public static $draftItem = ['itemid' => '59c2b0f8807b8378cc2c7594'];
    public static $reviewItem = ['itemid' => '59c2b172807b8379a8536614'];
    // With a single reviewer
    public static $reviewItem1 = ['itemid' => '59c8fe46807b8309b7515774'];
    public static $reviewedItem = ['itemid' => '59c2ba8e807b83032535ed54'];
    public static $approvedItem = ['itemid' => '59c8fcb3807b83089414c974'];
    public static $inpretestItem = ['itemid' => '59c8fc1f807b8307e8249454'];
    public static $changeItem = ['itemid' => '59fe0533a26fc53ad8005e76'];
    public static $changeRedraft_cycleItem = ['itemid' => '59c1808e807b8353c2613d14'];
    public static $archivedItem = ['itemid' => '59c2b331807b8379b06d70e4'];
    public static $rejectedItem = ['itemid' => '59c2b2c5807b8379da0b9ee4'];
    public static $approvedItemBeenToPretest = ['itemid' => '59fe3b24a26fc53ad8005f19'];

    public static $draftItemWAsset = [
        'itemid' => '59fe05d2a26fc53ad8005e78',
        'asset_workflowids' => []
    ];

    // Note that item below has no assets. It is used in adding assets tests
    public static $draftItemAssets = ['itemid' => '5ce51a613bd29848b04f4174'];
    public static $reviewedItemAssets = ['itemid' => '5ce51fd63bd29842eb223bef'];

    public static $reviewItemWAssetFreeTextMarkScheme = [
        'itemid' => '5cd945d6c628790047558a0d',
        'asset_workflowids' => [
            'finalAssetContentBlock'              => '5cd945c5c6287900475589e6',
            'assetBriefContentBlockWithoutImage'  => '5cd945c5c6287900475589e7',
            'assetBriefContentBlockWithImage'     => '5cd945c5c6287900475589e8',
            'audioAssetContentBlock'              => '5cd945c7c6287900475589ea',
            'videoAssetContentBlock'              => '5cd945c8c6287900475589ec',
            'finalAssetQuestionBlock'             => '5cd945c9c6287900475589ee',
            'assetBriefQuestionBlockWithoutImage' => '5cd945c9c6287900475589ef',
            'assetBriefQuestionBlockWithImage'    => '5cd945c9c6287900475589f0',
            'audioAssetQuestionBlock'             => '5cd945cbc6287900475589f2',
            'videoAssetQuestionBlock'             => '5cd945ccc6287900475589f4',
            'finalAssetMcqAnswerA'                => '5cd945cdc6287900475589f6',
            'assetBriefWithoutImageMcqAnswerA'    => '5cd945cdc6287900475589f7',
            'assetBriefWithImageMcqAnswerA'       => '5cd945cdc6287900475589f8',
            'finalAssetMcqCorrectAnswer'          => '5cd945d1c628790047558a02',
            'assetBriefWithoutImageMcqCorrect'    => '5cd945d1c628790047558a03',
            'assetBriefWithImageMcqCorrect'       => '5cd945d1c628790047558a04',
            'finalAssetMarkScheme'                => '5cd9468ac6287900761ebfc6',
            'assetBriefMarkSchemeWithoutImage'    => '5cd946b5c6287900662ec477',
            'assetBriefMarkSchemeWithImage'       => '5cd946d7c6287900722fcc24',
            'audioAssetMarkScheme'                => '5cd946e4c62879007032cae6',
            'videoAssetMarkScheme'                => '5cd946f0c62879008b7e1515'
        ]
    ];

    public static $reviewItemWAssetTabularMarkScheme = [
        'itemid' => '5cd93b24c62879002020d474',
        'asset_workflowids' => [
            'finalAssetContentBlock'              => '5cd93d2ec62879002020d476',
            'assetBriefContentBlockWithoutImage'  => '5cd93d4dc62879001e5cd9c4',
            'assetBriefContentBlockWithImage'     => '5cd93d8bc628790023785a63',
            'audioAssetContentBlock'              => '5cd93db0c6287900224d1465',
            'videoAssetContentBlock'              => '5cd93dd4c62879001e5cd9c6',
            'finalAssetMcqAnswerA'                => '5cd93df8c6287900176c77f5',
            'assetBriefWithoutImageMcqAnswerA'    => '5cd94217c62879003a2ebc43',
            'assetBriefWithImageMcqAnswerA'       => '5cd942b7c62879001e5cd9c8',
            'finalAssetMcqCorrectAnswer'          => '5cd93e1dc62879002020d478',
            'assetBriefWithoutImageMcqCorrect'    => '5cd94313c6287900224d1468',
            'assetBriefWithImageMcqCorrect'       => '5cd94326c62879002122e567',
            'finalAssetQuestionBlock'             => '5cd93e3ac628790023785a65',
            'assetBriefQuestionBlockWithoutImage' => '5cd93e70c62879001e5cd9c7',
            'assetBriefQuestionBlockWithImage'    => '5cd93e7fc6287900196dfb44',
            'audioAssetQuestionBlock'             => '5cd93e91c62879002122e564',
            'videoAssetQuestionBlock'             => '5cd93ea0c62879002020d47a',
            'finalAssetMarkScheme'                => '5cd9440bc6287900144be246',
            'assetBriefMarkSchemeWithoutImage'    => '5cd9441ac62879004e396e33',
            'assetBriefMarkSchemeWithImage'       => '5cd94428c62879002122e568',
            'audioAssetMarkScheme'                => '5cd94438c62879001e5cd9ca',
            'videoAssetMarkScheme'                => '5cd9444fc62879002020d47d'
        ]
    ];

    public static $reviewedItemWAssets = [
        'itemid' => '59ca4f02807b83395d326a64',
        'asset_workflowids' => []
    ];

    public static $reviewedItemWSubmittedDragDropAsset = [
        'itemid' => '59c2b689807b837d047f11f4',
        'asset_workflowids' => ['59c2b6cc807b837df5276275']
    ];

    public static $approvedItemWCompletedAudioAssets = [
        'itemid' => '59c2124a807b8368982f0574',
        'asset_workflowids' => []
    ];

    public static $archivedItemWCompletedAssets = [
        'itemid' => '59c2b331807b8379b06d70e4',
        'asset_workflowids' => []
    ];

    // The following items are in "Paper with assets" (paperid 59c20ffe807b83686b3c8f64)
    public static $reviewedItemWDraftTextAsset = [
        'itemid' => '59c183f7807b8356cc053b14',
        'asset_workflowids' => ['59c1842f807b8355c67dfb64']
    ];

    public static $reviewedItemWDraftImageAsset = [
        'itemid' => '59c184a0807b8356ff58e9c4',
        'asset_workflowids' => ['59c18533807b8357965d3f24']
    ];

    public static $reviewedItemWSubmittedAsset = [
        'itemid' => '59c185ad807b8356c20df4a4',
        'asset_workflowids' => ['59c185d4807b83580b2d8604']
    ];

    public static $reviewedItemWRequestedAsset = [
        'itemid' => '59c18684807b8358f24e6864',
        'asset_workflowids' => ['59c18694807b83598f755d74']
    ];

    public static $reviewedItemWChangeAsset = [
        'itemid' => '59c186e8807b8359bc794254',
        'asset_workflowids' => ['59c1872c807b8359fb652b95']
    ];

    // The following item is in "Paper with copyright not cleared" (paperid)
    public static $reviewedItemWApprovedNotCopyrightClearedAsset = [
        'itemid' => '59c18352807b835614113324',
        'asset_workflowids' => ['59c18389807b8356164b4fb5']
    ];

    public static $draftItemOtherSubject = ['itemid' => '59c2c1d4807b830a9d7be794'];
    public static $reviewItemOtherSubject = ['itemid' => '59c2c227807b830a1d6f25d4'];
    public static $reviewedItemOtherSubject = ['itemid' => '59c2c27f807b830bad2ffb34'];
    public static $approvedItemOtherSubject = ['itemid' => '59c2c179807b830a776d3194'];

    public static $draftItemOtherAuthor = ['itemid' => '59c2c30a807b830c2d4f5f04'];
    public static $reviewItemOtherReviewer = ['itemid' => '59c2c389807b830ca337a454'];
    public static $reviewedItemOtherAuthor = ['itemid' => '59ca395c807b83301426aac4'];
    public static $approvedItemOtherAuthor = ['itemid' => '59ca39c2807b83303225e304'];

    public static $reviewItemOtherAwardingbody = ['itemid' => '5975c588ae6844333c6df77c'];
    public static $approvedItemOtherAwardingbody = ['itemid' => '5975d03dae6844333c6df7a9'];

    public static $reviewedItemInNoPaper = ['itemid' => '5cd2fb0fc628790114278065'];
    public static $reviewedItemInOnePaper = ['itemid' => '5cd2fb20c62879010b4af496'];
    public static $reviewedItemInMultiplePapers = ['itemid' => '5cd2fb20c62879010b4af497'];

    /**
     *
     * Paper data
     *
     */

    public static $draftPaper = [
        'paperid' => '59f75804a26fc51ad0007bdf',
        'itemids' => ['59fe297aa26fc53ad8005e81'] // Reviewed
    ];

    public static $reviewPaper = [
        'paperid' => '59c20f23807b8367a80e3cc4',
        'itemids' => ['59c18251807b83559a271f34']
    ];

    public static $reviewedPaper = [
        'paperid' => '59c18e50807b835f7565c9e4',
        'itemids' => [
            '59c17e07807b8351e3354f24',
            '59c17e80807b835277443644',
            '59c8e750807b830155145694'
        ]
    ];

    public static $reviewedPaperWithOneReviewedItem = [
        'paperid' => '5cd2fd36c628790103322867',
        'itemids' => [
            '5cd2fb20c62879010b4af497',
        ]
    ];

    public static $reviewedPaperWithMultipleReviewedItems = [
        'paperid' => '5cd2fd71c62879011d0d1506',
        'itemids' => [
            '5cd2fb20c62879010b4af497',
            '5cd2fb20c62879010b4af496'
        ]
    ];

    public static $reviewedWithproofsPaper = [
        'paperid' => '59c8f3a5807b83032407e7f4',
        'itemids' => [
            '59c8e692807b837f5132d944',
            '59c8e701807b837f717d2a94'
        ]
    ];

    public static $reviewedPaperWAssets = [
        'paperid' => '',
        'itemids' => ['', '']
    ];

    public static $draftPaperWithAssets = [
        'paperid' => '5cd94dbbc6287900a859c3e4',
        'itemids' => [
            '5cd945d6c628790047558a0d',
            '5cd93b24c62879002020d474'
        ]
    ];

    public static $draftPaperOtherSubject = [
        'paperid' => '59ca3b26807b83312f1ed4f4',
        'itemids' => []
    ];

    public static $reviewPaperOtherSubject = [
        'paperid' => '59ca3c2c807b83318a72a9e4',
        'itemids' => ['59ca3b86807b833142655bb4']
    ];

    public static $draftPaperOtherAuthor = [
        'paperid' => '59ca3aec807b8330f83a3924',
        'itemids' => []
    ];

    public static $reviewPaperOtherReviewer = [
        'paperid' => '59ca3cae807b83322d3991e4',
        'itemids' => ['59ca3be6807b833142655bb5']
    ];

    public static $reviewedPaperOtherAwardingbody = [
        'paperid' => '5979c21ece22e52c64f34448',
        'itemids' => [
            '5976f4a3ae6844333c6e4dcc',
            '5976f4a3ae6844333c6e4dcb',
            '5976f4a3ae6844333c6e4dc3'
        ]
    ];

    public static $reviewedPaperItemsInManyStates = [
        'paperid' => '59c18dc1807b835eb16dcae4',
        'itemids' => [
            '59c17fff807b8353974aa5d4', // Change
            '59c180e0807b83543e66f404', // Review
            '59c18136807b835484279985', // Reviewed
            '59c1819a807b835484279986', // Approved
            '59c181dd807b835550494aa4'
        ], // Pre-test
    ];

    public static $reviewedPaperSharingItemsWOtherPaper = [
        'paperid' => '59c20d5f807b8365d056e205',
        'itemids' => [
            '59c17ee8807b83526b036254', // In other paper, approved
            '59c17f55807b8353471e2954', // In other paper, reviewed
            '59c20e8b807b83670c108044'
        ],
    ];

    // Added general paper reviewer as reviewer for this paper
    public static $reviewPaperOtherAwardingbody = [
        'paperid' => '5979c038ce22e52c64f34447',
        'itemids' => [
            '5976f4a3ae6844333c6e4dcc',
            '5976f4a3ae6844333c6e4dcb',
            '5976f4a3ae6844333c6e4dc3'
        ]
    ];

    public static $examreadyPaper = [
        'paperid' => '59c90289807b830cc41735a4',
        'itemids' => [
            '59c8fb76807b8307a8141484',
            '59c8fbb9807b830779050694'
        ]
    ];

    public static $examreadyWithproofsPaper = [
        'paperid' => '59c90289807b830cc41735a4',
        'itemids' => [
            '59c8e750807b830155145694',
            '59c8e7af807b837fad05df84'
        ]
    ];

    public static $typeSettingWithproofsPaper = [
        'paperid' => '59c8f434807b83032a37ff44',
        'itemids' => ['59c8e80d807b8301bd7e31d4', '']
    ];

    public static $typesettingNoProofsPaper = [
        'paperid' => '59c21583807b836b20088ad4',
        'itemids' => [
            '59c215d8807b836b4a2ff6d4',
            '59c216c7807b836bee75d394'
        ]
    ];

    public static $inPretestPaper = [
        'paperid' => '59fe3263a26fc53ad8005e98',
        'itemids' => [
            '59fe2a6ea26fc53ad8005e85',
            '59fe29f0a26fc53ad8005e83'
        ]
    ];

    public static $changePaper = [
        'paperid' => '59fe33aea26fc53ad8005e9d',
        'itemids' => [
            '59fe2ceca26fc53ad8005e8b',  // Review
            '59fe2d97a26fc53ad8005e8d',  // Approved
            '59fe2b7ea26fc53ad8005e87']  // Reviewed
    ];

    public static $archivedPaper = [
        'paperid' => '59fe3407a26fc53ad8005e9f',
        'itemids' => [
            '59fe2f42a26fc53ad8005e91',
            '59fe2ec6a26fc53ad8005e8f'
        ]
    ];

    public static $rejectedPaper = [
        'paperid' => '59fe3468a26fc53ad8005ea1',
        'itemids' => [
            '59fe30d2a26fc53ad8005e95',
            '59fe3008a26fc53ad8005e93'
        ]
    ];

    /**
     * User specific data
     * - for example draft items are only editable by the author
     */

    // ItemSetterPaperSetter Maths - Maths A-Level
    public static $itemSetterPaperSetterMaths = [
        'paperDraftWithDraftItem' => [
            'paperid' => '5cc857f3c62879010319f134',
            'itemids' => [
                '5cc80356c62879009b51c465'
            ]
        ],
        'paperDraftWithMultipleDraftItems' => [
            'paperid' => '5cc857e0c6287900ff6a0306',
            'itemids' => [
                '5cc85843c6287900e11e67df',
                '5cc80356c62879009b51c465'
            ]
        ],
        'draftPaperWithSharedItems' => [
            'paperid' => '5cc71fd14fde632880038aab',
            'items' => [
                ['id' => '5cc720044fde632880038aac', 'name' => 'Draft shared item' ], // draft
                ['id' => '5cd424e54fde635c5120eada', 'name' => 'Draft shared item 2' ], // draft
            ]
        ],
        'anotherDraftPaperWithSharedItems' => [
            'paperid' => '5cc867f74fde632880038ad3',
            'items' => [
                ['id' => '5cc720044fde632880038aac', 'name' => 'Draft shared item' ], // draft
                ['id' => '5cd424e54fde635c5120eada', 'name' => 'Draft shared item 2' ], // draft
            ]
        ],
        'draftPaperOwnDraftAndChangeItems' => [
            'paperid' => '5cf91342d7271c14cc006130',
            'items' => [
                ['id' => '5cf9134cd7271c14cc006131', 'name' => 'Item created from Paper "Draft paper with its own items" - Draft' ], // draft
                ['id' => '5cf913d1d7271c14cc006137', 'name' => 'Item created from Paper "Draft paper with its own items" - Change' ], // change
                ['id' => '5cf91a16d7271c14cc006147', 'name' => 'Another Item created from Paper - Draft' ], // draft
                ['id' => '5cf91a35d7271c14cc006149', 'name' => 'Another Item created from Paper - Change' ], // change
            ]
        ],
        'itemDraftNotInPaper' => ['itemid' => '5cc306f4c6287902a50445e7'],
        'itemDraftInOnePaper' => ['itemid' => '5cc80309c62879009e78ce66'],
        'itemDraftInTwoPapers' => ['itemid' => '5cc80356c62879009b51c465'],
        'itemChangeNotInPaper' => ['itemid' => '5cc80420c62879009e78ce67'],
        'itemChangeInOnePaper' => ['itemid' => '5cc80452c62879009b51c466'],
        'itemChangeInTwoPapers' => ['itemid' => '5cc8045cc6287900a666cd03'],
    ];


    // ItemSetterPaperSetter Maths - Maths A-Level
    public static $itemSetterPaperReviewerMaths = [
        'paperReviewOneDraftOneChangeItem' => [
            'paperid' => '5cc9d4fec6287901fb6418a6',
            'itemids' => [
                '5cc9d39cc6287901f0255c38',
                '5cc9d3bfc6287901f5265607'
            ]
        ],
        'paperReviewMultipleDraftChangeItems' => [
            'paperid' => '5cc9d5b8c62879020a06de53',
            'itemids' => [
                '5cc9d3d8c6287901f0255c39',
                '5cc9d3edc6287901e86bc2f9',
                '5cc9d39cc6287901f0255c38',
                '5cc9d3bfc6287901f5265607'
            ]
        ],
        'itemDraftNotInPaper' => ['itemid' => '5cc9d351c6287901d323d7b5'],
        'itemDraftInOnePaper' => ['itemid' => '5cc9d3d8c6287901f0255c39'],
        'itemDraftInTwoPapers' => ['itemid' => '5cc9d39cc6287901f0255c38'],
        'itemChangeNotInPaper' => ['itemid' => '5cc9d36bc6287901f705c134'],
        'itemChangeInOnePaper' => ['itemid' => '5cc9d3edc6287901e86bc2f9'],
        'itemChangeInTwoPapers' => ['itemid' => '5cc9d3bfc6287901f5265607']
    ];

    // ItemSetterPaperApprover Maths - Maths A-Level
    public static $itemSetterPaperApproverMaths = [
        'paperReviewedOneChangeOneDraftItem' => [
            'paperid' => '5cd2a3d4c6287900c224c4c7',
            'itemids' => [
                '5cd2a2aec6287900b77b8678',
                '5cd2a2aec6287900b77b8675'
            ]
        ],
        'paperReviewedMultipleChangeDraftItems' => [
            'paperid' => '5cd2a44bc6287900c72636a4',
            'itemids' => [
                '5cd2a2aec6287900b77b8674',
                '5cd2a2aec6287900b77b8675',
                '5cd2a2aec6287900b77b8677',
                '5cd2a2aec6287900b77b8678'
            ]
        ],
        'itemDraftNotInPaper' => ['itemid' => '5cd2a298c6287900b6207195'],
        'itemDraftInOnePaper' => ['itemid' => '5cd2a2aec6287900b77b8674'],
        'itemDraftInTwoPapers' => ['itemid' => '5cd2a2aec6287900b77b8675'],
        'itemChangeNotInPaper' => ['itemid' => '5cd2a2aec6287900b77b8676'],
        'itemChangeInOnePaper' => ['itemid' => '5cd2a2aec6287900b77b8677'],
        'itemChangeInTwoPapers' => ['itemid' => '5cd2a2aec6287900b77b8678']
    ];

    // ItemSetterPaperSetter Maths - Maths A-Level
    public static $itemSetterTypesetterMaths = [
        'paperTypesettingTwoChangeItem' => [
            'paperid' => '5cd188efc628790041525734',
            'itemids' => [
                '5cd15faac62879002654a555',
                '5cd2a793c6287900d60f2d45' // ItemSetterPaperApprover
            ]
        ],
        'paperTypesettingMultipleChangeItems' => [
            'paperid' => '5cd18964c62879003f57d314',
            'itemids' => [
                '5cd15f9fc628790013411c15',
                '5cd15faac62879002654a555',
                '5cd2a787c6287900d31d1be4', // ItemSetterPaperApprover
                '5cd2a793c6287900d60f2d45' // ItemSetterPaperApprover
            ]
        ],
        'itemDraftNotInPaper' => ['itemid' => '5cd15c2ac62879001920eec5'],
        'itemDraftInOnePaper' => ['itemid' => '5cd15c6dc628790013411c14'],
        'itemDraftInTwoPapers' => ['itemid' => '5cd15ef6c62879001a3232f5'],
        'itemChangeNotInPaper' => ['itemid' => '5cd15f94c62879002b1543f4'],
        'itemChangeInOnePaper' => ['itemid' => '5cd15f9fc628790013411c15'],
        'itemChangeInTwoPapers' => ['itemid' => '5cd15faac62879002654a555']
    ];

    // ItemSetter Maths - Maths A-Level
    public static $itemSetterMaths = [
        'paperReviewTwoItems' => [
            'paperid' => '5cd2d889c6287901050f9769',
            'itemids' => [
                '5cd2d6bec62879010229d845',
                '5cd2d6bec62879010229d848'
            ]
        ],
        'paperReviewMultipleItems' => [
            'paperid' => '5cd2d8bbc6287901083d8d84',
            'itemids' => [
                '5cd2d6bec62879010229d844',
                '5cd2d6bec62879010229d845',
                '5cd2d6bec62879010229d847',
                '5cd2d6bec62879010229d848'
            ]
        ],
        'itemDraftNotInPaper' => ['itemid' => '5cd2d6a6c62879010163e444'],
        'itemDraftInOnePaper' => ['itemid' => '5cd2d6bec62879010229d844'],
        'itemDraftInTwoPapers' => ['itemid' => '5cd2d6bec62879010229d845'],
        'itemChangeNotInPaper' => ['itemid' => '5cd2d6bec62879010229d846'],
        'itemChangeInOnePaper' => ['itemid' => '5cd2d6bec62879010229d847'],
        'itemChangeInTwoPapers' => ['itemid' => '5cd2d6bec62879010229d848']
    ];

    // ItemApproverPaperSetter Maths - Maths A-Level
    public static $itemApproverPaperSetterMaths = [
        'draftPaperMultipleItems' => [
            'paperid' => '5cd30174c62879010332286a',
            'itemids' => [
                '5cd30202c62879012a46f5f7',
                '5cd2fb20c62879010b4af497'
            ]
        ],
        'draftPaperOneItem' => [
            'paperid' => '5cd30717c62879013b0ff783',
            'itemids' => [
                '5cd2fb20c62879010b4af497'
            ]
        ],
        'reviewedPaperWithSharedItems' => [
            'paperid' => '5ccaddb44fde632880038b21',
            'items' => [
                ['id' => '5cc719634fde632880038a8b', 'name' => 'Shared Reviewd Item JB' ], // reviewed
                ['id' => '5ccae5074fde632880038b41', 'name' => 'Shared Reviewd Item JB 2' ], // reviewed
            ]

        ],
        'anotherReviewedPaperWithSharedItems' => [
            'paperid' => '5ccae6644fde632880038b49',
            'items' => [
                ['id' => '5cc719634fde632880038a8b', 'name' => 'Shared Reviewd Item JB' ], // reviewed
                ['id' => '5ccae5074fde632880038b41', 'name' => 'Shared Reviewd Item JB 2' ], // reviewed
            ]

        ],
    ];

    // ItemApproverPaperReviwer Maths - Maths A-Level
    public static $itemApproverPaperReviewerMaths = [
        'reviewPaperMultipleItems' => [
            'paperid' => '5cd3d8f6c62879013d3c7cd3',
            'itemids' => [
                '5cd3da15c62879013c08ef76',
                '5cd2fb20c62879010b4af497'
            ]
        ]
    ];

    // ItemApproverPaperApprover Maths - Maths A-Level
    public static $itemPaperApproverMaths = [
        'reviewedPaperMultipleItems' => [
            'paperid' => '5cd3e83fc62879013007e117',
            'itemids' => [
                '5cd3ec6bc62879013007e119', // In this paper only
                '5cd2fb20c62879010b4af497' // In multiple papers
            ]
        ],
        'reviewedPaperOneItem' => [
            'paperid' => '5cd3e875c62879013007e118',
            'itemids' => [
                '5cd2fb20c62879010b4af497'
            ]
        ]
    ];

    // ItemApproverTypesetter Maths - Maths A-Level
    public static $itemApproverTypesetterMaths = [
        'typesettingPaperMultipleItems' => [
            'paperid' => '5cd3f4dec62879015945a4e4',
            'itemids' => [
                '5cd3f47bc628790157702434',
                '5cd2fb20c62879010b4af497'
            ]
        ],
        'typesettingPaperOneItem' => [
            'paperid' => '5cd3f508c62879015d46ea74',
            'itemids' => [
                '5cd2fb20c62879010b4af497'
            ]
        ]
    ];

    // ItemApproverTypesetter Maths - Maths A-Level
    public static $typesetterMaths = [
        'typesettingPaperMultipleItems' => [
            'paperid' => '5cd57904c62879027a11ec27',
            'itemids' => [
                '5cd57a4ac62879028c77eab4',
                '5cd2fb20c62879010b4af497'
            ]
        ],
        'typesettingPaperOneItem' => [
            'paperid' => '5cd5793cc62879028b4a4e95',
            'itemids' => [
                '5cd2fb20c62879010b4af497'
            ]
        ]
    ];

    // Paper ids for paper approver tests
    public static $paperWithDraftItem = '5cc2f38d5279bf2cb74b7389';
    public static $paperWithPretestItemToBeSentToPretest = '5cc6aae75279bf6a19582003';
    public static $paperWithPretestItemToBeSentToExamReady = '5cc6b8bc5279bf6bbc5be1b5';
    public static $paperWithPretestItemToBeSentToTypesetting = '5cc6b8cf5279bf6bb9069b16';
    public static $paperWithPretestItemToBeSentToArchive = '5cc6b8d85279bf6bb20f4578';
    public static $paperWithPretestItemToBeSentToArchiveWithItemsIncluded = '5cc803185279bf7d572b4b35';

    public static $paperWithReviewedItemToBeSentToPretest = '5cc818f05279bf7fd84a7cb6';
    public static $paperWithReviewedItemToBeSentToExamReady = '5cc819025279bf017b3d652b';
    public static $paperWithReviewedItemToBeSentToTypesetting = '5cc819155279bf01871c9825';
    public static $paperWithReviewedItemToBeSentToArchive = '5cc819255279bf7fd84a7cb8';
    public static $paperWithReviewedItemToBeSentToArchiveWithItemsIncluded = '5cc819355279bf01e277bd65';

    public static $paperWithApprovedItemToBeSentToPretest = '5cc95c835279bf15b21e3065';
    public static $paperWithApprovedItemToBeSentToExamReady = '5cc95c605279bf15624d95f5';
    public static $paperWithApprovedItemToBeSentToTypesetting = '5cc95c345279bf154a5a7bf5';
    public static $paperWithApprovedItemToBeSentToArchive = '5cc95c415279bf155a05a696';
    public static $paperWithApprovedItemToBeSentToArchiveWithItemsIncluded = '5cc95c505279bf155c677006';

    public static $paperWithItemsUsedInOtherPaperToBeSentToPreTest = '5cca9ed95279bf2934219141';
    public static $paperWithItemsUsedInOtherPaperToBeSentToExamReady = '5cca9ec85279bf2ac71e5e97';
    public static $paperWithItemsUsedInOtherPaperToBeSentToTypesetting = '5cca9ee75279bf2b1a05da47';
    public static $paperWithItemsUsedInOtherPaperToBeSentToArchive = '5cca9ef55279bf2b1b06d047';

    public static $paperWithChangeItem = '5cc85cf35279bf05773dae96';
    public static $paperWithReviewItem = '5cc9580f5279bf1552766305';

    public static $paperWithUnapprovedAssets = '5cc99ea35279bf16b93bc40e';
    public static $paperWithNonCopyrightClearedAssets = '5cc9af925279bf17c628f20b';

    //Pretest paper with 2 items
    public static $paperToPretestWithItemInItemBankAndItemInPretest = '5cc9c503232b393f9e62a8f9';

    public static $allGeneralMaths = [
        'reviewedPaperAllSharedItems' => [
            'paperid' => '5cd1d25c4fde632b0101a62a',
            'items' => [
                ['id' => '5cd1d2a14fde632b0101a62b', 'name' => 'All General draft item' ], // draft
                ['id' => '5cd1d3384fde632b0101a631', 'name' => 'All General change item' ], // change
                ['id' => '5cd1d3f84fde632b0101a635', 'name' => 'All General reviewed item' ], // reviewed
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1d6594fde632b0101a64b', 'name' => 'All General rejected item' ], // rejected
                ['id' => '5cd1e4a74fde635c5120e9a3', 'name' => 'All General draft item 2' ], // draft
                ['id' => '5cd1e55a4fde635c5120e9a4', 'name' => 'All General change item 2' ], // change
                ['id' => '5cd1e6514fde635c5120e9ac', 'name' => 'All General reviewed item 2' ], // reviewed
                ['id' => '5cd1e72d4fde635c5120e9af', 'name' => 'All General approved item 2' ], // approved
                ['id' => '5cd271a84fde635c5120e9b8', 'name' => 'All General pre-test item 2' ], // pre-test
                ['id' => '5cd271f04fde635c5120e9be', 'name' => 'All General archive item 2' ], // archive
                ['id' => '5cd2724c4fde635c5120e9c4', 'name' => 'All General rejected item 2' ], // rejected
            ],
        ],
        'anotherReviewedPaperAllSharedItems' => [
            'paperid' => '5cd1d7324fde632b0101a651',
            'items' => [
                ['id' => '5cd1d2a14fde632b0101a62b', 'name' => 'All General draft item' ], // draft
                ['id' => '5cd1d3384fde632b0101a631', 'name' => 'All General change item' ], // change
                ['id' => '5cd1d3f84fde632b0101a635', 'name' => 'All General reviewed item' ], // reviewed
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1d6594fde632b0101a64b', 'name' => 'All General rejected item' ], // rejected
                ['id' => '5cd1e4a74fde635c5120e9a3', 'name' => 'All General draft item 2' ], // draft
                ['id' => '5cd1e55a4fde635c5120e9a4', 'name' => 'All General change item 2' ], // change
                ['id' => '5cd1e6514fde635c5120e9ac', 'name' => 'All General reviewed item 2' ], // reviewed
                ['id' => '5cd1e72d4fde635c5120e9af', 'name' => 'All General approved item 2' ], // approved
                ['id' => '5cd271a84fde635c5120e9b8', 'name' => 'All General pre-test item 2' ], // pre-test
                ['id' => '5cd271f04fde635c5120e9be', 'name' => 'All General archive item 2' ], // archive
                ['id' => '5cd2724c4fde635c5120e9c4', 'name' => 'All General rejected item 2' ], // rejected

            ],
        ],
        'reviewedPaperNoSharedItems' => [
            'paperid' => '5d08cb67d7271c1424002b16',
            'items' => [
                ['id' => '5d08cb66d7271c1424002b0c', 'name' => 'All General draft item - in single paper' ], // draft
                ['id' => '5d08cb66d7271c1424002b0d', 'name' => 'All General change item - in single paper' ], // change
                ['id' => '5d08cb66d7271c1424002b14', 'name' => 'All General review item - in single paper' ], // reviewed
                ['id' => '5d08cb66d7271c1424002b0e', 'name' => 'All General reviewed item - in single paper' ], // reviewed
                ['id' => '5d08cb66d7271c1424002b0f', 'name' => 'All General approved item - in single paper' ], // approved
                ['id' => '5d08cb66d7271c1424002b10', 'name' => 'All General pre-test item - in single paper' ], // pre-test
                ['id' => '5d08cb66d7271c1424002b11', 'name' => 'All General archive item - in single paper' ], // archive
                ['id' => '5d08cb66d7271c1424002b12', 'name' => 'All General rejected item - in single paper' ], // rejected
            ],
        ],
        'typesettingPaperAllSharedItems' => [
            'paperid' => '5cd96eb74fde6341c9636582',
            'items' => [
                ['id' => '5cd1d3f84fde632b0101a635', 'name' => 'All General reviewed item' ], // reviewed
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1e6514fde635c5120e9ac', 'name' => 'All General reviewed item 2' ], // reviewed
                ['id' => '5cd1e72d4fde635c5120e9af', 'name' => 'All General approved item 2' ], // approved
                ['id' => '5cd271a84fde635c5120e9b8', 'name' => 'All General pre-test item 2' ], // pre-test
                ['id' => '5cd271f04fde635c5120e9be', 'name' => 'All General archive item 2' ], // archive
            ],
        ],
        'approvedPaperAllSharedItems' => [
            'paperid' => '5cda5f8c4fde6341c96365d0',
            'items' => [
                // First items are not in this paper, just here as placeholders to have same numbering as in other papers
                ['name' => 'All General draft item' ], // Not in this paper
                ['name' => 'All General change item' ], // Not in this paper
                ['name' => 'All General reviewed item' ], // Not in this paper
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1d6594fde632b0101a64b', 'name' => 'All General rejected item' ], // rejected

            ],
        ],
        'pretestPaperAllSharedItems' => [
            'paperid' => '5cda60f94fde6341c96365e8',
            'items' => [
                // First items are not in this paper, just here as placeholders to have same numbering as in other papers
                ['name' => 'All General draft item' ], // Not in this paper
                ['name' => 'All General change item' ], // Not in this paper
                ['name' => 'All General reviewed item' ], // Not in this paper
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1d6594fde632b0101a64b', 'name' => 'All General rejected item' ], // rejected
            ],
        ],
        'archivePaperAllSharedItems' => [
            'paperid' => '5cda61544fde6341c96365f2',
            'items' => [
                // First items are not in this paper, just here as placeholders to have same numbering as in other papers
                ['name' => 'All General draft item' ], // Not in this paper
                ['name' => 'All General change item' ], // Not in this paper
                ['name' => 'All General reviewed item' ], // Not in this paper
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1d6594fde632b0101a64b', 'name' => 'All General rejected item' ], // rejected
            ],
        ],
        'rejectedPaperAllSharedItems' => [
            'paperid' => '5cda61d24fde6341c96365f8',
            'items' => [
                // First items are not in this paper, just here as placeholders to have same numbering as in other papers
                ['name' => 'All General draft item' ], // Not in this paper
                ['name' => 'All General change item' ], // Not in this paper
                ['name' => 'All General reviewed item' ], // Not in this paper
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1d6594fde632b0101a64b', 'name' => 'All General rejected item' ], // rejected
            ],
        ],
        'reviewPaperAllSharedItems' => [
            'paperid' => '5cdd0df74fde6341c9636837',
            'items' => [
                ['id' => '5cd1d2a14fde632b0101a62b', 'name' => 'All General draft item' ], // draft
                ['id' => '5cd1d3384fde632b0101a631', 'name' => 'All General change item' ], // change
                ['id' => '5cd1d3f84fde632b0101a635', 'name' => 'All General reviewed item' ], // reviewed
                ['id' => '5cd1d4d24fde632b0101a639', 'name' => 'All General approved item' ], // approved
                ['id' => '5cd1d5484fde632b0101a63f', 'name' => 'All General pre-test item' ], // pre-test
                ['id' => '5cd1d5e94fde632b0101a645', 'name' => 'All General archive item' ], // archive
                ['id' => '5cd1d6594fde632b0101a64b', 'name' => 'All General rejected item' ], // rejected
                ['id' => '5cd1e4a74fde635c5120e9a3', 'name' => 'All General draft item 2' ], // draft
                ['id' => '5cd1e55a4fde635c5120e9a4', 'name' => 'All General change item 2' ], // change
                ['id' => '5cd1e6514fde635c5120e9ac', 'name' => 'All General reviewed item 2' ], // reviewed
                ['id' => '5cd1e72d4fde635c5120e9af', 'name' => 'All General approved item 2' ], // approved
                ['id' => '5cd271a84fde635c5120e9b8', 'name' => 'All General pre-test item 2' ], // pre-test
                ['id' => '5cd271f04fde635c5120e9be', 'name' => 'All General archive item 2' ], // archive
                ['id' => '5cd2724c4fde635c5120e9c4', 'name' => 'All General rejected item 2' ], // rejected

            ],
        ],
        'draftPaperReviewedItems' => [
            'paperid' => '5cf92a71d7271c14cc006216',
            'items' => [
                ['id' => '5cf92a79d7271c14cc006217', 'name' => 'First reviewed from "Draft paper with reviewed items"' ], // reviewed
                ['id' => '5cf92af0d7271c14cc00621b', 'name' => 'Second Item from "Draft paper with reviewed items"' ], // reviewed
            ],
        ]
    ];
}