<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Astro\Badges\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Astro extends Template implements BlockInterface
{
    protected $postFactory;

    protected $post;

    public $url = "/pub/media/astro/banner/";
    
    public function __construct(
        Template\Context $context,
        \Astro\Badges\Model\AstroFactory $postFactory,
        array $data = []
    )
    {
        $this->postFactory = $postFactory;
        parent::__construct($context, $data);
    }


    public function getAstro()
    {
        $id = $this->getRequest()->getParam('id');
        if(!$id) {
            $post = $this->postFactory->create();
            $collection = $post->getCollection();
            return $collection;
        }else{
            $samples = $this->postFactory->create();
            $id = $this->getRequest()->getParam('id');
            $this->post = $samples->load($id);
            return $samples;
        }
    }
}
