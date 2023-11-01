<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Plugin\Override;

use Magegang\LogoConfig\Model\ImageUploader;
use Magento\Catalog\Model\ImageUploader as CoreImageUploader;
use Magento\Cms\Model\Wysiwyg\Images\Storage;
use Magento\Framework\Filesystem;
use Magento\MediaGalleryApi\Api\DeleteAssetsByPathsInterface;
use Magento\MediaGalleryApi\Api\GetAssetsByPathsInterface;
use Magento\MediaGalleryCatalogIntegration\Plugin\SaveBaseCategoryImageInformation as CorePlugin;
use Magento\MediaGallerySynchronizationApi\Api\SynchronizeFilesInterface;
use Magento\MediaGalleryUiApi\Api\ConfigInterface;

class SaveBaseCategoryImageInformation extends CorePlugin
{
    public function __construct(
        protected ImageUploader $imageUploader,
        DeleteAssetsByPathsInterface $deleteAssetsByPath,
        Filesystem $filesystem,
        GetAssetsByPathsInterface $getAssetsByPaths,
        Storage $storage,
        SynchronizeFilesInterface $synchronizeFiles,
        ConfigInterface $config
    ) {
        parent::__construct($deleteAssetsByPath, $filesystem, $getAssetsByPaths, $storage, $synchronizeFiles, $config);
    }

    /**
     * @param \Magento\Catalog\Model\ImageUploader $subject
     * @param string $imagePath
     * @param string $initialImageName
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterMoveFileFromTmp(CoreImageUploader $subject, string $imagePath, string $initialImageName): string
    {
        $path = $this->imageUploader->getBaseTmpPath();
        $tmpPath = $subject->getBaseTmpPath();
        if($tmpPath === $path) {
            return "";
        }
        return parent::afterMoveFileFromTmp($subject, $imagePath, $initialImageName);
    }
}
