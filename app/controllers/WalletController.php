<?php

namespace App\Controllers;

use App\Core\Security;
use App\Models\Wallet;
use App\Models\Expense;
use App\Models\Category;

class WalletController
{
    public function dashboard(): void
    {
        Security::requireUser();

        $wallet = new Wallet();
        $expense = new Expense();
        $category = new Category();

        $userId = $_SESSION['user_id'];
        $dashboardData = $wallet->getDashboardData($userId);
        $monthlyExpenses = $expense->getMonthlyExpenses($userId);
        $categories = $category->getAllCategories();

        require __DIR__ . '/../views/wallet/dashboard.php';
    }

    public function setBudget(): void
    {
        Security::requireUser();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['set_budget'])) {
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Invalid security token';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        $budget = Security::clean($_POST['budget'] ?? '');

        if (empty($budget) || !is_numeric($budget) || $budget <= 0) {
            $_SESSION['error'] = 'Please enter a valid budget amount';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $wallet = new Wallet();

        if ($wallet->setBudget($userId, floatval($budget))) {
            $_SESSION['success'] = 'Budget set successfully!';
        } else {
            $_SESSION['error'] = 'Failed to set budget';
        }

        header('Location: /walletApp/public/dashboard');
        exit();
    }

    public function addExpense(): void
    {

    Security::requireUser();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['add_expense'])) {
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Invalid security token';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        $title = Security::clean($_POST['title'] ?? '');
        $amount = Security::clean($_POST['amount'] ?? '');
        $category = $_POST['category'] ?? '';
        $expenseDate = $_POST['expense_date'] ?? '';

        if (empty($title)) {
            $_SESSION['error'] = 'Please enter expense title';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
            $_SESSION['error'] = 'Please enter a valid amount';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        if (empty($category)) {
            $_SESSION['error'] = 'Please select a category';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        if (empty($expenseDate)) {
            $_SESSION['error'] = 'Please select expense date';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $expense = new Expense();

        if ($expense->addExpense($userId, $title, floatval($amount), $category, $expenseDate)) {
            $_SESSION['success'] = 'Expense added successfully!';
        } else {
            $_SESSION['error'] = 'Failed to add expense. Make sure you have set a budget first.';
        }

        header('Location: /walletApp/public/dashboard');
        exit();
    }

    public function deleteExpense(): void
    {
        Security::requireUser();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        $expense_id = intval($_POST['expense_id'] ?? 0);
        $userId = $_SESSION['user_id'];

        if ($expense_id <= 0) {
            $_SESSION['error'] = 'Invalid expense ID';
            header('Location: /walletApp/public/dashboard');
            exit();
        }

        $expense = new Expense();

        if ($expense->deleteExpense($expense_id, $userId)) {
            $_SESSION['success'] = 'Expense deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete expense';
        }

        header('Location: /walletApp/public/dashboard');
        exit();
    }
}
