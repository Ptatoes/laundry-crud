<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();

        return view('orders.create', compact('customers', 'services'));
    }

    // public function edit($id)
    // {
    //     $order = Order::findOrFail($id);
    //     $customers = Customer::all(); // Fetch all customers
    //     $services = Service::all();   // Fetch all services

    //     return view('orders.edit', compact('order', 'customers', 'services'));
    // }
    public function edit($id)
{
    // Fetch the order using the given ID
    $order = Order::findOrFail($id);
    
    // Fetch customers and services if necessary
    $customers = Customer::all();
    $services = Service::all();

    // Pass the order, customers, and services to the view
    return view('orders.edit', compact('order', 'customers', 'services'));
}



public function update(Request $request, Order $order)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'service_id' => 'required|exists:services,id',
        'order_date' => 'required|date',
        'status' => 'required|string',
        'weight' => 'required|numeric',
        'price' => 'required|numeric',
        // 'date_taken' is optional if "Pending" is checked
        'date_taken' => 'nullable|date'
    ]);

    // If pending is checked, set date_taken to null
    if (isset($request->pending)) {
        $validatedData['date_taken'] = null;
    }

    // Update the order with validated data
    $order->update($validatedData);

    // Redirect or return a response
    return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
}

    
    public function index(Request $request)
    {
        $query = Order::query();
    
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('customer', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('service', function($q) use ($search) {
                $q->where('service_name', 'like', "%{$search}%");
            })
            ->orWhere('status', 'like', "%{$search}%");
        }
    
        $orders = $query->with(['customer', 'service'])->paginate(10);
    
        return view('orders.index', compact('orders'));
    }
    

    public function store(Request $request)
{
    // Validate request data
    $validatedData = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'service_id' => 'required|exists:services,id',
        'order_date' => 'required|date',
        'status' => 'required|string',
        'weight' => 'required|numeric',
        'price' => 'required|numeric', // If you're saving price, make sure it's validated
        // Only require date_taken if pending is unchecked
        'date_taken' => 'nullable|date' // Remove required_if for clarity
    ]);

    // Handle the "Pending" logic if necessary
    if (isset($request->pending)) {
        // If pending, set date_taken to null or handle accordingly
        $validatedData['date_taken'] = null;
    }

    // Create the order
    Order::create($validatedData);

    return redirect()->route('orders.index')->with('success', 'Order created successfully.');
}


    public function destroy($id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($id);
        
        // Delete the order
        $order->delete();

        // Redirect to the orders index with a success message
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
