<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShLog
{
    private $name;
    private $log = [];
    public $LEVEL_DEBUG = 0;
    public $LEVEL_INFO = 1;
    public $LEVEL_ERROR = 2;
    public $level = ["Debug", "Info", "Error"];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function add($level, $message) {
        $logMessage = $this->name . " " . $this->level[$level] . ": " . $message;
        $this->log[] = $logMessage;
        error_log($logMessage);
    }

    public function print() {
        foreach ($this->log as $logMessage) {
            echo $logMessage . "<br/>";
        }
    }
}