<?php
namespace Oribi\Analytics\Block\Adminhtml;
class Oribi extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_oribi';/*block grid.php directory*/
        $this->_blockGroup = 'Oribi_Analytics';
        $this->_headerText = __('Oribi Events');
        $this->_addButtonLabel = __('Add New Event'); 
        parent::_construct();
		
    }
}
