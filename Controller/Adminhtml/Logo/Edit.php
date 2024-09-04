<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Controller\Adminhtml\Logo;

use Magegang\LogoConfig\Controller\Adminhtml\Logo as MainController;
use Magegang\LogoConfig\Model\Logo;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends MainController implements HttpGetActionInterface
{
    public function __construct(
        private readonly PageFactory $resultPageFactory,
        private readonly RequestInterface $request,
        private readonly Logo $model,
        private readonly RedirectFactory  $redirectFactory,
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute(): Page|Redirect
    {
        $model = $this->model;
        $id = (int) $this->request->getParam('logo_config_id');
        if ($id) {
            $model->load($id);
            if(!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This logo no longer exists.'));
                $resultRedirect = $this->redirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Logo') : __('New Logo'),
            $id ? __('Edit Logo') : __('New Logo')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Schedules'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Logo %1', $model->getId()) : __('New Logo'));

        return $resultPage;
    }
}
