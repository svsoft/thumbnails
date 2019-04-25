<?php

namespace svsoft\thumbnails;

use Imagine\Image\ImageInterface;
use svsoft\thumbnails\exceptions\FileNotFoundException;
use svsoft\thumbnails\exceptions\UnableOpenImageException;

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
     * @throws FileNotFoundException
     * @throws UnableOpenImageException
     */
    function open($path);
}