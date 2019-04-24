<?php

namespace svsoft\thumbnails\handlers;

/**
 * Interface ResizeHandlerInterface
 * @package svsoft\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ResizeHandlerInterface
{
    /**
     * @return array
     */
    function getSize();
}