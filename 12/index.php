<?php

if (isset($_REQUEST['send'])) {
    session_start();
    $string = $_REQUEST['string'];
    $_SESSION['str'] = $string;
    if (!isset($_COOKIE["string"])) {
        setcookie("string", $string, time() + 3600, "/12/");
        $_COOKIE["string"] = $string;
    }
    header("Location: http://localhost:63342/php/12/generator.php?string=$string&send=Send");
} else {
    include("form.php");
}


