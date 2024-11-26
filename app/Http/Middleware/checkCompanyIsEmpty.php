<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkCompanyIsEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = \Auth::guard('admin')->user();

        if (!$request->is('api/*') && (!$request->is('company/*') && (!$user->company))) {
            return redirect()->route('company.profileEdit', ['slug' => $user->id])
                ->with('status_fail', __('message.update_info'))
                ->with('status_success', session('status_success'));
        }

        return $next($request);
    }

}
