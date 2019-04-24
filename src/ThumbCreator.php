<?php

namespace svsoft\thumbnails;


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
     */
    function create($imageUri, ThumbInterface $thumb) : string
    {
        $thumbUri = $thumb->getUri($imageUri);

        if (1 || !$this->thumbStorage->exists($thumbUri))
        {
            $image = $this->imageStorage->open($imageUri);

            $image = $thumb->handle($image);

            $this->thumbStorage->save($image, $thumbUri);
        }

        return $this->thumbStorage->getUrl($thumbUri);
    }
}