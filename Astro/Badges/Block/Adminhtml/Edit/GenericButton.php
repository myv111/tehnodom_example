<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Astro\Badges\Block\Adminhtml\Edit;

use Astro\Badges\Model\AstroFactory;
use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class GenericButton
{
    protected $context;

    protected $pageRepository;

    protected $model;

    public function __construct(
        AstroFactory $model,
        Context $context,
        PageRepositoryInterface $pageRepository
    ) {
        $this->context = $context;
        $this->pageRepository = $pageRepository;
        $this->model = $model;
    }

    /**
     * Return CMS page ID
     *
     * @return int|null
     */
    public function getId()
    {
        if($this->context->getRequest()->getParam('id')){
            $model = $this->model->create();
            $model->load($this->context->getRequest()->getParam('id'));

            return $model->getId();
        }
        return false;
    }
//
//    /**
//     * Generate url by route and parameters
//     *
//     * @param   string $route
//     * @param   array $params
//     * @return  string
//     */
    public function getUrlBuilder()
    {
        return $this->context->getUrlBuilder();
    }
}
