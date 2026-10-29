<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class AdminGalleryController extends Controller
{
   /**
     * Generate SEO metadata for admin pages.
     */
    private function makeSeoData(
        string $title,
        string $description
    ): SEOData {
        return new SEOData(
            title: $title,
            description: $description,
            robots: 'noindex, nofollow',
        );
    }

    /**
     * Display all gallery activities.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(15);

        $seoData = $this->makeSeoData(
            'Gallery Management | Admin',
            'Manage gallery activities, images, and community stories.'
        );

        return view(
            'admin.gallery.index',
            compact('galleries', 'seoData')
        );
    }

    /**
     * Show the create gallery form.
     */
    public function create()
    {
        $gallery = new Gallery();

        $seoData = $this->makeSeoData(
            'Add Gallery Activity | Admin',
            'Add a new gallery activity, image, and description.'
        );

        return view(
            'admin.gallery.create',
            compact('gallery', 'seoData')
        );
    }

    /**
     * Store a new gallery activity.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'activity_date' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $validated['image'] = $request->file('image')
            ->store('gallery', 'public');

        Gallery::create($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery activity created successfully.');
    }

    /**
     * Show the edit gallery form.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $seoData = $this->makeSeoData(
            'Edit ' . $gallery->title . ' | Admin Gallery',
            'Update gallery activity details and images.'
        );

        return view(
            'admin.gallery.edit',
            compact('gallery', 'seoData')
        );
    }

    /**
     * Update an existing gallery activity.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'activity_date' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('gallery', 'public');

            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $validated['image'] = $newImage;
        }

        $gallery->update($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery activity updated successfully.');
    }

    /**
     * Delete a gallery activity and its image.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery activity deleted successfully.');
    }
}