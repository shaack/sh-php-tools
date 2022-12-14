<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShRexDb
{
    private static $db;

    public static function db()
    {
        if (!self::$db) {
            self::$db = rex_sql::factory();
        }
        return self::$db;
    }

    public static function queryUnique(String $stmt, array $params = [])
    {
        self::db()->setQuery($stmt, $params);
        $result = self::db()->getArray();
        return !empty($result) ? self::db()->getArray()[0] : null;
    }

    public static function queryList(String $stmt, array $params = [])
    {
        self::db()->setQuery($stmt, $params);
        return self::db()->getArray();
    }

    public static function update(String $stmt, array $params = [])
    {
        return self::db()->setQuery($stmt, $params);
    }

    public static function updateField(String $table, int $id, String $field, String $value) {
        self::update("UPDATE $table SET $field = ? WHERE id = ? ", [$value, $id]);
    }

    public static function escape(String $string) {
        return self::db()->escape($string);
    }
}