<?php

namespace App\Models;

use App\Core\Database;

class Expense
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getMonthlyExpenses($user_id)
    {
        $sql = "SELECT e.*, c.name as category_name, c.icon as category_icon
                FROM expenses e 
                JOIN wallet w ON e.wallet_id = w.id 
                JOIN categories c ON e.category = c.name
                WHERE w.user_id = :user_id 
                AND MONTH(e.expense_date) = MONTH(CURRENT_DATE()) 
                AND YEAR(e.expense_date) = YEAR(CURRENT_DATE())
                ORDER BY e.expense_date DESC";
                
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        
        return $stmt->fetchAll();
    }

    public function addExpense($user_id, $title, $amount, $category, $expense_date)
    {
        $currentMonth = date('Y-m');
        $sql = "SELECT id FROM wallet WHERE user_id = :user_id AND month = :month";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'month' => $currentMonth]);
        
        $wallet = $stmt->fetch();
        if (!$wallet) {
            return false;
        }
        
        $sql = "INSERT INTO expenses (wallet_id, title, category, amount, expense_date) 
                VALUES (:wallet_id, :title, :category, :amount, :expense_date)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'wallet_id' => $wallet['id'],
            'title' => $title,
            'category' => $category,
            'amount' => $amount,
            'expense_date' => $expense_date
        ]);
    }

    public function deleteExpense($expense_id, $user_id)
    {
        $sql = "DELETE e FROM expenses e 
                JOIN wallet w ON e.wallet_id = w.id 
                WHERE e.id = :expense_id AND w.user_id = :user_id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'expense_id' => $expense_id,
            'user_id' => $user_id
        ]);
    }
}
