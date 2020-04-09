<?php

if (isset($_REQUEST['execute'])) {
    $result = [];
    $add = $_REQUEST['add'];
    for ($i = 1; $i <= 2; $i++) {
        if (isset($_REQUEST[$i])) {
            $command = $_REQUEST[$i];
        }
    }
    if ($add == null) {
        print ("Enter address");
    } else {
        exec($command . " " . $add, $result_of_command);

        changeBoldIp($result_of_command);

        switch ($command) {
            case 'ping':
                    $proportion_of_received = 0;
                    foreach ($result_of_command as $value) {
                        if(!(stristr($value, 'Packets:') === FALSE)){
                            $pos_sent = stristr($value, '=');
                            $str = str_split($pos_sent);
                            $sent = (int) $str[2];

                            $pos_received = stristr($value, 'Lost', true);
                            $received = (int) substr($pos_received, -3, 1);

                            $proportion_of_received = (int) ($received / $sent) * 100;
                            break;
                        }
                    }
                    print("<br>");
                    print ("Proportion of received packets = ".$proportion_of_received."%");
                break;
            case 'tracert':
                $add = [];
                foreach ($result_of_command as $value) {
                    $current_str = explode(" ", $value);
                    foreach ($current_str as $item) {
                        if (preg_match("/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]):$/", $item) || preg_match("/^\[(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\]$/" , $item) || preg_match("/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/" , $item) )  {
                            array_push($add, $item);
                        }
                    }
                }
                print ("<br>");
                print ("Trace: ");
                for ($i = 1; $i < count($add); $i++){
                   print ($add[$i].", ");
                }
                break;
            default:
                print ("ERROR");
        }
    }
} else {
    include "form.html";
}

function changeBoldIp($result_of_command)
{
    foreach ($result_of_command as $value) {
        $current_str = explode(" ", $value);
        foreach ($current_str as $item) {
            if (preg_match("/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]):$/", $item) || preg_match("/^\[(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\]$/", $item) || preg_match("/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/" , $item)) {
                $current_str = str_replace($item, "<b>" . $item . "</b>", $current_str);
            }
        }
        $value = implode(" ", $current_str);
        print($value);
        print ("<br>");
    }
}