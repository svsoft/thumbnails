<?php

namespace svsoft\thumbnails;

use Imagine\Image\ImageInterface;
use svsoft\thumbnails\handlers\HandlerInterface;
use svsoft\thumbnails\handlers\ResizeHandlerInterface;

/**
 * Class Thumb
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class Thumb implements ThumbInterface
{
    /**
     * @var HandlerInterface[]
     */
    protected $handlers = [];

    function __construct($handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @return HandlerInterface[]
     */
    function getHandlers() : array
    {
        return $this->handlers;
    }

    function getUri($filePath) : string
    {
        $filename = pathinfo($filePath, PATHINFO_BASENAME);

        $path = [''];
        $id = $filePath;
        foreach($this->getHandlers() as $handler)
        {
            if ($handler instanceof ResizeHandlerInterface)
            {
                $path[] = implode('x', $handler->getSize());
            }

            $id .= implode(',', $handler->getParams());
        }

        $hash = md5($id);
        $path[] = substr($hash, 0, 8);
        $path[] = $filename;

        return implode(DIRECTORY_SEPARATOR, $path);
    }

    /**
     * @param ImageInterface $image
     *
     * @return ImageInterface
     */
    function handle(ImageInterface $image) : ImageInterface
    {
        foreach($this->getHandlers() as $handler)
        {
            $image = $handler->handle($image);
        }

        return $image;
    }

}