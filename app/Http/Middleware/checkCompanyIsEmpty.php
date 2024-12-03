<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::guard('admin')->user();

        // Nếu user không có thông tin company
        if (!$user->company) {
            // Cho phép tiếp tục nếu đang ở route chỉnh sửa hoặc nếu là yêu cầu POST/PUT/PATCH
            if (
                $request->route()->getName() === 'company.profileEdit' ||
                in_array($request->method(), ['POST', 'PUT', 'PATCH'])
            ) {
                return $next($request);
            }

            // Chuyển hướng đến trang chỉnh sửa
            return redirect()->route('company.profileEdit', ['slug' => $user->id])
                ->with('status_fail', __('message.update_info'))
                ->with('status_success', session('status_success'));
        }

        // Nếu user đã có thông tin company, cho phép tiếp tục
        return $next($request);
    }





}
