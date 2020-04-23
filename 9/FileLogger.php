<?php
include_once "Logger.php";

class FileLogger extends Logger
{
    private $file;


    public function __construct($filename )
    {
        $this->file = fopen($filename, 'w');
    }

    public function writeString($string)
    {
        fwrite($this->file, $string);
    }

    function __destruct()
    {
        fclose($this->file);
    }
}