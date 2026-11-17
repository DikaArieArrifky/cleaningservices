<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $fields = [
            'site_name' => 'general',
            'site_tagline' => 'general',
            'whatsapp_number' => 'contact',
            'phone_number' => 'contact',
            'email_address' => 'contact',
            'office_address' => 'contact',
            'operating_hours' => 'general',
            'instagram_url' => 'social',
            'facebook_url' => 'social',
            'google_maps_embed' => 'contact',
            'hero_title' => 'homepage',
            'hero_subtitle' => 'homepage',
        ];

        foreach ($fields as $key => $group) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key), $group);
            }
        }

        SiteSetting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}
