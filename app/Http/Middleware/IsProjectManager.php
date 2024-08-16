<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsProjectManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $position = Auth()->user()->position->position_name;
        $role = Auth()->user()->user_role;

        if (Auth::check()) { // check if user is authenticated
            if ($position === 'Project Manager' && $role === 'Leader') { // check if user has 'Project Manager' position and 'Leader' role
                return $next($request);
            }
        }
        return response()->json([ // if above condition(s) are not met
            'status' => 'error',
            'message' => 'Forbidden'
        ], 403);
    }
}
