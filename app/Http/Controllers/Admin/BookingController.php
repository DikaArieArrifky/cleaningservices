<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ServiceCategory::ordered()->get();
        $statusOptions = Booking::statusOptions();

        $query = Booking::with(['category', 'service'])->latest();

        // Search by booking code, customer name, phone, or email
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($catId = $request->query('category_id')) {
            $query->where('service_category_id', $catId);
        }

        // Filter by status
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $bookings = $query->paginate(15)->withQueryString();

        return view('admin.bookings.index', compact('bookings', 'categories', 'statusOptions'));
    }

    public function show(Booking $booking): View
    {
        $booking->load(['category', 'service']);
        $statusOptions = Booking::statusOptions();

        return view('admin.bookings.show', compact('booking', 'statusOptions'));
    }

    public function updateStatus(Request $request, Booking $booking): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:'.implode(',', array_keys(Booking::statusOptions()))],
        ]);

        $booking->update([
            'status' => $request->input('status'),
        ]);

        return back()->with('success', "Status booking #{$booking->booking_code} berhasil diperbarui.");
    }

    public function update(UpdateBookingRequest $request, Booking $booking): RedirectResponse
    {
        $booking->update($request->validated());

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', "Data booking #{$booking->booking_code} berhasil diperbarui.");
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $code = $booking->booking_code;
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', "Booking #{$code} berhasil dihapus dari sistem.");
    }
}
