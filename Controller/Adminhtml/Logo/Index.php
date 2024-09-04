<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Controller\Adminhtml\Logo;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    public function __construct(
        protected PageFactory $resultPageFactory
    ) {
    }

    public function execute(): Page
    {
        $result = $this->resultPageFactory->create();

        $result->getConfig()->getTitle()->prepend(__("Schedule Logo"));

        return $result;
    }
}
