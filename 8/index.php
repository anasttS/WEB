<?php
if (isset($_REQUEST["show"])) {
    $now_date = new DateTime();
    if (($_REQUEST["month"]) != 0) {
        $month = $_REQUEST["month"];
        if ($month > 12 || $month < 1) {
            print ("Количество месяцев 12!");
            exit;
        }
    } else {
        $month = $now_date->format('n'); // месяц без ведущего нуля
    }
    $year = $now_date->format('Y'); // год
    $calendar = createCalendar($month, $year);
    print "<p><h4>".$month.".".$year."</h4></p>";
    print $calendar;
} else {
    include "form.html";
}

function createCalendar($month, $year)
{
    $calendar = "";
    $result = generator($month, $year);
    foreach ($result as $day) {
        $calendar .= $day;
    }
    return $calendar;
}

function generator($month, $year)
{
    $now_date = new DateTime();
    $current_day = $now_date->format('j'); // сегодняшний день без ведущего нуля
    $current_month = $now_date->format('n');
    $calendar = "";
    $number_of_days = date('t', mktime(0, 0, 0, $month, 1, $year));
    $number_of_weeks = ceil($number_of_days / 7);
    $count = 1;
    $last_day = date('N', mktime(0, 0, 0, $month, $number_of_days, $year));
    $first_day = date('N', mktime(0, 0, 0, $month, 1, $year));

    if (($number_of_days == 31 && ($first_day == 6 || $first_day == 7)) || ($number_of_days == 30 && $first_day == 7)) {
        $number_of_weeks++;
    }

    // 1 неделя
    for ($j = 0; $j < $first_day - 1; $j++) {
        $calendar .= "__" . " ";
    }
    for ($j = $first_day - 1; $j < 7; $j++) {
        if ($count == $current_day && $current_month == $month) {
            $calendar .= "<strong>" . "0" . $count . "</strong>" . "  ";
        } elseif ($j == 5 || $j == 6) {
            $calendar .= "<span style=\"color: red; \">" . "0" . $count . "</span>" . "  ";
        } else {
            $calendar .= "0" . $count . " ";
        }
        $count++;
    }
    $calendar .= "<br>";

    for ($j = 1; $j < $number_of_weeks - 1; $j++) {
        for ($i = 0; $i < 7; $i++) {
            if ($count < 10) {
                if ($i == 5 || $i == 6) {
                    $calendar .= "<span style=\"color: red; \">" . "0" . $count . "</span>" . " ";
                } elseif ($count == $current_day && $current_month == $month) {
                    $calendar .= "<b>" . "0" . $count . "</b>" . " ";
                } else {
                    $calendar .= "0" . $count . " ";
                }
            } else {
                if ($i == 5 || $i == 6) {
                    $calendar .= "<span style=\"color: red; \">" . $count . "</span>" . " ";
                } elseif ($count == $current_day && $current_month == $month) {
                    $calendar .= "<b>" . $count . "</b>" . " ";
                } else {
                    $calendar .= $count . " ";
                }
            }
            $count++;
        }
        $calendar .= "<br>";
    }

    // последняя неделя
    for ($j = 0; $j < $last_day; $j++) {
        if ($j == 5 || $j == 6) {
            $calendar .= "<span style=\"color: red; \">" . $count . "</span>" . " ";
        } elseif ($count == $current_day && $current_month == $month) {
            $calendar .= "<strong>" . $count . "</strong>" . " ";
        } else {
            $calendar .= $count . " ";
        }
        $count++;
    }
    $calendar .= "<br>";

    yield $calendar;
}
