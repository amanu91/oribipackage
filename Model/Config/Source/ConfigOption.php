<?php

namespace Oribi\Analytics\Model\Config\Source;

class ConfigOption implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => '2', 'label' => __('Price')],
            ['value' => '3', 'label' => __('Categories')],
            ['value' => '4', 'label' => __('Currency')],
            ['value' => '5', 'label' => __('Tax Price')],
            ['value' => '6', 'label' => __('Shipping Price')],
            ['value' => '7', 'label' => __('Product Quantity')],
            ['value' => '8', 'label' => __('Product Id')],
            ['value' => '9', 'label' => __('Product Name')],
            ['value' => '10', 'label' => __('Products')],
            ['value' => '11', 'label' => __('Discount Price')],
            ['value' => '12', 'label' => __('OrderID')],

        ];
    }
}