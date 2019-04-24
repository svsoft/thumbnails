<?php

namespace svsoft\thumbnails;

use Imagine\Image\ImageInterface;

/**
 * Interface ImageStorageInterface
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ImageStorageInterface
{
    /**
     * @param $path
     *
     * @return ImageInterface
     */
    function open($path);
}