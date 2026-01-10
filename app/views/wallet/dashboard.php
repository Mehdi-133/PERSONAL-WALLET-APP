<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../partials/header.php';
?>

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    <!-- Top Navigation -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">MoneyMind</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/walletApp/public/profile" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-lg text-sm font-medium transition">
                        👤 Profile
                    </a>
                    <button onclick="showModal('budgetModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition text-sm font-medium">
                        💰 Set Budget
                    </button>
                    <button onclick="showModal('expenseModal')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition text-sm font-medium">
                        💸 Add Expense
                    </button>
                    <a href="/walletApp/public/logout" class="text-gray-500 hover:text-red-500 p-2 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Messages -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center">
                <svg class="w-5 h-5 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center">
                <svg class="w-5 h-5 mr-3 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                </svg>
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Dashboard Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Financial Dashboard</h2>
            <p class="text-gray-600"><?= date('l, F j, Y , h:i A') ?>  Overview</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <!-- Budget Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium bg-white/20 px-2 py-1 rounded-full text-white">Monthly</span>
                </div>
                <h3 class="text-sm font-medium text-blue-100 mb-1">Budget</h3>
                <p class="text-2xl font-bold text-white">$<?= number_format($dashboardData['budget'] ?? 0, 2) ?></p>
            </div>

            <!-- Spent Card -->
            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium bg-white/20 px-2 py-1 rounded-full text-white">Total</span>
                </div>
                <h3 class="text-sm font-medium text-red-100 mb-1">Spent</h3>
                <p class="text-2xl font-bold text-white">$<?= number_format($dashboardData['monthly_expenses'] ?? 0, 2) ?></p>
            </div>

            <!-- Remaining Card -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium bg-white/20 px-2 py-1 rounded-full text-white">Left</span>
                </div>
                <h3 class="text-sm font-medium text-emerald-100 mb-1">Remaining</h3>
                <p class="text-2xl font-bold text-white">$<?= number_format($dashboardData['remaining'] ?? 0, 2) ?></p>
            </div>

            <!-- Progress Card -->
            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">
                        <?= $dashboardData['budget'] > 0 ? round(($dashboardData['monthly_expenses'] / $dashboardData['budget']) * 100) : 0 ?>%
                    </span>
                </div>
                <h3 class="text-sm font-medium text-gray-500 mb-3">Budget Usage</h3>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-3">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-3 rounded-full transition-all duration-500" 
                         style="width: <?= $dashboardData['budget'] > 0 ? min(($dashboardData['monthly_expenses'] / $dashboardData['budget']) * 100, 100) : 0 ?>%"></div>
                </div>
                <p class="text-xs text-gray-500"><?= count($monthlyExpenses ?? []) ?> transactions this month</p>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Categories -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Categories</h3>
                    <button onclick="toggleAllCategories()" id="viewAllBtn" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</button>
                </div>
                <div class="space-y-4" id="categoriesContainer">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $index => $cat): ?>
                            <?php
                            $categoryTotal = 0;
                            if (!empty($monthlyExpenses)) {
                                foreach ($monthlyExpenses as $exp) {
                                    if ($exp['category'] == $cat['name']) {
                                        $categoryTotal += $exp['amount'];
                                    }
                                }
                            }
                            $percentage = $dashboardData['monthly_expenses'] > 0 ? ($categoryTotal / $dashboardData['monthly_expenses']) * 100 : 0;
                            ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition category-item <?= $index >= 5 ? 'hidden' : '' ?>">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                                        <span class="text-lg"><?= $cat['icon'] ?></span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900"><?= htmlspecialchars($cat['name']) ?></p>
                                        <p class="text-xs text-gray-500"><?= round($percentage, 1) ?>% of total</p>
                                    </div>
                                </div>
                                <p class="font-semibold text-gray-900">$<?= number_format($categoryTotal, 2) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p>No categories yet</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="xl:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Transactions</h3>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500"><?= count($monthlyExpenses ?? []) ?> total</span>
                            <button onclick="showModal('expenseModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                Add New
                            </button>
                        </div>
                    </div>
                </div>

                <div class="max-h-96 overflow-y-auto">
                    <?php if (empty($monthlyExpenses)): ?>
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-2">No transactions yet</h4>
                            <p class="text-gray-500 mb-6">Start tracking your expenses by adding your first transaction</p>
                            <button onclick="showModal('expenseModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition">
                                Add First Expense
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="divide-y divide-gray-100">
                            <?php foreach (array_slice($monthlyExpenses, 0, 8) as $expense): ?>
                                <div class="p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                                                <span class="text-lg"><?= $expense['category_icon'] ?? '📦' ?></span>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900"><?= htmlspecialchars($expense['title']) ?></p>
                                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                    <span class="bg-gray-100 px-2 py-1 rounded-full text-xs font-medium">
                                                        <?= htmlspecialchars($expense['category_name']) ?>
                                                    </span>
                                                    <span>•</span>
                                                    <span><?= date('M j, Y', strtotime($expense['expense_date'])) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-red-600">-$<?= number_format($expense['amount'], 2) ?></p>
                                                <p class="text-xs text-gray-500"><?= date('g:i A', strtotime($expense['created_at'])) ?></p>
                                            </div>
                                            <button onclick="deleteExpense(<?= $expense['id'] ?>)" 
                                                    class="text-gray-400 hover:text-red-500 p-2 rounded-lg hover:bg-red-50 transition"
                                                    title="Delete expense">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Budget Modal -->
