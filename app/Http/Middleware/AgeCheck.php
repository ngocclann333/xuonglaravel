<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AgeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $age = $request->query('age'); // Lấy tuổi từ query string

        if (is_null($age) || !is_numeric($age) || $age < 18) {
            session()->flash('error', 'Bạn cân cần đủ 18 tuổi để truy cập trang
                    ');

            return redirect('/');
        }

        return $next($request); // Tiếp tục nếu đủ tuổi

    }
}
