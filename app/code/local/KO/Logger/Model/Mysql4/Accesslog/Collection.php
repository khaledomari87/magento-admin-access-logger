<?php
class KO_Logger_Model_Mysql4_Accesslog_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('ko_logger/accesslog');
    }
}