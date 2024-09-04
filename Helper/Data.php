<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Helper;

use Magegang\LogoConfig\Model\ImageUploader;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    public function __construct(
        private readonly StoreManagerInterface $storeManager,
        private readonly ImageUploader $imageUploader,
        Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getLogoSrc(string $filename): string
    {
        return sprintf('%s/%s/%s', $this->getMediaUrl(), $this->getBasePath(), $filename);
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMediaUrl(): string
    {
        return rtrim(
            $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA), '/'
        );
    }

    public function getBasePath(): string
    {
        return $this->imageUploader->getBasePath();
    }
}
