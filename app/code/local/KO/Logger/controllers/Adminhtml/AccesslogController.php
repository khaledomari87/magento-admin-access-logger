<?php

class KO_Logger_Adminhtml_AccesslogController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title($this->__("Access Log"));
        $this->renderLayout();
    }

    public function loadparamsAction()
    {
        $logger = Mage::getModel('ko_logger/accesslog')->load($this->getRequest()->getParam('id'));
        $params = $logger->getParams();

        $params = unserialize(Mage::helper('core')->decrypt($params));
        if(empty($params))
            $params = 'N/A';
        $params = (string)var_export($params, true);
        $this->getResponse()->setBody($params);
        $this->getResponse()->setHeader('content-type', 'application/json', true);
    }

    public function clearAction()
    {
        $observer = new KO_Logger_Model_Observer();
        $interval = $observer->clearOldAccessLogs();
        Mage::getSingleton("core/session")->addSuccess("Access records older than $interval minutes have been deleted.");
        $this->_redirect('*/*/index');
    }
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('ko/ko_logger_accesslog');
    }
}
