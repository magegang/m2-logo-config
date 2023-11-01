<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Controller\Adminhtml\Logo;

use Magento\Backend\Model\View\Result\Forward;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class NewAction implements HttpGetActionInterface
{

    /**
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        protected ForwardFactory $resultForwardFactory
    ) {
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute(): Forward
    {
        $result = $this->resultForwardFactory->create();
        return $result->forward('edit');
    }
}
