@extends('layouts.app')

<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

@section('content')
<h1 class="page-title">Edit Customer</h1>

<!-- Form for editing an existing customer -->
<form id="editCustomerForm" action="{{ route('customers.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $customer->name }}" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ $customer->email }}" required><br>

    <label for="phone_number">Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number" value="{{ $customer->phone_number }}" required><br>

    <button type="button" id="submitEditCustomerBtn" class="back-btn">Update Customer</button>
</form>

<!-- Back Button -->
<a href="{{ route('customers.index') }}" class="back-btn">Back to Customers List</a>

<!-- Modal for confirmation -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <h2>Are you sure you want to update this customer?</h2>
        <div class="modal-buttons">
            <button id="confirmEditCustomerBtn">Yes, Update Customer</button>
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
    const submitEditCustomerBtn = document.getElementById('submitEditCustomerBtn');
    const confirmationModal = document.getElementById('confirmationModal');
    const warningModal = document.getElementById('warningModal');
    const confirmEditCustomerBtn = document.getElementById('confirmEditCustomerBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const closeWarningModalBtn = document.getElementById('closeWarningModalBtn');
    const editCustomerForm = document.getElementById('editCustomerForm');

    // Validate the form fields
    function validateForm() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone_number').value;

        // Check if all fields are filled
        return (name !== "" && email !== "" && phone !== "");
    }

    // Show the confirmation modal or warning modal based on validation
    submitEditCustomerBtn.addEventListener('click', function() {
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
    confirmEditCustomerBtn.addEventListener('click', function() {
        editCustomerForm.submit();
    });
</script>

@endsection
