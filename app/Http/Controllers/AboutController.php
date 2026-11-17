<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $siteName = SiteSetting::get('site_name', 'Jasmine Services');

        return view('pages.about', compact('siteName'));
    }
}
