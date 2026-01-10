<?php

namespace App\Models;

use App\Core\Database;

class Wallet
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }


    public function setBudget($user_id, $budget)
    {
        $currentMonth = date('Y-m');

        $sql = "SELECT id FROM wallet WHERE user_id = :user_id AND month = :month";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'month' => $currentMonth]);

        if ($stmt->fetch()) {
           
            $sql = "UPDATE wallet SET budjet = :budget WHERE user_id = :user_id AND month = :month";
        } else {
            
            $sql = "INSERT INTO wallet (user_id, month, budjet) VALUES (:user_id, :month, :budget)";
        }

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'user_id' => $user_id,
            'month' => $currentMonth,
            'budget' => $budget
        ]);
    }


    public function getCurrentMonthWallet($user_id)
    {
        $currentMonth = date('Y-m');
        $sql = "SELECT * FROM wallet WHERE user_id = :user_id AND month = :month LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'month' => $currentMonth]);

        return $stmt->fetch();
    }

    public function getMonthlyExpenses($user_id)
    {
        $sql = "SELECT SUM(e.amount) as total_expenses 
                FROM expenses e 
                JOIN wallet w ON e.wallet_id = w.id 
                WHERE w.user_id = :user_id 
                AND MONTH(e.expense_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(e.expense_date) = YEAR(CURRENT_DATE())";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);

        $result = $stmt->fetch();
        return $result ? $result['total_expenses'] ?? 0 : 0;
    }

    public function getDashboardData($user_id)
    {
        $wallet = $this->getCurrentMonthWallet($user_id);
        $monthlyExpenses = $this->getMonthlyExpenses($user_id);

        $budget = $wallet ? $wallet['budjet'] : 0;
        $remaining = $budget - $monthlyExpenses;

        return [
            'budget' => $budget,
            'monthly_expenses' => $monthlyExpenses,
            'remaining' => $remaining
        ];
    }
}
