<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            $path = $request->path();

            // **SIMPLER FIX: Just check the URL path**
            // If it's an admin route (starts with admin/) but not login page
            if (str_starts_with($path, 'admin/') && $path !== 'admin/login') {
                return route('admin.login');
            }

            // For all other routes (user routes), redirect to home
            return '/';
        }

        return null;
    }
}
