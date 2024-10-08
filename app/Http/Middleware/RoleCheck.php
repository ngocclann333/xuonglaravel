<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // Nhận tham số từ route để xác định vai trò
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();


        if (!$user) {
            return redirect('/login')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
        }


        switch ($role) {
            case 'admin':
                if ($user->role !== 'admin') {
                    return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
                }
                break;

            case 'staff':
                if ($user->role !== 'admin' && $user->role !== 'staff') {
                    return redirect('/')->with('error', 'Chỉ nhân viên hoặc admin mới có quyền truy cập.');
                }
                break;

            default:
                return redirect('/')->with('error', 'Không thể xác định vai trò của bạn.');
        }

        return $next($request);
    }
}
