<?php

namespace App\Models;

use App\Models\User; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasSEO;
    
    protected $fillable = [
        "name",
        "description",
        "start_at",
        "end_date",
        "images",
        "slug",
        "location",
        "auth_id"
    ];

    protected function casts(): array
    {
      return [
        'images' => 'json',
        'start_at' => 'datetime',
        'end_date' => 'datetime',
      ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auth_id', 'id');
    }

    /**
     * Defines the dynamic SEO data for a single Event.
     */
    public function getDynamicSEOData(): SEOData
    {
        // 1. Prepare SEO Image URL (using the last image in the array)
        $fullImageURL = null;

        if (is_array($this->images) && !empty($this->images)) {
            // Get the last element's value (latest uploaded image filename)
            // Using array_values ensures we get the value correctly even if array keys are non-numeric/gaps exist.
            $lastImageFileName = \Illuminate\Support\Arr::last($this->images); 
            
            // Construct the full URL using asset() and the correct storage path
            $fullImageURL = asset('storage/' . $lastImageFileName); 
        }

        // 2. Generate a concise, text-only excerpt for the description
        $descriptionExcerpt = Str::limit(strip_tags($this->description), 160, '...');
        
        return new SEOData(
            title: $this->name, 
            description: $descriptionExcerpt, 
            image: $fullImageURL, 
            author: $this->user->name ?? 'Unknown Author', 
            
            // ⭐️ IMPROVEMENT: Canonical URL is essential and should be included
            // canonicalUrl: route('events.show', $this->id), 

            robots: 'index, follow'
        );
    }
}