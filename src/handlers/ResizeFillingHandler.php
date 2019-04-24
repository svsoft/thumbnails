<?php

namespace svsoft\thumbnails\handlers;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use svsoft\thumbnails\traits\GetImagineTrait;

/**
 * Class ResizeFillingHandler
 * @package svsoft\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeFillingHandler extends AbstractHandler implements ResizeHandlerInterface
{
    use GetImagineTrait;

    public $width;

    public $height;

    public $color;
    /**
     * @var int 0..100
     */
    public $opacity;

    function __construct($width, $height, $color = '#FFFFFF', int $opacity = 0)
    {
        $this->width = $width;
        $this->height = $height;
        $this->color = $color;
        $this->opacity = (int)$opacity;
    }

    /**
     * Возвращает массив параметров обработчика
     *
     * @return array
     */
    protected static function params(): array
    {
        return ['width','height','color','opacity'];
    }

    function handle(ImageInterface $image) : ImageInterface
    {
        $imagine = $this::getImagine();
        $size    = new Box($this->width, $this->height);
        $thumb = $image->thumbnail($size, ImageInterface::THUMBNAIL_INSET);

        $thumbWidth = $thumb->getSize()->getWidth();
        $thumbHeight = $thumb->getSize()->getHeight();

        $color = (new \Imagine\Image\Palette\RGB())->color($this->color, $this->opacity);
        $point = new \Imagine\Image\Point(($size->getWidth() - $thumbWidth)/2, ($size->getHeight() - $thumbHeight)/2);

        $thumb = $imagine->create($size, $color)->paste($thumb, $point);

        return $thumb;
    }

    /**
     * @return array
     */
    function getSize()
    {
        return [$this->width, $this->height];
    }
}