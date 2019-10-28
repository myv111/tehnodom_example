<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Model;

use Astro\Badges\Model\ResouceModel\Astro\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

use Magento\Framework\App\ObjectManager;
use Astro\Badges\Model\FileInfo;
use Magento\Framework\FileSystem;

use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $collection;
    
    protected $loadedData;

    protected $dataPersistor;
    
    private $fileInfo;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
//    public function getData()
//    {
//        if(isset($this->loadedData)){
//            return $this->loadedData;
//        }
//
//        $items = $this->collection->getItems();
//
//        foreach ($items as $baner){
//            $baner = $this->converValues($baner);
//            $this->loadedData[""] = $baner->getData();
//        }
//
//        $data = $this->dataPersistor->get('banner');
//
//        if(!empty($data)){
//            $baner = $this->collection->getNewEmptyItem();
//            $baner->setData($data);
//            $this->loadedData[""] = $baner->getData();
//            $this->dataPersistor->clear('banner');
//        }
//
////        var_dump($this->loadedData);die;
////        unset($this->loadedData[""]["image"]);
//        return $this->loadedData;
//    }
    public function getData()
    {
        if(isset($this->loadedData)){
            return $this->loadedData;
        }
    
//        if($this->loadedData == null){
//            $this->loadedData = [];
//            $items = $this->collection->getItems();
//            foreach($items as $v){
//                $this->loadedData[$v->getId()] = $v->getData();
//            }
//        }
//        var_dump($this->loadedData);die;
//        return $this->loadedData;
        
        $items = $this->collection->getItems();
        
        foreach ($items as $baner){
            $baner = $this->converValues($baner);
            $this->loadedData[$baner->getId()] = $baner->getData();
            $this->loadedData[$baner->getId()]['img'] = $this->loadedData[$baner->getId()]['image'];
            unset($this->loadedData[$baner->getId()]['image']);
        }
        
        $data = $this->dataPersistor->get('banner');
        
        if(!empty($data)){
            $baner = $this->collection->getNewEmptyItem();
            $baner->setData($data);
            $this->loadedData[$baner->getId()] = $baner->getData();
            $this->loadedData[$baner->getId()]['img'] = $this->loadedData[$baner->getId()]['image'];
            unset($this->loadedData[$baner->getId()]['image']);
            
            $this->dataPersistor->clear('banner');
        }
        
        return $this->loadedData;
    }
    
    private function converValues($baner)
    {
        $fileName = $baner->getImage();
        $image = [];
        
        $fileInfo = $this->getFileInfo();

        if ($fileInfo->isExist($fileName)) {
            $stat = $fileInfo->getStat($fileName);
            $mime = $fileInfo->getMimeType($fileName);
    
            $image[0]['name'] = $fileName;
            $image[0]['url']  = $baner->getImageUrl();
            $image[0]['size'] = isset($stat) ? $stat['size'] : 0;
            $image[0]['type'] = $mime;
        }
        $baner->setImage($image);

        return $baner;
    }
    
    private function getFileInfo()
    {
        if($this->fileInfo === null){
            $this->fileInfo = ObjectManager::getInstance()->get(FileInfo::class);
        }
        return $this->fileInfo ;
    }
}
