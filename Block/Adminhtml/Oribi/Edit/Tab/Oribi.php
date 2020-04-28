<?php
namespace Oribi\Analytics\Block\Adminhtml\Oribi\Edit\Tab;
class Oribi extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
		/* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('analytics_oribi');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Competition')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

		$fieldset->addField(
            'event_name',
            'text',
            array(
                'name' => 'event_name',
                'label' => __('Event Name'),
                'title' => __('Event Name'),
                'required' => true,
            )
        );
		$fieldset->addField(
            'event_page',
            'select',
            array(
                'name' => 'event_page',
                'label' => __('Event Page'),
                'title' => __('Event Page'),
                'options' => ['home-page'=>'Home Page','cat-page'=>'Category Page', 'product-view' => "Product View Page" , "cart-page" => "Checkout Cart Page" ,"checkout" => "Checkout Page"],
                'required' => true,
            )
        );
        $fieldset->addField(
            'slug',
            'text',
            array(
                'name' => 'slug',
                'label' => __('Identifier'),
                'title' => __('Identifier'),
                'required' => true,
            )
        );
         $fieldset->addField(
            'is_active',
            'select',
            array(
                'name' => 'is_active',
                'label' => __('Status'),
                'title' => __('Identifier'),
                'options' => ['1'=>'Enabled','0'=>'Disabled'],
                'required' => true,
            )
        );

		/*{{CedAddFormField}}*/
        
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Manage Event');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Manage Event');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
