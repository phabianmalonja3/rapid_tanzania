<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateHttpResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        
        $seoData = new SEOData(
            title: 'Our Projects | RAPID Tanzania',
            description: 'Explore the current and past disaster risk reduction and humanitarian projects conducted by RAPID Tanzania.',
            robots: 'index, follow'
        );

        return view("pages.project.index", compact("projects", "seoData"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seoData = new SEOData(
            title: 'Create Project',
            robots: 'noindex, nofollow'
        );
        return view("pages.project.form", compact('seoData'));
    }

    /**
     * Store a newly created resource in storage, including SEO data.
     */
    public function store(Request $request)
    {
        // 1. Validation


  
        
        $validatedData = $request->validate([
            'title' => ['required', "string", "max:255", "unique:projects,title"], // Added unique check
            'content' => ['required'],
            'category_id' => 'required|exists:categories,id',
            'attachment' => ['nullable', 'file', 'max:1024', 'mimes:pdf,xlsx,xls,doc,docx'],
            "images.*" => ["required", "mimes:jpeg,png,jpg,gif,svg|max:2048"],
        ]);
        $uploadFiles = [];
        $attachmentPath = null;
        $latestImageForSEO = null;

        // 2. Handle File Uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filePath = $image->store('project/images', 'public');
                $uploadFiles[] = $filePath;
            }
            $latestImageForSEO = end($uploadFiles);
        }
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('project/attachments', 'public');
        }

        // 3. Prepare Final Data
        
        try {
            $validatedData['images'] = $uploadFiles;
            $validatedData['attachment'] = $attachmentPath;
            $validatedData['slug'] = Str::slug($validatedData['title']);
            $validatedData['auth_id'] = Auth::id();
            DB::transaction(function () use ($validatedData, $latestImageForSEO) {
                // Create the Project
                $project = Project::create($validatedData);

                // Create SEO Data
                $description = Str::limit(strip_tags($validatedData['content']), 160, '...');
                $fullImageURL = $latestImageForSEO ? asset('storage/' . $latestImageForSEO) : null;

                $project->seo()->create([
                    'title' => $validatedData['title'],
                    'description' => $description,
                    'image' => $fullImageURL,
                    'author' => $project->user->name ?? 'RAPID Tanzania', 
                ]);
            });
            
            flash()->success('Project saved successfully!');
            return redirect()->route("projects.index");

        } catch (\Throwable $th) {
            // Rollback uploaded files if DB fails
            if (!empty($uploadFiles)) {
                foreach ($uploadFiles as $filePath) {
                    Storage::disk('public')->delete($filePath);
                }
            }
            if ($attachmentPath) {
                 Storage::disk('public')->delete($attachmentPath);
            }

            flash()->error("Failed to create project due to: " .$th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Use the model's method to get dynamically generated SEO data
        $seoData = $project->getDynamicSEOData();
        return view("pages.project.show", compact('project', 'seoData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Authorization check
        if (Auth::id() !== $project->auth_id) {
            abort(IlluminateHttpResponse::HTTP_FORBIDDEN, 'Unauthorized action.');
        }

        

        $seoData = $project->getDynamicSEOData();
        return view('pages.project.form', compact('project', 'seoData'));
    }

 
public function update(Request $request, Project $project)
{
    // Authorization check
    if (Auth::id() !== $project->auth_id) {
        abort(IlluminateHttpResponse::HTTP_FORBIDDEN, 'Unauthorized action.');
    }

    // 1. Validation
    $validatedData = $request->validate([
        'title' => ['required', "string", "max:255"],
        'content' => ['required'],
        'category_id' => 'required|exists:categories,id',
        'attachment' => ['nullable', 'file', 'max:1024', 'mimes:pdf,xlsx,xls,doc,docx'],
        "images.*" => ["nullable", "mimes:jpeg,png,jpg,gif,svg|max:2048"],
    ]);

    $uploadFiles = [];
    $latestImageForSEO = null;

    // ⭐️ FIX: Safely retrieve existing images as an array copy.
    // Use array_filter to remove any potential null/empty strings if the JSON casting failed partially.
    // Use Arr::wrap to ensure it's an array if it was null/string.
    $existImages = array_filter(Arr::wrap($project->images));
    $currentAttachment = $project->attachment;
    
    // 2. Handle Image Updates
    if ($request->hasFile('images')) {
        // Store new images
        foreach ($request->file('images') as $image) {
            $uploadFiles[] = $image->store('project/images', 'public');
        }
        
        // Merge existing and new images
        $validatedData['images'] = array_merge($existImages, $uploadFiles);
        // Use Arr::last() on the simple array copy
        $latestImageForSEO = Arr::last($uploadFiles); 
    } else {
        // If no new files, keep the existing array and determine the last existing image
        $validatedData['images'] = $existImages;
        
        // ⭐️ FIX: Use Arr::last() for a safe way to get the last element of the array copy
        $latestImageForSEO = Arr::last($existImages);
    }

    // 3. Handle Attachment Update (logic is fine)
    if ($request->hasFile('attachment')) {
         // Delete old attachment if it exists
        if ($currentAttachment) {
            Storage::disk('public')->delete($currentAttachment);
        }
        $currentAttachment = $request->file('attachment')->store('project/attachments', 'public');
    }
    $validatedData['attachment'] = $currentAttachment;
    $validatedData['slug']=Str::slug($validatedData['title']);
    $validatedData['title']=Str::title($validatedData['title']);

    // 4. Update the Model
    $project->update($validatedData);

    // 5. Update SEO (logic is fine)
    $description = Str::limit(strip_tags($validatedData['content']), 160, '...');
    $fullImageURL = $latestImageForSEO ? asset('storage/' . $latestImageForSEO) : null;

    $project->seo()->update([
        'title' => $validatedData['title'],
        'description' => $description,
        'image' => $fullImageURL,
        'author' => $project->user->name ?? 'RAPID Tanzania', 
    ]);

    return redirect()->route('projects.show', $project->slug)
        ->with('success', 'Project updated successfully!');
}
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Authorization check
        if (Auth::id() !== $project->auth_id) {
            abort(403, 'Unauthorized action.');
        }

        // 1. Delete associated files
        if (!empty($project->images)) {
            foreach ($project->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        if ($project->attachment) {
            Storage::disk('public')->delete($project->attachment);
        }
        
        // 2. Delete the Project record (which also deletes the SEO record automatically)
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}