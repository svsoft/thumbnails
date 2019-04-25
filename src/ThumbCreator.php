<?php

namespace svsoft\thumbnails;

use svsoft\thumbnails\exceptions\FileNotFoundException;
use svsoft\thumbnails\exceptions\UnableOpenImageException;

/**
 * Class ThumbCreator
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ThumbCreator implements ThumbCreatorInterface
{
    /**
     * @var ImageStorageInterface
     */
    protected $imageStorage;

    /**
     * @var ThumbStorageInterface
     */
    protected $thumbStorage;

    function __construct(ImageStorageInterface $imageStorage, ThumbStorageInterface $thumbStorage)
    {
        $this->imageStorage = $imageStorage;
        $this->thumbStorage = $thumbStorage;
    }

    /**
     * @param $imageUri
     * @param ThumbInterface $thumb
     *
     * @return string
     * @throws FileNotFoundException
     * @throws UnableOpenImageException
     */
    function create($imageUri, ThumbInterface $thumb) : string
    {
        $thumbUri = $thumb->getUri($imageUri);

        if (!$this->thumbStorage->exists($thumbUri))
        {
            $image = $this->imageStorage->open($imageUri);

            $image = $thumb->handle($image);

            $this->thumbStorage->save($image, $thumbUri);
        }

        return $this->thumbStorage->getUrl($thumbUri);
    }

    /**
     * @param string $imageUri
     * @param ThumbInterface $thumb
     *
     * @return string
     */
    function getUrl(string $imageUri, ThumbInterface $thumb): string
    {
        $thumbUri = $thumb->getUri($imageUri);

        return $this->thumbStorage->getUrl($thumbUri);
    }
}