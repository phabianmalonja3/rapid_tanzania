<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasSEO;
    protected $fillable=[
         "title",
        "content",
        "images",
        "auth_id",
        "slug",
    "attachment",
    'status',
    'category_id'
    ];

    public function auth(){
        return $this->belongsTo(User::class,"auth_id","id");
    }
    public function category(){
        return $this->belongsTo(Category::class,"category_id","id");
    }

     protected function casts(): array
    {
        return [
            'images' => 'json',
           
        ];
    }

    public function getDynamicSEOData(): SEOData // <-- 3. MISSING METHOD
    {
        // 1. Prepare SEO Image URL (using the last image in the array)
        $fullImageURL = null;

        if (is_array($this->images) && !empty($this->images)) {
            // Get the last element of the array (the latest uploaded image)
            $lastImageFileName = $this->images[0];
            
            // Construct the full URL
            // Assumes images are stored relative to the public disk root, e.g., 'project/images/file.jpg'
            $fullImageURL = asset('storage/' . $lastImageFileName); 
        }

        // 2. Generate a concise, text-only excerpt for the description
        $descriptionExcerpt = Str::limit(strip_tags($this->content), 160, '...');
        
        return new SEOData(
            title: $this->title, 
            description: $descriptionExcerpt, 
            image: $fullImageURL, 
            author: $this->user->name ?? 'Unknown Author', 
            
         

            // Projects should typically be indexed
            robots: 'index, follow'
        );
    }
}
