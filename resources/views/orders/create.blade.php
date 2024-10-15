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
<!-- Centered title under the navbar -->
<h1 class="page-title">Create New Order</h1>

<form id="createOrderForm" action="{{ route('orders.store') }}" method="POST">
    @csrf

    <label for="customer">Customer</label>
    <select name="customer_id" id="customer" required>
        <option value="">Select Customer</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>

    <label for="service">Service</label>
    <select name="service_id" id="service" required>
        <option value="">Select Service</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->service_name }}</option>
        @endforeach
    </select>

    <label for="order_date">Order Date</label>
    <input type="date" name="order_date" id="order_date" required>

    <label for="status">Payment Status</label>
    <select name="status" id="status" required>
        <option value="">Select Payment Status</option>
        <option value="Paid">Paid</option>
        <option value="Pending">Pending</option>
    </select>

    <label for="weight">Weight (kg)</label>
    <input type="number" step="0.01" name="weight" id="weight" required>

    <label for="price">Price (Rp)</label>
    <input type="number" step="0.01" name="price" id="price" readonly>

    <div class="form-group">
        <div class="not-taken-container">
            <label for="pending" class="not-taken-label">Laundry Not Taken Yet</label>
            <input type="checkbox" id="pending" name="pending" onclick="toggleDateInput()">
        </div>
    
        <div class="date-taken-container">
            <label for="date_taken">Date Taken</label>
            <input type="date" name="date_taken" id="date_taken" disabled>
        </div>
    </div>
    

    <button type="button" id="submitOrderBtn" class="back-btn">Create Order</button>
</form>

<!-- Back Button -->
<a href="{{ route('orders.index') }}" class="back-btn">Back to Homepage</a>

<!-- Modal for confirmation -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <h2>Are you sure you want to create this order?</h2>
        <div class="modal-buttons">
            <button id="confirmOrderBtn">Yes, Create Order</button>
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
    const submitOrderBtn = document.getElementById('submitOrderBtn');
    const confirmationModal = document.getElementById('confirmationModal');
    const warningModal = document.getElementById('warningModal');
    const confirmOrderBtn = document.getElementById('confirmOrderBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const closeWarningModalBtn = document.getElementById('closeWarningModalBtn');
    const createOrderForm = document.getElementById('createOrderForm');
    const weightInput = document.getElementById('weight');
    const priceInput = document.getElementById('price');
    const serviceSelect = document.getElementById('service');
    const dateTakenInput = document.getElementById('date_taken');
    const pendingCheckbox = document.getElementById('pending');

    // Function to toggle Date Taken field based on Pending checkbox
    function toggleDateTakenField() {
        dateTakenInput.disabled = pendingCheckbox.checked; // Disable date input if pending
        if (pendingCheckbox.checked) {
            dateTakenInput.value = ''; // Clear the date input if pending
        }
    }

    // Call toggleDateTakenField on page load
    window.onload = toggleDateTakenField;

    // Event listener for the pending checkbox
    pendingCheckbox.addEventListener('change', toggleDateTakenField);

    // Function to calculate price based on service price and weight
    function calculatePrice() {
        const selectedService = serviceSelect.options[serviceSelect.selectedIndex];
        const servicePrice = parseFloat(selectedService.getAttribute('data-price')) || 0; // Get service price
        const weight = parseFloat(weightInput.value) || 0; // Get weight
        const totalPrice = servicePrice * weight; // Calculate total price

        priceInput.value = totalPrice.toFixed(2); // Set the calculated price
    }

    // Event listeners to calculate price
    weightInput.addEventListener('input', calculatePrice);
    serviceSelect.addEventListener('change', calculatePrice);

    // Validate the form fields
    function validateForm() {
        const customer = document.getElementById('customer').value;
        const service = document.getElementById('service').value;
        const orderDate = document.getElementById('order_date').value;
        const status = document.getElementById('status').value;
        const weight = document.getElementById('weight').value;
        const dateTaken = dateTakenInput.value;

        // Check if all fields are filled
        if (customer === "" || service === "" || orderDate === "" || status === "" || weight === "") {
            return false;
        }

        // If Pending is not checked, ensure the date taken is filled
        if (!pendingCheckbox.checked && dateTaken === "") {
            return false;
        }

        return true;
    }

    // Show the confirmation modal or warning modal based on validation
    submitOrderBtn.addEventListener('click', function() {
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
    confirmOrderBtn.addEventListener('click', function() {
        createOrderForm.submit();
    });
</script>

@endsection
