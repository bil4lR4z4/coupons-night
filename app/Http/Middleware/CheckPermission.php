<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $permission)
    {
        $user = auth()->user();

        // agar login nahi
        if (!$user) {
            return redirect()->route('login');
        }

        // Admin ko full access
        if ($user->role === 'admin') {
            return $next($request);
        }

        // permission table check
        if ($user->permission && $user->permission->$permission == 1) {
            return $next($request);
        }

        // agar permission nahi
        abort(403, 'Unauthorized Access');
    }

}
