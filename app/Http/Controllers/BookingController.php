<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Show the interactive booking form.
     */
    public function create(Request $request): View
    {
        $categories = ServiceCategory::active()->ordered()->with(['services' => function ($q) {
            $q->active()->ordered();
        }])->get();

        $selectedCategorySlug = $request->query('category');
        $selectedServiceId = $request->query('service');

        $selectedCategory = $categories->firstWhere('slug', $selectedCategorySlug) ?? $categories->first();

        return view('pages.booking', compact('categories', 'selectedCategory', 'selectedServiceId'));
    }

    /**
     * Store a newly created booking in database.
     */
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Generate unique booking code: JAS-YYYYMMDD-XXXX
        $datePrefix = date('Ymd');
        $randomPart = strtoupper(Str::random(4));
        $bookingCode = "JAS-{$datePrefix}-{$randomPart}";

        // Ensure uniqueness
        while (Booking::where('booking_code', $bookingCode)->exists()) {
            $randomPart = strtoupper(Str::random(4));
            $bookingCode = "JAS-{$datePrefix}-{$randomPart}";
        }

        // Calculate price if service selected
        $totalPrice = null;
        if (! empty($validated['service_id'])) {
            $service = Service::find($validated['service_id']);
            $totalPrice = $service?->price;
        }

        // Build metadata based on category
        $metadata = [];
        if (! empty($validated['vehicle_type'])) {
            $metadata['vehicle_type'] = $validated['vehicle_type'];
        }
        if (! empty($validated['vehicle_model'])) {
            $metadata['vehicle_model'] = $validated['vehicle_model'];
        }
        if (! empty($validated['service_location'])) {
            $metadata['service_location'] = $validated['service_location'];
        }
        if (! empty($validated['property_type'])) {
            $metadata['property_type'] = $validated['property_type'];
        }
        if (! empty($validated['cleaning_focus'])) {
            $metadata['cleaning_focus'] = $validated['cleaning_focus'];
        }

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'service_category_id' => $validated['service_category_id'],
            'service_id' => $validated['service_id'] ?? null,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'service_date' => $validated['service_date'],
            'service_time' => $validated['service_time'],
            'service_address' => $validated['service_address'],
            'notes' => $validated['notes'] ?? null,
            'metadata' => $metadata,
            'total_price' => $totalPrice,
            'status' => Booking::STATUS_PENDING,
        ]);

        return redirect()->route('booking.confirmation', ['booking' => $booking->booking_code])
            ->with('success', 'Pemesanan Anda berhasil dibuat! Silakan lanjutkan konfirmasi melalui WhatsApp.');
    }

    /**
     * Show booking confirmation details with WhatsApp continue button.
     */
    public function confirmation(string $bookingCode): View
    {
        $booking = Booking::with(['category', 'service'])
            ->where('booking_code', $bookingCode)
            ->firstOrFail();

        $adminPhone = SiteSetting::get('whatsapp_number', '081234567890');
        $whatsAppUrl = $booking->getWhatsAppUrl($adminPhone);

        return view('pages.booking-confirmation', compact('booking', 'whatsAppUrl', 'adminPhone'));
    }

    /**
     * Show lookup / tracking page.
     */
    public function track(Request $request): View
    {
        $query = $request->query('q');
        $booking = null;

        if ($query) {
            $cleaned = trim($query);
            $booking = Booking::with(['category', 'service'])
                ->where('booking_code', $cleaned)
                ->orWhere('customer_phone', $cleaned)
                ->latest()
                ->first();
        }

        return view('pages.booking-track', compact('booking', 'query'));
    }

    /**
     * API: Get services for a specific category ID.
     */
    public function getServicesByCategory(int $categoryId): JsonResponse
    {
        $services = Service::where('service_category_id', $categoryId)
            ->active()
            ->ordered()
            ->get(['id', 'name', 'price', 'duration_minutes', 'badge', 'summary']);

        return response()->json($services);
    }
}
