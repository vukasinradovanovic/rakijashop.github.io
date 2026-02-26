<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromUrl
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if ($locale === 'rs') {
            $segments = $request->segments();
            $segments[0] = 'sr';
            $query = $request->getQueryString();
            $targetUrl = '/' . implode('/', $segments) . ($query ? ('?' . $query) : '');

            return redirect($targetUrl, 301);
        }

        $supportedLocales = ['en', 'sr'];

        if (!in_array($locale, $supportedLocales, true)) {
            abort(404);
        }

        App::setLocale($locale);
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
