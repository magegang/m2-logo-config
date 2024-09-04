<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Block\Html\Header;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Theme\Block\Html\Header\Logo as CoreBlock;

class Logo extends CoreBlock implements IdentityInterface
{
    public function getIdentities(): array
    {
        return [\Magegang\LogoConfig\Model\Logo::CACHE_TAG];
    }
}
