<?php

namespace svsoft\thumbnails;

/**
 * Interface ThumbManagerInterface
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ThumbManagerInterface
{

    /**
     * @param ThumbInterface[] $thumbs
     */
    function setThumbs(array $thumbs) ;

    /**
     * @param $key
     *
     * @return ThumbInterface
     */
    function getThumb($key) : ThumbInterface;

    /**
     * @return ThumbInterface[]
     */
    function getThumbs() : array ;
}