<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role, $roles)) {
            // Se a requisição for para API ou JSON
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['error' => 'Acesso não autorizado.'], 403);
            }

            // Caso contrário, redireciona com mensagem flash (Inertia)
            return redirect()->route('dashboard')->with('error', 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
