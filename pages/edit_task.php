<?php
session_start();

// Debugging: Check if session variables exist
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/database.php";

// Check if 'id' is set in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<p class='text-red-500 text-center'>Task ID is missing.</p>");
}

$task_id = $_GET['id'];

// Fetch task details
$sql = "SELECT * FROM production_schedule WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $task_id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();

if (!$task) {
    die("<p class='text-red-500 text-center'>Task not found.</p>");
}

// Handle form submission for updating task
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_name = $_POST['task_name'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $status = $_POST['status'];

    $update_sql = "UPDATE production_schedule SET task_name=?, start_time=?, end_time=?, status=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $task_name, $start_time, $end_time, $status, $task_id);

    if ($update_stmt->execute()) {
        header("Location: dashboard.php?msg=Task updated successfully!");
        exit();
    } else {
        echo "<p class='text-red-500 text-center'>Error updating task: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Edit Task</h2>

        <form method="POST" class="space-y-4">
            <label class="block">
                <span class="text-gray-700">Task Name</span>
                <input type="text" name="task_name" value="<?= htmlspecialchars($task['task_name']) ?>" required 
                       class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </label>

            <label class="block">
                <span class="text-gray-700">Start Time</span>
                <input type="datetime-local" name="start_time" value="<?= htmlspecialchars($task['start_time']) ?>" required 
                       class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </label>

            <label class="block">
                <span class="text-gray-700">End Time</span>
                <input type="datetime-local" name="end_time" value="<?= htmlspecialchars($task['end_time']) ?>" required 
                       class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </label>

            <label class="block">
                <span class="text-gray-700">Status</span>
                <select name="status" required 
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </label>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-all">Update Task</button>
        </form>

        <a href="dashboard.php" class="block text-center mt-4 text-gray-600 hover:underline">Cancel</a>
    </div>
</body>
</html>