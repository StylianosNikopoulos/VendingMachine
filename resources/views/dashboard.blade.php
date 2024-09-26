<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vending Machine</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }

        header {
            transition: background-color 0.3s ease;
        }

        header:hover {
            background-color: #f7fafc; 
        }

        .navbar a {
            transition: color 0.3s ease;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem; 
        }

        .navbar a:hover {
            color: #1d4ed8; 
            background-color: rgba(29, 78, 216, 0.1); 
        }

        footer {
            background-color: #2d3748; 
        }

        footer p {
            font-size: 0.875rem; 
        }

        .welcome-message {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1a202c;
        }

        .btn-logout {
            background-color: #e53e3e; 
        }

        .btn-logout:hover {
            background-color: #c53030; 
        }

    </style>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="hidden lg:flex space-x-4 navbar">
                    <a href="{{ url('/') }}">Home</a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex flex-col items-center justify-center container mx-auto px-4 lg:px-8 py-10">
        <h2 class="welcome-message text-center">Hello, {{ Auth::user()->name }}! You are logged in.</h2>
        <a href="{{ url('/') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Go back to Home Page</a>
    </main>

    <footer class="text-white py-6 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Vending Machine. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
