<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Model\Attribute\Material;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;
use Astro\Badges\Model\AstroFactory;
use Magento\Eav\Model\Entity\Attribute\Source\BooleanFactory;


class Frontend extends AbstractFrontend
{
    public $model;
    
    public function __construct(
        BooleanFactory $attrBooleanFactory,
        AstroFactory $model
    ) {
        parent::__construct($attrBooleanFactory);
        $this->model = $model->create();
    }

    public function getValue(DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        $model = $this->model->load($value);
        
        if($model['status'])
            return "<img src='".$model->getImageUrl()."' style='width: 150px;'>";
    }
}

