<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::latest()->where("published",true)->paginate(5);
 $seoData = new SEOData(
            title: 'Disaster Risk Reduction & Humanitarian Response | RAPID Tanzania',
            description: 'RAPID Tanzania is a leading organization dedicated to disaster risk reduction, climate resilience, and effective humanitarian response across Tanzania. Explore our projects, events, and latest insights.',
            author: 'RAPID Tanzania',
            // canonical: route('website.index') // Assuming 'website.index' is the route name for '/'
        );

        // 3. Pass data and SEO object to the view
        return view('website.index', compact('posts', 'seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
