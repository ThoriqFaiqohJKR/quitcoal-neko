<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cmslogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        
        if (!session()->has('account_id')) {
            return redirect('/pltu/login');
        }

        if ($role && session('account_role') !== $role) {
            abort(403);
        }

        return $next($request);
    }
}