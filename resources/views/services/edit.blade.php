{{-- @extends('layouts.app')

@section('content')
<h1>Edit Service</h1>

<form action="{{ route('services.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="service_name">Service Name</label>
    <input type="text" name="service_name" value="{{ $service->service_name }}" required>

    <label for="price">Price</label>
    <input type="number" step="0.01" name="price" value="{{ $service->price }}" required>

    <button type="submit">Update Service</button>
</form>
@endsection --}}
@extends('layouts.app')

<head>
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
            </ul>
        </nav>
    </header>

@section('content')
<section>
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-white bg-opacity-80 dark:bg-gray-800 dark:bg-opacity-80 relative shadow-md sm:rounded-lg overflow-hidden p-4">
            <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-4">Edit Service</h1>

            <form action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="service_name" class="block text-gray-700 dark:text-gray-300">Service Name:</label>
                    <input type="text" name="service_name" id="service_name" value="{{ old('service_name', $service->service_name) }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-3 pr-4 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @error('service_name')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 dark:text-gray-300">Price (Rupiah):</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" required step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-3 pr-4 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @error('price')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                

                <div class="flex justify-end">
                    <button type="submit" class="back-btn  hover:bg-primary-1000">
                        Update Service
                    </button>
                    <a href="{{ route('services.index') }}" class=" back-btn hover:bg-primary-1000">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
</body>

