<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', Booking::STATUS_PENDING)->count(),
            'confirmed_bookings' => Booking::where('status', Booking::STATUS_CONFIRMED)->count(),
            'completed_bookings' => Booking::where('status', Booking::STATUS_COMPLETED)->count(),
            'total_services' => Service::count(),
            'total_galleries' => Gallery::count(),
            'total_testimonials' => Testimonial::count(),
            'unread_messages' => ContactMessage::unread()->count(),
            'total_revenue' => Booking::where('status', Booking::STATUS_COMPLETED)->sum('total_price'),
        ];

        $recentBookings = Booking::with(['category', 'service'])
            ->latest()
            ->take(6)
            ->get();

        $unreadMessages = ContactMessage::unread()
            ->latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'unreadMessages'));
    }
}
