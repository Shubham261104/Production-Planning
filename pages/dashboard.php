<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/database.php';

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Production Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../assets/js/script.js" defer></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-700">📅 Production Schedule</h2>
            <a href="../auth/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Logout</a>
        </div>

        <!-- Search Bar -->
        <div class="mb-4">
            <input type="text" id="search" placeholder="Search tasks..." class="w-full p-2 border rounded-lg">
        </div>

        <!-- Task Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">Task</th>
                        <th class="border border-gray-300 px-4 py-2">Start</th>
                        <th class="border border-gray-300 px-4 py-2">End</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody id="taskTable">
                    <?php
                    $query = "SELECT * FROM production_schedule WHERE user_id = ? ORDER BY start_time ASC";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Dynamic progress bar based on status
                            $progress = ($row['status'] == 'Completed') ? "w-full bg-green-500" : "w-1/2 bg-yellow-500";
                            echo "<tr class='hover:bg-gray-100'>
                                <td class='border border-gray-300 px-4 py-2'>{$row['task_name']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$row['start_time']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$row['end_time']}</td>
                                <td class='border border-gray-300 px-4 py-2'>
                                    <div class='relative w-32 h-2 bg-gray-300 rounded-full'>
                                        <div class='absolute top-0 left-0 h-2 rounded-full $progress'></div>
                                    </div>
                                    <span class='text-sm'>{$row['status']}</span>
                                </td>
                                <td class='border border-gray-300 px-4 py-2 text-center'>
                                    <a href='edit_task.php?id={$row['id']}' class='bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600'>Edit</a>
                                    <a href='delete_task.php?id={$row['id']}' class='bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center p-4'>No tasks found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Action Buttons -->
        <div class="mt-4 flex space-x-2">
            <a href="add_task.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">➕ Add Task</a>
            <!-- <a href="schedule.php" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">📅 View Schedule</a> -->
        </div>
    </div>

    <!-- JavaScript for Search Filter -->
    <script>
        document.getElementById('search').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#taskTable tr');

            rows.forEach(row => {
                let task = row.children[0].innerText.toLowerCase();
                row.style.display = task.includes(filter) ? '' : 'none';
            });
        });
    </script>

</body>
</html>
