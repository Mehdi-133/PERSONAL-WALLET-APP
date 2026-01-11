<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: /walletApp/public/dashboard');
    exit;
}

require __DIR__ . '/../partials/header.php';
?>

<div class="min-h-screen flex flex-col lg:flex-row">
    <!-- Left Section - Auth Form -->
    <div class="flex-1 flex items-center justify-center px-6 py-12 lg:px-8 bg-white">
        <div class="w-full max-w-sm space-y-8">
            <!-- Logo -->
            <div class="text-center">
                <div class="mx-auto w-12 h-12 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
                <p class="mt-2 text-sm text-gray-600">Sign in to your account</p>
            </div>

            <!-- Messages -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="/walletApp/public/auth/login" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input id="email" name="email" type="email" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm"
                           placeholder="Enter your email">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm"
                           placeholder="Enter your password">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <span class="ml-2 text-gray-700">Remember me</span>
                    </label>
                    <a href="#" class="text-purple-600 hover:text-purple-500 font-medium">Forgot password?</a>
                </div>

                <button type="submit" name="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-2.5 px-4 rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 focus:ring-4 focus:ring-purple-200 transition-all duration-200 shadow-lg text-sm">
                    Sign in
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="/walletApp/public/register" class="font-medium text-purple-600 hover:text-purple-500">Create account</a>
            </p>
        </div>
    </div>

    <!-- Right Section - Visual -->
    <div class="hidden lg:flex flex-1 bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 relative overflow-hidden">
        <div class="flex flex-col justify-center items-center w-full p-8 relative z-10">
            <div class="text-center text-white mb-8">
                <h3 class="text-3xl font-bold mb-4">Take control of your finances</h3>
                <p class="text-lg text-purple-100 max-w-md">Track expenses, set budgets, and achieve your financial goals.</p>
            </div>

            <!-- Floating Cards -->
            <div class="relative w-full max-w-md">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-4 border border-white/20 animate-pulse">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-white font-medium text-sm">Monthly Budget</span>
                        <div class="w-6 h-6 bg-green-400 rounded-lg"></div>
                    </div>
                    <div class="text-2xl font-bold text-white">$5,240</div>
                    <div class="text-green-300 text-xs">+15% from last month</div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20" style="animation: pulse 2s infinite 1s;">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-white font-medium text-sm">Savings Goal</span>
                        <div class="text-emerald-300 text-xs">78%</div>
                    </div>
                    <div class="w-full bg-white/20 rounded-full h-2 mb-2">
                        <div class="bg-emerald-400 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                    <div class="text-white text-xs">$7,800 of $10,000</div>
                </div>
            </div>
        </div>

        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
