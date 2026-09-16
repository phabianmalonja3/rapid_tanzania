<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Post extends Model
{
    use HasSEO;
    protected $table = "posts";

    // The fields that are mass assignable
    protected $fillable =[
        'title',
        'slug',
        'content',
        'image',
        'published',
        'auth_id'
    ];

    // Cast the 'published' field to a boolean for easy handling
    protected $casts = [
        'published' => 'boolean',
    ];
    
    /**
     * Define the relationship to the User model (the author).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'auth_id','id');
    }

    /**
     * Defines the dynamic SEO data for a single Post.
     */
   public function getDynamicSEOData(): SEOData
    {
        // 1. Prepare SEO Description (excerpt)
        $description = Str::limit(strip_tags($this->content), 160, '...');
        
        // 2. Prepare SEO Image URL
        $fullImageURL = $this->image ? asset('storage/' . $this->image) : null;
        
        return new SEOData(
            title: $this->title, 
            description: $description, 
            image: $fullImageURL, 
            author: $this->user->name ?? 'Unknown Author', 
            // Assuming you have a route named 'posts.show' that accepts the slug
            // canonicalUrl: route('posts.show', $this->id), 
            // Conditional robots for drafts (optional, based on your config)
            robots: $this->published ? 'index, follow' : 'noindex, nofollow',
        );
    }
}