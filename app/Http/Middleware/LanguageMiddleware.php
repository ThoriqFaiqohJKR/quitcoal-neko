<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;
class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = in_array($request->segment(1), ['id', 'en'])
            ? $request->segment(1)
            : 'en';

        app()->setLocale($locale);
        URL::defaults(compact('locale'));

        return $next($request);
    }


}
