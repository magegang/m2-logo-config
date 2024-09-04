<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Controller\Adminhtml\Logo;

use Magegang\LogoConfig\Api\LogoConfigRepositoryInterface;
use Magegang\LogoConfig\Model\ImageUploader;
use Magegang\LogoConfig\Model\Logo;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Message\Manager;

class Save implements HttpPostActionInterface
{
    public function __construct(
        private readonly RequestInterface $request,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly LogoConfigRepositoryInterface $logoConfigRepository,
        private readonly Logo $model,
        private readonly Manager $messageManager,
        private readonly RedirectFactory $redirectFactory,
        private readonly ImageUploader $imageUploader
    ) {
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $resultRedirect = $this->redirectFactory->create();
        $params = $this->request->getPostValue();
        if ($params) {
            $id = (int)$this->request->getParam('logo_config_id');
            if ($id) {
                $model = $this->model->load($id);
                if(!$model->getId()) {
                    $this->messageManager->addErrorMessage(__('This Logo no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            if (isset($params['src'][0]['name']) && isset($params['src'][0]['tmp_name'])) {
                $params['src'] = $params['src'][0]['name'];
                $this->imageUploader->moveFileFromTmp($params['src']);
            } elseif (isset($data['logo'][0]['image']) && !isset($data['logo'][0]['tmp_name'])) {
                $params['src'] = $data['src'][0]['src'];
            } else {
                $params['src'] = $model->getSrc();
            }

            $model = $this->model->setData($params);
            try {
                $this->logoConfigRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Logo.'));

                if ($this->request->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['logo_config_id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving.'));
            }

            $this->dataPersistor->set('logo_config_logo', $params);
            return $resultRedirect->setPath('*/*/edit', ['logo_config_id' => $this->request->getParam('logo_config_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
