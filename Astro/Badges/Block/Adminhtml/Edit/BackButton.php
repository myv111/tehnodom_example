<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Astro\Badges\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrlBuilder()->getUrl("*/*/Index")),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
