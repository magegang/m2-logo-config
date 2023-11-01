<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Api\Data;
interface LogoInterface
{
    const LOGO_CONFIG_ID = 'logo_config_id';
    const SRC = 'src';
    const START_AT = 'start_at';
    const STORE_ID = 'store_id';
    const END_AT = 'end_at';

    /**
     * Get logo_config_id
     * @return int|null
     */
    public function getLogoConfigId(): ?int;

    /**
     * Set logo_config_id
     * @param int $logoConfigId
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     */
    public function setLogoConfigId(int $logoConfigId): LogoInterface;

    /**
     * Get store_id
     * @return int|null
     */
    public function getStoreId(): ?int;

    /**
     * Set store_id
     * @param int $storeId
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     *
     */
    public function setStoreId(int $storeId): LogoInterface;

    /**
     * Get src
     * @return string|null
     */
    public function getSrc(): ?string;

    /**
     * Set src
     * @param string $src
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     *
     */
    public function setSrc(string $src): LogoInterface;

    /**
     * Get start_at
     * @return string|null
     */
    public function getStartAt(): ?string;

    /**
     * Set start_at
     * @param \DateTime $startAt
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     *
     */
    public function setStartAt(\DateTime $startAt): LogoInterface;

    /**
     * Get end_at
     * @return string|null
     */
    public function getEndAt(): ?string;

    /**
     * Set end_at
     * @param \DateTime $endAt
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     *
     */
    public function setEndAt(\DateTime $endAt): LogoInterface;
}

