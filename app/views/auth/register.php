<?php

require __DIR__ . '/../partials/header.php';

use App\Core\handelErrors;

handelErrors::register();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white w-full max-w-md rounded-xl shadow-xl p-8">

        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">
            WalletApp
        </h1>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="/walletApp/public/auth/register" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">

            <input type="text" name="nom" placeholder="Name"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

            <input type="email" name="email" placeholder="Email"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

            <input type="password" name="password" placeholder="Password"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

            <button type="submit" name="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                Register
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Already have an account?
            <a href="/walletApp/public/login" class="text-indigo-600 font-semibold">Login</a>
        </p>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>