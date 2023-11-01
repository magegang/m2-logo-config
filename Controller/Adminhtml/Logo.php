<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\Page;

abstract class Logo extends Action
{
    /**
     * @param \Magento\Framework\View\Result\Page $resultPage
     * @return \Magento\Framework\View\Result\Page
     */
    public function initPage(Page $resultPage): Page
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Magegang'), __('Magegang'))
            ->addBreadcrumb(__('Logo'), __('Logo'));

        return $resultPage;
    }
}
