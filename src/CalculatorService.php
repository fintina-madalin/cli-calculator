<?php

namespace FintinaMadalin\CliCalculator;

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
}