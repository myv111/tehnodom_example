<?php
/**
 *  Technodom
 *
 * @category    Badges
 * @package     Badges
 * @author      Yuriy Manzhela <yvmanzhela@mail.ru>
 */

namespace Newcms\NewPage\Setup\Patch\Data;

use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\PageRepository;
use Newcms\NewPage\Api\BadgesRepositoryInterface;

/**
 * Class DummyPatch
 * @package Newcms\NewPage\Setup\Patch\Data
 */
class DummyPatch implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    
    /**
     * @var PageFactory
     */
    private $pageFactory;
    
    /**
     * @var PageRepository
     */
    private $pageRepository;
    
    /**
     * @var DirectoryList
     */
    private $directory;
    
    /**
     * DummyPatch constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $PageFactory
     * @param PageRepository $pageRepository
     * @param DirectoryList $DirectoryList
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $PageFactory,
        PageRepository $pageRepository,
        DirectoryList $DirectoryList
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $PageFactory;
        $this->pageRepository = $pageRepository;
        $this->directory = $DirectoryList;
    }
    
    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }
    
    /**
     * @return void
     */
    public function apply(): void
    {
        $directory = $this->directory;
        $rootPath = $directory->getRoot();
        $templatePath = $rootPath . "/app/code/Newcms/NewPage/view/frontend/templates/";
        
        $pagesDat = [
            'title' => 'Title CMS',
            'page_layout' => '1column',
            'meta_keywords' => 'Keywords CMS',
            'meta_description' => 'Description CMS',
            'identifier' => 'cms',
            'content_heading' => 'cms',
            'content' => file_get_contents($templatePath . "astro.phtml"),
            'layout_update_xml' => '',
            'url_key' => 'cms',
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];
        $this->moduleDataSetup->getConnection()->startSetup();
        
        $model = $this->pageFactory->create()->setData($pagesDat);
        
        $this->pageRepository->save($model);
        
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    
    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }
}
