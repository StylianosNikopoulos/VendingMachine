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

        /* Button Styles */
        .btn {
            padding: 0.5rem 1rem;
            color: white;
            border-radius: 0.375rem;
            text-align: center;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-blue {
            background-color: #2563eb; 
        }

        .btn-blue:hover {
            background-color: #1d4ed8; 
        }

        .btn-red {
            background-color: #e53e3e;
        }

        .btn-red:hover {
            background-color: #c53030; 
        }

        .bg-blue {
            background-color: #2563eb;
        }

        .bg-blue:hover {
            background-color: #1d4ed8;
        }

        .bg-red {
            background-color: #e53e3e;
        }

        .bg-red:hover {
            background-color: #c53030;
        }

        .transition {
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 lg:px-0">
            <div class="flex items-center justify-between">
                <div class="hidden lg:flex space-x-4 navbar">
                    <a href="{{ url('/') }}">Home</a>
                    @if (Auth::user() && Auth::user()->role == 'seller')
                        <a href="{{ url('/product') }}">Add Products</a>
                        <a href="{{ route('Sellers.myproducts') }}">My Products</a>
                    @endif
                </div>
                @if (Auth::user() && Auth::user()->role == 'buyer')
                <div class="mt-4 p-2 bg-gray-100 border rounded-lg shadow">
                    <p class="text-gray-700 font-semibold">Your Total Amount: {{ Auth::user()->deposit }} cents</p>
                </div>
                @endif


                <div>
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <h2 class="welcome-message">Welcome, {{ Auth::user()->name }}</h2>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-blue transition">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-blue transition">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-blue transition">Register</a>
                                @endif
                            @endauth
                            @auth
                            <form method="POST" action="{{ route('logout.all') }}">
                                @csrf
                                <button type="submit" class="btn btn-red transition">Logout from All Devices</button>
                            </form>
                            @endauth 
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 lg:px-8 py-10">
        @yield('content')
    </main>

    <footer class="text-white py-6 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Vending Machine. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>
