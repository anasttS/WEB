<?php
include "generator.php";

if (isset($_REQUEST["convert"])) {

    $data = $_REQUEST["data"];

    print ("1.");
    $separated_data = explode("\n", $data);
    $json_arr = convertToJson($separated_data);
    print_r(json_encode($json_arr, JSON_PRETTY_PRINT));

    print ("<br />"."<br />");

    print("2.");
    $data_from_json = [];
    array_push($data_from_json, $json_arr["data"]);
    $arr_weight = [];
    foreach ($json_arr["data"] as $item){
        array_push($arr_weight, $item["weight"]);
    }
    $arr = checkGenerator($arr_weight, $data_from_json);
    print_r(json_encode($arr, JSON_PRETTY_PRINT));

} else {
    include "form.html";
}

function countSumWeight($separated_data)
{
//    $arr_weight = [];
    $sum_weight = 0;
    for ($i = 0; $i < count($separated_data); $i++) {
        $arr = explode(" ", $separated_data[$i]);
        $elem = (int) end($arr);
        $sum_weight += $elem;
//       array_push($arr_weight, $elem);
    }
    return $sum_weight;
}


function convertToJson($separated_data)
{
    $weight = countSumWeight($separated_data)[0];
    $json_arr = ["sum" => $weight, "data" => []];
    for ($i = 0; $i < count($separated_data); $i++) {
        $arr = explode(" ", $separated_data[$i]);
        $elem = (int) end($arr);
        $probability = (float)$elem / $weight;
        array_push($json_arr["data"], ["text" => $separated_data[$i], "weight" => $elem, "probability" => $probability]);
    }
    return $json_arr;
}


