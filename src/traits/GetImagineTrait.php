<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 14.04.2019
 * Time: 10:22
 */

namespace svsoft\thumbnails\traits;

use Imagine\Image\ImagineInterface;

/**
 * Trait GetImagineTrait
 * @package svsoft\thumbnails\traits
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
trait GetImagineTrait
{
    /**
     * @var ImagineInterface
     */
    static private $imagine;

    /**
     * @return ImagineInterface
     */
    static protected function getImagine()
    {
        if (self::$imagine === null)
            self::$imagine = new \Imagine\Gd\Imagine();

        return self::$imagine;
    }

}