<?php

namespace svsoft\thumbnails;

use Imagine\Exception\InvalidArgumentException;
use Imagine\Exception\RuntimeException;
use Imagine\Image\ImageInterface;
use svsoft\thumbnails\exceptions\FileNotFoundException;
use svsoft\thumbnails\exceptions\UnableOpenImageException;
use svsoft\thumbnails\traits\GetImagineTrait;

/**
 * Class ImageLocalStorage
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ImageLocalStorage implements ImageStorageInterface
{

    use GetImagineTrait;

    /**
     * @param $path
     *
     * @return ImageInterface
     * @throws FileNotFoundException
     * @throws UnableOpenImageException
     */
    function open($path)
    {
        try
        {
            return self::getImagine()->open($path);
        }
        catch(InvalidArgumentException $exception)
        {
            throw new FileNotFoundException($exception->getMessage());
        }
        catch(RuntimeException $exception)
        {
            throw new UnableOpenImageException($exception->getMessage());
        }
    }
}