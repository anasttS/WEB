<?php

$info = parse_ini_file('index.ini', INI_SCANNER_TYPED);

$descriptor = fopen("data.txt", 'r');

$strings = readFileData($descriptor);

handleStrings($info, $strings);

fclose($descriptor);


function readFileData($descriptor)
{
    $strings = [];
    if ($descriptor) {
        while (!feof($descriptor)) {
            array_push($strings, fgets($descriptor));
        }
    }
    return $strings;
}

function handleStrings($info, $strings)
{
    print ("Unmodified strings:");
    print ("<br />");
    foreach ($strings as $i) {
        print ($i);
        print ("<br />");
    }

    print ("<br />");
    print ("Modified strings:");
    print ("<br />");

    for ($i = 0; $i < count($strings); $i++) {
        $current = $strings[$i];
        $separated_current = explode(' ', $current);
        switch ($separated_current[0]) {
            case ($info["first_rule"]["symbol"]):
            {
                $first_rule = $info["first_rule"]["upper"];
                check1($first_rule, $separated_current);
                break;
            }

            case ($info["second_rule"]["symbol"]):
            {
                $second_rule = $info["second_rule"]["direction"];
                check2($second_rule, $separated_current);
                break;
            }

            case($info["third_rule"]["symbol"]) :
            {
                $third_rule = $info["third_rule"]["delete"];
                check3($third_rule, $separated_current);
                break;
            }
            default:
            {
                print("String must started with such symbols as 1,2,3");
            }
        }
    }
}

function check1($first_rule, $separated_current)
{
    $result = "";
    if ($first_rule) {
        foreach ($separated_current as $item) {
            $item = strtoupper($item);
            $result = $result . $item . " ";
        }
    }
    print ($result);
    print ("<br />");
}

function check2($second_rule, $separated_current)
{
    $result = "";
    for ($i = 1; $i < count($separated_current); $i++) {
        $word = $separated_current[$i];
        $symbols_of_word = str_split($word);
        if ($second_rule == '+') {
            for ($j = 0; $j < count($symbols_of_word); $j++) {
                if (is_numeric($symbols_of_word[$j])) {
                    if ($symbols_of_word[$j] == '9') {
                        $change = (int)'0';
                    } else {
                        $change = (int)$symbols_of_word[$j] + 1;
                    }
                    $word = str_replace($symbols_of_word[$j], $change, $word);
                }
            }
        } else {
            for ($j = 0; $j < count($symbols_of_word); $j++) {
                if (is_numeric($symbols_of_word[$j])) {
                    if ($symbols_of_word[$j] == '0') {
                        $change = (int)'9';
                    } else {
                        $change = (int)$symbols_of_word[$j] - 1;
                    }
                    $word = str_replace($symbols_of_word[$j], $change, $word);
                }
            }
        }
        $result = $result . $word . " ";
    }
    print ("2 " . $result);
    print ("<br />");
}

function check3($third_rule, $separated_current)
{
    $result3 = "";
    for ($i = 0; $i < count($separated_current); $i++) {
        $separated_current[$i] = str_replace($third_rule, '', $separated_current[$i]);
        $result3 = $result3 . $separated_current[$i] . " ";
    }
    print ($result3);
    print ("<br />");
}

