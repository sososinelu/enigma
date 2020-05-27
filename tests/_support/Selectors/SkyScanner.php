<?php
namespace Selectors;

class SkyScanner
{
    /**
     * Cookie policy popup
     */
    public static $cookiePolicyAccept = '//*[@id="cookie-banner-root"]/div[1]/div/div[3]/button[1]';

    /**
     * Homepage
     */
    public static $origin = '//*[@id="fsc-origin-search"]';
    public static $destination = '//*[@id="fsc-destination-search"]';
    public static $departDateDropdown = '//*[@id="depart-fsc-datepicker-button"]';
    public static $departDateWholeMonth = '//*[@id="depart-fsc-datepicker-popover"]/div/div/div[1]/div/nav/ul/li[2]/button';
    public static $departDateCheapestMonth = '//*[@id="depart-fsc-datepicker-popover"]/div/div/div[2]/div/button[1]';
    public static $travellersDropdown = '//*[@id="CabinClassTravellersSelector_fsc-class-travellers-trigger__1qSiF"]';
    public static $travellersDropdownIncrease = '#cabin-class-travellers-popover > div > div > div:nth-child(4) > div > button:nth-child(3)';
    public static $closeTravellersDropdown = '//*[@id="cabin-class-travellers-popover"]/footer/button';
    public static $flightsSearch = '//*[@id="flights-search-controls-root"]/div/div/form/div[3]/button';
}




