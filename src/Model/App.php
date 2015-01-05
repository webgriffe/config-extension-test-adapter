<?php
/**
 * Created by PhpStorm.
 * User: manuele
 * Date: 30/12/14
 * Time: 11:48
 */

class Webgriffe_ConfigTestAdapter_Model_App extends EcomDev_PHPUnit_Model_App
{
    protected static $_configClass = 'Webgriffe_ConfigTestAdapter_Model_Config';

    /**
     * This method replaces application, event and config objects
     * in Mage to perform unit tests in separate Magento steam
     *
     */
    public static function applyTestScope()
    {
        // Save old environment variables
        self::$_oldApplication = EcomDev_Utils_Reflection::getRestrictedPropertyValue('Mage', '_app');
        self::$_oldConfig = EcomDev_Utils_Reflection::getRestrictedPropertyValue('Mage', '_config');
        self::$_oldEventCollection = EcomDev_Utils_Reflection::getRestrictedPropertyValue('Mage', '_events');
        self::$_oldRegistry = EcomDev_Utils_Reflection::getRestrictedPropertyValue('Mage', '_registry');


        // Setting environment variables for unit tests
        EcomDev_Utils_Reflection::setRestrictedPropertyValue('Mage', '_config', new self::$_configClass);
        EcomDev_Utils_Reflection::setRestrictedPropertyValue('Mage', '_app', new self);
        EcomDev_Utils_Reflection::setRestrictedPropertyValue('Mage', '_events', new self::$_eventCollectionClass);
        EcomDev_Utils_Reflection::setRestrictedPropertyValue('Mage', '_registry', array());

        // All unit tests will be run in admin scope, to get rid of frontend restrictions
        Mage::app()->initTest();
    }
} 
