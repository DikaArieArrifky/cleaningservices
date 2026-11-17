<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = ServiceCategory::active()->ordered()->with(['services' => function ($q) {
            $q->active()->ordered();
        }])->get();

        $featuredServices = Service::active()
            ->featured()
            ->with('category')
            ->ordered()
            ->take(6)
            ->get();

        $testimonials = Testimonial::published()
            ->ordered()
            ->take(6)
            ->get();

        $galleries = Gallery::featured()
            ->ordered()
            ->take(8)
            ->get();

        $siteSettings = [
            'hero_title' => SiteSetting::get('hero_title', 'Kilau Sempurna untuk Mobil Anda, Kebersihan Menyeluruh untuk Rumah Anda'),
            'hero_subtitle' => SiteSetting::get('hero_subtitle', 'Layanan perawatan kendaraan dan pembersihan hunian berstandar premium dengan staf profesional, peralatan modern, dan jaminan kepuasan 100%.'),
            'whatsapp_number' => SiteSetting::get('whatsapp_number', '081234567890'),
            'operating_hours' => SiteSetting::get('operating_hours', 'Senin - Minggu: 08:00 - 18:00 WIB'),
        ];

        return view('pages.home', compact('categories', 'featuredServices', 'testimonials', 'galleries', 'siteSettings'));
    }
}
