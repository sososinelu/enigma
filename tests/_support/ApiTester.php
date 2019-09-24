<?php
use Helper\Database;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

    public $accessToken = "";

    public function loginAndRecordAccessToken($credentials)
    {
        $I = $this;
        $I->sendPOST('api/v1/user/login', [
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ]);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $this->accessToken = $I->grabDataFromResponseByJsonPath('$.access_token')[0];
        $I->haveHttpHeader('Authorization', 'Bearer '.$I->accessToken);
    }

    public function logout($accessToken = null)
    {
        if (!$accessToken) {
            $accessToken = $this->accessToken;
        }

        $I = $this;
        $I->haveHttpHeader('Authorization', 'Bearer '.$accessToken);
        $I->sendPOST('api/v1/user/logout', []);
        $this->accessToken = "";
    }

    public function logoutExpectSuccess($accessToken = null)
    {
        if (!$accessToken) {
            $accessToken = $this->accessToken;
        }

        $I = $this;
        $I->haveHttpHeader('Authorization', 'Bearer '.$accessToken);
        $I->sendPOST('api/v1/user/logout', []);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $this->accessToken = "";
    }

    public function logoutExpectFailure()
    {
        $I = $this;
        $I->haveHttpHeader('Authorization', 'Bearer '.$this->accessToken);
        $I->sendPOST('api/v1/user/logout', []);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::UNAUTHORIZED);
        $I->seeResponseIsJson();
        $this->accessToken = "";
    }

    /**
     * Clear one or all existing sessions in DB
     *
     * @param null $email
     */
    public function clearSession($email = null)
    {
        $db = new Database($this->scenario);
        if (!empty($email)) {
            $db->clearSession($email);
        } else {
            $db->dropSession();
        }
    }
}
