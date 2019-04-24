<?php

namespace svsoft\thumbnails;

/**
 * Class ThumbManager
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ThumbManager implements ThumbManagerInterface
{
    /**
     * @var ThumbInterface[]
     */
    protected $thumbs;


    /**
     * @param ThumbInterface[] $thumbs
     */
    function setThumbs(array $thumbs) : void
    {
        $this->thumbs = $thumbs;
    }


    /**
     * @param $key
     *
     * @return ThumbInterface
     */
    function getThumb($key) : ThumbInterface
    {
        if (empty($this->thumbs[$key]))
            throw new \InvalidArgumentException("handler with key \"{$key}\" not found");

        return $this->thumbs[$key];
    }

    /**
     * @return ThumbInterface[]
     */
    function getThumbs() : array
    {
        return $this->thumbs;
    }

}