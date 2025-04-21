<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Production Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex flex-col">

    <!-- Navbar -->
    <?php include './navbar.php'; ?>

    <!-- About Section -->
    <main class="flex-1">
        <section class="py-20 px-6 md:px-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">About Production Planner</h1>
            <p class="max-w-3xl mx-auto text-gray-600 text-lg">
                Welcome to <strong class="text-blue-600">Production Planner</strong> — a smart web-based system built to simplify and automate your production scheduling.
            </p>
        </section>

        <!-- Feature Highlights -->
        <section class="bg-white py-16 px-6 md:px-12">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-gradient-to-tr from-blue-500 to-purple-500 text-white p-6 rounded-xl shadow-lg hover:scale-105 transition">
                    <h3 class="text-xl font-semibold mb-2">📋 Task Management</h3>
                    <p>Easily create, update, and monitor production tasks to ensure smooth operations.</p>
                </div>
                <div class="bg-gradient-to-tr from-yellow-500 to-pink-500 text-white p-6 rounded-xl shadow-lg hover:scale-105 transition">
                    <h3 class="text-xl font-semibold mb-2">🕒 Real-time Scheduling</h3>
                    <p>Manage production timelines dynamically with an intuitive and responsive UI.</p>
                </div>
                <div class="bg-gradient-to-tr from-green-500 to-teal-500 text-white p-6 rounded-xl shadow-lg hover:scale-105 transition">
                    <h3 class="text-xl font-semibold mb-2">📊 Progress Overview</h3>
                    <p>Track daily goals and overall schedule at a glance with visual indicators.</p>
                </div>
            </div>
        </section>

        <!-- The Developer -->
        <!-- The Developers -->
        <section class="py-20 px-6 md:px-12 bg-gray-100 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Meet the Team Behind Production Planner</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 max-w-6xl mx-auto">

                <!-- Member 1 -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition">
                    <img src="https://avatars.githubusercontent.com/u/0000001?v=4" alt="Member 1" class="w-24 h-24 mx-auto rounded-full border-4 border-blue-500 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Alice Sharma</h3>
                    <p class="text-gray-600 text-sm">Frontend Developer</p>
                    <div class="mt-3 flex justify-center gap-3 text-blue-500 text-lg">
                        <a href="#" class="hover:text-black">GitHub</a>
                        <a href="#" class="hover:text-black">LinkedIn</a>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition">
                    <img src="https://avatars.githubusercontent.com/u/0000002?v=4" alt="Member 2" class="w-24 h-24 mx-auto rounded-full border-4 border-green-500 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Ravi Patel</h3>
                    <p class="text-gray-600 text-sm">Backend Developer</p>
                    <div class="mt-3 flex justify-center gap-3 text-green-500 text-lg">
                        <a href="#" class="hover:text-black">GitHub</a>
                        <a href="#" class="hover:text-black">LinkedIn</a>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition">
                    <img src="https://avatars.githubusercontent.com/u/0000003?v=4" alt="Member 3" class="w-24 h-24 mx-auto rounded-full border-4 border-yellow-500 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Sneha Roy</h3>
                    <p class="text-gray-600 text-sm">Database Architect</p>
                    <div class="mt-3 flex justify-center gap-3 text-yellow-500 text-lg">
                        <a href="#" class="hover:text-black">GitHub</a>
                        <a href="#" class="hover:text-black">LinkedIn</a>
                    </div>
                </div>

                <!-- Member 4 -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition">
                    <img src="https://avatars.githubusercontent.com/u/0000004?v=4" alt="Member 4" class="w-24 h-24 mx-auto rounded-full border-4 border-red-500 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Karan Verma</h3>
                    <p class="text-gray-600 text-sm">UI/UX Designer</p>
                    <div class="mt-3 flex justify-center gap-3 text-red-500 text-lg">
                        <a href="#" class="hover:text-black">GitHub</a>
                        <a href="#" class="hover:text-black">LinkedIn</a>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>