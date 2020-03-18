<?php

function checkGenerator($arr_weight, $data)
{
    $res = array();
    $count = 0;
    //$dataNew = array_fill(0, count($data),0);
    $frequency = array_fill(0, count($data),0);

    while ($count < 10000) {
        $generator = generator($arr_weight, $data);
        foreach ($generator as $item) {
            $index = array_search($item, $data);
            //$dataNew[$index] = $item;
            $frequency[$index]++;
        }
        $count++;
    }

    for ($i = 0; $i < count($data); $i++) {
        array_push($res, ["text" => $data[$i], "count" => $frequency[$i], "calculated_probability" => $frequency[$i] / 10000]);
    }
    return $res;
}

function generator($arr_weight, $data)
{
    $data_for_random = [];
    $sum = 0;
    for ($i = 0; $i < count($arr_weight); $i++) {
        $sum += $arr_weight[$i];
        while ($arr_weight[$i] != 0) {
            array_push($data_for_random, $data[$i]);
            $arr_weight[$i]--;
        }
    }
    $rand_number = mt_rand(0, $sum);
//    if (count($data_for_random) == $sum){
//        echo ("OEHJFSEJ");
//    }
    for ($i = 0; $i < count($data_for_random); $i++) {
        if ($rand_number == $i) {
            yield $data_for_random[$rand_number];
        }
    }
}

