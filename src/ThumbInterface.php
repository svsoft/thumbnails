<?php

namespace svsoft\thumbnails;

use Imagine\Image\ImageInterface;
use svsoft\thumbnails\handlers\HandlerInterface;

/**
 * Interface ThumbInterface
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ThumbInterface
{
    /**
     * @return HandlerInterface[]
     */
    function getHandlers() : array;

    function getUri($filePath) : string ;

    /**
     * @param ImageInterface $image
     *
     * @return ImageInterface
     */
    function handle(ImageInterface $image) : ImageInterface;
}