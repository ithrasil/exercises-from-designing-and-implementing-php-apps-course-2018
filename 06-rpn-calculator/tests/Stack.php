<?php

namespace tests\Unit;

use Structure\Stack;
//use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    /**
     * @dataProvider getDataForPush
     * @param $startingData
     * @param $toPush
     * @param $expectedValue
     */
    public function testPush($startingData, $toPush, $expectedValue)
    {
        // Arrange
        $stack = new Stack($startingData);
        // Act
        $stack->push($toPush);
        // Assert
        $this->assertEquals($stack->getStack(), $expectedValue);
    }

    public function getDataForPush()
    {
        return [
            [[1, 2, 3], 5, [1, 2, 3, 5]],
            [[4, 5], 10, [4, 5, 10]],
            [[5, 10], 25, [5, 10, 25]]
        ];
    }

    /**
     * @dataProvider getDataForPush
     * @param $startingData
     * @param $toPush
     * @param $expectedValue
     */
    public function testPop($startingData, $toPush, $expectedValue)
    {
        // Arrange
        $stack = new Stack($startingData);
        // Act
        $result = $stack->pop();
        // Assert
        $this->assertEquals($result, $expectedValue);
    }

    public function getDataForPop()
    {
        return [
            [[1, 2, 3], 3],
            [[4, 5], 5],
            [[5, 10], 10]
        ];
    }
}