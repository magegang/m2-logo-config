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
    /**
     * Save Logo
     * @param \Magegang\LogoConfig\Api\Data\LogoInterface $logo
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        LogoInterface $logo
    ): Data\LogoInterface;

    /**
     * Retrieve Logo
     * @param int $logoId
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get(int $logoId): LogoInterface;

    /**
     * Retrieve Logo matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResults
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): SearchResults;

    /**
     * Delete Logo
     * @param \Magegang\LogoConfig\Api\Data\LogoInterface $logo
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        LogoInterface $logo
    ): bool;

    /**
     * Delete Logo by ID
     * @param int $logoId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $logoId): bool;
}

