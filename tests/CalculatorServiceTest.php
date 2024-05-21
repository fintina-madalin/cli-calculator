<?php

use PHPUnit\Framework\TestCase;
use FintinaMadalin\CliCalculator\CalculatorService;

class CalculatorServiceTest extends TestCase
{
    private CalculatorService $calculator;

    protected function setUp(): void {
        $this->calculator = new CalculatorService();
    }

    public function testAddition(): void {
        $this->assertEquals(7, $this->calculator->calculate('+', 5, 2));
    }

    public function testSubtraction(): void {
        $this->assertEquals(3, $this->calculator->calculate('-', 5, 2));
    }

    public function testMultiplication(): void {
        $this->assertEquals(10, $this->calculator->calculate('*', 5, 2));
    }

    public function testDivision(): void {
        $this->assertEquals(2.5, $this->calculator->calculate('/', 5, 2));
    }

    public function testDivisionByZero(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->calculate('/', 5, 0);
    }

    public function testSquareRoot(): void {
        $this->assertEquals(3, $this->calculator->calculate('sqrt', 9));
    }

    public function testSquareRootOfNegativeNumber(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->calculate('sqrt', -9);
    }

    public function testInvalidOperation(): void {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->calculate('^', 5, 2);
    }

    public function testParseArgumentsValid(): void {
        $argv = ['script.php', '5', '+', '2'];
        $result = $this->invokeMethod($this->calculator, 'parseArguments', [$argv]);
        $this->assertEquals([5.0, '+', 2.0], $result);
    }

    protected function invokeMethod(&$object, $methodName, array $parameters = []) {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
