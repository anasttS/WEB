<?php

if (isset($_REQUEST["sort"])) {
    $strings = $_REQUEST["strings"];
    $separate_strings = explode("\n", $strings);

    $sort_string = sort_str($separate_strings);

    foreach ($sort_string as $value) {
        echo $value . "<br />";
    }

} else {
    include "from.html";
}

function sort_str($separate_strings)
{
    $sort_string = [];
    for ($i = 0; $i < count($separate_strings); $i++) {
        $separate_strings[$i] = explode(' ', $separate_strings[$i]);
        array_push($sort_string, $separate_strings[$i]);
        shuffle($separate_strings[$i]);
        array_push($sort_string, $separate_strings[$i]);
    }
    usort($sort_string, function ($a, $b) {
        if ($a[1] < $b[1]) return -1;
        else return 1;
    });

    for ($i = 0; $i < count($sort_string); $i++) {
        $sort_string[$i] = implode(" ", $sort_string[$i]);
    }
    return $sort_string;
}
