<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Http\Response as IlluminateHttpResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();

        // Static SEO Data for the blog listing page
        $seoData = new SEOData(
            title: 'Blog | News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, projects, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );
        

        return view('posts.index', compact('posts', 'seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seoData = new SEOData(
            title: 'Post Create',
            description: 'Start a new post on disaster risk reduction and humanitarian response for RAPID Tanzania.',
            robots: 'noindex, nofollow', // Prevent indexing of the form page
        );

        return view('posts.post-form', compact('seoData'));
    }

    /**
     * Store a newly created resource in storage, including SEO data.
     */
    public function store(Request $request)
    {
        // 1. Validation Rules
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:posts,title', 
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'published' => 'boolean', 
        ]);

        // 2. Handle File Upload
        $imagePath = $request->file('image')->store('posts/images', 'public');

        try {
            DB::transaction(function () use ($validatedData, $imagePath, $request) {
                
                // 3. Create the Post
                $post = Post::create([
                    'title' => $validatedData['title'],
                    'slug' => Str::slug($validatedData['title']),
                    'content' => $validatedData['content'],
                    'image' => $imagePath,
                    'published' => $request->filled('published'), 
                    'auth_id' => Auth::id(),
                ]);

                // 4. GENERATE AND SAVE SEO DATA ON CREATION
                $description = Str::limit(strip_tags($validatedData['content']), 160, '...');
                $fullImageURL = asset('storage/' . $imagePath);

                $post->seo()->create([
                    'title' => $validatedData['title'],
                    'description' => $description,
                    'image' => $fullImageURL,
                    'author' => $post->user->name ?? 'Unknown Author', 
                ]);
            });

            flash()->success('Post created and SEO data saved successfully!');
            return redirect()->route('posts.index');
            
        } catch (\Throwable $th) {
            // Safety: Delete the uploaded image if the DB transaction fails
            Storage::disk('public')->delete($imagePath);
            \Illuminate\Support\Facades\Log::error("Post creation failed: " . $th->getMessage());
            flash()->error("Failed to create post due to: " . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

    
        $seoData = $post->getDynamicSEOData(); 
    
        return view('posts.show', compact('post', 'seoData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
       
        // Authorization

        
        if (Auth::id() !== $post->auth_id) {
            abort(IlluminateHttpResponse::HTTP_FORBIDDEN, 'This Post Not Belong To You ');
        }
        
        // Get the dynamic SEO data for the edit page
        $seoData = $post->getDynamicSEOData(); 

        return view('posts.post-form', compact('post', 'seoData'));
    }

    /**
     * Update the specified resource in storage, including SEO data.
     */
    public function update(Request $request, Post $post)
    {
        // Authorization
        if (Auth::id() !== $post->auth_id) {
            abort(IlluminateHttpResponse::HTTP_FORBIDDEN, 'Unauthorized action.'); 
        }

        // 1. Validation Rules
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'published' => 'nullable|boolean',
        ]);

        $seoImagePath = $post->image;
        
        // 2. Handle File Update
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            
            $newImagePath = $request->file('image')->store('posts/images', 'public');
            $validatedData['image'] = $newImagePath;
            $seoImagePath = $newImagePath; // Update path for SEO
        } else {
            // Ensure we don't clear the existing image path
            unset($validatedData['image']);
        }
        
        // 3. Update the Post Model
        $validatedData['published'] = $request->filled('published');
        $post->update($validatedData);

        // 4. Prepare and Update SEO Data
        $description = Str::limit(strip_tags($validatedData['content']), 160, '...');
        $fullImageURL = $seoImagePath ? asset('storage/' . $seoImagePath) : null;
        
        // Retrieve the updated SEOData object from the model
        $updatedSEO = $post->getDynamicSEOData();

        // Manually update the attributes that rely on request data 
        // (like title/description) since getDynamicSEOData runs before the update.
        $post->seo()->update([
            'title' => $validatedData['title'],
            'description' => $description,
            'image' => $fullImageURL,
            // 'author' and canonical are usually handled by the model's getDynamicSEOData method
        ]);

        
        flash()->success('Post updated successfully!');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
       

    
        
        // Delete the associated image file from storage
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}