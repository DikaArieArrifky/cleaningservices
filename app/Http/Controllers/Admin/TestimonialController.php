<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::with('category')->latest()->paginate(15);
        $categories = ServiceCategory::ordered()->get();

        return view('admin.testimonials.index', compact('testimonials', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'client_name' => ['required', 'string', 'max:100'],
            'client_title' => ['nullable', 'string', 'max:100'],
            'service_name' => ['nullable', 'string', 'max:100'],
            'service_category_id' => ['nullable', 'exists:service_categories,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'min:10', 'max:2000'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'avatar_url' => ['nullable', 'url', 'max:500'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $avatar = null;
        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('avatars', 'public');
            $avatar = Storage::url($path);
        } elseif ($request->filled('avatar_url')) {
            $avatar = $request->input('avatar_url');
        }

        Testimonial::create([
            'client_name' => $request->input('client_name'),
            'client_title' => $request->input('client_title'),
            'service_name' => $request->input('service_name'),
            'service_category_id' => $request->input('service_category_id'),
            'rating' => $request->input('rating'),
            'content' => $request->input('content'),
            'avatar' => $avatar,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni baru berhasil ditambahkan!');
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $request->validate([
            'client_name' => ['required', 'string', 'max:100'],
            'client_title' => ['nullable', 'string', 'max:100'],
            'service_name' => ['nullable', 'string', 'max:100'],
            'service_category_id' => ['nullable', 'exists:service_categories,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'min:10', 'max:2000'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'avatar_url' => ['nullable', 'url', 'max:500'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data = [
            'client_name' => $request->input('client_name'),
            'client_title' => $request->input('client_title'),
            'service_name' => $request->input('service_name'),
            'service_category_id' => $request->input('service_category_id'),
            'rating' => $request->input('rating'),
            'content' => $request->input('content'),
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('avatars', 'public');
            $data['avatar'] = Storage::url($path);
        } elseif ($request->filled('avatar_url')) {
            $data['avatar'] = $request->input('avatar_url');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimoni dari '{$testimonial->client_name}' berhasil diperbarui!");
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $name = $testimonial->client_name;
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimoni dari '{$name}' telah dihapus.");
    }

    public function togglePublish(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_published' => ! $testimonial->is_published]);

        $status = $testimonial->is_published ? 'dipublikasikan' : 'disembunyikan';

        return back()->with('success', "Status testimoni berhasil diubah menjadi {$status}.");
    }
}
