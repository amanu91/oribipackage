<?php
namespace Oribi\Analytics\Block\Oribi;
class HeaderScript extends \Magento\Framework\View\Element\Template
{
	/**
	* @var \Magento\Framework\App\Config\ScopeConfigInterface
	*/
	protected $scopeConfig;

	/**
	* Recipient email config path
	*/
	const ORIBI_STATUS = 'oribi/general/enable';

	const ORIBI_TOKEN = 'oribi/general/token';

	const ORIBI_SCRIPT_CODE = 'oribi/general/script_code';

	const ORIBI_MULTISELECT_CODE = 'oribi/general/multievents';

	protected $mymodulemodelFactory;

    protected $request;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Oribi\Analytics\Model\ResourceModel\OribiEvents\CollectionFactory $OribiEventsFactory,
		\Magento\Framework\App\Request\Http $request
	)
	{
		parent::__construct($context);
		$this->scopeConfig = $scopeConfig;
		$this->oribiEventsCollection = $OribiEventsFactory;
		$this->request = $request;
	}

	public function checkModule(){

     $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

     return $this->scopeConfig->getValue(self::ORIBI_STATUS, $storeScope);

	}

	public function headScript(){

		 if($this->checkModule()){
		 	 $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

	    	 return $this->scopeConfig->getValue(self::ORIBI_SCRIPT_CODE, $storeScope);
		 }

	}

	public function isToken(){


	 if($this->checkModule()){

	 	 $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

    	 return $this->scopeConfig->getValue(self::ORIBI_TOKEN, $storeScope);

	 }

	}
	public function getEventCollection(){

		return $this->oribiEventsCollection->create()->addFieldToFilter('is_active', ['eq' => 1]);

	}

	public function getActions(){

		$moduleName = $this->request->getModuleName();
        $controller = $this->request->getControllerName();
        $action     = $this->request->getActionName();
        $route      = $this->request->getRouteName();

        return $moduleName."_".$controller."_".$action;
    
	}

	
}