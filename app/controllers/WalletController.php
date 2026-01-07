<?php

namespace App\Controllers;

use App\Core\Security;

class WalletController
{
    public function dashboard(): void
    {
        Security::requireUser();
        require __DIR__ . '/../views/wallet/dashboard.php';
    }
}
