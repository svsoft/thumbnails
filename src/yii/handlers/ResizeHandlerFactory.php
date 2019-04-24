<?php

namespace svsoft\thumbnails\yii\handlers;

use svsoft\thumbnails\yii\AbstractFactory;

/**
 * Class ResizeHandlerFactory
 * @package svsoft\thumbnails\yii\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeHandlerFactory extends AbstractFactory
{
    public $width;

    public $height;

    function create()
    {
        return new \svsoft\thumbnails\handlers\ResizeHandler($this->width, $this->height);
    }
}