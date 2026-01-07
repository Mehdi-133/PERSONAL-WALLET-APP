<?php

namespace App\Core;

use App\Controllers\AuthController;
use App\Controllers\WalletController;

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


            case '/login':
                (new AuthController())->showLogin();
                break;

            case '/register':
                (new AuthController())->showRegister();
                break;


            case '/auth/login':
                (new AuthController())->login();
                break;

            case '/walletApp/app/views/auth/register.php':
                (new AuthController())->register();
                break;

            case '/logout':
                (new AuthController())->logout();
                break;


            case '/dashboard':
                (new WalletController())->dashboard();
                break;

            default:
                http_response_code(404);
                echo '404 - Page not found';
        }
    }
}
