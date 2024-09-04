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

    public function getLogoConfigId(): ?int;

    public function setLogoConfigId(int $logoConfigId): LogoInterface;

    public function getStoreId(): ?int;

    public function setStoreId(int $storeId): LogoInterface;

    public function getSrc(): ?string;

    public function setSrc(string $src): LogoInterface;

    public function getStartAt(): ?string;

    public function setStartAt(\DateTime $startAt): LogoInterface;

    public function getEndAt(): ?string;

    public function setEndAt(\DateTime $endAt): LogoInterface;
}

