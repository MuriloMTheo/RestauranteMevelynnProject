<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Prefer explicit is_admin flag if present, otherwise fallback to email check
        if (isset($user->is_admin) && $user->is_admin) {
            return $next($request);
        }

        if ($user->email === 'admin@hotmail.com') {
            return $next($request);
        }

        abort(403, 'Acesso negado');
    }
}
