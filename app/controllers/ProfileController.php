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
        $email = Security::clean($_POST['email'] ?? '');
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';

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

        // Check if email already exists for another user
        if ($user->emailExists($email)) {
            $currentUser = $user->getProfile($userId);
            if ($currentUser['email'] !== $email) {
                $_SESSION['error'] = 'Email already exists';
                header('Location: /walletApp/public/profile');
                exit();
            }
        }

        // Update basic profile info
        $profileUpdated = $user->updateProfile($userId, $name, $email);

        if (!$profileUpdated) {
            $_SESSION['error'] = 'Failed to update profile';
            header('Location: /walletApp/public/profile');
            exit();
        }

        // Handle password update if provided
        if (!empty($currentPassword) && !empty($newPassword)) {
            if (strlen($newPassword) < 6) {
                $_SESSION['error'] = 'New password must be at least 6 characters';
                header('Location: /walletApp/public/profile');
                exit();
            }

            $passwordUpdated = $user->updatePassword($userId, $currentPassword, $newPassword);
            
            if (!$passwordUpdated) {
                $_SESSION['error'] = 'Profile updated but failed to update password. Please check your current password.';
                header('Location: /walletApp/public/profile');
                exit();
            }
            
            $_SESSION['success'] = 'Profile and password updated successfully!';
        } else {
            $_SESSION['success'] = 'Profile updated successfully!';
        }

        header('Location: /walletApp/public/profile');
        exit();
    }
}
