<?php

use Exceptions\Exception1;
use Exceptions\Exception2;
use Exceptions\Exception3;
use Exceptions\Exception4;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$main_class = new Main();
    for ($i = 1; $i <= 4; $i++) {
        try {
            switch ($i) {
                case 1:
                    print ("1 ");
                    for ($j = 1; $j <= 2; $j++) {
                        $main_class->method1();
                    }
                    break;
                case 2:
                    print ("2 ");
                    for ($j = 1; $j <= 2; $j++) {
                        $main_class->method2();
                    }
                    break;
                case 3:
                    print ("3 ");
                    for ($j = 1; $j <= 2; $j++) {
                        $main_class->method3();
                    }
                    break;
                case 4:
                    print ("4 ");
                    for ($j = 1; $j <= 2; $j++) {
                        $main_class->method4();
                    }
                    break;
            }
        } catch (Exception4 $e) {
            print ($e->getMessage() . "<br>");
        } catch (Exception3 $e) {
            print ($e->getMessage() . "<br>");
        } catch (Exception2 $e) {
            print ($e->getMessage() . "<br>");
        } catch (Exception1 $e) {
            print ($e->getMessage() . "<br>");
        } catch (Exception $e) {
            print ($e->getMessage() . "<br>");
        }
}
