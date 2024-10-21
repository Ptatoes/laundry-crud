@extends('layouts.app')

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- Include the Navbar -->
@include('layouts.navbar')

@section('content')
<div class="container mx-auto mt-8 px-6 py-8 profile-container max-w-3xl bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6 text-center">Profile Information</h1>

    @if ($user) <!-- Check if user is available -->
        <div class="profile-info space-y-4 form-container">
            <div class="profile-item flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                <strong class="text-lg text-gray-700 dark:text-gray-300">Name:</strong>
                <span class="profile-value text-lg text-gray-900 dark:text-white">{{ $user->name }}</span>
            </div>

            <div class="profile-item flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                <strong class="text-lg text-gray-700 dark:text-gray-300">Email:</strong>
                <span class="profile-value text-lg text-gray-900 dark:text-white">{{ $user->email }}</span>
            </div>

            <div class="profile-item flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                <strong class="text-lg text-gray-700 dark:text-gray-300">Phone Number:</strong>
                <span class="profile-value text-lg text-gray-900 dark:text-white">{{ $user->phone_number ?? 'Not Provided' }}</span>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('profile.edit') }}" class="inline-block px-6 py-3 text-lg font-medium text-white bg-blue-600 hover:bg-blue-800 rounded-lg shadow-md focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 transition ease-in-out duration-300">Edit Profile</a>
        </div>
    @else
        <p class="text-center text-lg text-red-600 dark:text-red-400 mt-6">User information is not available.</p>
    @endif
</div>
@endsection
