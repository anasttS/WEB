<?php

use Exceptions\Exception1;
use Exceptions\Exception2;
use Exceptions\Exception3;
use Exceptions\Exception4;

class Main
{
    function createNumber(){
        $number = 0;
        try {
            $number = random_int(1, 4);
        } catch (Exception $e) {
            print ("Error in random_int");
        }
        return $number;
    }

    function method1()
    {
        $number = $this->createNumber();
        $this->randomException($number);
    }

    function method2()
    {
        $number = $this->createNumber();
        $this->randomException($number);
    }

    function method3()
    {
        $number = $this->createNumber();
        $this->randomException($number);
    }

    function method4()
    {
        $number = $this->createNumber();
        $this->randomException($number);
    }

    function randomException($number)
    {
        switch ($number) {
            case 1:
                throw new Exception1("Exception");
                break;
            case 2:
                throw new Exception2("Compile Error");
                break;
            case 3:
                throw new Exception3("Error Exception");
                break;
            case 4:
                throw new Exception4("Closed Generator Exception");

                break;
            default:
                print("Error in method randomException()   ");
        }
    }
}