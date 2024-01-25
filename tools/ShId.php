<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShId
{
    private static $id = 0;
    private static $prefix = "id-";

    public function __construct()
    {
        self::$id++;
    }

    public function __toString()
    {
        return self::$prefix . self::$id;
    }
}