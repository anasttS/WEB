<?php
require_once "13\app\ComplexExpression.php";

use PHPUnit\Framework\TestCase;
use ComplexExpression\ComplexExpression;

class ComplexExpressionTest extends TestCase
{
    public function testAddCorrect()
    {
        $complex = new ComplexExpression(10, 2);
        $complex->add(new ComplexExpression(2, -10));
        $this->assertEquals("(12,-8)", $complex->__toString());
    }

    public function testAddIncorrect()
    {
        $complex = new ComplexExpression(10, 2);
        $complex->add(new ComplexExpression(2, -10));
        $this->assertTrue("(10,8)" != $complex->__toString());
    }

    public function testSubCorrect()
    {
        $complex = new ComplexExpression(10, 2);
        $complex->sub(5);
        $this->assertTrue("(50,10)" == $complex->__toString());
    }

    public function testSubIncorrect()
    {
        $complex = new ComplexExpression(10, 2);
        $complex->sub(5);
        $this->assertFalse("(50,8)" == $complex->__toString());
    }

    public function testMultCorrect()
    {
        $complex = new ComplexExpression(10, 2);
        $complex->mult(new ComplexExpression(2, -10));
        $this->assertEquals("(40,-96)", $complex->__toString());
    }

    public function testMultIncorrect()
    {
        $complex = new ComplexExpression(10, 2);
        $complex->mult(new ComplexExpression(2, -10));
        $this->assertFalse("(100,80)" == $complex->__toString());
    }

    public function testDivCorrect()
    {
        $complex = new ComplexExpression(-2, 1);
        $complex->div(new ComplexExpression(1, 1));
        $this->assertEquals("(-0.5,1.5)", $complex->__toString());
    }

    public function testDivIncorrect()
    {
        $complex = new ComplexExpression(9, 1);
        $complex->div(new ComplexExpression(9, 8));
        $this->assertNotSame("(0,1)", $complex->__toString());
    }

    public function testAbsCorrect()
    {
        $complex = new ComplexExpression(0, 0);
        $this->assertIsFloat($complex->abs());

    }

    public function testAbsIncorrect()
    {
        $complex = new ComplexExpression(0, 1);
        $this->assertNotSame('1', $complex->abs());
    }

}