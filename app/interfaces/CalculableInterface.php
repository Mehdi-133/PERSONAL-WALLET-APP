<?php

namespace App\Interfaces;

interface FinancialCalculatorInterface
{
    public function calculateTotal(array $amounts): float;
    public function calculateRemaining(float $budget, float $expenses): float;
    public function calculatePercentage(float $amount, float $total): float;
}
