<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Model\Attribute\Material;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Astro\Badges\Model\ResouceModel\Astro\CollectionFactory;

class Source extends AbstractSource
{
    protected $collection;
    
    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collection = $collectionFactory->create();
    }
    
    public function getAllOptions()
    {
        if(!$this->_options){
            $items = $this->collection->getItems();
            
            foreach ($items as $item){
                if($item->getData()['status'] != 0)
                    $this->_options[] = [
                        'value' => $item->getData()['id'],
                        'label' => __($item->getData()['name'])
                    ];
            }
        }
        return $this->_options;
    }
}

