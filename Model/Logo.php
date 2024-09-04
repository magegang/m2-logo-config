<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Model;

use Magegang\LogoConfig\Api\Data\LogoInterface;
use Magegang\LogoConfig\Model\ResourceModel\Logo as ResourceLogo;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Logo extends AbstractModel implements LogoInterface, IdentityInterface
{
    public const CACHE_TAG = 'logo_config';

    protected $_cacheTag = true;

    protected $_eventPrefix = 'logo_config';

    public function _construct(): void
    {
        $this->_init(ResourceLogo::class);
    }

    public function getLogoConfigId(): ?int
    {
        return (int)$this->getData(self::LOGO_CONFIG_ID);
    }

    public function setLogoConfigId(int $logoConfigId): LogoInterface
    {
        return $this->setData(self::LOGO_CONFIG_ID, $logoConfigId);
    }

    public function getStoreId(): ?int
    {
        return $this->getData(self::STORE_ID);
    }

    public function setStoreId($storeId): LogoInterface
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    public function getSrc(): ?string
    {
        return $this->getData(self::SRC);
    }

    public function setSrc(string $src): LogoInterface
    {
        return $this->setData(self::SRC, $src);
    }

    public function getStartAt(): ?string
    {
        return $this->getData(self::START_AT);
    }

    public function setStartAt(\DateTime $startAt): LogoInterface
    {
        return $this->setData(self::START_AT, $startAt);
    }

    public function getEndAt(): ?string
    {
        return $this->getData(self::END_AT);
    }

    public function setEndAt(\DateTime $endAt): LogoInterface
    {
        return $this->setData(self::END_AT, $endAt);
    }

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}

