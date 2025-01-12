<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\DashboardController;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            return redirect('/')->with('warning', 'Anda tiada akses ke halaman ini.');
        }

        return $next($request);
    }
}
