<?php
namespace Step\Acceptance;

use AcceptanceTester;
use Page\Login as LoginPage;

class Login extends \AcceptanceTester
{
    /**
     * Login to the app with the supplied credentials
     * Assumes logins should be stored and reused, unless explicitly told not to
     *
     * @todo retainLogin works, but might not be what we want.  investigate later
     *
     * @param AcceptanceTester $I
     * @param $credentials
     * @param bool $retainLogin
     * @throws \Exception
     */
    public function login($credentials, $retainLogin = false)
    {
        $I = $this;
        $snapshotKey = 'login.'.md5(json_encode($credentials));
        if ($retainLogin && $I->loadSessionSnapshot($snapshotKey)) {
            return;
        }
        $I->amOnPage(LoginPage::$URL);
        $I->waitForElementClickable(LoginPage::$loginButton, 5);
        $I->fillField(LoginPage::$usernameField, $credentials['email']);
        $I->fillField(LoginPage::$passwordField, $credentials['password']);
        $I->click(LoginPage::$loginButton);
        $I->waitForElementNotVisible(LoginPage::$usernameField, 10);
        if ($retainLogin) {
            $I->saveSessionSnapshot($snapshotKey);
        }
    }

    /**
     * @param AcceptanceTester $I
     * @throws \Exception
     */
    public function logout()
    {
        $I = $this;
        $I->closePopup(); // Close any browser popups
        $I->moveMouseOver(LoginPage::$settingUsernameDropdown);
        $I->click(LoginPage::$clickLogoutDropDown);
        $I->waitForElementClickable(LoginPage::$yesButton);
        $I->click(LoginPage::$yesButton);
    }
}
