<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function index(Request $request)
    {

        // dd(Auth::guard('admin')->check());

        // Check if admin is already authenticated
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Attempt to authenticate with admin guard
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to admin dashboard after successful login
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

       return redirect('/admin/login');
    }
}
