<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | Production Planner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to right, #6dd5fa, #2980b9);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>
<body class="font-sans text-white">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Contact Section -->
    <section class="min-h-screen flex items-center justify-center px-4 py-16">
        <div class="w-full max-w-2xl glass-card rounded-3xl p-10">
            <h2 class="text-4xl font-extrabold text-center text-white mb-3">Contact Us</h2>
            <p class="text-center text-white text-opacity-90 mb-8 text-sm">
                Have any questions or feedback? We're always here to help!
            </p>

            <form class="space-y-6">
                <div>
                    <label class="block text-white text-sm font-medium mb-1">Your Name</label>
                    <input type="text" placeholder="Enter your name" required
                        class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-80 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition shadow-md">
                </div>
                <div>
                    <label class="block text-white text-sm font-medium mb-1">Email</label>
                    <input type="email" placeholder="Enter your email" required
                        class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-80 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition shadow-md">
                </div>
                <div>
                    <label class="block text-white text-sm font-medium mb-1">Message</label>
                    <textarea rows="4" placeholder="Write your message..." required
                        class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-80 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition shadow-md"></textarea>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg transition transform hover:scale-105 shadow-lg">
                    🚀 Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

</body>
</html>
