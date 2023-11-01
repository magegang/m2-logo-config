<?php
/**
 * Copyright © Magegang All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magegang\LogoConfig\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem;
use Magento\Framework\UrlInterface;
use Magento\MediaStorage\Helper\File\Storage\Database;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class ImageUploader
{
    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    private Filesystem\Directory\WriteInterface $mediaDirectory;

    /**
     * ImageUploader constructor.
     * @param \Magento\MediaStorage\Helper\File\Storage\Database $coreFileStorageDatabase
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Psr\Log\LoggerInterface $logger
     * @param string $baseTmpPath
     * @param string $basePath
     * @param array $allowedExtensions
     * @param array $allowedMimeTypes
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        protected Database $coreFileStorageDatabase,
        protected Filesystem $filesystem,
        protected UploaderFactory $uploaderFactory,
        protected StoreManagerInterface $storeManager,
        protected LoggerInterface $logger,
        protected string $baseTmpPath,
        protected string $basePath,
        protected array $allowedExtensions = [],
        protected array $allowedMimeTypes = [],
    ) {
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * @param $imageName
     * @return mixed
     * @throws LocalizedException
     */
    public function moveFileFromTmp($imageName): mixed
    {
        $baseTmpPath = $this->baseTmpPath;
        $basePath = $this->basePath;
        $baseImagePath = $this->getFilePath($basePath, $imageName);
        $baseTmpImagePath = $this->getFilePath($baseTmpPath, $imageName);
        try {
            $this->coreFileStorageDatabase->copyFile(
                $baseTmpImagePath,
                $baseImagePath
            );
            $this->mediaDirectory->renameFile(
                $baseTmpImagePath,
                $baseImagePath
            );
        } catch (\Exception $e) {
            throw new LocalizedException(
                __('Something went wrong while saving the file(s).')
            );
        }
        return $imageName;
    }

    /**
     * @param $fileId
     * @return array|bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     * @throws \Exception
     */
    public function saveFileToTmpDir($fileId): array|bool
    {
        $baseTmpPath = $this->baseTmpPath;
        $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowedExtensions($this->allowedExtensions);
        $uploader->setAllowRenameFiles(true);
        $result = $uploader->save($this->mediaDirectory->getAbsolutePath($baseTmpPath));

        if (!$result) {
            throw new LocalizedException(
                __('File can not be saved to the destination folder.')
            );
        }

        $result['tmp_name'] = str_replace('\\', '/', $result['tmp_name']);
        $result['path'] = str_replace('\\', '/', $result['path']);
        $result['url'] = $this->storeManager
                ->getStore()
                ->getBaseUrl(
                    UrlInterface::URL_TYPE_MEDIA
                ) . $this->getFilePath($baseTmpPath, $result['file']);
        $result['name'] = $result['file'];

        if (isset($result['file'])) {
            try {
                $relativePath = rtrim($baseTmpPath, '/') . '/' . ltrim($result['file'], '/');
                $this->coreFileStorageDatabase->saveFile($relativePath);
            } catch (\Exception $e) {
                $this->logger->critical($e);
                throw new LocalizedException(
                    __('Something went wrong while saving the file(s).')
                );
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * @param string|null $path
     * @param string|null $imageName
     * @return string
     */
    public function getFilePath(string|null $path, string|null $imageName): string
    {
        $path = $path !== null ? rtrim($path, '/') : '';
        $imageName = $imageName !== null ? ltrim($imageName, '/') : '';
        return $path . '/' . $imageName;
    }
}
