<?php

namespace App\Models\Abstract;

use App\Core\Database;
use App\Traits\MoneyFormatterTrait;
use App\Interfaces\FinancialCalculatorInterface;

abstract class Transaction implements FinancialCalculatorInterface
{
    use MoneyFormatterTrait;
    
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    
    abstract public function create(array $data): bool;
    abstract public function delete(int $id, int $userId): bool;
    
    public function calculateTotal(array $amounts): float
    {
        return array_sum($amounts);
    }
    
    public function calculateRemaining(float $budget, float $expenses): float
    {
        return $budget - $expenses;
    }
    
    public function calculatePercentage(float $amount, float $total): float
    {
        return $total > 0 ? ($amount / $total) * 100 : 0;
    }
}
