<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class MediaController extends Controller
{

public function index() { 
    $seoData = new SEOData( title: 'Videos', description: 'Browse and manage videos.',);
    
     $videos = Video::latest()->paginate(10); return view('videos.index', compact('seoData', 'videos')); 
     }



public function lastest()
{
    $seoData = new SEOData(
        title: 'Videos',
        description: 'Browse and manage videos.',
    );

    $videos = Video::latest()->take(2)->get();

    return view('videos', compact('seoData', 'videos'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seoData = new SEOData(
            title: 'Add Video',
            description: 'Add a new video to the media library.',
        );

        return view('videos.create', compact('seoData'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'video' => 'required|file|mimes:mp4,mov,avi,webm|max:102400',
    ]);

    $file = $request->file('video');

    $filename = time() . '_' . $file->getClientOriginalName();

    Storage::disk('public')->put(
        'videos/' . $filename,
        file_get_contents($file)
    );

    Video::create([
        'url' => '/storage/videos/' . $filename,
    ]);

    return redirect()
        ->route('videos.index')
        ->with('success', 'Video uploaded successfully.');
}

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    $video = Video::findOrFail($id);

    $seoData = new SEOData(
        title: $video->title,
        description: 'View video details.',
    );

    return view('videos.show', compact('video', 'seoData'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $seoData = new SEOData(
            title: 'Edit Video',
            description: 'Edit video information.',
        );

        return view('videos.edit', compact('seoData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

public function destroy(string $id)
{
    $video = Video::findOrFail($id);

    // Delete thumbnail from storage
    if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
        Storage::disk('public')->delete($video->thumbnail);
    }

    // Delete video record
    $video->delete();

    return redirect()
        ->route('videos.index')
        ->with('success', 'Video deleted successfully.');
}


}