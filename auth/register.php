<?php
session_start();
include "../config/database.php";

// Handle registration logic before HTML
$register_error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $register_error = "All fields are required.";
    } else {
        $check_sql = "SELECT id FROM users WHERE username = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $register_error = "Username already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("ss", $username, $hashed_password);

            if ($insert_stmt->execute()) {
                header("Location: login.php?msg=registered");
                exit();
            } else {
                $register_error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<?php include '../pages/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Production Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-300 via-orange-800 to-yellow-300 min-h-screen flex flex-col mt-20">

    <!-- Register Form -->
    <div class="flex flex-1 items-center justify-center">
        <div class="bg-white bg-opacity-90 backdrop-blur-md shadow-lg rounded-xl p-8 max-w-sm w-full">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Register</h2>

            <?php if (!empty($register_error)) : ?>
                <p class="text-red-500 text-center font-semibold mb-4"><?= htmlspecialchars($register_error) ?></p>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <input type="text" name="username" placeholder="Username" required
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700 bg-gray-50 shadow-sm">
                <input type="password" name="password" placeholder="Password" required
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700 bg-gray-50 shadow-sm">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-300 shadow-md">
                    Register
                </button>
            </form>

            <p class="text-gray-700 text-sm text-center mt-4">
                Already have an account? <a href="login.php" class="text-blue-600 font-semibold hover:underline">Login here</a>
            </p>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

</body>

</html>
