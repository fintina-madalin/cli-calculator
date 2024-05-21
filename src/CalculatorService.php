<?php

namespace FintinaMadalin\CliCalculator;

use Exception;
use InvalidArgumentException;

class CalculatorService
{
    public function run(): void {
        global $argv;

        try {
            list($num1, $operation, $num2) = $this->parseArguments($argv);
            $result = $this->calculate($operation, $num1, $num2);
            echo $result . "\n";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . "\n";
        }
    }

    public function calculate(string $operation, float $a, ?float $b = null): float
    {
        return match ($operation) {
            '+' => $this->add($a, $b),
            '-' => $this->subtract($a, $b),
            '*' => $this->multiply($a, $b),
            '/' => $this->divide($a, $b),
            'sqrt' => $this->sqrt($a),
            default => throw new InvalidArgumentException('Invalid operation.')
        };
    }

    private function add($a, $b) {
        return $a + $b;
    }

    private function subtract($a, $b) {
        return $a - $b;
    }

    private function multiply($a, $b): float|int
    {
        return $a * $b;
    }

    private function divide($a, $b): float|int
    {
        if ($b == 0) {
            throw new InvalidArgumentException('Division by zero.');
        }
        return $a / $b;
    }

    private function sqrt($a): float
    {
        if ($a < 0) {
            throw new InvalidArgumentException('Cannot take square root of a negative number.');
        }
        return sqrt($a);
    }

    private function parseArguments(array $arguments): array {
        if (count($arguments) < 2) {
            throw new InvalidArgumentException('Insufficient arguments.');
        }

        $num1 = floatval($arguments[1]);
        $operation = $arguments[2];
        $num2 = isset($arguments[3]) ? floatval($arguments[3]) : null;

        return [$num1, $operation, $num2];
    }
}