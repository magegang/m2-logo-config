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

    /**
     * @param \Magegang\LogoConfig\Helper\Data $helper
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Magegang\LogoConfig\Model\ResourceModel\Logo\CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        protected Data $helper,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        protected CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
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
     * @param array $data
     * @return void
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
