<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: UNLICENSED
 */

class ShTools
{
    public static $currentLocale;

    public static function dateTimeToSqlDate(DateTime $dateTime)
    {
        return date_format($dateTime, 'Y-m-d H:i:s');
    }

    public static function dateTimeToSchemaOrgDateTime(DateTime $dateTime)
    {
        return date_format($dateTime, 'Y-m-d\TH:i');
    }

    public static function p2nl(String $text)
    {
        $text = str_replace("</p>", "\n", str_replace("<p>", "", $text));
        return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $text);
    }

    public static function removeNewlines(String $text)
    {
        return preg_replace("/(\n\s*)/", "", $text);
    }

    public static function setLocale($localeOrLang, $category = LC_ALL)
    {
        $locale = self::lang2locale($localeOrLang);
        if($locale === "de_DE") {
            $locale = "de_DE.UTF-8";
        }
        setlocale($category, $locale);
    }

    public static function resetLocale($category = LC_ALL)
    {
        setlocale($category, self::$currentLocale);
    }

    public static function lang2locale($lang)
    {
        if ($lang == "de") {
            return "de_DE";
        } else if ($lang == "en") {
            return "en_US";
        } else {
            return $lang;
        }
    }

    public static function Csv2Table($csv)
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
}

ShTools::$currentLocale = setlocale(LC_ALL, 0);