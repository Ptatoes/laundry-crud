@extends('layouts.app')

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@include('layouts.navbar')

@section('content')

<body class="login-page"> <!-- Consistent page class -->

    <div class="login-container w-full max-w-md mx-auto mt-8 px-6 py-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white mb-6 text-center">Edit Profile</h1>

        <form action="{{ route('profile.update') }}" method="POST" id="editProfileForm" class="space-y-6">
            @csrf
            @method('PUT') <!-- This is important for PUT request -->

            <!-- Name Input -->
            <div class="form-group">
                <label for="name" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border border-gray-300 dark:border-gray-600">
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border border-gray-300 dark:border-gray-600">
            </div>

            <!-- Phone Number Input -->
            <div class="form-group">
                <label for="phone_number" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ $user->phone_number ?? '' }}"
                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border border-gray-300 dark:border-gray-600">
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center">
                <button type="button" id="submitEditProfileBtn" class="inline-block px-6 py-3 text-lg font-medium text-white bg-blue-600 hover:bg-blue-800 rounded-lg shadow-md focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 transition ease-in-out duration-300">
                    Update Profile
                </button>
                <a href="{{ route('profile.show') }}" class="inline-block px-6 py-3 text-lg font-medium text-gray-700 dark:text-gray-300 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg shadow-md focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-800 transition ease-in-out duration-300">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Modal for confirmation -->
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <h2>Are you sure you want to update your profile?</h2>
                <div class="modal-buttons">
                    <button id="confirmEditProfileBtn">Yes, Update Profile</button>
                    <button id="cancelModalBtn" class="cancel-btn">No, Go Back</button>
                </div>
            </div>
        </div>

        <!-- Modal for warning -->
        <div id="warningModal" class="modal">
            <div class="modal-content">
                <h2>Please fill in all the required fields.</h2>
                <div class="modal-buttons">
                    <button id="closeWarningModalBtn" class="cancel-btn">Close</button>
                </div>
            </div>
        </div>

        <script>
            // Get elements
            const submitEditProfileBtn = document.getElementById('submitEditProfileBtn');
            const confirmationModal = document.getElementById('confirmationModal');
            const warningModal = document.getElementById('warningModal');
            const confirmEditProfileBtn = document.getElementById('confirmEditProfileBtn');
            const cancelModalBtn = document.getElementById('cancelModalBtn');
            const closeWarningModalBtn = document.getElementById('closeWarningModalBtn');
            const editProfileForm = document.getElementById('editProfileForm');

            // Validate the form fields
            function validateForm() {
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;

                // Check if all fields are filled
                return (name !== "" && email !== "");
            }

            // Show the confirmation modal or warning modal based on validation
            submitEditProfileBtn.addEventListener('click', function() {
                if (validateForm()) {
                    confirmationModal.style.display = 'flex'; // Show confirmation modal if form is valid
                } else {
                    warningModal.style.display = 'flex'; // Show warning modal if form is incomplete
                }
            });

            // Hide the confirmation modal when cancel button is clicked
            cancelModalBtn.addEventListener('click', function() {
                confirmationModal.style.display = 'none';
            });

            // Hide the warning modal when close button is clicked
            closeWarningModalBtn.addEventListener('click', function() {
                warningModal.style.display = 'none';
            });

            // Submit the form when confirmation button is clicked
            confirmEditProfileBtn.addEventListener('click', function() {
                editProfileForm.submit();
            });
        </script>
    </div>
</body>

@endsection
