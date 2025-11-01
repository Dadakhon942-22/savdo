<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function switch($locale)
    {
        if (!in_array($locale, ['uz', 'en', 'ru'])) {
            abort(404);
        }

        // Session'ga locale'ni saqlash
        session(['locale' => $locale]);
        
        // Laravel locale'ni darhol o'rnatish
        App::setLocale($locale);

        return redirect()->back();
    }
}
