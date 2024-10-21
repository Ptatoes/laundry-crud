<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css']) <!-- Assuming you're using Vite for assets -->
</head>
<body class="login-page"> <!-- Apply the specific class here -->
    <div class="login-container w-full max-w-md">
        <h1 class="text-center text-2xl font-bold">Login</h1>
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block mb-2">Email</label>
                <input type="email" name="email" id="email" required class="w-full p-2 border">
            </div>
            <div class="mt-4">
                <label for="password" class="block mb-2">Password</label>
                <input type="password" name="password" id="password" required class="w-full p-2 border">
            </div>
            <button type="submit" class="mt-6">Login</button>
        </form>
        <div class="mt-4 text-center">
            <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</body>
</html>
