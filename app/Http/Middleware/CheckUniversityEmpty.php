<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUniversityEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('admin')->user();

        if ($user->role == ROLE_SUB_UNIVERSITY) {
            return $next($request);
        }

        if (!$user->university) {
            if (
                $request->route()->getName() === 'university.profile' ||
                in_array($request->method(), ['POST', 'PUT', 'PATCH'])
            ) {
                return $next($request);
            }
            return redirect()->route('university.register', ['id' => $user->id])
                ->with('status_fail', __('message.update_info'))
                ->with('status_success', session('status_success'));
        }

        return $next($request);
    }
}
