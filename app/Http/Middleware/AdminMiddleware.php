<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario no está logueado o no es admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
