<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function index(): View
    {
        $contact = [
            'whatsapp' => SiteSetting::get('whatsapp_number', '081234567890'),
            'phone' => SiteSetting::get('phone_number', '+62 812-3456-7890'),
            'email' => SiteSetting::get('email_address', 'halo@jasmineservices.id'),
            'address' => SiteSetting::get('office_address', 'Jl. Boulevard Raya No. 45, Kebayoran Baru, Jakarta Selatan, DKI Jakarta 12150'),
            'hours' => SiteSetting::get('operating_hours', 'Senin - Minggu: 08:00 - 18:00 WIB'),
            'maps' => SiteSetting::get('google_maps_embed', ''),
            'instagram' => SiteSetting::get('instagram_url', '#'),
            'facebook' => SiteSetting::get('facebook_url', '#'),
        ];

        return view('pages.contact', compact('contact'));
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact')
            ->with('success', 'Pesan Anda telah berhasil terkirim! Tim Jasmine Services akan segera menghubungi Anda.');
    }
}
