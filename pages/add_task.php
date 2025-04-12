<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/database.php';

$message = "";

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
  <title>Add Task</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .glass {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .float-label input:focus ~ label,
    .float-label input:not(:placeholder-shown) ~ label {
      transform: scale(0.85) translateY(-1.4rem);
      color: #6366f1;
    }

    .float-label label {
      position: absolute;
      left: 1rem;
      top: 1rem;
      pointer-events: none;
      color: #94a3b8;
      transition: all 0.2s ease-in-out;
    }
  </style>
  <script>
    function validateForm() {
      const startTime = document.getElementById("start_time").value;
      const endTime = document.getElementById("end_time").value;

      if (endTime <= startTime) {
        alert("🚨 End time must be later than start time!");
        return false;
      }
      return true;
    }

    window.onload = () => {
      const toast = document.getElementById("toast");
      if (toast) {
        setTimeout(() => toast.classList.add("opacity-0"), 3000);
      }
    };
  </script>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-emerald-100 dark:from-slate-900 dark:to-slate-800 min-h-screen flex items-center justify-center px-4 transition-all duration-500">

  <div class="glass rounded-2xl p-8 shadow-2xl w-full max-w-lg dark:text-white">
    <h1 class="text-3xl text-center font-bold text-indigo-700 dark:text-indigo-400 mb-6">🗓️ Add a New Task</h1>

    <?php if ($message): ?>
      <div id="toast" class="mb-6 px-4 py-3 rounded-lg font-semibold text-center transition-opacity duration-500 <?= strpos($message, '✅') !== false ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-700' ?>">
        <?= $message ?>
      </div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()" class="space-y-6">

      <!-- Task Name -->
      <div class="relative float-label">
        <input type="text" name="task_name" placeholder=" " required
          class="peer w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-indigo-500 placeholder-transparent" />
        <label>Task Name</label>
      </div>

      <!-- Start Time -->
      <div class="relative float-label">
        <input type="datetime-local" name="start_time" id="start_time" placeholder=" " required
          class="peer w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-indigo-500 placeholder-transparent" />
        <label>Start Time</label>
      </div>

      <!-- End Time -->
      <div class="relative float-label">
        <input type="datetime-local" name="end_time" id="end_time" placeholder=" " required
          class="peer w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-indigo-500 placeholder-transparent" />
        <label>End Time</label>
      </div>

      <!-- Status -->
      <select name="status" required
        class="w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-indigo-500">
        <option value="Pending">⏳ Pending</option>
        <option value="In Progress">🚧 In Progress</option>
        <option value="Completed">✅ Completed</option>
      </select>

     
      <button type="submit"
        class="w-full py-3 font-bold text-white rounded-lg bg-gradient-to-r from-indigo-500 to-emerald-500 hover:from-indigo-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
        ➕ Add Task
      </button>
    </form>

    <div class="flex justify-between mt-6 text-sm text-indigo-600 dark:text-indigo-300">
      <a href="dashboard.php" class="hover:underline">🔙 Dashboard</a>
      <a href="../auth/logout.php" class="hover:underline text-rose-500">🚪 Logout</a>
    </div>
  </div>

</body>
</html>
