<?php

namespace svsoft\thumbnails;

/**
 * Class ImageThumb
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class Thumbnails implements ThumbnailsInterface
{
    /**
     * @var ThumbManager
     */
    private $manager;

    /**
     * @var ThumbCreator
     */
    private $creator;

    /**
     * ImageThumb constructor.
     *
     * @param ThumbManager $manager
     * @param ThumbCreator $creator
     */
    function __construct(ThumbManager $manager, ThumbCreator $creator)
    {
        $this->manager = $manager;
        $this->creator = $creator;
    }

    function thumb(string $imageUri, string $thumbId) : string
    {
        $thumb = $this->manager->getThumb($thumbId);

        return $this->creator->create($imageUri, $thumb);
    }

    /**
     * @return ThumbCreator
     */
    function getCreator() : ThumbCreatorInterface
    {
        return $this->creator;
    }

    /**
     * @return ThumbManagerInterface
     */
    function getManager(): ThumbManagerInterface
    {
        return $this->manager;
    }
}