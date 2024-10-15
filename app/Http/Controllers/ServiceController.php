<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // In ServiceController.php

// In ServiceController.php

public function index(Request $request)
{
    $search = $request->input('search');
    $services = [];

    // If there's a search query, filter services by the search term
    if ($search) {
        $services = Service::where('service_name', 'LIKE', "%{$search}%")->get();

        // If no services found, show warning and keep the search term in the input
        if ($services->isEmpty()) {
            return view('services.index', compact('services', 'search'))
                ->with('message', 'No services found matching your search.');
        }
    } else {
        // If no search query, return all services
        $services = Service::all();
    }

    return view('services.index', compact('services', 'search'));
}



    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required',
            'price' => 'required|numeric'
        ]);

        Service::create($request->all());

        return redirect()->route('services.index');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_name' => 'required',
            'price' => 'required|numeric'
        ]);

        $service->update($request->all());

        return redirect()->route('services.index');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index');
    }
}
