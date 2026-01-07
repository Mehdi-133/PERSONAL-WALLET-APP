<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/database.php';

use App\Core\handelErrors;
use App\Core\Database;
use App\Core\Security;
use App\Controllers\WalletController;
    

handelErrors::register();

$db = Database::getInstance();
$conn = $db->getConnection();

echo " Database connected successfully";


new WalletController();

echo "WalletController loaded successfully";
