<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
         $seoData = new SEOData(
            title: 'Category Management | News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, projects, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );
        

        return view('pages.category.index',compact('categories','seoData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $seoData = new SEOData(
            title: 'Category | News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, Category, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );
        return view('pages.category.form',compact('seoData'));
    }

    /**
     * Store a newly created resource in storage.
     */
   
         public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        // Generate slug
        $slug = \Illuminate\Support\Str::slug($request->name);

        // Check if slug already exists
        $count = Category::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        $seoData = new SEOData(
            title: 'Category'.$category->name.' | News & Updates from Rapid Tanzania',
            description: 'Stay updated with the latest news, Category, and insights on disaster risk reduction and humanitarian response from RAPID Tanzania.',
            author: 'RAPID Tanzania',
        );
        
        return view('pages.category.form',compact('category','seoData'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        $slug = Str::slug($request->name);

        // Ensure unique slug if the name changed
        if ($category->slug !== $slug) {
            $count = Category::where('slug', 'like', "{$slug}%")
                ->where('id', '!=', $category->id)
                ->count();

            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $category->slug = $slug;
        }

        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

   

    /**
 * Remove the specified category from storage.
 */
public function destroy(Category $category)
{
    
    $category->delete();

    return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully.');
}

}
