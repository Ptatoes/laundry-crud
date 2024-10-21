@extends('layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laundry Service - Orders')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f5f1; /* Light beige background */
            color: #333;
        }

        header {
            background-color: #004080; /* Dark blue header */
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        nav a {
            color: white;
        }

        .back-btn {
            background-color: #4F2D13; /* Blue button */
            color: white;
        }

        .back-btn:hover {
            background-color: #4F2D13; /* Darker blue on hover */
        }

        /* Search bar styles */
        .search-bar input {
            background-color: #ffffff; /* White input */
            border: 1px solid #ccc; /* Light gray border */
            color: #333; /* Dark text */
        }

        .search-bar button {
            background-color: #4F2D13; /* Blue button */
            color: white;
        }

        .search-bar button:hover {
            background-color: #b59661; /* Darker blue on hover */
        }

        .table-container {
            margin-top: 20px;
            background-color: #ffffff; /* White table background */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1.page-title {
            color: #4F2D13; /* Dark blue title */
        }

        /* Button styles */
        .btn-edit {
            background-color: #007BFF; /* Blue */
            color: white;
        }

        .btn-edit:hover {
            background-color: #0056b3; /* Darker blue */
        }

        .btn-delete {
            background-color: #dc3545; /* Red */
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333; /* Darker red */
        }
    </style>
</head>

<body>
    <!-- Include the Navbar -->
    @include('layouts.navbar')

    @section('content')
    <section>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white bg-opacity-80 relative shadow-md sm:rounded-lg overflow-hidden">
                
                <!-- Search Bar and Add Order Button Section -->
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    
                    <!-- Search Bar -->
                    <div class="w-full md:w-1/2 search-bar">
                        <form class="flex items-center w-full" action="{{ route('orders.index') }}" method="GET">
                            <label for="order-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input 
                                    type="text" 
                                    id="order-search" 
                                    name="search"  
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 pr-4 py-2"
                                    placeholder="Search Orders" 
                                    value="{{ request('search') }}"
                                >
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Search Button -->
                            <button 
                                type="submit" 
                                class="back-btn ml-2 px-4 py-2 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm hover:bg-opacity-90"
                            >
                                Search
                            </button>
                        </form>
                    </div>

                    <!-- "Back to All List" Button (Visible Only When Searching) -->
                    @if(request('search'))
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="{{ route('orders.index') }}" class="back-btn px-4 py-2 hover:text-brown-900 font-medium rounded-lg text-sm">
                            Back to All List
                        </a>
                    </div>
                    @endif

                    <!-- Add Order Button -->
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button 
                            type="button" 
                            onclick="window.location='{{ route('orders.create') }}'" 
                            class="flex items-center justify-center text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
                            style="background-color: #4F2D13; hover:bg-opacity-90;"
                        >
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add Order
                        </button>
                    </div>
                </div>

                <!-- Page Title -->
                <h1 class="text-2xl font-bold text-center text-gray-800 mb-4 page-title">Orders</h1>

                <!-- Warning Messages -->
                @if (session()->has('message'))
                    <div class="text-center p-4 bg-red-200 text-red-800">
                        {{ session('message') }}
                    </div>
                @elseif ($orders->isEmpty() && request('search'))
                    <div class="text-center p-4 bg-red-100 text-red-800">
                        No orders found.
                    </div>
                @endif

                <!-- Orders Table -->
                @if ($orders->isNotEmpty())
                <div class="table-container overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Customer Name</th>
                                <th scope="col" class="px-4 py-3">Service</th>
                                <th scope="col" class="px-4 py-3">Order Date</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="bg-white border-b">
                                    <td class="px-4 py-3">{{ $order->customer->name }}</td>
                                    <td class="px-4 py-3">{{ $order->service->service_name }}</td>
                                    <td class="px-4 py-3">{{ $order->order_date }}</td>
                                    <td class="px-4 py-3">{{ $order->status }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex space-x-2">
                                            <!-- Edit Button -->
                                            <form action="{{ route('orders.edit', $order->id) }}" method="GET" class="inline-block">
                                                <button type="submit" class="btn-edit px-4 py-2 font-medium rounded-lg text-sm">Edit</button>
                                            </form>
                                            
                                            <!-- Delete Button with Confirmation -->
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="button" 
                                                    onclick="confirmDelete({{ $order->id }})" 
                                                    class="btn-delete px-4 py-2 font-medium rounded-lg text-sm"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Back to Homepage Button -->
                <div class="p-4 text-center">
                    <a href="{{ route('home') }}" class="back-btn hover:bg-opacity-90">Back to Homepage</a>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for Delete Confirmation -->
    <script>
        function confirmDelete(orderId) {
            if (confirm('Are you sure you want to delete this order?')) {
                document.querySelector(`form[action$="orders/${orderId}"]`).submit();
            }
        }
    </script>
    @endsection
</body>
