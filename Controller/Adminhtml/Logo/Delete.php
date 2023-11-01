<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Controller\Adminhtml\Logo;

use Magegang\LogoConfig\Model\LogoConfigRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete extends Action
{
    public function __construct(
        protected RedirectFactory $redirectFactory,
        protected LogoConfigRepository $logoConfigRepository,
        protected Context $context
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->redirectFactory->create();

        $id = (int)$this->getRequest()->getParam('logo_config_id');
        if($id) {
            try {
                $this->logoConfigRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the Logo.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['logo_config_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a Logo to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
