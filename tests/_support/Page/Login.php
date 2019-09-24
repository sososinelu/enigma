<?php
namespace Page;

class Login
{
    public static $URL = '/auth/login';

    // elements in login page
    public static $usernameField = "//input[@id='input-username']";
    public static $passwordField = "//input[@id='input-password']";
    public static $loginButton = '/html/body/div[2]/div/form/div[3]/button'; // @todo get this as an ID

    // logout elements (not specific to this page, but logically grouped with login)
    public static $settingUsernameDropdown = '#settingsDropdown';
    public static $clickLogoutDropDown = "//a[@href='#logoutPopup']";
    public static $yesButton = "//*[@id=\"logoutPopup\"]/div/div/div[3]/button";

    /**
     * The following roles are always for all subjects and qualifications
    */

    // Syllanbus manager (for all subjects and qualifications)
    public static $syllabusManager = [
        'email' => 'syllabus.manager@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Syllabus Manager'
    ];
    // User manager (for all subjects and qualifications)
    public static $userManager = [
        'email' => 'user.manager@grademaker.com',
        'password' => 'Testing1',
        'name' => 'User Manager'
    ];

    /**
     * The following users have only permissions for A-level Maths
    */

    // Item setter on Maths / A-level only
    public static $itemSetter = [
        'email' => 'itemsetter.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Itemsetter Maths'
    ];
	
	// Item setter and item approver on General
	public static $itemSetterItemApprover = [
		'email' => 'itemsetter.itemapprover.general@grademaker.com',
		'password' => 'Testing1',
		'name' => 'ItemSetterApprover General'
	];
	
    // Item reviewer on Maths / A-level only
    public static $itemReviewer = [
        'email' => 'itemreviewer.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemReviewer Maths'
    ];
    // Item approver on Maths / A-level only
    public static $itemApprover = [
        'email' => 'itemapprover.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemApprover Maths'
    ];
    // AssetManager on Maths / A-level only
    public static $assetManager = [
        'email' => 'assetmanager.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'AssetManager Maths'
    ];
    // Paper setter on Maths / A-level only
    public static $paperSetter = [
        'email' => 'papersetter.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'PaperSetter Maths'
    ];
    // Paper reviewer on Maths / A-level only
    public static $paperReviewer = [
        'email' => 'paperreviewer.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'PaperReviewer Maths'
    ];
    // Paper approver on Maths / A-level only
    public static $paperApprover = [
        'email' => 'paperapprover.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'PaperApprover Maths'
    ];
	// Paper setter and paper approver on General
	public static $paperSetterPaperApprover = [
		'email' => 'papersetter.paperapprover.general@grademaker.com',
		'password' => 'Testing1',
		'name' => 'PaperSetterApprover General'
	];
    // Typesetter on Maths / A-level only
    public static $typeSetter = [
        'email' => 'typesetter.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Typesetter Maths'
    ];
    // Item setter and paper setter on Maths / A-level only
    public static $itemSetterPaperSetter = [
        'email' => 'itemsetterpapersetter.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemSetter PaperSetter Maths'
    ];
    // Item setter and paper setter on Maths / A-level only
    public static $itemSetterPaperReviewer = [
        'email' => 'itemsetterpaperreviewer.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemSetter PaperReviewer Maths'
    ];
    // Item setter and paper setter on Maths / A-level only
    public static $itemSetterPaperApprover = [
        'email' => 'itemsetterpaperapprover.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemSetter PaperApprover Maths'
    ];
    // Item setter and typesetter on Maths / A-level only
    public static $itemSetterTypesetter = [
        'email' => 'itemsettertypesetter.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemSetter Typesetter Maths'
    ];
    // Item approver and paper setter on Maths / A-level only
    public static $itemApproverPaperSetter = [
        'email' => 'itemapproverpapersetter.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemApprover PaperSetter Maths'
    ];
    // Item approver and paper approver on Maths / A-level only
    public static $itemApproverPaperApprover = [
        'email' => 'approver.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Approver Maths'
    ];
    // Item approver and paper approver on Maths / A-level only
    public static $itemApproverPaperReviewer = [
        'email' => 'itemapproverpaperreviewer.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemApprover PaperReviewer Maths'
    ];
    // Item approver and paper approver on Maths / A-level only
    public static $itemApproverTypesetter = [
        'email' => 'itemapprovertypesetter.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemApprover Typesetter Maths'
    ];

