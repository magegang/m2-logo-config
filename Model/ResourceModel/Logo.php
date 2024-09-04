<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Store\Model\StoreManagerInterface;

class Logo extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('logo_config', 'logo_config_id');
    }

    public function __construct(
        private readonly StoreManagerInterface $storeManager,
        Context $context,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
    }

    public function getLogoSrcByDateRange(string $from, string $to): bool|string
    {
        $connection = $this->getConnection();
        $select = $connection
            ->select()
            ->from($this->getMainTable(), 'src')
            ->where('store_id = ?', $this->storeManager->getStore()->getId())
            ->where('start_at <= ?', $from)
            ->where('end_at >= ?', $to)
            ->limit(1);

        return $connection->fetchOne($select);
    }
}

