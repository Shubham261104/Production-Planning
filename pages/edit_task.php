<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

include "../config/database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<p class='text-red-500 text-center'>Task ID is missing.</p>");
}

$task_id = $_GET['id'];

$sql = "SELECT * FROM production_schedule WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $task_id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();

if (!$task) {
    die("<p class='text-red-500 text-center'>Task not found.</p>");
}

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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Task</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .glass-card {
      backdrop-filter: blur(15px);
      background: rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .float-label input:focus ~ label,
    .float-label input:not(:placeholder-shown) ~ label {
      transform: scale(0.85) translateY(-1.5rem);
      color: #3b82f6;
    }

    .float-label input {
      transition: all 0.2s ease;
    }

    .float-label label {
      position: absolute;
      left: 1rem;
      top: 0.75rem;
      transition: all 0.2s ease;
      pointer-events: none;
      color: #9ca3af;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center px-4">

  <div class="glass-card p-10 rounded-3xl shadow-2xl w-full max-w-lg">
    <h2 class="text-4xl font-bold text-center text-blue-600 mb-10 animate-pulse tracking-wide">✏️ Edit Task</h2>

    <form method="POST" class="space-y-8">

      <!-- Task Name -->
      <div class="relative float-label">
        <input type="text" name="task_name" placeholder=" " value="<?= htmlspecialchars($task['task_name']) ?>" required
          class="peer w-full px-4 py-3 border border-gray-300 rounded-lg bg-white bg-opacity-60 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
        <label class="absolute left-4 top-3 text-sm transition-all">Task Name</label>
      </div>

      <!-- Start Time -->
      <div class="relative float-label">
        <input type="datetime-local" name="start_time" placeholder=" " value="<?= htmlspecialchars($task['start_time']) ?>" required
          class="peer w-full px-4 py-3 border border-gray-300 rounded-lg bg-white bg-opacity-60 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
        <label class="absolute left-4 top-3 text-sm transition-all">Start Time</label>
      </div>

      <!-- End Time -->
      <div class="relative float-label">
        <input type="datetime-local" name="end_time" placeholder=" " value="<?= htmlspecialchars($task['end_time']) ?>" required
          class="peer w-full px-4 py-3 border border-gray-300 rounded-lg bg-white bg-opacity-60 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
        <label class="absolute left-4 top-3 text-sm transition-all">End Time</label>
      </div>

      <!-- Status -->
      <div class="relative">
        <select name="status" required
          class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white bg-opacity-60 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
          <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
          <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
          <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
        </select>
      </div>

      <!-- Submit -->
      <button type="submit"
        class="w-full bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-semibold py-3 rounded-xl shadow-md hover:from-blue-600 hover:to-indigo-600 transition duration-300 transform hover:scale-105">
        💾 Update Task
      </button>
    </form>

    <a href="dashboard.php"
      class="block text-center mt-6 text-sm text-blue-500 hover:underline hover:text-blue-700 transition duration-200">
      ← Back to Dashboard
    </a>
  </div>

</body>
</html>
