<?php
/**
 * Copyright © 2015 Oribi. All rights reserved.
 */
namespace Oribi\Analytics\Model\ResourceModel;

/**
 * OribiEvents resource
 */
class OribiEvents extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('oribi_events', 'id');
    }

  
}
