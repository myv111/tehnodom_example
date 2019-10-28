<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Model\ResouceModel\Astro;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public $_idFieldName = 'id';
    
    public function _construct()
    {
        $this->_init(\Astro\Badges\Model\Astro::class, \Astro\Badges\Model\ResouceModel\Astro::class);
    }
}
