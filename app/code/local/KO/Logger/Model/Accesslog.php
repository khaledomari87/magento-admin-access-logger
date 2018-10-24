<?php
class KO_Logger_Model_Accesslog extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('ko_logger/accesslog');
    }
}