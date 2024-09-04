<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Api;

use Magegang\LogoConfig\Api\Data\LogoInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;

interface LogoConfigRepositoryInterface
{
    public function save(
        LogoInterface $logo
    ): Data\LogoInterface;

    public function get(int $logoId): LogoInterface;

    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): SearchResults;

    public function delete(
        LogoInterface $logo
    ): bool;

    public function deleteById(int $logoId): bool;
}