    // Syllabus editor on Maths / A-level only
    public static $syllabusEditor = [
        'email' => 'syllabuseditor.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'SyllabusEditor Maths'
    ];
    // Analytic on Maths / A-level only
    public static $analytic = [
        'email' => 'analytic.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Analytic Maths'
    ];

    // User with all permissions on Maths / A-level only
    public static $all = [
        'email' => 'all.maths@grademaker.com',
        'password' => 'Testing1',
        'name' => 'All Maths'
    ];
    
    /**
     * The following users have their permissions for all subjects and qualifications
    */

    // Item setter for all subjects and qualifications
    public static $itemSetterGeneral = [
        'email' => 'itemsetter.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Item General'
    ];
    // Item reviewer for all subjects and qualifications
    public static $itemReviewerGeneral = [
        'email' => 'itemreviewer.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemReviewer General'
    ];
    // Item approver for all subjects and qualifications
    public static $itemApproverGeneral = [
        'email' => 'itemapprover.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'ItemApprover General'
    ];
    // AssetManger for all subjects and qualifications
    public static $assetManagerGeneral = [
        'email' => 'assetmanager.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'AssetManager General'
    ];
    // Paper setter for all subjects and qualifications
    public static $paperSetterGeneral = [
        'email' => 'papersetter.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Paper General'
    ];
    // Paper reviewer for all subjects and qualifications
    public static $paperReviewerGeneral = [
        'email' => 'paperreviewer.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'PaperReviewer General'
    ];
    // Paper approver for all subjects and qualifications
    public static $paperApproverGeneral = [
        'email' => 'paperapprover.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'PaperApprover General'
    ];
    // Typesetter for all subjects and qualifications
    public static $typesetterGeneral = [
        'email' => 'typesetter.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Typesetter General'
    ];

    // Syllabus editor for all subjects and qualifications
    public static $syllabusEditorGeneral = [
        'email' => 'syllabuseditor.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'SyllabusEditor General'
    ];
    // Analytic for all subjects and qualifications
    public static $analyticGeneral = [
        'email' => 'analytic.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Analytic General'
    ];

    // User with all permissions for all subjects and qualifications
    public static $allGeneral = [
        'email' => 'all.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'All General'
    ];
    

    /**
     * The following users have no permissions
    */

    // User set to "Not active"
    public static $notActive = [
        'email' => 'notactive.general@grademaker.com',
        'password' => 'Testing1',
        'name' => 'NotActive General'
    ];

    /**
     * The following users have all permissions
    */

    public static $apiTestAll = [
        'email' => 'apitest@grademaker.com',
        'password' => 'Testing1',
        'name' => 'Apitest All'
    ];
    
    /**
     * These users are for the advanced search testing AB
     */
    public static $astAllRoles = [
        'email' => 'ast.allroles@grademaker.com',
        'password' => 'Testing1',
        'name' => 'AST AllRoles',
    ];
    
    public static $astSetter = [
        'email' => 'ast.setter@grademaker.com',
        'password' => 'Testing1',
        'name' => 'AST Setter',
    ];

    public static $astMainSetter = [
        'email' => 'ast.mainsetter@grademaker.com',
        'password' => 'Testing1',
        'name' => 'AST MainSetter',
    ];

    public static $astUserManager = [
        'email' => 'ast.usermanager@grademaker.com',
        'password' => 'Testing1',
        'name' => 'AST UserManager',
    ];
}
