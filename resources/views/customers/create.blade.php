{{-- @extends('layouts.app')

@section('content')
<h1>Add Customer</h1>
<form action="{{ route('customers.store') }}" method="POST">
    @csrf
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Phone Number: <input type="text" name="phone_number" required><br>
    <button type="submit">Add</button>
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection --}}
@extends('layouts.app')

<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<!-- Navbar with title included -->
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
<!-- Centered title under the navbar -->
<h1 class="page-title">Create New Customer</h1>

<form id="createCustomerForm" action="{{ route('customers.store') }}" method="POST">
    @csrf

    <label for="name">Customer Name</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="phone">Phone Number</label>
    <input type="text" name="phone_number" id="phone" required>

    <button type="button" id="submitCustomerBtn" class="back-btn">Create Customer</button>
</form>

<!-- Back Button -->
<a href="{{ route('customers.index') }}" class="back-btn">Back to Customers List</a>

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

        // Check if all fields are filled
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

@endsection


