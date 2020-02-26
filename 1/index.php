<?php
// ++++[->+++++++++++++>++++++++++++<<]>.>++.  42
if (isset($_REQUEST["send"])) {
    $code = $_REQUEST["code"];
    $text = $_REQUEST["text"];
    $code_str = str_split($code);
    $text_str = str_split($text);

    checkSymbols($code_str, $text_str);

} else {
    include("form.html");
}

function checkSymbols($code_str, $text_str)
{
    $current = 0;
    $result = array(0);
    $param = 0;
    $number_of_opened_brackets = 0;
    $number_of_closed_brackets = 0;
    for ($i = 0; $i < count($code_str); ++$i) {
        switch ($code_str[$i]) {
            case ">":
                $current++;
                if (!isset($result[$current])) {
                    $result[$current] = 0;
                }
                break;
            case "<":
                $current--;
                if (!isset($result[$current])) {
                    $result[$current] = 0;
                }
                break;
            case "+":
                $result[$current]++;
                break;
            case "-":
                $result[$current]--;
                break;
            case ".":
                print(chr($result[$current]));
                break;
            case ",":
                $result[$current] = ord($text_str[$param]);
                $param++;
                break;
            case "[":
                if ($result[$current] == 0) {
                    $number_of_opened_brackets++;
                    while ($number_of_opened_brackets != 0) {
                        $i++;
                        if ($code_str[$i] == "[") {
                            $number_of_opened_brackets++;
                        } else if ($code_str[$i] == "]") {
                            $number_of_opened_brackets--;
                        }
                    }
                }
                break;
            case "]":
                if ($result[$current] != 0) {
                    $number_of_closed_brackets++;
                    while ($number_of_closed_brackets != 0) {
                        $i--;
                        if ($code_str[$i] == "]") {
                            $number_of_closed_brackets++;
                        } else if ($code_str[$i] == "[") {
                            $number_of_closed_brackets--;
                        }
                    }
                }
                break;
        }
    }
}
