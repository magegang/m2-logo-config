<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        protected Context $context
    ) {
    }

    /**
     * @return int|null
     */
    public function getModelId(): ?int
    {
        return (int)$this->context->getRequest()->getParam('logo_config_id');
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
