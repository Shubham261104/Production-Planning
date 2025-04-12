<?php
// Only start session if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>


<nav class="bg-gray-900 text-white fixed top-0 left-0 w-full px-6 py-4 shadow-md z-50">
    <div class="flex justify-between items-center max-w-6xl mx-auto">
        <!-- Logo / Brand Name -->
        <a href="../pages/dashboard.php" class="text-2xl font-bold tracking-wide">Production Planner</a>

        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-6">
            <a href="../pages/dashboard.php" class="hover:text-yellow-400 transition font-medium">Dashboard</a>
            <?php if (!$username): ?>
                <a href="../auth/login.php" class="hover:text-yellow-400 transition font-medium">Login</a>
                <a href="../auth/register.php" class="hover:text-yellow-400 transition font-medium">Signup</a>
            <?php endif; ?>
        </div>

        <!-- User Profile / Logout -->
        <div class="flex items-center space-x-4">
            <?php if ($username): ?>
                <span class="text-yellow-400 font-semibold">👋 <?= htmlspecialchars($username) ?></span>
                <a href="../auth/logout.php" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition font-medium">
                    Logout
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu (Hidden by Default) -->
    <div id="mobile-menu" class="md:hidden hidden bg-gray-800 text-white text-center py-4 space-y-2">
        <a href="../pages/dashboard.php" class="block hover:text-yellow-400 transition">Dashboard</a>
        <?php if ($username): ?>
            <span class="block text-yellow-400 font-semibold">👋 <?= htmlspecialchars($username) ?></span>
            <a href="../auth/logout.php" class="block bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition inline-block">
                Logout
            </a>
        <?php else: ?>
            <a href="../auth/login.php" class="block hover:text-yellow-400 transition">Login</a>
            <a href="../auth/register.php" class="block hover:text-yellow-400 transition">Signup</a>
        <?php endif; ?>
    </div>

    <!-- JavaScript for Mobile Menu Toggle -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</nav>
