<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerCredentials
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('SESSION_API_BEARER_TOKEN')) {
            $userRole = $request->session()->get('SESSION_USER_ROLE');

            // Check if the user has the "manager" role
            if ($userRole === 'superadmin') {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
