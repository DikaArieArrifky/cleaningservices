<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $categories = ServiceCategory::ordered()->get();

        $query = Service::with('category')->latest();

        if ($catId = $request->query('category_id')) {
            $query->where('service_category_id', $catId);
        }

        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $services = $query->paginate(12)->withQueryString();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create(): View
    {
        $categories = ServiceCategory::active()->ordered()->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Process features (newline-separated or array)
        if (isset($data['features']) && is_string($data['features'])) {
            $lines = array_filter(array_map('trim', explode("\n", $data['features'])));
            $data['features'] = array_values($lines);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = Storage::url($path);
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    public function edit(Service $service): View
    {
        $categories = ServiceCategory::active()->ordered()->get();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if (isset($data['features']) && is_string($data['features'])) {
            $lines = array_filter(array_map('trim', explode("\n", $data['features'])));
            $data['features'] = array_values($lines);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = Storage::url($path);
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', "Layanan '{$service->name}' berhasil diperbarui!");
    }

    public function destroy(Service $service): RedirectResponse
    {
        $name = $service->name;
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', "Layanan '{$name}' telah dihapus.");
    }

    public function toggleActive(Service $service): RedirectResponse
    {
        $service->update(['is_active' => ! $service->is_active]);

        $status = $service->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Layanan '{$service->name}' berhasil {$status}.");
    }
}
