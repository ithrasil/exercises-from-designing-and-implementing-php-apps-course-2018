<?php

namespace tests\Unit;

use Calculator\RPNCalculator;

//use PHPUnit\Framework\TestCase;

class RPNCalculatorTest extends TestCase
{
    /**
     * @dataProvider getDataForAddition
     * @param $expression
     * @param $expectedValue
     */
    public function testAddition($expression, $expectedValue)
    {
        // Arrange
        $calculator = new RPNCalculator();
        // Act
        $result = $calculator->compute($expression);
        // Assert
        $this->assertEquals($result, $expectedValue);
    }

    public function getDataForAddition()
    {
        return [
            ["5 5 +", 10],
            ["10 20 +", 30],
            ["-100 100 +", 200]
        ];
    }

    /**
     * @dataProvider getDataForSubtracting
     * @param $expression
     * @param $expectedValue
     */
    public function testSubtracting($expression, $expectedValue)
    {
        // Arrange
        $calculator = new RPNCalculator();
        // Act
        $result = $calculator->compute($expression);
        // Assert
        $this->assertEquals($result, $expectedValue);
    }

    public function getDataForSubtracting()
    {
        return [
            ["5 5 -", 0],
            ["10 20 -", -10],
            ["-100 100 -", -200],
        ];
    }

    /**
     * @dataProvider getDataForMultiplying
     * @param $expression
     * @param $expectedValue
     */
    public function testMultiplying($expression, $expectedValue)
    {
        // Arrange
        $calculator = new RPNCalculator();
        // Act
        $result = $calculator->compute($expression);
        // Assert
        $this->assertEquals($result, $expectedValue);
    }

    public function getDataForMultiplying()
    {
        return [
            ["5 5 *", 25],
            ["10 20 *", 200],
            ["-100 100 *", -10000]
        ];
    }

    /**
     * @dataProvider getDataForDividing
     * @param $expression
     * @param $expectedValue
     */
    public function testDividing($expression, $expectedValue)
    {
        // Arrange
        $calculator = new RPNCalculator();
        // Act
        $result = $calculator->compute($expression);
        // Assert
        $this->assertEquals($result, $expectedValue);
    }

    public function getDataForDividing()
    {
        return [
            ["5 5 /", 1],
            ["10 20 /", 0.5],
            ["-100 100 /", -1]
        ];
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testX()
    {

    }

    /**
     * @dataProvider getDataForMixed
     * @param $expression
     * @param $expectedValue
     */
    public function testMixed($expression, $expectedValue)
    {
        // Arrange
        $calculator = new RPNCalculator();
        // Act
        $result = $calculator->compute($expression);
        // Assert
        $this->assertEquals($result, $expectedValue);
    }

    public function getDataForMixed()
    {
        return [
            ["2 8 log 2 +", 5],
            ["10 20 * 5 /", 40],
            ["2 2 + 2 * 4 / 10 * 400 log", 2]
        ];
    }
}