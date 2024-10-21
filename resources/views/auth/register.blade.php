<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css']) <!-- Assuming you're using Vite for assets -->
    <style>
        /* Earth-tone colors and immersive design */
        body {
            background: linear-gradient(135deg, #D8A47F, #7C4C20); /* Soft brown earth-tone gradient */
        }

        .register-container {
            background-color: #F2E8D5; /* Light beige for contrast */
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .register-container:hover {
            transform: scale(1.03); /* Slight hover effect */
        }

        h1 {
            color: #4F2D13; /* Darker earth-tone for title */
        }

        input {
            border: 2px solid #B68973;
            border-radius: 8px;
            padding: 0.5rem;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        input:focus {
            background-color: #F7E4C8;
            border-color: #8C4F28; /* Darker brown on focus */
        }

        button {
            background-color: #8C4F28; /* Earthy brown for button */
            color: #fff;
            border-radius: 8px;
            padding: 0.75rem;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #5F351A;
            transform: translateY(-3px); /* Lift button on hover */
        }

        .register-container p {
            color: #4F2D13;
        }

        .register-container a {
            color: #8C4F28;
            transition: color 0.3s ease;
        }

        .register-container a:hover {
            color: #5F351A;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="register-container w-full max-w-md">
        <h1 class="text-center text-2xl font-bold">Register</h1>
        
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="block mb-2">Name</label>
                <input type="text" name="name" id="name" required class="w-full p-2 border">
            </div>
            <div class="mt-4">
                <label for="email" class="block mb-2">Email</label>
                <input type="email" name="email" id="email" required class="w-full p-2 border">
            </div>
            <div class="mt-4">
                <label for="password" class="block mb-2">Password</label>
                <input type="password" name="password" id="password" required class="w-full p-2 border">
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="block mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full p-2 border">
            </div>
            <button type="submit" class="mt-6">Register</button>
        </form>

        <div class="mt-4 text-center">
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
</body>
</html>
