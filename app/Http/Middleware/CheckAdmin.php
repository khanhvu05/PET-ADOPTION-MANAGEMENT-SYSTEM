<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->hasAnyRole(['admin', 'staff'])) {
            return $next($request);
        }

        // Redirect normal users away from admin pages
        return redirect()->route('frontend.adoptions.index')->with('error', 'Bạn không có quyền truy cập trang này.');
    }
}
