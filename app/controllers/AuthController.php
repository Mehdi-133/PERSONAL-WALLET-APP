<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Security;
var_dump($_POST);
class AuthController 
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();


        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    public function showRegister(): void
    {

        if (!empty($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit();
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    public function register(): void
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ');
            exit();
        }

        if (!isset($_POST['submit'])) {
            $_SESSION['error'] = 'Veuillez cliquer sur le bouton Register';
            header('Location: ');
            exit();
        }


        if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Token de sécurité invalide';
            header('Location: ');
            exit();
        }

        $nom = Security::clean($_POST['nom'] ?? '');
        $email = Security::clean($_POST['email'] ?? '');
        $password = Security::clean($_POST['password'] ?? '');


        if (empty($nom) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'Tous les champs sont requis';
            header('Location: /walletApp/app/views/auth/register.php');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email invalide';
            header('Location: ');
            exit();
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Le mot de passe doit avoir au moins 6 caractères';
            header('Location: ');
            exit();
        }


        if ($this->user->getProfile($email)) {
            $_SESSION['error'] = 'Email déjà utilisé';
            header('Location: ');
            exit();
        }


        $result = $this->user->register($nom, $email, $password);

        if ($result) {
            $_SESSION['success'] = 'Inscription réussie. Vous pouvez vous connecter maintenant.';
            header('Location: /login');
        } else {
            $_SESSION['error'] = 'Erreur lors de l’inscription';
            header('Location: /app/views/auth/register.php');
        }
        exit();
    }

    public function showLogin(): void
    {

        if (!empty($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit();
        }

        require __DIR__ . '/../views/auth/login.php';
    }


    public function login(): void
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit();
        }


        if (!isset($_POST['csrf_token']) || !Security::verifyCSRFToken($_POST['csrf_token'])) {
            $_SESSION['error'] = 'Token de sécurité invalide';
            header('Location: /login');
            exit();
        }


        $email = Security::clean($_POST['email'] ?? '');
        $password = Security::clean($_POST['password'] ?? '');


        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Tous les champs sont requis';
            header('Location: /login');
            exit();
        }


        $result = $this->user->login($email, $password);

        if ($result) {
            $_SESSION['success'] = 'Connexion réussie';
            header('Location: /dashboard');
        } else {
            $_SESSION['error'] = 'Email ou mot de passe invalide';
            header('Location: /login');
        }
        exit();
    }


    public function logout(): void
    {
        $this->user->logout();
        $_SESSION['success'] = 'Déconnexion réussie';
        header('Location: /login');
        exit();
    }



}


