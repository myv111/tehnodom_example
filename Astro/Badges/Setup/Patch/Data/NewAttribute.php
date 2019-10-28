<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Astro\Badges\Setup\Patch\Data;

use Astro\Badges\Model\Attribute\Material\Backend;
use Astro\Badges\Model\Attribute\Material\Frontend;
use Astro\Badges\Model\Attribute\Material\Source;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class NewAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;
    
    protected $moduleDataSetup;
    
    /**
     * UpgradeData constructor
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory, ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }
    
    public static function getDependencies()
    {
        return [];
    }
    
    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create();
        /**
         * Add attributes to the eav/attribute
         */
        
        $eavSetup->addAttribute(
            Product::ENTITY,
            'badges',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Badges',
                'input' => 'select',
                'source' => Source::class,
                'frontend' => Frontend::class,
                'backend' => Backend::class,
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true,
            ]
        );
    }
    
    /**
     * {@inheritdoc}
     */
    
    
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    
    public function getAliases()
    {
        return [];
    }
}
