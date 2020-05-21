<?php

namespace loggerImpl;

use DateTime;
use loggerInterface\LoggerInterface;

require "LoggerInterface.php";

class LoggerInterfaceImpl  implements LoggerInterface
{
    private array $json_arr = [];
    private $file;

    public function __construct($filename)
    {
        $this->file = fopen($filename, 'w');
    }

    public function log($level, $message, array $context = [])
    {
        switch ($level) {
            case "emergency":
                $this->emergency($message, $context);
                break;
            case "alert":
                $this->alert($message, $context);
                break;
            case "critical":
                $this->critical($message, $context);
                break;
            case "error":
                $this->error($message, $context);
                break;
            case "warning":
                $this->warning($message, $context);
                break;
            case "notice":
                $this->notice($message, $context);
                break;
            case "info":
                $this->info($message, $context);
                break;
            case "debug":
                $this->debug($message);
                break;
            default:
                print "Unknown level";

        }
    }

    public function emergency($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "emergency",
            'time' => $now,
            'context' => $context]);
    }

    public function alert($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "alert",
            'time' => $now,
            'context' => $context]);
    }

    public function critical($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "critical",
            'time' => $now,
            'context' => $context]);
    }

    public function error($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "error",
            'time' => $now,
            'context' => $context]);
    }

    public function warning($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "warning",
            'time' => $now,
            'context' => $context]);
    }

    public function notice($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "notice",
            'time' => $now,
            'context' => $context]);
    }

    public function info($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "info",
            'time' => $now,
            'context' => $context]);
    }

    public function debug($message, array $context = [])
    {
        $now = new DateTime('now');
        array_push($this->json_arr, [
            'type' => "debug",
            'time' => $now,
            'context' => $context]);
    }

    public function __destruct()
    {
        fwrite($this->file, json_encode($this->json_arr, JSON_PRETTY_PRINT));
    }
}
