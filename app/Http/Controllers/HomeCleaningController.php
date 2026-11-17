<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\ServiceCategory;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeCleaningController extends Controller
{
    public function index(): View
    {
        $category = ServiceCategory::where('slug', 'home-cleaning')
            ->with(['services' => function ($query) {
                $query->active()->ordered();
            }])
            ->firstOrFail();

        $galleries = Gallery::where('service_category_id', $category->id)
            ->orWhere('category_tag', 'like', '%home%')
            ->orWhere('category_tag', 'like', '%kitchen%')
            ->orWhere('category_tag', 'like', '%bathroom%')
            ->ordered()
            ->take(6)
            ->get();

        $testimonials = Testimonial::published()
            ->where('service_category_id', $category->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('pages.home-cleaning', compact('category', 'galleries', 'testimonials'));
    }
}
