<?php
header('Content-type: text/html; charset=cp-1251');

if (isset($_REQUEST['execute'])) {
    $result = [];
    $add = $_REQUEST['add'];
    $add = escapeshellcmd($add);
    for ($i = 1; $i <= 2; $i++) {
        if (isset($_REQUEST[$i])) {
            $command = $_REQUEST[$i];
        }
    }
    if ($add == null) {
        print ("Enter address");
    } else {
        exec($command . " " . $add, $result_of_command);

        for ($i = 0; $i < count($result_of_command); $i++) {
            if (!((stristr($result_of_command[$i], 'Bad') === FALSE)) || !((stristr($result_of_command[$i], 'Неправильный') === FALSE))) {
                print ($result_of_command[$i]);
                exit;
            }
        }

        findIp($result_of_command);

        switch ($command) {
            case 'ping':
                $proportion_of_received = 0;
                foreach ($result_of_command as $value) {
                    if (!(stristr($value, '%') === FALSE)) {
                        $pos_sent = strpos($value, '=');
                        $sent = (int)$value[$pos_sent + 2];

                        $pos_received = strpos($value, '=', 2);
                        $received = (int)$value[$pos_received + 2];

                        $proportion_of_received = (int)($received / $sent) * 100;
                        break;
                    }
                }
                print("<br>");
                print ("Proportion of received packets = " . $proportion_of_received . "%");
                break;
            case 'tracert':
                $add = [];
                foreach ($result_of_command as $value) {

                    if (stristr($value, '[')) {
                        $ip = '';
                        $line = stristr($value, '[');
                        $pos = strpos($line, ']');
                        for ($i = 1; $i < $pos; $i++) {
                            $ip = $ip . $line[$i];
                        }
                        array_push($add, $ip);
                    } else {
                        $current_str = explode(" ", $value);
                        foreach ($current_str as $item) {
                            if (preg_match("/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/", $item)) {
                                array_push($add, $item);
                            }
                        }
                    }
                }
                print ("<br>");
                print ("Trace: ");
                for ($i = 1; $i < count($add); $i++) {
                    print ($add[$i] . ",");
                }
                break;
            default:
                print ("ERROR");
        }
    }
} else {
    include "form.html";
}

function findIp($result_of_command)
{
    $ip = '';
    $line = stristr($result_of_command[1], '[');
    $pos = strpos($line, ']');
    for ($i = 1; $i < $pos; $i++) {
        $ip = $ip . $line[$i];
    }
    $ip_bold = "<b>" . $ip . "</b>";
    print ("Ip address: " . $ip_bold);

}