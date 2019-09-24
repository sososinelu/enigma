<?php
namespace Step\Acceptance\Authoring;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Step\Acceptance\Authoring\AdvancedSearch as AdvancedSearchStep;

class AdvancedSearch extends \AcceptanceTester
{

    public function setAdvancedFilterValue($name, $operator = null, $value = null)
    {
        $I = $this;
        $I->selectOption('.custom-filters #searchCustomKey', $name);

        if ($operator) {
            $I->waitForElementVisible('.custom-filters #searchCustomOperator');
            $I->selectOption('.custom-filters #searchCustomOperator', $operator);
        }

        if ($value) {
            $I->executeInSelenium(function (RemoteWebDriver $remoteWebDriver) use ($I, $value) {
                if (is_array($value) && count($value) === 2) {
                    $lowerElem = $remoteWebDriver->findElement(WebDriverBy::cssSelector('.custom-filters #searchCustomValueLower'));
                    $upperElem = $remoteWebDriver->findElement(WebDriverBy::cssSelector('.custom-filters #searchCustomValueUpper'));
                    if ($lowerElem && $upperElem) {
                        $lowerElem->clear();
                        $lowerElem->sendKeys($value[0]);
                        $upperElem->clear();
                        $upperElem->sendKeys($value[1]);
                    }
                } else {
                    if (is_array($value)) {
                        $value = $value[0];
                    }
                    $elem = $remoteWebDriver->findElement(WebDriverBy::cssSelector('.custom-filters #searchCustomValue'));
                    switch ($elem->getTagName()) {
                        case 'input':
                            $I->fillField('.custom-filters #searchCustomValue', $value);
                            break;
                        case 'select':
                            $I->selectOption('.custom-filters #searchCustomValue', $value);
                            break;
                    }
                }
            });
        }

        $I->waitThenClick('button.add-custom-filter');
    }

    public function setSliderValue($sliderLabel, $minValue, $maxValue)
    {
        // Find element
        $I = $this;
        if (!in_array($sliderLabel, ['Facility', 'Difficulty', 'Discrimination'])) {
            return;
        }
        $parentSelector = sprintf('.d-xl-block .col[ng-if="itemData.%s"]', strtolower($sliderLabel));

        $I->checkOption($parentSelector . ' .fa-check');
        $I->executeInSelenium(function (RemoteWebDriver $remoteWebDriver) use ($minValue, $maxValue, $parentSelector) {
            $minPointer = $remoteWebDriver->findElement(WebDriverBy::cssSelector($parentSelector . ' .rz-pointer-min'));
            $maxPointer = $remoteWebDriver->findElement(WebDriverBy::cssSelector($parentSelector . ' .rz-pointer-max'));

            $minPossibleMinValue = $minPointer->getAttribute('aria-valuemin');
            $maxPossibleMinValue = $minPointer->getAttribute('aria-valuemax');
            $minValue = max($minPossibleMinValue, $minValue);
            $minValue = min($maxPossibleMinValue, $minValue);
            $remoteWebDriver->getMouse()->mouseDown($minPointer->getCoordinates());
            do {
                $currentMinValue = (float)$minPointer->getAttribute('aria-valuenow');
                $offset = ($minValue > $currentMinValue) ? 1 : -1;
                $remoteWebDriver->getMouse()->mouseMove(null, $offset, 0);
                $currentMinValue = (float)$minPointer->getAttribute('aria-valuenow');
            } while ($currentMinValue !== $minValue);

            $remoteWebDriver->getMouse()->mouseUp();

            $minPossibleMaxValue = $maxPointer->getAttribute('aria-valuemin');
            $maxPossibleMaxValue = $maxPointer->getAttribute('aria-valuemax');
            $maxValue = max($minPossibleMaxValue, $maxValue);
            $maxValue = min($maxPossibleMaxValue, $maxValue);
            $remoteWebDriver->getMouse()->mouseDown($maxPointer->getCoordinates());
            do {
                $currentMaxValue = (float)$maxPointer->getAttribute('aria-valuenow');
                $offset = ($maxValue > $currentMaxValue) ? 1 : -1;
                $remoteWebDriver->getMouse()->mouseMove(null, $offset, 0);
                $currentMaxValue = (float)$maxPointer->getAttribute('aria-valuenow');
            } while ($currentMaxValue !== $maxValue);

            $remoteWebDriver->getMouse()->mouseUp();
        });
    }

    public function clearAllFilters()
    {
        $I = $this;
        $I->executeInSelenium(function (RemoteWebDriver $remoteWebDriver) {
            $elements = $remoteWebDriver->findElements(WebDriverBy::cssSelector('a.trash-icon'));
            foreach ($elements as $element) {
                $remoteWebDriver->wait()->until(WebDriverExpectedCondition::elementToBeClickable(WebDriverBy::cssSelector('a.trash-icon')));
                $element->click();
            }
            $itemData = ['facility', 'difficulty', 'discrimination'];
            foreach ($itemData as $itemDatum) {
                try {
                    $checkbox = $remoteWebDriver->findElement(WebDriverBy::cssSelector('.d-xl-block .col[ng-if="itemData.' . $itemDatum . '"] input[type="checkbox"]'));
                } catch (NoSuchElementException $e) {
                    continue;
                }
                if ($checkbox->isSelected()) {
                    $label = $remoteWebDriver->findElement(WebDriverBy::cssSelector('.d-xl-block .col[ng-if="itemData.' . $itemDatum . '"] div.checkbox'));
                    $label->click();
                }
            }
        });
        $I->waitForElementVisible('.d-xl-block #searchStatus');
        $I->selectOption('.d-xl-block #searchStatus', 'All active');
    }
}