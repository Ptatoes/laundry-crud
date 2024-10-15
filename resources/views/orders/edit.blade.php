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
<h1 class="page-title">Edit Order</h1>

<form id="editOrderForm" action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="customer">Customer</label>
    <select name="customer_id" id="customer" required>
        <option value="">Select Customer</option> <!-- Default option to trigger validation -->
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>

    <label for="service">Service</label>
    <select name="service_id" id="service" required>
        <option value="">Select Service</option> <!-- Default option to trigger validation -->
        @foreach($services as $service)
            <option value="{{ $service->id }}" data-price="{{ $service->price }}" {{ $order->service_id == $service->id ? 'selected' : '' }}>
                {{ $service->service_name }}
            </option>
        @endforeach
    </select>

    <label for="order_date">Order Date</label>
    <input type="date" name="order_date" id="order_date" value="{{ $order->order_date }}" required>

    <!-- Updated Payment Status Dropdown -->
    <label for="status">Payment Status</label>
    <select name="status" id="status" required>
        <option value="">Select Payment Status</option>
        <option value="Paid" {{ $order->status == 'Paid' ? 'selected' : '' }}>Paid</option>
        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
    </select>

    <label for="weight">Weight (kg)</label>
    <input type="number" step="0.01" name="weight" id="weight" value="{{ $order->weight }}" required>

    <label for="price">Price (Rp)</label>
    <input type="number" step="0.01" name="price" id="price" value="{{ $order->price }}" readonly>

    <!-- Checkbox for Laundry Not Taken Yet -->
    <div class="form-group">
        <label for="pending" class="not-taken-label">
            <input type="checkbox" id="pending" name="pending" onclick="toggleDateInput()" class="not-taken-checkbox"> 
            Laundry Not Taken Yet
        </label>
    </div>
    
    <!-- Date Taken Input -->
    <div class="form-group">
        <label for="date_taken">Date Taken</label>
        <input type="date" name="date_taken" id="date_taken" value="{{ $order->date_taken }}" required>
    </div>
    

    <!-- Update Order Button -->
    <button type="button" id="submitOrderBtn" class="back-btn" onclick="validateForm()">Update Order</button>

    <script>
        function toggleDateInput() {
            const checkbox = document.getElementById('pending');
            const dateInput = document.getElementById('date_taken');

            // Enable or disable the date input based on the checkbox state
            if (!checkbox.checked) {  // If checkbox is NOT checked
                dateInput.disabled = false; // Enable date input
                dateInput.required = true; // Make it required
            } else {
                dateInput.disabled = true; // Disable date input when checked
                dateInput.value = ""; // Clear the date input if checked
                dateInput.required = false; // Remove the required attribute
            }
        }

        // Call this function on page load to set the correct state
        window.onload = function() {
            toggleDateInput(); // Set initial state based on checkbox
        };

        function validateForm() {
            const dateInput = document.getElementById('date_taken');
            const checkbox = document.getElementById('pending');

            // Check if the checkbox is NOT checked and the date is empty
            if (!checkbox.checked && !dateInput.value) {
                alert("Please enter the Date Taken when Laundry Not Taken Yet is not checked.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission if valid
        }

        // Your existing price calculation logic can stay here
    </script>
</form>

<!-- Back Button -->
<a href="{{ route('orders.index') }}" class="back-btn">Back to Homepage</a>

<!-- Modal for confirmation -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <h2>Are you sure you want to update this order?</h2>
        <div class="modal-buttons">
            <button id="confirmOrderBtn">Yes, Update Order</button>
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
    const editOrderForm = document.getElementById('editOrderForm');
    const weightInput = document.getElementById('weight');
    const priceInput = document.getElementById('price');
    const serviceSelect = document.getElementById('service');

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
        editOrderForm.submit();
    });

    // Calculate initial price on load
    calculatePrice();
</script>

@endsection
