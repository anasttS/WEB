<?php
if (isset($_REQUEST["check"])) {
    $password = $_REQUEST["password"];

    $length_of_password = '/.{10}/';
    $required_two_symbols = '/(?=..*[0-9])(?=..*[%$#_*])(?=..*[a-z])(?=..*[A-Z])/';
    $three_near = '/ ([0-9]{4,})|([%$#_*]{4,})|([a-z]{4,})|([A-Z]{4,})/';

    if (preg_match($length_of_password, $password) && preg_match($required_two_symbols, $password) && !(preg_match($three_near, $password))) {
        print ("Good Password!");
    } else {
        check1($length_of_password, $password);
        echo("<br/>" . "<br/>");
        check2($required_two_symbols, $password);
        echo("<br/>" . "<br/>");
        check3($three_near, $password);
    }
} else {
    include "form.html";
}

function check1($length_of_password, $password)
{
    if (!preg_match($length_of_password, $password)) {
        print("Problem with length of password. It should be more 10");
    }
}

function check2($required_two_symbols, $password)
{
    if (!preg_match($required_two_symbols, $password)) {
        print ("Required 2 symbols of each group: lower case, upper case, numbers and special symbols:");
        if (preg_match('/..*[0-9]/', $password)) {
            print ("Check numbers ");
        }
        if (preg_match('/..*[a-z]/', $password)) {
            print (" Check lowercase letters ");
        }
        if (preg_match('/..*[A-Z]/', $password)) {
            print (" Check uppercase letters ");
        }
        if (preg_match('/..*[%$#_*]/', $password)) {
            print (" Check special symbols");
        }
    }

}

function check3($three_near, $password)
{
    if (preg_match($three_near, $password)) {
        print ("3 symbols of each group shouldn't be near: ");
        if (preg_match('/[0-9]{4,}/', $password)) {
            print (" Check numbers ");
        }
        if (preg_match('/[a-z]{4,}/', $password)) {
            print (" Check lowercase letters ");
        }
        if (preg_match('/[A-Z]{4,}/', $password)) {
            print (" Check uppercase letters ");
        }
        if (preg_match('/[%$#_*]{4,}/', $password)) {
            print (" Check special symbols");
        }
    }
}