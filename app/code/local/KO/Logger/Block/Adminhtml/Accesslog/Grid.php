<?php

class KO_Logger_Block_Adminhtml_Accesslog_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('desc');
        $this->setId('ko_logger_accesslog_grid');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'ko_logger/accesslog_collection';
    }

    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'entity_id',
            )
        );
        $this->addColumn('created_at',
            array(
                'header'=> $this->__('Created At'),
                'index' => 'created_at',
                'type' => 'datetime',
                'filter_time' => true,
                'width' => '100px',
            )
        );
        $this->addColumn('area',
            array(
                'header'=> $this->__('Area'),
                'index' => 'area',
            )
        );
        $this->addColumn('user_id',
            array(
                'header'=> $this->__('User Id'),
                'index' => 'user_id',
                'type'  => 'range',
            )
        );
        $this->addColumn('user_name',
            array(
                'header'=> $this->__('Username'),
                'index' => 'user_name',
            )
        );
        $this->addColumn('controller_module',
            array(
                'header'=> $this->__('Module'),
                'index' => 'controller_module',
            )
        );
        $this->addColumn('controller_name',
            array(
                'header'=> $this->__('Controller'),
                'index' => 'controller_name',
            )
        );
        $this->addColumn('action_name',
            array(
                'header'=> $this->__('Action'),
                'index' => 'action_name',
            )
        );
        $this->addColumn('params', array(
            'header'       => $this->__('Parameters'),
            'index'        => 'params',
            'renderer'     => 'KO_Logger_Block_Adminhtml_Accesslog_Renderer_Params',
            'sortable'     => false,
            'filter'       => false,
        ));
        return parent::_prepareColumns();
    }
}