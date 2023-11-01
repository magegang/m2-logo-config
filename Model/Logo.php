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
    const CACHE_TAG = 'logo_config';

    /**
     * @var bool
     */
    protected $_cacheTag = true;

    /**
     * @var string
     */
    protected $_eventPrefix = 'logo_config';

    /**
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(ResourceLogo::class);
    }

    /**
     * @return int|null
     */
    public function getLogoConfigId(): ?int
    {
        return (int)$this->getData(self::LOGO_CONFIG_ID);
    }

    /**
     * @param int $logoConfigId
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     */
    public function setLogoConfigId(int $logoConfigId): LogoInterface
    {
        return $this->setData(self::LOGO_CONFIG_ID, $logoConfigId);
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * @param $storeId
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     */
    public function setStoreId($storeId): LogoInterface
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * @return string|null
     */
    public function getSrc(): ?string
    {
        return $this->getData(self::SRC);
    }

    /**
     * @param string $src
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     */
    public function setSrc(string $src): LogoInterface
    {
        return $this->setData(self::SRC, $src);
    }

    /**
     * @return string|null
     */
    public function getStartAt(): ?string
    {
        return $this->getData(self::START_AT);
    }

    /**
     * @param \DateTime $startAt
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     */
    public function setStartAt(\DateTime $startAt): LogoInterface
    {
        return $this->setData(self::START_AT, $startAt);
    }

    /**
     * @return string|null
     */
    public function getEndAt(): ?string
    {
        return $this->getData(self::END_AT);
    }

    /**
     * @param \DateTime $endAt
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     */
    public function setEndAt(\DateTime $endAt): LogoInterface
    {
        return $this->setData(self::END_AT, $endAt);
    }

    /**
     * @return string[]
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}

