<?php
if (isset($_REQUEST['send'])) {
    $string = $_REQUEST['string'];
    $result = changeSymbols($string);
    $str = $result[0];
    $count = $result[1];
    print ($str." ".$count." - количество замен");
} else {
    include("form.html");
}

function generator($string)
{
    static $count = 0;
    for ($i = 0; $i < strlen($string); $i++) {
        switch ($string[$i]) {
            case "h":
                $count++;
                yield "4";
                break;
            case "l":
                $count++;
                yield "1";
                break;
            case "e":
                $count++;
                yield "3";
                break;
            case "o":
                $count++;
                yield "0";
                break;
            default:
                yield $string[$i];
        }
    }
    return $count;
}

function changeSymbols($string)
{
    $str = "";
    $generator = generator($string);
    foreach ($generator as $item) {
        $str .= $item;
    }
    $count = $generator -> getReturn();
    return [$str, $count];
}