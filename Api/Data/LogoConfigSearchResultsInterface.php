<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface LogoConfigSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Logo list.
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface[]
     */
    public function getItems();

    /**
     * Set Logo list.
     * @param \Magegang\LogoConfig\Api\Data\LogoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

