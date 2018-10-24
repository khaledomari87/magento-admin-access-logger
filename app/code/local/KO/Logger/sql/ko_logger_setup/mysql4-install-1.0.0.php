<?php

/**
 * @var Mage_Core_Model_Resource_Setup $this
 */
$this->startSetup();

$this->getConnection()->dropTable($this->getTable('ko_logger/accesslog'));

$table = $this->getConnection()
    ->newTable($this->getTable('ko_logger/accesslog'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'primary'   => true,
        'unsigned'  => true,
        'nullable'  => false,
    ), 'Entity id for the log row')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
        'default'   => Varien_Db_Ddl_Table::TIMESTAMP_INIT
    ), 'Record created date and time')
    ->addColumn('area', Varien_Db_Ddl_Table::TYPE_TEXT, 20, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Could be adminhtml/frontend')
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Logged in user id')
    ->addColumn('user_name', Varien_Db_Ddl_Table::TYPE_TEXT, 30, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Logged in user name')
    ->addColumn('action_name', Varien_Db_Ddl_Table::TYPE_TEXT, 20, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Accessed action name')
    ->addColumn('controller_name', Varien_Db_Ddl_Table::TYPE_TEXT, 20, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Accessed contorller name')
    ->addColumn('controller_module', Varien_Db_Ddl_Table::TYPE_TEXT, 20, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Accessed module')
    ->addColumn('params', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => true,
        'default'   => null,
    ), 'Passed parameters')
;
$this->getConnection()->createTable($table);

$this->endSetup();