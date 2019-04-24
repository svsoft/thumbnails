<?php

namespace svsoft\thumbnails;

/**
 * Interface ThumbCreatorInterface
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ThumbCreatorInterface
{

    /**
     * @param $imageUri
     * @param ThumbInterface $thumb
     *
     * @return string
     */
    function create($imageUri, ThumbInterface $thumb) : string ;
}