<?php

use loggerImpl\LoggerInterfaceImpl;

require "LoggerInterfaceImpl.php";

$LoggerInterfaceImpl = new LoggerInterfaceImpl("log");
    $context = array("username" => "Nastya");
    $LoggerInterfaceImpl->log("log", "log", $context);
