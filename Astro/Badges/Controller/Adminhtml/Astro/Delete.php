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

class Delete extends \Magento\Backend\App\Action
{
    protected $model;
    
    public function __construct(
        Context $context,
        AstroFactory $model
    ) {
        $this->model = $model;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $redirect = $this->resultRedirectFactory->create();
        
        $id = $this->getRequest()->getParam("id");
        
        if ($id) {
            $model = $this->model->create();
            $model->load($id);
            
            if ($model->getId()) {
                try {
                    $model->delete();
                    $this->messageManager->addSuccessMessage(__("Success delete"));
                } catch (\Exception $er) {
                    $this->messageManager->addErrorMessage(__("Error"));
                }
                return $redirect->setPath('*/*/Index');
            }
        }
        $this->messageManager->addErrorMessage(__("Error"));
        return $redirect->setPath('*/*/Index');
    }
}
