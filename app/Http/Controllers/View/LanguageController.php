<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change(string $language)
    {
        if ($language == 'vi' || $language == 'en') {
            Session::put('language', $language);
        }
    }
}
