<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Model;

use Magegang\LogoConfig\Api\Data\LogoConfigSearchResultsInterfaceFactory;
use Magegang\LogoConfig\Api\Data\LogoInterface;
use Magegang\LogoConfig\Api\LogoConfigRepositoryInterface;
use Magegang\LogoConfig\Model\ResourceModel\Logo as ResourceLogo;
use Magegang\LogoConfig\Model\ResourceModel\Logo\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class LogoConfigRepository implements LogoConfigRepositoryInterface
{
    /**
     * @param \Magegang\LogoConfig\Model\ResourceModel\Logo $resource
     * @param \Magegang\LogoConfig\Api\Data\LogoInterface $model
     * @param \Magegang\LogoConfig\Model\LogoFactory $modelFactory
     * @param \Magegang\LogoConfig\Model\ResourceModel\Logo\CollectionFactory $logoCollectionFactory
     * @param \Magegang\LogoConfig\Api\Data\LogoConfigSearchResultsInterfaceFactory $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        protected ResourceLogo $resource,
        protected LogoInterface $model,
        protected LogoFactory $modelFactory,
        protected CollectionFactory $logoCollectionFactory,
        protected LogoConfigSearchResultsInterfaceFactory $searchResultsFactory,
        protected CollectionProcessorInterface $collectionProcessor
    ) {
    }

    /**
     * @param \Magegang\LogoConfig\Api\Data\LogoInterface $logo
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(LogoInterface $logo): LogoInterface
    {
        try {
            $this->resource->save($logo);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Logo: %1',
                $exception->getMessage()
            ));
        }
        return $logo;
    }

    /**
     * @param int $logoId
     * @return \Magegang\LogoConfig\Api\Data\LogoInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(int $logoId): LogoInterface
    {
        $model = $this->modelFactory->create();
        $this->resource->load($model, $logoId);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('Logo with id "%1" does not exist.', $logoId));
        }
        return $model;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResults
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): SearchResults
    {
        $collection = $this->logoCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @param \Magegang\LogoConfig\Api\Data\LogoInterface $logo
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(LogoInterface $logo): bool
    {
        try {
            $model = $this->modelFactory->create();
            $this->resource->load($model, $logo->getLogoConfigId());
            $this->resource->delete($model);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Logo: %1',
                $e->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param $logoId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($logoId): bool
    {
        return $this->delete($this->get($logoId));
    }
}

