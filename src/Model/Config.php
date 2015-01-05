<?php
/**
 * Created by PhpStorm.
 * User: manuele
 * Date: 30/12/14
 * Time: 11:49
 */

class Webgriffe_ConfigTestAdapter_Model_Config extends EcomDev_PHPUnit_Model_Config
{
    /**
     * @var Webgriffe_Config_Model_Config_Override
     */
    protected $_configOverrideModel;

    public function __construct($sourceData = null)
    {
        parent::__construct($sourceData);
        $this->_configOverrideModel = new Webgriffe_Config_Model_Config_Override($this->_prototype);
    }

    public function loadBase()
    {
        parent::loadBase();
        $this->extend($this->_configOverrideModel->getBaseOverride());
        return $this;
    }

    /**
     * This override is needed because in the loadModules method Magento prevents local.xml overwriting that is
     * exactly what we have to do. So we need to re-override base configuration after the loadMoudles.
     *
     * @return $this|Mage_Core_Model_Config
     */
    public function loadModules()
    {
        parent::loadModules();
        $this->extend($this->_configOverrideModel->getBaseOverride());
        return $this;
    }

    public function loadDb()
    {
        parent::loadDb();
        $this->extend($this->_configOverrideModel->getOverride());
        return $this;
    }

    /**
     * @return \Webgriffe_Config_Model_Config_Override
     */
    public function getConfigOverrideModel()
    {
        return $this->_configOverrideModel;
    }
}
