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
    public function __construct(
        private readonly Context $context
    ) {
    }

    public function getModelId(): ?int
    {
        return (int)$this->context->getRequest()->getParam('logo_config_id');
    }

    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
