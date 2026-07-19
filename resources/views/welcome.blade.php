<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            background: linear-gradient(135deg,#0f172a,#1e3a8a);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

<div class="bg-white rounded-3xl shadow-2xl p-12 w-11/12 max-w-5xl">

    <div class="text-center">

        <h1 class="text-5xl font-bold text-blue-700">
            🗳 Online Voting System
        </h1>

        <p class="mt-5 text-gray-600 text-lg">
            A secure and transparent online voting platform built with Laravel 12.
        </p>

    </div>

    <div class="grid md:grid-cols-3 gap-8 mt-14">

        <div class="border rounded-xl p-8 text-center shadow hover:shadow-xl transition">
            <h2 class="text-2xl font-bold text-blue-700">
                Voter Login
            </h2>

            <p class="mt-4 text-gray-600">
                Existing voters can log in and cast their votes.
            </p>

            <a href="{{ route('voter.login') }}"
               class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Login
            </a>
        </div>

        <div class="border rounded-xl p-8 text-center shadow hover:shadow-xl transition">
            <h2 class="text-2xl font-bold text-green-700">
                Register
            </h2>

            <p class="mt-4 text-gray-600">
                New voters can register for upcoming elections.
            </p>

            <a href="{{ route('voter.register') }}"
               class="mt-6 inline-block bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                Register
            </a>
        </div>

        <div class="border rounded-xl p-8 text-center shadow hover:shadow-xl transition">
            <h2 class="text-2xl font-bold text-red-700">
                Administrator
            </h2>

            <p class="mt-4 text-gray-600">
                Election administrators manage elections and results.
            </p>

            <a href="{{ route('admin.login') }}"
               class="mt-6 inline-block bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">
                Admin Login
            </a>
        </div>

    </div>

    <div class="mt-14 text-center text-gray-500">

        <p>
            © Online Voting System
        </p>

    </div>

</div>

</body>
</html>