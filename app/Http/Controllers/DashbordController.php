<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class DashbordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $posts = Post::latest()->paginate(5);
        
        $seoData = new SEOData(
            title: 'Dashboad | Rapid Tanzania',
            description: 'Welcome to, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania', 
        );
       return view('pages.dashboad',compact("posts",'seoData'));
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
