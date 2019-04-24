<?php

namespace svsoft\thumbnails\yii\handlers;

use svsoft\thumbnails\handlers\WatermarkHandler;
use svsoft\thumbnails\yii\AbstractFactory;

/**
 * Class WatermarkHandlerFactory
 * @package svsoft\thumbnails\yii\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class WatermarkHandlerFactory extends AbstractFactory
{
    public $watermarkFilePath;

    public $color;

    public $opacity;

    /**
     * @return WatermarkHandler
     */
    function create()
    {
        $handler = new WatermarkHandler(\Yii::getAlias($this->watermarkFilePath));

        if ($this->color)
            $handler->color = $this->color;

        if ($this->opacity)
            $handler->opacity = $this->opacity;

        return $handler;
    }
}