<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!in_array(auth()->user()?->role, $roles)) {
            return response()->json(['error' => 'Acesso não autorizado.'], 403);
        }

        return $next($request);
    }
}
