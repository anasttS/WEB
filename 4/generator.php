<?php

function checkGenerator($arr_weight, $data)
{
    $count = 0;
    $res = array();
    $frequency = array();
    $dataNew = array();
    $length = count($data);

    while ($count < 10000) {
        $generator = generator($arr_weight, $data);
        foreach ($generator as $item) {
            for ($i = 0; $i < $length; $i++) {
                if ($data[$i] == $item) {
                    $frequency[$i]++;
                    array_push($dataNew[$i], $data[$i]);
                }
            }
        }
        $count++;
    }

    for ($i = 0; $i < count($dataNew); $i++) {
        array_push($res, ["text" => $dataNew[$i], "count" => $frequency[$i], "calculated_probability" => $frequency[$i] / 10000]);
    }
    return $res;
}

function generator($arr_weight, $data)
{
    $data_for_random = [];

    for ($i = 0; $i < count($arr_weight); $i++){
        while ($arr_weight[$i] != 0) {
            array_push($data_for_random, $data[$i]);
            $arr_weight[$i]--;
        }

    }

    $rand_number = array_rand($data_for_random, 1);
    for ($i = 0; $i < count($data_for_random); $i++) {
        if ($rand_number == $i) {
            yield $data_for_random[$rand_number];
        }
    }

}

