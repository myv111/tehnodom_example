<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Astro extends AbstractModel
{
    protected $_storeManager;
    
    public function _construct()
    {
        $this->_init(\Astro\Badges\Model\ResouceModel\Astro::class);
    }
    
    public function getImageUrl()
    {
        $url = '';
        $image = $this->getData('img');
        if($image){
            if(is_string($image)){
                $url = $this->_getStoreManager()->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA).\Astro\Badges\Model\FileInfo::ENTITY_MEDIA_PATH . "/". $image;
            }else{
                throw new LocalizedException(__("Error"));
            }
        }
        return $url;
    }
    
    private function _getStoreManager()
    {
        if($this->_storeManager === null){
            $this->_storeManager = ObjectManager::getInstance()->get(StoreManagerInterface::class);
        }
        return $this->_storeManager;
    }
}
