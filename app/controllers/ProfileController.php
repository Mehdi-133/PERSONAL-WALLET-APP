<?php

namespace App\Controllers;

use App\Core\Security;
use App\Models\User;
use App\Models\Category;

class ProfileController
{

    public function addCategory(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        Security::requireUser();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /walletApp/public/profile');
            exit();
        }

        if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Invalid security token';
            header('Location: /walletApp/public/profile');
            exit();
        }

        $name = Security::clean($_POST['name'] ?? '');
        $icon = Security::clean($_POST['icon'] ?? '');

        if (empty($name) || empty($icon)) {
            $_SESSION['error'] = 'Name and icon are required';
            header('Location: /walletApp/public/profile');
            exit();
        }

        $category = new Category();
        if ($category->addCategory($name, $icon)) {
            $_SESSION['success'] = 'Category added successfully!';
        } else {
            $_SESSION['error'] = 'Failed to add category';
        }

        header('Location: /walletApp/public/profile');
        exit();
    }



    public function profile(): void
    {
        Security::requireUser();

        $user = new User();
        $category = new Category();
        $userProfile = $user->getProfile($_SESSION['user_id']);
        $categories = $category->getAllCategories();

        require __DIR__ . '/../views/profile/show.php';
    }


    public function updateProfile(): void
    {
        Security::requireUser();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /walletApp/public/profile');
            exit();
        }

        if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Invalid security token';
            header('Location: /walletApp/public/profile');
            exit();
        }

        $name = Security::clean($_POST['name'] ?? '');
        $email = Security::clean($_POST['email'] ?? '');

        if (empty($name) || empty($email)) {
            $_SESSION['error'] = 'Name and email are required';
            header('Location: /walletApp/public/profile');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email format';
            header('Location: /walletApp/public/profile');
            exit();
        }

        $user = new User();
        $userId = $_SESSION['user_id'];

        if ($user->updateProfile($userId, $name, $email)) {
            $_SESSION['success'] = 'Profile updated successfully!';
        } else {
            $_SESSION['error'] = 'Failed to update profile';
        }

        header('Location: /walletApp/public/profile');
        exit();
    }
}
