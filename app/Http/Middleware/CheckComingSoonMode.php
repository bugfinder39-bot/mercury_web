<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckComingSoonMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Fetch coming soon mode setting
        $comingSoonEnabled = Setting::where('key', 'coming_soon_enabled')->value('value');

        // If Coming Soon Mode is OFF or not set, continue request
        if (! in_array($comingSoonEnabled, ['true', '1', 1, true], true)) {
            return $next($request);
        }

        // Exempt routes that must stay operational (Admin, Login, Dashboard, CMS, Assets, etc.)
        if (
            $request->is('admin*') ||
            $request->is('login*') ||
            $request->is('logout*') ||
            $request->is('register*') ||
            $request->is('password*') ||
            $request->is('dashboard*') ||
            $request->is('coming-soon*') ||
            $request->is('up') ||
            $request->is('api*') ||
            $request->is('_inertia*') ||
            $request->is('sanctum*')
        ) {
            return $next($request);
        }

        // Target page check
        $target = Setting::where('key', 'coming_soon_target')->value('value') ?: 'entire_website';

        $shouldRedirect = false;
        if ($target === 'entire_website') {
            $shouldRedirect = true;
        } elseif ($target === 'home_only' && ($request->path() === '/' || $request->is('/'))) {
            $shouldRedirect = true;
        } elseif ($target === 'services_only' && $request->is('services*')) {
            $shouldRedirect = true;
        } elseif ($target === 'about_only' && $request->is('about*')) {
            $shouldRedirect = true;
        } elseif ($target === 'contact_only' && $request->is('contact*')) {
            $shouldRedirect = true;
        }

        if ($shouldRedirect) {
            return redirect()->route('coming-soon');
        }

        return $next($request);
    }
}
