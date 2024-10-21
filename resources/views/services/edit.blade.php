@extends('layouts.app')

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
  <!-- Include the Navbar -->
    @include('layouts.navbar')
<body class="login-page"> <!-- Ensure consistent styling -->

  

    @section('content')
    <section>
        <div class="login-container w-full max-w-md mx-auto">
            <h1 class="page-title text-center">Edit Service</h1>

            <form id="editServiceForm" action="{{ route('services.update', $service->id) }}" method="POST">
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
                    <button type="button" id="submitEditServiceBtn" class="mt-6">Update Service</button>
                </div>
            </form>
            <div class="mt-4 text-center">
                <a href="{{ route('services.index') }}" class="mt-6">Back to the list</a>
                
                    </div>
        </div>

        <!-- Modal for confirmation -->
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <h2>Are you sure you want to update this service?</h2>
                <div class="modal-buttons">
                    <button id="confirmEditServiceBtn">Yes, Update Service</button>
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
            const submitEditServiceBtn = document.getElementById('submitEditServiceBtn');
            const confirmationModal = document.getElementById('confirmationModal');
            const warningModal = document.getElementById('warningModal');
            const confirmEditServiceBtn = document.getElementById('confirmEditServiceBtn');
            const cancelModalBtn = document.getElementById('cancelModalBtn');
            const closeWarningModalBtn = document.getElementById('closeWarningModalBtn');
            const editServiceForm = document.getElementById('editServiceForm');

            // Validate the form fields
            function validateForm() {
                const serviceName = document.getElementById('service_name').value;
                const price = document.getElementById('price').value;

                // Check if all fields are filled
                return (serviceName !== "" && price !== "");
            }

            // Show the confirmation modal or warning modal based on validation
            submitEditServiceBtn.addEventListener('click', function() {
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
            confirmEditServiceBtn.addEventListener('click', function() {
                editServiceForm.submit();
            });
        </script>
    </section>
    @endsection

</body>
