<?php

// app/Http/Middleware/IsAdmin.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\UserRole;


class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === UserRole::Admin ) {
            return $next($request);
        }
        abort(403, 'Accès réservé à l\'administration ');
    }
}
