<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Core\handelErrors;
handelErrors::register();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 flex items-center justify-center h-screen">

    <div class="bg-white shadow-2xl rounded-xl px-10 py-8 w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Create Your Account</h2>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../../controllers/AuthController.php" class="space-y-5">
            <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">
            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-medium">Name</label>
                <input type="text" name="nom" placeholder="Your Name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium"9+>Email</label>
                <input type="email" name="email" placeholder="you@example.com"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" placeholder="********"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                name="submit"
                class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                Register
            </button>
        </form>

        <p class="text-center text-gray-600 mt-6">
            Already have an account?
            <a href="/login" class="text-purple-600 font-semibold hover:underline">Login here</a>
        </p>
    </div>

</body>

</html>