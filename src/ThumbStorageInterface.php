<?php
namespace svsoft\thumbnails;

use Imagine\Image\ImageInterface;

/**
 * Interface ThumbStorageInterface
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ThumbStorageInterface
{
    /**
     * @param ImageInterface $image
     * @param string $uri - идентификатор файла, относительный путь
     *
     * @return mixed
     */
    function save(ImageInterface $image, $uri) : void;

    /**
     * @param $uri - идентификатор файла, относительный путь
     *
     * @return bool
     */
    function exists($uri) : bool ;

    /**
     * @param $uri - идентификатор файла, относительный путь
     *
     * @return mixed
     */
    function getUrl($uri) : string ;

}