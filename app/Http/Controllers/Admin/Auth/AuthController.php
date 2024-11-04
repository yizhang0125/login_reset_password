<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.auth.login'); // View for the admin login form
    }

    // Handle admin login
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Retrieve credentials from the request
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if "remember me" is checked

        // Attempt to log in the admin
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            // If successful, redirect to the admin dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors(['loginError' => 'Invalid login credentials.']);
    }

    // Show the admin dashboard
    public function dashboard()
    {
        return view('admin.auth.dashboard'); // View for the admin dashboard
    }

    // Handle admin logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logs the admin out
        return redirect('/admin/login')->with('success', 'Successfully logged out.');
    }
}
