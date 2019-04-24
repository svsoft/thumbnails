<?php

namespace svsoft\thumbnails\yii;

use yii\base\BaseObject;

/**
 * Class AbstractFactory
 * @package svsoft\thumbnails\yii
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
abstract class AbstractFactory extends BaseObject
{
    /**
     * @return object
     */
    abstract public function create();
}