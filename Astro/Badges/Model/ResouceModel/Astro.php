<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Model\ResouceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Astro extends AbstractDb
{
    public function _construct()
    {
        $this->_init('astro_badges', 'id');
    }
}
