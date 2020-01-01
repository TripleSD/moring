<?php

namespace App\Http\Controllers;

class LocalizationController extends Controller
{
    public function index($locale)
    {
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
