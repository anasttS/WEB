<?php

namespace loggerImpl;

use DateTime;
use loggerInterface\LoggerInterface;

require "LoggerInterface.php";

class LoggerInterfaceImpl implements LoggerInterface
{
    private array $json_arr = [];
    private $file;

    public function __construct($filename)
    {
        $this->file = fopen($filename, 'w');
    }

    public function log($level, $message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => $level,
            'time' => $now,
            'context' => $context]);
    }

    public function __destruct()
    {
        fwrite($this->file, json_encode($this->json_arr, JSON_PRETTY_PRINT));
    }

    public function emergency($message, array $context = [])
    {
    }

    public function alert($message, array $context = [])
    {
    }

    public function critical($message, array $context = [])
    {
    }

    public function error($message, array $context = [])
    {
    }

    public function warning($message, array $context = [])
    {
    }

    public function notice($message, array $context = [])
    {
    }

    public function info($message, array $context = [])
    {
    }

    public function debug($message, array $context = [])
    {
    }
}
