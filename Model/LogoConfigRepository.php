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
    public function __construct(
        protected ResourceLogo $resource,
        protected LogoInterface $model,
        protected LogoFactory $modelFactory,
        protected CollectionFactory $logoCollectionFactory,
        protected LogoConfigSearchResultsInterfaceFactory $searchResultsFactory,
        protected CollectionProcessorInterface $collectionProcessor
    ) {
    }

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

    public function get(int $logoId): LogoInterface
    {
        $model = $this->modelFactory->create();
        $this->resource->load($model, $logoId);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('Logo with id "%1" does not exist.', $logoId));
        }
        return $model;
    }

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
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $logoId): bool
    {
        return $this->delete($this->get($logoId));
    }
}

