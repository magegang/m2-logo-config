<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magegang\LogoConfig\Model\Logo;

use Magegang\LogoConfig\Helper\Data;
use Magegang\LogoConfig\Model\ResourceModel\Logo\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected array $loadedData = [];

    public function __construct(
        private readonly Data $helper,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        protected readonly CollectionFactory $collectionFactory,
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName);
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getData(): array
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            $this->setImageUploaderData($this->loadedData[$model->getId()]);
        }

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
        }

        return $this->loadedData;
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function setImageUploaderData(array &$data): void
    {
        if($data['src']) {
            $src = $data['src'];
            unset($data['src']);
            $data['src'][0]['name'] = $data['name'];
            $data['src'][0]['url'] = $this->helper->getLogoSrc($src);
        }
    }
}
