<?php
require_once "App/Models/User.php";

use App\Models\User;

$test = new User();

$result = $test->register("hhhh", "test@gmail.com", "1023");

if ($result) {
    echo "Inscription réussie ✅";
} else {
    echo "Erreur lors de l'inscription ❌";
}

?>