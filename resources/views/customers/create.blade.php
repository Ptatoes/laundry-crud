@extends('layouts.app')

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- Include the Navbar -->
@include('layouts.navbar')

@section('content')

<body class="login-page"> <!-- Apply the specific class for consistent page theme -->

    <!-- Form container with login-container styling -->
    <div class="login-container w-full max-w-md mx-auto">
        <h1 class="page-title text-center">Create New Customer</h1>

        <!-- Form with client-side email validation -->
        <form id="createCustomerForm" action="{{ route('customers.store') }}" method="POST">
            @csrf

            <label for="name">Customer Name</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required> <!-- Email field with HTML5 validation -->

            <label for="phone">Phone Number</label>
            <input type="text" name="phone_number" id="phone" required>

            <button type="button" id="submitCustomerBtn" class="mt-6">Create Customer</button>
        </form>

        <!-- Display errors (Server-side validation) -->
        @if($errors->any())
        <div class="error-messages">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Back Button -->
        <div class="mt-4 text-center">
            <a href="{{ route('customers.index') }}" class="mt-6">Back to Customers List</a>
        </div>
    </div>

    <!-- Modal for confirmation -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <h2>Are you sure you want to create this customer?</h2>
            <div class="modal-buttons">
                <button id="confirmCustomerBtn">Yes, Create Customer</button>
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
        const submitCustomerBtn = document.getElementById('submitCustomerBtn');
        const confirmationModal = document.getElementById('confirmationModal');
        const warningModal = document.getElementById('warningModal');
        const confirmCustomerBtn = document.getElementById('confirmCustomerBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');
        const closeWarningModalBtn = document.getElementById('closeWarningModalBtn');
        const createCustomerForm = document.getElementById('createCustomerForm');

        // Validate the form fields
        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;

            // Check if all fields are filled and email is valid
            if (name === "" || email === "" || phone === "") {
                return false;
            }
            return true;
        }

        // Show the confirmation modal or warning modal based on validation
        submitCustomerBtn.addEventListener('click', function() {
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
        confirmCustomerBtn.addEventListener('click', function() {
            createCustomerForm.submit();
        });
    </script>

</body>
@endsection