<div id="budgetModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">💰 Set Monthly Budget</h3>
            <button onclick="hideModal('budgetModal')" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form method="POST" action="/walletApp/public/wallet/budget" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Budget Amount ($)</label>
                <input type="number" name="budget" step="0.01" min="0.01" placeholder="5000.00" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition">
                <p class="text-xs text-gray-500 mt-2">Enter your monthly budget amount</p>
            </div>
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="hideModal('budgetModal')"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-xl transition font-medium">
                    Cancel
                </button>
                <button type="submit" name="set_budget"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-xl transition font-medium">
                    Set Budget
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Expense Modal -->
<div id="expenseModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">💸 Add New Expense</h3>
            <button onclick="hideModal('expenseModal')" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form method="POST" action="/walletApp/public/wallet/expense" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?= App\Core\Security::generateCSRFToken(); ?>">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" placeholder="e.g., Grocery shopping" required maxlength="150"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount ($)</label>
                    <input type="number" name="amount" step="0.01" min="0.01" placeholder="50.00" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                    <input type="date" name="expense_date" value="<?= date('Y-m-d') ?>" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition">
                    <option value="">Select category...</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['name']) ?>"><?= $cat['icon'] ?> <?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="hideModal('expenseModal')"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-xl transition font-medium">
                    Cancel
                </button>
                <button type="submit" name="add_expense"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-xl transition font-medium">
                    Add Expense
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function toggleAllCategories() {
    const hiddenCategories = document.querySelectorAll('.category-item.hidden');
    const viewAllBtn = document.getElementById('viewAllBtn');
    
    if (hiddenCategories.length > 0) {
        // Show all categories
        hiddenCategories.forEach(category => {
            category.classList.remove('hidden');
        });
        viewAllBtn.textContent = 'Show Less';
    } else {
        // Hide categories after first 5
        const allCategories = document.querySelectorAll('.category-item');
        allCategories.forEach((category, index) => {
            if (index >= 5) {
                category.classList.add('hidden');
            }
        });
        viewAllBtn.textContent = 'View All';
    }
}

function deleteExpense(expenseId) {
    if (confirm('Are you sure you want to delete this expense?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/walletApp/public/expense/delete';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'expense_id';
        input.value = expenseId;

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = 'csrf_token';
        csrfInput.value = '<?= App\Core\Security::generateCSRFToken(); ?>';

        form.appendChild(input);
        form.appendChild(csrfInput);
        document.body.appendChild(form);
        form.submit();
    }
}

// Modal interactions
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('bg-black/50')) {
        e.target.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});
</script>

<?php require __DIR__ . '/../partials/footer.php'; ?>
