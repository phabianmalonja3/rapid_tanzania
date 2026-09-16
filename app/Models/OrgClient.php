<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Str;

class OrgClient extends Model
{
    use HasSEO;

    protected $fillable =[
        'name',
        'profile',
        "slug"
    ];

    /**
     * Defines the dynamic SEO data for a single client/organization.
     */
    public function getDynamicSEOData(): SEOData
    {
        // 1. Prepare SEO Image URL
        $fullImageURL = null;
        if ($this->profile) {
            // Assuming client logos/profiles are stored in storage/app/public/clients/images
            $fullImageURL = asset('storage/' . $this->profile); 
        }

        // 2. Prepare SEO Description
        $description = 'Organizational client profile for ' . $this->name . 
                       '. View our collaboration and partnership details.';

        // 3. Return SEO Data object
        return new SEOData(
            title: $this->name . ' | Our Client',
            description: Str::limit($description, 160), 
            image: $fullImageURL,
            
            robots: 'index, follow'
        );
    }
}