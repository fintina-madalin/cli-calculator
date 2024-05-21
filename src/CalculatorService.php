<?php

namespace FintinaMadalin\CliCalculator;

use Exception;
use InvalidArgumentException;

class CalculatorService
{
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

    private function add(float $a, float $b): float
    {
        return $a + $b;
    }

    private function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    private function multiply(float $a, float $b): float|int
    {
        return $a * $b;
    }

    private function divide(float $a, float $b): float|int
    {
        if ($b == 0) {
            throw new InvalidArgumentException('Division by zero.');
        }
        return $a / $b;
    }

    private function sqrt(float $a): float
    {
        if ($a < 0) {
            throw new InvalidArgumentException('Cannot take square root of a negative number.');
        }
        return sqrt($a);
    }
}