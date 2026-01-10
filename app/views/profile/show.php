<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../partials/header.php';
?>

<style>
@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animate-slide-up { animation: slideInUp 0.6s ease-out; }
.animate-fade-in { animation: fadeIn 0.8s ease-out; }

.glass-effect {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.card-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-hover:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
}
</style>

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100">
    <!-- Navigation -->
    <nav class="glass-effect shadow-lg sticky top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">MoneyMind</h1>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="/walletApp/public/dashboard" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-purple-600 hover:bg-white/50 rounded-lg transition-all duration-200">Dashboard</a>
                    <button class="px-4 py-2 text-sm font-medium text-purple-600 bg-purple-100/50 rounded-lg backdrop-blur-sm">Profile</button>
                </div>

                <!-- Action Button -->
                <div class="flex items-center space-x-3">
                    <a href="/walletApp/public/logout" class="p-2 text-gray-500 hover:text-red-500 rounded-lg transition-all duration-200 hover:bg-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Messages -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center animate-slide-up shadow-lg">
                <svg class="w-5 h-5 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center animate-slide-up shadow-lg">
                <svg class="w-5 h-5 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                </svg>
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-2">Profile Settings</h2>
            <p class="text-gray-600 text-lg">Manage your account information and preferences</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Profile Form -->
            <div class="xl:col-span-2">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 card-hover animate-slide-up">
                    <div class="flex items-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">Personal Information</h3>
                            <p class="text-gray-500">Update your account details</p>
                        </div>
                    </div>

                    <form method="POST" action="/walletApp/public/profile/update" class="space-y-6">
                        <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">👤 Full Name</label>
                                <input type="text" name="name" value="<?= htmlspecialchars($userProfile['name'] ?? '') ?>" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white/50 backdrop-blur-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">📧 Email Address</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($userProfile['email'] ?? '') ?>" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white/50 backdrop-blur-sm">
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-8">
                            <h4 class="text-lg font-semibold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-6">🔒 Change Password (Optional)</h4>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">Current Password</label>
                                    <input type="password" name="current_password" placeholder="Enter current password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white/50 backdrop-blur-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">New Password</label>
                                    <input type="password" name="new_password" placeholder="Enter new password (min 6 characters)" minlength="6"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 bg-white/50 backdrop-blur-sm">
                                    <p class="text-xs text-gray-500 mt-2">Must be at least 6 characters long</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-4 pt-6">
                            <button type="submit"
                                class="flex-1 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white py-3 px-6 rounded-xl transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                ✨ Update Profile
                            </button>
                            <a href="/walletApp/public/dashboard"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-6 rounded-xl transition-all duration-200 font-semibold text-center">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Account Info -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 card-hover animate-slide-up" style="animation-delay: 0.1s;">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-green-500 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Account Info</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-4 rounded-xl">
                            <p class="text-sm text-gray-500 mb-1">👋 Welcome back</p>
                            <p class="font-semibold text-gray-900"><?= htmlspecialchars($userProfile['name'] ?? 'User') ?></p>
                        </div>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl">
                            <p class="text-sm text-gray-500 mb-1">📅 Member since</p>
                            <p class="font-semibold text-gray-900"><?= date('F j, Y', strtotime($userProfile['created_at'] ?? '')) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="mr-2">⚡</span> Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <a href="/walletApp/public/dashboard"
                            class="flex items-center w-full bg-gradient-to-r from-purple-100 to-blue-100 hover:from-purple-200 hover:to-blue-200 text-purple-700 py-3 px-4 rounded-xl transition-all duration-200 font-medium group">
                            <span class="mr-3 text-lg">📊</span>
                            <span>View Dashboard</span>
                            <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <button onclick="showModal('budgetModal')"
                            class="flex items-center w-full bg-gradient-to-r from-emerald-100 to-green-100 hover:from-emerald-200 hover:to-green-200 text-emerald-700 py-3 px-4 rounded-xl transition-all duration-200 font-medium group">
                            <span class="mr-3 text-lg">💰</span>
                            <span>Set Budget</span>
                            <svg class="w-4 h-4 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 card-hover animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="mr-2">📂</span> Categories
                        </h3>
                        <button onclick="showModal('categoryModal')"
                            class="bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                            + Add
                        </button>
                    </div>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-gray-50 to-purple-50 rounded-xl hover:from-purple-50 hover:to-blue-50 transition-all duration-200 group">
                                    <span class="font-medium text-gray-700 group-hover:text-gray-900"><?= $cat['icon'] ?> <?= htmlspecialchars($cat['name']) ?></span>
                                    <div class="w-2 h-2 bg-purple-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-8 text-gray-500">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-100 to-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                                    <span class="text-2xl">📂</span>
                                </div>
                                <p class="text-sm">No categories yet</p>
                                <p class="text-xs text-gray-400">Add your first category</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Category Modal -->
<div id="categoryModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white/95 backdrop-blur-md rounded-2xl p-8 w-full max-w-md shadow-2xl border border-white/20 animate-slide-up">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">📂 Add New Category</h3>
            <button onclick="hideModal('categoryModal')" class="text-gray-400 hover:text-gray-600 p-2 rounded-lg transition-all duration-200 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form method="POST" action="/walletApp/public/category/add" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Category Name</label>
                <input type="text" name="name" required maxlength="100" placeholder="e.g., Groceries, Entertainment"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Icon (emoji)</label>
                <input type="text" name="icon" required maxlength="10" placeholder="🛒 🎬 🍕 ⛽"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                <p class="text-xs text-gray-500 mt-2">Choose an emoji to represent this category</p>
            </div>
            
            <div class="flex space-x-3 pt-6">
                <button type="button" onclick="hideModal('categoryModal')"
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-xl transition-all duration-200 font-medium">
                    Cancel
                </button>
                <button type="submit"
                    class="flex-1 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white py-3 px-4 rounded-xl transition-all duration-200 font-medium shadow-lg">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden');
    setTimeout(() => modal.querySelector('.animate-slide-up').style.animation = 'slideInUp 0.4s ease-out', 10);
}

function hideModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Add smooth scroll behavior
document.documentElement.style.scrollBehavior = 'smooth';
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
