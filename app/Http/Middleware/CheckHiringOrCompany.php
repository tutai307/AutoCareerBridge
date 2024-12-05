<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckHiringOrCompany
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        if ($user && $user->role == ROLE_HIRING) { 
            return $next($request);
        }

        if ($user && $user->role == ROLE_COMPANY && !$user->company) {
            return redirect()->route('company.profileEdit', ['slug' => $user->id])
                ->with('status_fail', 'Vui lòng cập nhật thông tin công ty trước khi tiếp tục.');
        }
        if ($user && $user->role == ROLE_COMPANY && $user->company) {
            return $next($request);
        }
        return redirect()->route('management.login');
    }
}
