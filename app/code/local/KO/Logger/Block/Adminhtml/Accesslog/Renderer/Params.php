<?php

/**
 * Adminhtml grid item renderer
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 */

class KO_Logger_Block_Adminhtml_Accesslog_Renderer_Params extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders grid column
     *
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        if(empty($row->getParams()))
            return 'N/A';
        return <<<HTML
<a href="#" onclick="return loadParams({$this->escapeHtml($row->getEntityId())}); return false;">
    Click to show params
</a>
HTML;
    }
}
