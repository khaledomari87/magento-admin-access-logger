<?php

class KO_Logger_Model_Observer
{
    public function logAdminhtmlAccess(Varien_Event_Observer $observer)
    {
        if(!Mage::getStoreConfigFlag('ko_logger_options/general/enabled'))
            return;

        /* @var $session Mage_Admin_Model_Session */
        $session = Mage::getSingleton('admin/session');
        if(!$session->isLoggedIn())
            return;

        /* @var $request Mage_Core_Controller_Request_Http */
        $request = $observer->getEvent()->getControllerAction()->getRequest();
        $controller = $request->getControllerName();
        $action = $request->getActionName();

        $excludedPaths = Mage::getStoreConfig('ko_logger_options/general/excluded_paths');
        $excludedPaths = preg_split('/(,|\s)+/', $excludedPaths);

        if(!empty($excludedPaths) && in_array("{$controller}_{$action}", $excludedPaths))
            return;

        /* @var $logger KO_Logger_Model_Accesslog */
        $logger = Mage::getModel('ko_logger/accesslog');
        /* @var $userObj Mage_Admin_Model_User */
        $userObj = $session->getUser();
        $logger->setUserId($userObj->getUserId());
        $logger->setUserName($userObj->getUsername());

        $logger->setArea(Mage::app()->getStore()->isAdmin() ? 'adminhtml' : 'frontend');

        $module = $request->getControllerModule();
        if(Mage::helper('ko_logger')->endsWith($module, '_Adminhtml'))
            $module = substr($module, 0, -10);
        $logger->setControllerModule($module);
        $logger->setControllerName($controller);
        $logger->setActionName($action);

        $excludedParams = Mage::getStoreConfig('ko_logger_options/general/excluded_params');
        $excludedParams = preg_split('/(,|\s)+/', $excludedParams);
        $params = Mage::app()->getRequest()->getParams();
        $params = array_diff_key($params, array_flip($excludedParams));
        if(!empty($params))
        {
            $serialized = serialize($params);//mb_strlen(serialize((array)$arr), '8bit');
            $encrypedParams = Mage::helper('core')->encrypt($serialized);
            $logger->setParams($encrypedParams);
        }

        try {
            $logger->save();
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

    public function clearOldAccessLogs()
    {
        $interval = (int)Mage::getStoreConfig('ko_logger_options/general/clear_logs_frequency');
        if($interval <= 0 || $interval > 43200 /*30 days*/)
            $interval = 2 * 1440; //In minutes = 2 day
        /*@var Magento_Db_Adapter_Pdo_Mysql $writeConnection */
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $writeConnection->delete(
            $resource->getTableName('ko_logger/accesslog'),
            "created_at < DATE_SUB(NOW(), INTERVAL $interval MINUTE)"
        );
        return $interval;
    }
}