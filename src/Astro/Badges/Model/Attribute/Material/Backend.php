<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Model\Attribute\Material;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;

class Backend extends AbstractBackend
{
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if($object->getAttributeSetId() == 10 && $value == 'fur'){
            throw new LocalizedException(_("Error fur"));
        }
    }
}

