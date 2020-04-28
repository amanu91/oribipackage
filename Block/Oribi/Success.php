<?php
namespace Oribi\Analytics\Block\Oribi;
class Success extends \Magento\Framework\View\Element\Template
{
    const ORIBI_STATUS = 'oribi/general/enable';
    const ORIBI_TRACK_PURCHASES = 'oribi/general/list';
    /**
   * @var \Magento\Framework\App\Config\ScopeConfigInterface
   */
    protected $scopeConfig;
    protected $_checkoutSession;
    protected $_orderFactory;
    protected $_scopeConfig;
    protected $_categoryCollectionFactory;
    protected $_productRepository;
    protected $_storeManager;


    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->_checkoutSession = $checkoutSession;
        $this->_orderFactory = $orderFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_productRepository = $productRepository;
        $this->_storeManager = $storeManager;
    }

    public function checkModule(){

     $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

     return $this->scopeConfig->getValue(self::ORIBI_STATUS, $storeScope);

    }
    // Use this method to get ID    
    public function getRealOrderId()
    {
        $lastorderId = $this->_checkoutSession->getLastOrderId();
        return $lastorderId;
    }

    public function getOrder()
    {
        if ($this->_checkoutSession->getLastRealOrderId()) {
             $order = $this->_orderFactory->create()->loadByIncrementId($this->_checkoutSession->getLastRealOrderId());
        return $order;
        }
        return false;
    }

    public function getShippingInfo()
    {
        $order = $this->getOrder();
        if($order) {
            $address = $order->getShippingAddress();    

            return $address;
        }
        return false;

    }
        public function trackLists(){


     if($this->checkModule()){

         $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

         return $this->scopeConfig->getValue(self::ORIBI_TRACK_PURCHASES, $storeScope);

     }

    }

     public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');        
        
        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }
                
        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }
        
        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }
        
        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize); 
        }    
        
        return $collection;
    }

    public function getCategoriesName($categoryIds){

        $categories = $this->getCategoryCollection()->addAttributeToFilter('entity_id', $categoryIds);
        $catName = '';
        foreach ($categories as $category) {
            $catName .= $category->getName().',';
        }

        return rtrim($catName,',');                       
    }

    public function getProductCategories($id){

        $product =  $this->_productRepository->getById($id);
        return $this->getCategoriesName($product->getCategoryIds());
    }

    public function currentCurrencyCode(){

      return   $this->_storeManager->getStore()->getCurrentCurrency()->getCode();

    }
    
}