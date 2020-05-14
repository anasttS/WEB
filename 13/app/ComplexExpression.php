<?php
namespace ComplexExpression;

use DivisionByZeroError;

class ComplexExpression
{
    public $a, $b;

    /**
     * ComplexExpressions constructor.
     * @param $a
     * @param $b
     */
    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function add(ComplexExpression $complex)
    {
        $this->a += $complex->a;
        $this->b += $complex->b;
    }


    public function mult(ComplexExpression $complex)
    {
        $c = $this->a;
        $this->a = $this->a * $this->b - $complex->a * $complex->b;
        $this->b = $c * $complex->b + $complex->a * $this->b;
    }


    public function div(ComplexExpression $complex)
    {
        $c = $this->a;
        $this->a = ($this->a * $this->b + $complex->a * $complex->b) / (pow($this->b, $this->b) + pow($complex->b, $complex->b));
        $this->b = ($complex->a * $this->b - $c * $complex->b) / (pow($this->b, $this->b) + pow($complex->b, $complex->b));
    }


    public function sub($number)
    {
        $this->a *= $number;
        $this->b *= $number;
    }


    public function abs()
    {
        return sqrt(pow($this->a, $this->a) + pow($this->b, $this->b));
    }


    public function __toString()
    {
        return "({$this->a},{$this->b})";
    }


}