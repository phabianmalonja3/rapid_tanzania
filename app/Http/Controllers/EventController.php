<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str; // Import Str facade
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Needed for transactions
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Needed for image deletion/storage
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Http\Response as IlluminateHttpResponse; // For abort
use Illuminate\Routing\Redirector; // For redirect (optional, but good practice)

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);

        $seoData = new SEOData(
            title: 'Latest Events | Rapid Tanzania',
            description: 'Stay updated with the latest news, projects, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania', 
        );

        return view('pages.events.index', compact('events', 'seoData')); 
    }

   
    public function create()
    {
        $seoData = new SEOData(
            title: 'Create Event | Rapid Tanzania',
            description: 'Use this form to create a new event record for RAPID Tanzania.',
            robots: 'noindex, nofollow', // Prevent indexing of the form page
        );
        
        return view('pages.events.form', compact('seoData')); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // IMPROVEMENT: Use the model's dynamic method for SEO data
        $seoData = $event->getDynamicSEOData();

      
        return view('pages.events.show', compact('event', 'seoData')); 
    }


    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            "images.*" => ["required", "mimes:jpeg,png,jpg,gif,svg|max:2048"],
            'end_date' => ['required', 'date', 'after:start_at'], 
        ]);
            
        $validatedData['auth_id'] = Auth::id();
        $uploadFiles = [];
        $latestImageForSEO = null;

        // 2. Handle File Uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filePath = $image->store('events/images', 'public');
                $uploadFiles[] = $filePath;
            }
            $validatedData['images'] = $uploadFiles;
            $latestImageForSEO = end($uploadFiles); // Get the last uploaded image
        } else {
             // This branch should be impossible if "images.*" is 'required' in validation, 
             // but we keep it for robustness if logic changes.
             return redirect()->back()->with('error', 'Image files are required for a new event.')->withInput();
        }

        // dd($validatedData['images']);

        try
{

        $validatedData['slug']=Str::slug($validatedData['name']);
      
                // 3. Create the Event
                $event = Event::create($validatedData);

                // 4. CREATE SEO DATA (CRITICAL IMPROVEMENT)
                $descriptionExcerpt = Str::limit(strip_tags($validatedData['description']), 160, '...');
                $fullImageURL = $latestImageForSEO ? asset('storage/' . $latestImageForSEO) : null;
                
                $event->seo()->create([
                    'title' => $validatedData['name'],
                    'description' => $descriptionExcerpt,
                    'image' => $fullImageURL,
                    'author' => $event->user->name ?? 'Unknown Author', 
                ]);
            



            // 5. Success response
            return redirect()->route('events.index')
                ->with('success', 'Event created successfully!');

        } catch (\Throwable $th) {
         
            if (!empty($uploadFiles)) {
                foreach ($uploadFiles as $filePath) {
                    Storage::disk('public')->delete($filePath);
                }
            }
            \Illuminate\Support\Facades\Log::error("Event creation failed: " . $th->getMessage());
            return redirect()->back()->with('error', 'Failed to create event.')->withInput();
        }
    }


    public function edit(Event $event)
    {
        
        if (Auth::id() !== $event->auth_id) {
            abort(IlluminateHttpResponse::HTTP_FORBIDDEN, 'Unauthorized action.');
        }

        // IMPROVEMENT: Use the model's dynamic method for SEO data
        $seoData = $event->getDynamicSEOData(); 

        return view('pages.events.form', compact('event', 'seoData'));
    }
 
    public function update(Request $request, Event $event)
    {
        // Authorization check (should be at the top)
        // if (Auth::id() !== $event->auth_id) {
        //     abort(IlluminateHttpResponse::HTTP_FORBIDDEN, 'Unauthorized action.');
        // }

        // 1. Validation
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            "images.*" => ["nullable", "mimes:jpeg,png,jpg,gif,svg|max:2048"],
            'end_date' => ['required', 'date', 'after:start_at'] 
        ]);

        $uploadFiles = [];
        $existImages = $event->images ?? [];
        $latestImageForSEO = null;

        // 2. Image Handling
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filePath = $image->store('events/images', 'public');
                $uploadFiles[] = $filePath;
            }

            $validatedData['images'] = array_merge($existImages, $uploadFiles);
            $latestImageForSEO = end($uploadFiles); // Newest image for SEO
        } else {
            // If no new files, check existing array for the image path to keep in SEO
            if (!empty($existImages)) {
                 $latestImageForSEO = end($existImages);
            }
        }
         $validatedData['slug']=Str::slug($validatedData['name']);

        // 3. Update the Event
        $event->update($validatedData);

        // 4. Prepare and Update SEO data
        $descriptionExcerpt = Str::limit(strip_tags($validatedData['description']), 160, '...');
        $fullImageURL = $latestImageForSEO ? asset('storage/' . $latestImageForSEO) : null;
        
        $event->seo()->update([
            // Note: Using $validatedData['name'] instead of $request->name for safety/consistency
            "title" => $validatedData['name'], 
            "description" => $descriptionExcerpt,
            "author" => $event->user->name ?? 'Unknown Author',
            "image" => $fullImageURL,
        ]);
        
        return redirect()->route('events.show', $event->slug)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Authorization
        if (Auth::id() !== $event->auth_id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete all associated image files from storage (assuming 'images' stores paths)
        if (!empty($event->images)) {
            foreach ($event->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}