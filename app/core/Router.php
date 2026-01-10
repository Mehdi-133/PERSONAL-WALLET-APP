<?php

namespace App\Core;

use App\Controllers\AuthController;
use App\Controllers\WalletController;
use App\Controllers\ProfileController;

class Router
{
    public function run(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = '/walletApp/public';
        $uri = str_replace($basePath, '', $uri);

        if ($uri === '' || $uri === '/') {
            $uri = '/login';
        }

        switch ($uri) {
            // Auth routes
            case '/login':
                (new AuthController())->showLogin();
                break;

            case '/register':
                (new AuthController())->showRegister();
                break;

            case '/auth/login':
                (new AuthController())->login();
                break;

            case '/auth/register':
                (new AuthController())->register();
                break;

            case '/logout':
                (new AuthController())->logout();
                break;

            // Dashboard routes
            case '/dashboard':
                (new WalletController())->dashboard();
                break;

            // Wallet routes
            case '/wallet/budget':
                (new WalletController())->setBudget();
                break;

            case '/wallet/expense':
                (new WalletController())->addExpense();
                break;

            case '/expense/delete':
                (new WalletController())->deleteExpense();
                break;


            case '/profile':
                (new ProfileController())->profile();
                break;

            case '/profile/update':
                (new ProfileController())->updateProfile();
                break;


            case '/category/add':
                (new ProfileController())->addCategory();
                break;

            default:
                http_response_code(404);
                echo '404 - Page not found';
        }
    }
}
