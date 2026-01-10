<?php
require __DIR__ . '/../partials/header.php';

use App\Core\handelErrors;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
                <h2 class="text-2xl font-bold text-gray-900">Create account</h2>
                <p class="mt-2 text-sm text-gray-600">Start your financial journey</p>
            </div>

            <!-- Messages -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="/walletApp/public/auth/register" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">
                
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Full name</label>
                    <input id="nom" name="nom" type="text" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm"
                           placeholder="Enter your full name">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input id="email" name="email" type="email" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm"
                           placeholder="Enter your email">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm"
                           placeholder="Create a password">
                    <p class="mt-1 text-xs text-gray-500">Must be at least 6 characters</p>
                </div>

                <div class="flex items-start">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded mt-0.5">
                    <label for="terms" class="ml-2 block text-xs text-gray-700">
                        I agree to the <a href="#" class="text-purple-600 hover:text-purple-500 font-medium">Terms</a> and <a href="#" class="text-purple-600 hover:text-purple-500 font-medium">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" name="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-2.5 px-4 rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 focus:ring-4 focus:ring-purple-200 transition-all duration-200 shadow-lg text-sm">
                    Create account
                </button>
            </form>

            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="/walletApp/public/login" class="font-medium text-purple-600 hover:text-purple-500">Sign in</a>
            </p>
        </div>
    </div>

    <!-- Right Section - Visual -->
    <div class="hidden lg:flex flex-1 bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 relative overflow-hidden">
        <div class="flex flex-col justify-center items-center w-full p-8 relative z-10">
            <div class="text-center text-white mb-8">
                <h3 class="text-3xl font-bold mb-4">Join thousands of users</h3>
                <p class="text-lg text-purple-100 max-w-md">Start managing your finances like a pro with powerful tools.</p>
            </div>

            <!-- Feature Cards -->
            <div class="space-y-4 w-full max-w-md">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-green-400 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                        </div>
                        <span class="text-white font-medium text-sm">Real-time tracking</span>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-blue-400 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                        </div>
                        <span class="text-white font-medium text-sm">Smart budgets</span>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-purple-400 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                        </div>
                        <span class="text-white font-medium text-sm">Advanced analytics</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
