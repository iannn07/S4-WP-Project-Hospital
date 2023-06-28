<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)
     */
    public function handle(Request $request, Closure $next, $userRole): Response
    {
        if (auth()->user()->role == $userRole) {
            return $next($request);
        }
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            session()->flash("error", "You ain't our employee");
            return redirect('/login');
        }
    }
}
