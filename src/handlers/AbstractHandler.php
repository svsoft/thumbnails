<?php

namespace svsoft\thumbnails\handlers;

/**
 * Class AbstractHandler
 * @package svsoft\thumbnails\handlers
 *
 * @author Shiryakov Viktor <shiryakovv@gmail.com>
 */
abstract class AbstractHandler implements HandlerInterface
{

    /**
     * Возвращает массив параметров обработчика
     *
     * @return array
     */
    abstract protected static function params(): array ;


    /**
     * Возвращает массив значений параметров обработчика
     *
     * @return array
     */
    function getParams(): array
    {
        $params = [];
        foreach($this::params() as $name)
        {
            $params[$name] = $this->$name;
        }

        return $params;
    }
}