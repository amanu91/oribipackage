<?php
namespace Oribi\Analytics\Block\Adminhtml\Oribi\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_oribi_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Event Information'));
    }
}