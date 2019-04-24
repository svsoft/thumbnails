<?php

namespace svsoft\thumbnails\yii\handlers;

use svsoft\thumbnails\yii\AbstractFactory;


/**
 * Factory for creating \svsoft\thumbnails\handlers\ResizeFillingHandler
 *
 * Class ResizeFillingHandlerFactory
 * @package svsoft\thumbnails\yii\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeFillingHandlerFactory extends AbstractFactory
{
    public $width;

    public $height;

    public $color;

    public $opacity;

    function create()
    {
        $handler = new \svsoft\thumbnails\handlers\ResizeFillingHandler($this->width, $this->height);

        if ($this->opacity)
            $handler->opacity = $this->opacity;

        if ($this->color)
            $handler->color = $this->color;

        return $handler;
    }
}