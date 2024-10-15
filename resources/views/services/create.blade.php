@extends('layouts.app')

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
<h1 class="page-title">Create New Service</h1>

<!-- Form for creating a new service -->
<form id="createServiceForm" action="{{ route('services.store') }}" method="POST">
    @csrf
    <label for="service_name">Service Name:</label>
    <input type="text" id="service_name" name="service_name" required><br>

    <label for="price">Price (Rupiah):</label>
    <input type="number" id="price" name="price" step="0.00" required><br>

    <button type="button" id="submitServiceBtn" class="back-btn">Create Service</button>
</form>

<!-- Back Button -->
<a href="{{ route('services.index') }}" class="back-btn">Back to Services List</a>

<!-- Modal for confirmation -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <h2>Are you sure you want to create this service?</h2>
        <div class="modal-buttons">
            <button id="confirmServiceBtn">Yes, Create Service</button>
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
    const submitServiceBtn = document.getElementById('submitServiceBtn');
    const confirmationModal = document.getElementById('confirmationModal');
    const warningModal = document.getElementById('warningModal');
    const confirmServiceBtn = document.getElementById('confirmServiceBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const closeWarningModalBtn = document.getElementById('closeWarningModalBtn');
    const createServiceForm = document.getElementById('createServiceForm');

    // Validate the form fields
    function validateForm() {
        const serviceName = document.getElementById('service_name').value;
        const price = document.getElementById('price').value;

        // Check if all fields are filled
        return (serviceName !== "" && price !== "");
    }

    // Show the confirmation modal or warning modal based on validation
    submitServiceBtn.addEventListener('click', function() {
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
    confirmServiceBtn.addEventListener('click', function() {
        createServiceForm.submit();
    });
</script>

@endsection
