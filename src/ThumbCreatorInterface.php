<?php

namespace svsoft\thumbnails;

use svsoft\thumbnails\exceptions\FileNotFoundException;
use svsoft\thumbnails\exceptions\UnableOpenImageException;

/**
 * Interface ThumbCreatorInterface
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
interface ThumbCreatorInterface
{

    /**
     * @param $imageUri
     * @param ThumbInterface $thumb
     *
     * @return string
     * @throws FileNotFoundException
     * @throws UnableOpenImageException
     */
    function create($imageUri, ThumbInterface $thumb) : string ;

    /**
     * @param string $imageUri
     * @param ThumbInterface $thumb
     *
     * @return string
     */
    function getUrl(string $imageUri, ThumbInterface $thumb): string ;
}