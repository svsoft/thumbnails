<?php

namespace svsoft\thumbnails;

use Imagine\Image\ImageInterface;

/**
 * Class ThumbLocalStorage
 * @package svsoft\thumbnails
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
class ThumbLocalStorage implements ThumbStorageInterface
{
    protected $dirPath;

    protected $webDirPath;

    public $mode = 0755;

    public function __construct($dirPath, $webDirPath)
    {
        if (!$dirPath)
            throw new \InvalidArgumentException('Argument dirPath must be set');

        if (!$webDirPath)
            throw new \InvalidArgumentException('Argument dirPath must be set');

        $this->dirPath = $dirPath;

        $this->webDirPath = $webDirPath;
    }
    /**
     * @param $uri
     *
     * @return string
     */
    protected function getFilePath($uri)
    {
        return $this->dirPath . $this->normalizeRelativePath($uri);
    }

    /**
     * @param $uri
     *
     * @return string
     */
    protected function normalizeRelativePath($uri)
    {
        return DIRECTORY_SEPARATOR . ltrim($uri, DIRECTORY_SEPARATOR);
    }

    /**
     * @param ImageInterface $image
     * @param string $uri - идентификатор файла, относительный путь
     */
    function save(ImageInterface $image, $uri) : void
    {
        $dirPath = dirname($this->getFilePath($uri));

        if (!file_exists($dirPath))
            mkdir($dirPath, $this->mode, true);
        elseif (!is_dir($dirPath))
            throw new \LogicException("{$dirPath} is not directory");

        $image->save($this->getFilePath($uri));
    }

    /**
     * @param string $uri - идентификатор файла, относительный путь
     *
     * @return bool
     */
    function exists($uri) : bool
    {
        return file_exists($this->getFilePath($uri));
    }

    /**
     * @param string $uri - идентификатор файла, относительный путь
     *
     * @return string
     */
    function getUrl($uri) : string
    {
        return $this->webDirPath . $this->normalizeRelativePath($uri);
    }
}