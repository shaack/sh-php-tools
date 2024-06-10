<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShTools
{
    public static string $currentLocale;

    public static function dateTimeToSqlDate(DateTime $dateTime): string
    {
        return date_format($dateTime, 'Y-m-d H:i:s');
    }

    public static function dateTimeToSchemaOrgDateTime(DateTime $dateTime): string
    {
        return date_format($dateTime, 'Y-m-d\TH:i');
    }

    public static function p2nl(string $text): string
    {
        $text = str_replace("</p>", "\n", str_replace("<p>", "", $text));
        return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $text);
    }

    public static function removeNewlines(string $text): string
    {
        return preg_replace("/(\n\s*)/", "", $text);
    }

    public static function setLocale($localeOrLang, $category = LC_ALL)
    {
        $locale = self::lang2locale($localeOrLang);
        if ($locale === "de_DE") {
            $locale = "de_DE.UTF-8";
        }
        setlocale($category, $locale);
    }

    public static function resetLocale($category = LC_ALL)
    {
        setlocale($category, self::$currentLocale);
    }

    public static function stringToHtmlId($string): string
    {
        $string = preg_replace("/[^a-zA-Z0-9]+/", "_", $string);
        return strtolower($string);
    }

    public static function lang2locale($lang): string
    {
        if ($lang == "de") {
            return "de_DE";
        } else if ($lang == "en") {
            return "en_US";
        } else {
            return $lang;
        }
    }

    public static function Csv2Table($csv): string
    {
        $trs = "";
        $rows = explode("\n", $csv);
        foreach ($rows as $row) {
            $fields = explode(";", $row);
            $tds = "";
            foreach ($fields as $field) {
                $field = trim($field);
                $tds .= "<td>$field</td>";
            }
            $trs .= "<tr>$tds</tr>";
        }
        return "<table>$trs</table>";
    }

    public static function createId($length = 8): string
    {
        $key = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for ($i = 0; $i < $length; $i++) {
            $key .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $key;
    }

    public static function getCurrentUri($includeQueryString = false)
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (!$includeQueryString) {
            $uri = strtok($uri, '?');
        }
        return $uri;
    }
}

// https://stackoverflow.com/questions/65502589/php-where-does-setlocales-value-come-from
// store the current locale (before changing it, so we can reset it later)
ShTools::$currentLocale = setlocale(LC_ALL, 0);