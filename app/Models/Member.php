<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Member extends Model
{

    use HasSEO;

    protected $fillable =[
        'full_name' ,
        'image',
        "slug",
        "position_id"

    ];

    /**
     * Accessor to ensure the full name is always uppercase.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value)
        );
    }

    /**
     * Relationship to the Position model.
     */
    public function position()
    {
        return $this->belongsTo(Position::class,"position_id","id");
    }

    /**
     * Defines the dynamic SEO data for a single team member profile.
     * * @return SEOData
     */
    public function getDynamicSEOData(): SEOData
    {
        // Retrieve position name safely, defaulting if not set or eager loaded
        $positionName = optional($this->position)->name ?? 'Team Member';
        
        // Use the accessor to get the name (which will be uppercase)
        $memberName = $this->full_name; 

        // 1. Prepare SEO Image URL
        $fullImageURL = null;
        if ($this->image) {
            // Assumes images are stored in storage/app/public/members/images
            $fullImageURL = asset('storage/' . $this->image); 
        }

        // 2. Prepare SEO Description
        $description = $memberName . ' is our ' . $positionName . 
                       '. Learn more about their role and contributions to the team.';

        // 3. Return SEO Data object
        return new SEOData(
            // Title combines name and position
            title: $memberName . ' - ' . $positionName,
            
            // Description is a truncated summary
            description: Str::limit($description, 160),
            
            image: $fullImageURL,
            
            
            
            robots: 'index, follow'
        );
    }
}