<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    // public function show()
    // {
    //     $user = Auth::user(); // Get the authenticated user
    //     return view('auth.show_profile', compact('user')); // Pass user to the view
    // }
    public function show()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user data to the 'show_profile' view
        return view('auth.show_profile', compact('user'));
    }
    public function edit()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Pass the user data to the profile edit view
        return view('auth.edit_profile', compact('user')); // Updated path to the edit view
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())], // Ensure unique email
            'phone_number' => 'required|string|max:15',
        ]);
    
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Get the authenticated user
    
        // Update the authenticated user's profile with validated data
        $user->update($validated);
    
        // Redirect back with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
    
}
