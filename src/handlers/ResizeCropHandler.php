<?php

namespace svsoft\thumbnails\handlers;

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Point;

/**
 * Class ResizeHandler
 * @package svsoft\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeCropHandler extends AbstractHandler implements ResizeHandlerInterface
{
    public $width;

    public $height;

    public $mode;

    const MODE_CENTER  = 'center';
    const MODE_BEGIN   = 'begin';
    const MODE_END     = 'end';


    /**
     * Возвращает массив параметров обработчика
     *
     * @return array
     */
    protected static function params(): array
    {
        return ['width','height','mode'];
    }

    function __construct($width, $height, $mode = self::MODE_CENTER)
    {
        $this->width = $width;
        $this->height = $height;
        $this->mode = $mode;
    }

    function handle(ImageInterface $image) : ImageInterface
    {
        $size = new \Imagine\Image\Box($this->width, $this->height);

        $imageSize = $image->getSize();

        $allowUpscale = true;

        $ratios = array(
            $size->getWidth() / $imageSize->getWidth(),
            $size->getHeight() / $imageSize->getHeight(),
        );
        $ratio = max($ratios);
        if ($imageSize->contains($size))
        {
            // Downscale the image
            $imageSize = $imageSize->scale($ratio);
            $image->resize($imageSize);
            $thumbSize = $size;
        }
        else
        {

            if ($allowUpscale)
            {
                // Upscale the image so that the max dimension will be the wanted one
                $imageSize = $imageSize->scale($ratio);
                $image->resize($imageSize);
            }
            $thumbSize = new Box(
                min($imageSize->getWidth(), $size->getWidth()),
                min($imageSize->getHeight(), $size->getHeight())
            );
        }

        switch($this->mode)
        {
            case self::MODE_BEGIN:
                $k = -1;
                break;
            case self::MODE_END:
                $k = 1;
                break;
            default:
                $k = 2;
        }

        $point = new Point(
            max(0, round(($imageSize->getWidth() - $size->getWidth()) / $k)),
            max(0, round(($imageSize->getHeight() - $size->getHeight()) / $k))
        );

        $image->crop( $point, $thumbSize );

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