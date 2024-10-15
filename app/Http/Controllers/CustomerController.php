<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
{
    // Retrieve the search query from the request
    $search = $request->input('search');

    // Initialize the query builder
    $query = Customer::query();

    // If a search query exists, apply filters
    if ($request->has('search') && !empty($search)) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone_number', 'like', "%{$search}%");
    }

    // Execute the query and paginate results
    $customers = $query->orderBy('name', 'asc')->paginate(10)->withQueryString();

    // Pass the customers and search query to the view
    return view('customers.index', compact('customers', 'search'));
}




    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:customers',
        'phone_number' => 'required|string|max:15',
    ]);

    // Create a new customer record
    Customer::create($validatedData);

    // Redirect to the index page with success message
    return redirect()->route('customers.index')->with('success', 'Customer created successfully');
}

    

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required'
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }
}
