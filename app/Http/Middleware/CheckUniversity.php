<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUniversity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check() && (Auth::guard('admin')->user()->role === ROLE_UNIVERSITY || Auth::guard('admin')->user()->role === ROLE_SUB_UNIVERSITY)) {
            return $next($request);
        } else {
            return redirect()->route('management.login');
        }
    }
}
