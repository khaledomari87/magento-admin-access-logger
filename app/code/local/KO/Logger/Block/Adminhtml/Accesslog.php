<?php

class KO_Logger_Block_Adminhtml_Accesslog extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'ko_logger';
        $this->_controller = 'adminhtml_accesslog';
        $this->_headerText = $this->__('Access Log');

        parent::__construct();
        $this->_removeButton('add');
        $this->_addButton('clear', array(
            'label'     => $this->__('Clear Old Records'),
            'class'     => 'delete',
            'onclick'   => $this->escapeHtml('if(confirm("All records older than ' .
                Mage::getStoreConfig('ko_logger_options/general/clear_logs_frequency') .
                ' minutes will be deleted! Continue?")) setLocation(\'' . $this->getClearUrl() .'\')'),
        ));
    }
    public function getClearUrl()
    {
        return $this->getUrl('*/*/clear');
    }
}