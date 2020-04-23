<?php
include_once "Logger.php";

class BrowserLogger extends Logger
{
    private $type;


    public function __construct($type)
    {
        $this->type = $type;

    }

    public function writeString($string)
    {
        $date = new DateTime('now', new DateTimeZone("Europe/Moscow"));

        if ($this->type != "off") {
            $date = $date->format($this->type);
            print ($date . " " . $string);
        } else {
            print ($string);
        }
    }
}