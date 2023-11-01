<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Plugin\Block\Html\Header;

use Magegang\LogoConfig\Helper\Data;
use Magegang\LogoConfig\Model\ResourceModel\Logo as LogoResourceModel;
use Magento\Theme\Block\Html\Header\Logo as CoreLogo;

class Logo
{
    /**
     * @param \Magegang\LogoConfig\Helper\Data $helper
     * @param \Magegang\LogoConfig\Model\ResourceModel\Logo $resourceModel
     */
    public function __construct(
        protected Data $helper,
        protected LogoResourceModel $resourceModel
    ) {
    }

    /**
     * @param CoreLogo $subject
     * @param $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterGetLogoSrc(CoreLogo $subject, $result): string
    {
        $from = \date('Y-m-d');
        $to = \date('Y-m-d', time() - 3600);
        $data = $this->resourceModel->getLogoSrcByDateRange($from, $to);
        if($data) {
            return $this->helper->getLogoSrc($data);
        }

        return $result;
    }
}
