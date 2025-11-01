<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Avval session'ni yaratishga harakat qilamiz
        $sessionLocale = $request->session()->get('locale');
        
        // Agar session'da locale bo'lmasa yoki null bo'lsa, default locale'ni o'rnatamiz
        if (!$sessionLocale || !in_array($sessionLocale, ['uz', 'en', 'ru'])) {
            $locale = 'uz';
            $request->session()->put('locale', $locale);
        } else {
            $locale = $sessionLocale;
        }
        
        // Laravel locale'ni o'rnatamiz
        App::setLocale($locale);
        
        // Debug uchun (keyinroq o'chirish mumkin)
        // \Log::info('SetLocale middleware: locale set to ' . $locale);

        return $next($request);
    }
}
