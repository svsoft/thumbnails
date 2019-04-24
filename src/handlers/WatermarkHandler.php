<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 14.04.2019
 * Time: 10:22
 */

namespace svsoft\thumbnails\handlers;

use Imagine\Image\ImageInterface;
use Imagine\Image\Point;
use svsoft\thumbnails\traits\GetImagineTrait;

/**
 * Puts a watermark on the image
 *
 * Class WatermarkHandler
 * @package svsoft\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class WatermarkHandler extends AbstractHandler
{
    use GetImagineTrait;

    public $watermarkFilePath;

    /**
     * @var int 0..100
     */
    public $opacity = 0;

    /**
     * Возвращает массив параметров обработчика
     *
     * @return array
     */
    protected static function params(): array
    {
        return ['watermarkFilePath', 'opacity'];
    }


    function __construct(string $watermarkFilePath, int $opacity = 100)
    {
        $this->watermarkFilePath = $watermarkFilePath;
        $this->opacity = $opacity;
    }

    function handle(ImageInterface $image) : ImageInterface
    {
        $watermark = self::getImagine()->open($this->watermarkFilePath);

        $imageSize      = $image->getSize();
        $watermarkSize     = $watermark->getSize();

        $bottomRight = new Point($imageSize->getWidth() - $watermarkSize->getWidth(), $imageSize->getHeight() - $watermarkSize->getHeight());

        $image->paste($watermark, $bottomRight, $this->opacity);

        return $image;
    }
}