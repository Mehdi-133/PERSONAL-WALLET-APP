<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/database.php';

use App\Core\handelErrors;
use App\Core\Database;
use App\Core\Router;

handelErrors::register();

$db = Database::getInstance();
$conn = $db->getConnection();



$router = new Router();
$router->run();


