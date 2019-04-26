<?php

namespace svsoft\thumbnails;

use svsoft\thumbnails\exceptions\FileNotFoundException;
use svsoft\thumbnails\exceptions\UnableOpenImageException;

/**
 * Class Thumbnails
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
     * Thumbnails constructor.
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
        $thumb = $this->getManager()->getThumb($thumbId);

        try
        {
            $url = $this->getCreator()->create($imageUri, $thumb);
        }
        catch(FileNotFoundException $exception)
        {
            $url = $this->getCreator()->getUrl($imageUri, $thumb);
        }
        catch(UnableOpenImageException $exception)
        {
            $url = $this->getCreator()->getUrl($imageUri, $thumb);
        }

        return $url;
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