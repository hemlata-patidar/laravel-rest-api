<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->roles()->where('slug', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
