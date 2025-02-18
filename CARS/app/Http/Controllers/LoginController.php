<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index()
    {
        return view('logins.index');
    }
    public function create()
    {
        return view('logins.create');
    }
    
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
        ]);

        // Redirect to the login page with a success message
        return redirect()->route('logins.index')->with('success', 'Account created successfully! Please log in.');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if (Auth::attempt($credentials)) {
            if (Auth::user()->admin) {
                return redirect()->route('admins.index')->with('success', 'Logged in successfully.');
            }
            else
                return redirect()->route('customers.index')->with('success', 'Logged in successfully.');
            
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // dd('Logout function called');  // Check if this is printed
        Auth::logout();
        return redirect()->route('logins.login')->with('success', 'Logged out successfully.');
    }

}
