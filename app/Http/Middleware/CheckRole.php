<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role->name ?? null;

        if (!in_array($userRole, $roles)) {
            abort(403, 'Нет доступа');
        }

        return $next($request);
    }
}