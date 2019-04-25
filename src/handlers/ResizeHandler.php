<?php

namespace svsoft\thumbnails\handlers;

use Imagine\Image\ImageInterface;

/**
 * Class ResizeHandler
 * @package svsoft\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeHandler extends AbstractHandler implements ResizeHandlerInterface
{
    public $width;

    public $height;

    /**
     * Возвращает массив параметров обработчика
     *
     * @return array
     */
    protected static function params(): array
    {
        return ['width','height'];
    }

    function __construct($width, $height)
    {
        $this->width = (int)$width;
        $this->height = (int)$height;

        if (!$this->width)
            throw new \InvalidArgumentException('Argument width must be set');

        if (!$this->height)
            throw new \InvalidArgumentException('Argument width must be set');
    }

    function handle(ImageInterface $image) : ImageInterface
    {
        $size = new \Imagine\Image\Box($this->width, $this->height);

        $image = $image->thumbnail($size, ImageInterface::THUMBNAIL_INSET);

        return $image;
    }

    /**
     * @return array
     */
    function getSize()
    {
        return [$this->width, $this->height];
    }

}