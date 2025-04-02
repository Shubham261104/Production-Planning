<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        setTimeout(function () {
            window.location.href = "login.php"; // Redirect after 3 seconds
        }, 3000);
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-sm text-center">
        <h2 class="text-2xl font-bold text-gray-800">You have been logged out</h2>
        <p class="text-gray-600 mt-2">Redirecting to login page...</p>
        
        <div class="mt-4">
            <svg class="mx-auto animate-spin h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4m0 8v4m8-8h-4M4 12H0m22.627-7.071l-2.828 2.829M7.071 2.929L4.243 5.757M22.627 19.071l-2.828-2.829M7.071 21.071L4.243 18.243"></path>
            </svg>
        </div>

        <p class="mt-2 text-sm text-gray-500">If you are not redirected, <a href="login.php" class="text-blue-500 font-semibold">click here</a>.</p>
    </div>
</body>
</html>
