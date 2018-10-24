<?php
class KO_Logger_Model_Mysql4_Accesslog extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('ko_logger/accesslog', 'entity_id');
    }
}
