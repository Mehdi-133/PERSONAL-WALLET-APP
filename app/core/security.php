<?php

namespace App\Core;

class Security
{

    private static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    public static function generateCSRFToken(): string
    {
        self::startSession();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }


    public static function verifyCSRFToken(string $token): bool
    {
        self::startSession();

        if (
            isset($_SESSION['csrf_token']) &&
            hash_equals($_SESSION['csrf_token'], $token)
        ) {

            return true;
        }

        return false;
    }


    public static function clean(string $value): string
    {
        return htmlspecialchars(
            trim($value),
            ENT_QUOTES,
            'UTF-8'
        );
    }


    public static function requireUser(): void
    {
        self::startSession();

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Veuillez vous connecter.';
            header('Location: /walletApp/public/login');
            exit();
        }
    }
}
