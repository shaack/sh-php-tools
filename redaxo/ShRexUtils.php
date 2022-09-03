<?php

class ShRexUtils
{
    static function csvToArray($csv): array
    {
        return explode(",", $csv);
    }

    static function csvToArticles($csv): array
    {
        $Ids = self::csvToArray($csv);
        $articles = [];
        foreach ($Ids as $id) {
            $articles[] = rex_article::get($id);
        }
        return $articles;
    }

    static function csvToMediaManagerFiles($csv): array
    {
        $names = self::csvToArray($csv);
        $mediaManagerFiles = [];
        foreach ($names as $name) {
            $mediaManagerFiles[] = new ShRexMediaManagerFile($name);
        }
        return $mediaManagerFiles;
    }

    /**
     * One link per line, Name URL. Separated by last space.
     * @return array
     */
    static function textareaLinklist($text)
    {
        $linksArray = [];
        $linesArray = preg_split("/\r\n|\n|\r/", $text);
        foreach ($linesArray as $line) {
            $line = trim($line);
            if ($line) {
                $parts = array_map('trim', explode(' ', $line));
                $result = array(implode(' ', array_slice($parts, 0, -1)), end($parts));
                $linksArray[$result[0]] = $result[1];
            }
        }
        return $linksArray;
    }
}