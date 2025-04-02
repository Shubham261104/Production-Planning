<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/database.php';

$message = ""; // Store success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = trim($_POST["task_name"]);
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $status = $_POST["status"];
    $user_id = $_SESSION["user_id"];  

    if ($end_time <= $start_time) {
        $message = "🚨 End time must be later than start time!";
    } else {
        $query = "INSERT INTO production_schedule (task_name, start_time, end_time, status, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $task_name, $start_time, $end_time, $status, $user_id);

        if ($stmt->execute()) {
            $message = "✅ Task added successfully!";
        } else {
            $message = "❌ Error: " . $conn->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validateForm() {
            let startTime = document.getElementById("start_time").value;
            let endTime = document.getElementById("end_time").value;

            if (endTime <= startTime) {
                alert("🚨 End time must be later than start time!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">📝 Add New Task</h2>

        <?php if ($message): ?>
            <p class="p-3 mb-4 text-center rounded-lg <?= strpos($message, '✅') !== false ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                <?= $message ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST" onsubmit="return validateForm()">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">Task Name</label>
            <input type="text" name="task_name" id="task_name" required class="border border-gray-300 dark:border-gray-600 p-2 mb-4 w-full rounded-lg focus:ring-2 focus:ring-blue-500">

            <label class="block text-gray-700 dark:text-gray-300 mb-2">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time" required class="border border-gray-300 dark:border-gray-600 p-2 mb-4 w-full rounded-lg focus:ring-2 focus:ring-blue-500">

            <label class="block text-gray-700 dark:text-gray-300 mb-2">End Time</label>
            <input type="datetime-local" name="end_time" id="end_time" required class="border border-gray-300 dark:border-gray-600 p-2 mb-4 w-full rounded-lg focus:ring-2 focus:ring-blue-500">

            <label class="block text-gray-700 dark:text-gray-300 mb-2">Status</label>
            <select name="status" class="border border-gray-300 dark:border-gray-600 p-2 mb-4 w-full rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-all duration-200">
                ➕ Add Task
            </button>
        </form>

        <div class="flex justify-between mt-4">
            <a href="dashboard.php" class="text-blue-500 hover:underline">🔙 Back to Dashboard</a>
            <a href="../auth/logout.php" class="text-red-500 hover:underline">🚪 Logout</a>
        </div>
    </div>

</body>
</html>
