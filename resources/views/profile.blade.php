<!DOCTYPE html>
<html lang="en">
{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>User Profile</title>
</head>
<body>
    <header>
        <h1>User Profile</h1>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                @auth
                    <li><span>Welcome, {{ Auth::user()->name }}!</span></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endguest
            </ul>
        </nav>
    </header> --}}
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Laundry Service - Customers')</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body>
        <!-- Navbar -->
        <header>
            <h1>Welcome to Our Laundry Service</h1>
            <nav>
                <ul>
                    <li><a href="{{ route('customers.index') }}">Customers</a></li>
                    <li><a href="{{ route('orders.index') }}">Orders</a></li>
                    <li><a href="{{ route('services.index') }}">Services</a></li>
                    <li><a href="{{ route('profile.show') }}">Profile</a></li>

                </ul>
            </nav>
        </header>
    <main>
        <h2>Profile Information</h2>
        <p>Name: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        <p>Phone Number: {{ Auth::user()->phone_number }}</p>

        <a href="{{ route('profile.edit') }}" class="edit-button">Edit Profile</a>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Laundry Service. All rights reserved.</p>
    </footer>
</body>
</html>
