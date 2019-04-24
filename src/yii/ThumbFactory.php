<?php

namespace svsoft\thumbnails\yii;

/**
 * Class ThumbFactory
 * @package svsoft\thumbnails\yii
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ThumbFactory extends AbstractFactory
{
    /**
     * @var AbstractFactory[]
     */
    public $handlers;

    function create()
    {
        $handlers = [];
        foreach($this->handlers as $key=>$handler)
        {
            if (is_array($handler))
                $handler = \Yii::createObject($handler);

            $handlers[] = $handler->create();
        }

        return new \svsoft\thumbnails\Thumb($handlers);
    }
}