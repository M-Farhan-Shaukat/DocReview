<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Debug logging
            \Log::info('User login attempt', [
                'email' => $user->email,
                'role_id' => $user->role_id,
                'hasRole_User' => $user->hasRole('User'),
            ]);

            // Check if user has ANY role
            if (!$user->role) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Account not properly configured. Please contact administrator.',
                ]);
            }
            // Redirect based on role
            if ($user->hasRole('Admin') || $user->hasRole('Manager') || $user->hasRole('Staff')) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have permission to access the User panel.',
                ]);
            }

            if ($user->hasRole('User')) {
                return redirect()->route('user.dashboard');
            }

            // Fallback
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign "User" role by default
        $userRole = Role::where('name', 'User')->first();
        if ($userRole) {
            $user->role_id = $userRole->id;
            $user->save();
        } else {
            \Log::error('User role not found during registration');
        }

        // Auto login after registration
        Auth::login($user);

        return redirect()->route('user.dashboard')
            ->with('success', 'Account created successfully!');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
