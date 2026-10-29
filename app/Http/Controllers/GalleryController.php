<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class GalleryController extends Controller
{
    /**
     * Display all gallery activities.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);

        $seoData = new SEOData(
            title: 'Our Gallery | RAPID Tanzania',
            description: 'Explore photos and stories of RAPID Tanzania activities, including disaster risk reduction, humanitarian response, community outreach, and volunteer initiatives.',
            robots: 'index, follow',
        );

        return view('gallery.view', compact('galleries', 'seoData'));
    }

    /**
     * Show the form for creating a gallery activity.
     */
    public function create()
    {
        
        $seoData = new SEOData(
            title: 'Our Gallery | RAPID Tanzania',
            description: 'Explore photos and stories of RAPID Tanzania activities, including disaster risk reduction, humanitarian response, community outreach, and volunteer initiatives.',
            robots: 'index, follow',
        );
        $gallery = new Gallery();

        return view('gallery.create', compact('gallery',"seoData"));
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
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $validated['image'] = $request->file('image')
            ->store('gallery', 'public');

        Gallery::create($validated);

        return redirect()
            ->route('gallery')
            ->with('success', 'Gallery activity created successfully.');
    }

    /**
     * Display a single gallery activity.
     */
    public function show(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $seoData = new SEOData(
            title: $gallery->title . ' | RAPID Tanzania',
            description: Str::limit(strip_tags($gallery->description), 155),
            robots: 'index, follow',
        );

        return view('gallery.show', compact('gallery', 'seoData'));
    }

    /**
     * Show the form for editing a gallery activity.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('gallery.edit', compact('gallery'));
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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
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
            ->route('gallery')
            ->with('success', 'Gallery activity updated successfully.');
    }

    /**
     * Delete a gallery activity.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->route('gallery')
            ->with('success', 'Gallery activity deleted successfully.');
    }
}
