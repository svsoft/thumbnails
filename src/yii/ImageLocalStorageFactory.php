<?php

namespace svsoft\thumbnails\yii;

use svsoft\thumbnails\ImageLocalStorage;

/**
 * Class ImageLocalStorageFactory
 * @package svsoft\thumbnails\yii
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ImageLocalStorageFactory extends AbstractFactory
{
    /**
     * @return object
     */
    public function create()
    {
        return new ImageLocalStorage();
    }
}