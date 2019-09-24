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

class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Clear one or all existing sessions in DB
     *
     * @param null $email
     */
    public function clearSession($email = null)
    {
        $I = $this;
        $I->closePopup(); // Close any browser popups

        $db = new Database($this->scenario);
        if (!empty($email)) {
            $db->clearSession($email);
        } else {
            $db->dropSession();
        }

        $db->removeItemLockedForEditing();
        $I->wait(0.5);
    }

    /**
     * Close popups
     *
     * @return void
     */
    public function closePopup()
    {
        $I = $this;
        try {
            $I->acceptPopup();
        } catch (Exception $e) {}

    }

	/**
	 * checkFileExists
	 *
	 * @param $filename
	 */
	public function checkFileExistsWithRetries($filename, $retries = 9, $interval = 1)
	{
		$I = $this;
		$exists = false;

		for($count = 0; $count < $retries; $count++) {

			$fileExists = count(glob($filename));
			if ($fileExists) {
				$exists = true;
				break;
			}
			$I->wait($interval);
		}

		\PHPUnit_Framework_Assert::assertTrue($exists);
	}

    /**
     * Wait for an element to become clickable, then click it
     *
     * @param string $element
     * @param int $timeout
     * @throws Exception
     */
    public function waitThenClick($element, $timeout = 30)
    {
        $I = $this;
        $I->waitForElementClickable($element, $timeout);
        $I->click($element);
    }

    /**
     * Waits for the page to reload, works by storing a reference to an element
     * on the current page and waiting for that reference to become stale.
     * @param callable|null $doBeforeReload
     * @param int $timeout
     */
    public function waitForReload(callable $doBeforeReload = null, $timeout = 30)
    {
        $I = $this;
        $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) use ($doBeforeReload, $timeout, $I) {
            $element = $webdriver->findElement(WebDriverBy::tagName('html'));
            if ($doBeforeReload !== null) {
                $doBeforeReload($I);
            }
            $webdriver->wait($timeout, 1)
                ->until(WebDriverExpectedCondition::stalenessOf($element));
        });
    }

    /**
     * Waits for an element to be visible and not empty
     *
     * @param $selector
     * @param int $timeout
     * @throws Exception
     */
    public function waitForElementNotEmpty($selector, $timeout = 30) {
        $I = $this;
        $I->waitForElementVisible($selector, $timeout);
        $I->waitForElementChange($selector, function(\Facebook\WebDriver\Remote\RemoteWebElement $el) {
            return !empty($el->getText());
        }, $timeout);
    }

    /**
     * Drag select (used for drag and drop)
     * @param $selector
     * @param $startX
     * @param $startY
     * @param $endX
     * @param $endY
     */
    public function dragSelect($selector, $startX, $startY, $endX, $endY)
    {
        $I = $this;
        $I->moveMouseOver($selector, $startX, $startY);
        $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $remoteWebDriver) {
            $remoteWebDriver->getMouse()->mouseDown();
        });
        $I->moveMouseOver($selector, $endX, $endY);
        $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $remoteWebDriver) {
            $remoteWebDriver->getMouse()->mouseUp();
        });
    }

    /**
     * Get the workflow id from the current url
     * Will fail if used on page other than /author/(paper|item)/<id>, /author/(paper|item)/edit/<id>
     * @return string
     */
    public function grabWorkflowIdFromCurrentUrl()
    {
        $I = $this;
        $workflowIdRegex = '~^/author/(?:item|paper)/(?:edit/)?([a-z\d]{24})~';
        $I->seeCurrentUrlMatches($workflowIdRegex);
        return $I->grabFromCurrentUrl($workflowIdRegex);
    }
}
