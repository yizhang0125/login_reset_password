<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class CustomAuthController extends Controller
{
    // Show the registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        // Validate the registration request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // Returns the login view
    }

        // Handle user login
        public function login(Request $request)
        {
            // Validate incoming request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
        
            // Retrieve credentials from the request
            $credentials = $request->only('email', 'password'); 
            $remember = $request->has('remember'); // Check if "remember me" is checked
        
            // Log the credentials (avoid logging passwords in production)
            \Log::info('Login Attempt:', $credentials);
        
            // Attempt to log in the user
            if (Auth::attempt($credentials, $remember)) {
                // If successful, redirect to the dashboard
                return redirect()->intended('/')->with('success', 'Welcome back!');
            }
        
            // Log failed login attempt
            \Log::warning('Login Failed:', ['email' => $request->email]);
        
            // If login fails, redirect back with an error message
            return back()->withErrors(['loginError' => 'Invalid login credentials.']);
        }
        

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'Successfully logged out.');
    }

    
}
