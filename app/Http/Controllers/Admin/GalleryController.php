<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::with('category')->latest()->paginate(16);
        $categories = ServiceCategory::ordered()->get();

        return view('admin.galleries.index', compact('galleries', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'service_category_id' => ['nullable', 'exists:service_categories,id'],
            'category_tag' => ['nullable', 'string', 'max:50'],
            'caption' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $disk = config('filesystems.upload_disk', 'public');
        $image = null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('galleries', $disk);
            $image = Storage::disk($disk)->url($path);
        } elseif ($request->filled('image_url')) {
            $image = $request->input('image_url');
        }

        if (! $image) {
            return back()->withErrors(['image_file' => 'Unggah file foto atau masukkan tautan URL gambar.'])->withInput();
        }

        Gallery::create([
            'title' => $request->input('title'),
            'service_category_id' => $request->input('service_category_id'),
            'category_tag' => $request->input('category_tag') ?: 'Service',
            'caption' => $request->input('caption'),
            'image' => $image,
            'is_featured' => $request->boolean('is_featured', true),
        ]);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri baru berhasil ditambahkan!');
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'service_category_id' => ['nullable', 'exists:service_categories,id'],
            'category_tag' => ['nullable', 'string', 'max:50'],
            'caption' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $data = [
            'title' => $request->input('title'),
            'service_category_id' => $request->input('service_category_id'),
            'category_tag' => $request->input('category_tag') ?: 'Service',
            'caption' => $request->input('caption'),
            'is_featured' => $request->boolean('is_featured'),
        ];

        $disk = config('filesystems.upload_disk', 'public');

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('galleries', $disk);
            $data['image'] = Storage::disk($disk)->url($path);
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', "Galeri '{$gallery->title}' berhasil diperbarui!");
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri telah dihapus.');
    }
}
