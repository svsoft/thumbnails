<?php

namespace svsoft\thumbnails\handlers;

use Imagine\Image\ImageInterface;

/**
 * Interface HandlerInterface
 * @package svsoft\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface HandlerInterface
{
    function handle(ImageInterface $image) : ImageInterface;

    /**
     * Возвращает массив параметров обработчика
     *
     * @return array
     */
    function getParams() : array ;
}