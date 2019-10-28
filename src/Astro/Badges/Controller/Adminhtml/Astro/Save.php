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
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Backend\App\Action\Context;
use Astro\Badges\Model\ImageUploader;

class Save extends \Magento\Backend\App\Action
{
    private $model;

    private $dataPersistor;

    private $imageUploader;
    
    public function __construct(
        Context $context,
        AstroFactory $model,
        DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploader
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->model = $model;
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $model = $this->model->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }else{
                unset($data['id']);
            }
            
            $imagename = '';
            if(!empty($data['img'][0]['name'])){
                $imagename = $data['img'][0]['name'];
                $data['img'] = $imagename;
            }else{
                $data['img'] = $model["img"];
            }
            
            $model->setData($data);
            
            
            try {
                $model->save();
                if($imagename){
                    $this->imageUploader->moveFileFromTmp($imagename);
                }
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                $this->dataPersistor->clear("example_data");
                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
            }
            $this->dataPersistor->set("example_data", $data);
        }
        return $resultRedirect->setPath('*/*/Index');
    }
}