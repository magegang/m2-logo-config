<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Model\ResourceModel\Logo;

use Magegang\LogoConfig\Model\Logo;
use Magegang\LogoConfig\Model\ResourceModel\Logo as ResourceLogo;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'logo_config_id';

    protected function _construct(): void
    {
        $this->_init(
            Logo::class,
            ResourceLogo::class
        );
    }
}

