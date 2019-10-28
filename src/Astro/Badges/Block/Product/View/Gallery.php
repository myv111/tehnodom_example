<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Astro\Badges\Block\Product\View;

use Astro\Badges\Block\Astro;
use Astro\Badges\Model\AstroFactory;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\View\Gallery as ParentGallery;
use Magento\Catalog\Model\Product\Gallery\ImagesConfigFactoryInterface;
use Magento\Catalog\Model\Product\Image\UrlBuilder;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Stdlib\ArrayUtils;
/**
 * Product gallery block
 *
 * @api
 */
class Gallery extends ParentGallery
{
    /**
     * @var BadgesRender
     */
    protected $model;
    
    protected $astro;
    /**
     * Gallery constructor.
     * @param BadgesRender $badgesRender
     * @param Context $context
     * @param ArrayUtils $arrayUtils
     * @param EncoderInterface $jsonEncoder
     * @param array $data
     * @param ImagesConfigFactoryInterface|null $imagesConfigFactory
     * @param array $galleryImagesConfig
     * @param UrlBuilder|null $urlBuilder
     */
    public function __construct(
        Astro $Astro,
        AstroFactory $model,
        Context $context,
        ArrayUtils $arrayUtils,
        EncoderInterface $jsonEncoder,
        array $data = [],
        ImagesConfigFactoryInterface $imagesConfigFactory = null,
        array $galleryImagesConfig = [],
        UrlBuilder $urlBuilder = null
    ) {
        parent::__construct(
            $context,
            $arrayUtils,
            $jsonEncoder,
            $data,
            $imagesConfigFactory,
            $galleryImagesConfig,
            $urlBuilder
        );
        $this->model = $model->create();
        $this->astro = $Astro;
    }
    
    public function getBadge($badgeIdList)
    {
        $model = $this->model->load($badgeIdList);
        
        if($model['status'] == 1)
            return $this->astro->url.$model['img'];
        else
            return null;
//        return $this->badgesRender->create()->renderBadges($badgeIdList);
    }
}
