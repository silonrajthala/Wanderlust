<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     * REMOVED - We use modal popups instead of separate login page
     */
    // public function create(): View
    // {
    //     return view('auth.login');
    // }

    /**
     * Handle an incoming authentication request (for modal login).
     */
   public function store(LoginRequest $request): JsonResponse|RedirectResponse
{
    try {
        $request->authenticate();
        $request->session()->regenerate();

        // Force JSON response for modal forms
        return response()->json([
            'message' => 'Login successful',
            'redirect' => route('home')
        ]);

    } catch (AuthenticationException $exception) {
        // Force JSON response for errors too
        return response()->json([
            'message' => 'The provided credentials are incorrect.',
            'errors' => [
                'email' => ['These credentials do not match our records.']
            ]
        ], 422);
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
