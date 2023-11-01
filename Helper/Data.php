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
    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magegang\LogoConfig\Model\ImageUploader $imageUploader
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        protected StoreManagerInterface $storeManager,
        protected ImageUploader $imageUploader,
        Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     * @param string $filename
     * @return string
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

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->imageUploader->getBasePath();
    }
}
