<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenanceMode = \App\Models\Setting::where('key', 'maintenance_mode')->value('value');

        if ($maintenanceMode === '1') {
            // Cho phép các route nội bộ của admin (backend)
            if ($request->is('quan-tri*') || $request->is('dang-nhap') || $request->is('dang-xuat') || $request->routeIs('login') || $request->routeIs('logout')) {
                return $next($request);
            }
            
            // Cho phép người có vai trò admin/staff truy cập
            if ($request->user() && ($request->user()->hasRole('admin') || $request->user()->hasRole('staff'))) {
                return $next($request);
            }

            // Trả về trang bảo trì với HTTP status 503
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}
