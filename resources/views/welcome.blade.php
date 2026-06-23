<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CRM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="text-center px-6">
        <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">Mini CRM</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-8">Gestioneaza task-urile tale simplu si eficient</p>

        <div class="flex gap-4 justify-center">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 gover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Log in</a>
                <a href="{{ route('register') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded">Register</a>
            @endauth
        </div>
    </div>
    
</body>
</html>