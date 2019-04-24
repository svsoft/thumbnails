<?php

namespace svsoft\thumbnails;

/**
 * Interface ImageThumbInterface
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ThumbnailsInterface
{

    /**
     * @param string $imageUri
     * @param string $thumbId
     *
     * @return string
     */
    function thumb(string $imageUri, string $thumbId) : string ;

    /**
     * @return ThumbCreatorInterface
     */
    function getCreator() : ThumbCreatorInterface;

    /**
     * @return ThumbManagerInterface
     */
    function getManager() : ThumbManagerInterface;
}