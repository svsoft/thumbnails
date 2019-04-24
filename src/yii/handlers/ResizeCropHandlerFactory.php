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

/**
 *
 * Factory for creating \svsoft\thumbnails\handlers\ResizeCropHandler
 *
 * Class ResizeFillingHandlerFactory
 * @package svsoft\thumbnails\yii\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ResizeCropHandlerFactory extends AbstractFactory
{
    public $width;

    public $height;

    public $mode;

    function create()
    {
        $handler = new \svsoft\thumbnails\handlers\ResizeCropHandler($this->width, $this->height);

        if ($this->mode)
            $handler->mode = $this->mode;

        return $handler;
    }
}