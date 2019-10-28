<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Controller\Adminhtml\Astro;

use Astro\Badges\Model\AstroFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    
    protected $model;
    
    protected $registry;
    
    public function __construct(
        Context $context,
        AstroFactory $model,
        PageFactory $resultPageFactory,
        Registry $registry
    ) {
        $this->model = $model;
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $model = $this->model->create();
        
        $id = $this->getRequest()->getParam("id");
        
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/Index');
            }
        }
        
        $this->registry->register('astro', $model);
        
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Astro_Badges::astro_badges');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit badge'));
        $resultPage->addBreadcrumb(__('astro_badges'), __('astro_badges'));
        
        
        return $resultPage;
    }
}
