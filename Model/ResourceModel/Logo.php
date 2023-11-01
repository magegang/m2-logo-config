<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Store\Model\StoreManagerInterface;

class Logo extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('logo_config', 'logo_config_id');
    }

    public function __construct(
        protected StoreManagerInterface $storeManager,
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $connectionName = null
    )
    {
        parent::__construct($context, $connectionName);
    }

    /**
     * @param string $from
     * @param string $to
     * @return bool|string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
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

