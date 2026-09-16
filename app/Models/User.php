<?php

namespace App\Models;

use Illuminate\Support\Str; // Required for Str::limit (used in SEO description)
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData; // Required for return type
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasSEO;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        "first_name",
        "last_name",
        'password',
        "slug", 
        'profile_img',
        'bio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Defines the dynamic SEO data for the User's public profile page.
     */
    public function getDynamicSEOData(): SEOData
    {
        // 1. Prepare SEO Image URL
        $fullImageURL = null;
        if ($this->profile_img) {
            // Assuming profile images are stored in storage/app/public/profiles
            $fullImageURL = asset('storage/' . $this->profile_img); 
        }

        // 2. Prepare SEO Description (using the bio)
        $description = Str::limit($this->bio ?? 'User profile for ' . $this->name, 160, '...');

        return new SEOData(
            // Use the user's name as the title
            title: $this->name . ' Profile',
            
            // Use the truncated bio for the description
            description: $description,
            
            // Use the full URL for the image
            image: $fullImageURL,
            
            // Define the canonical URL (Assuming a route named 'users.show')
            // canonicalUrl: route('users.show', $this->id),
            
            // Profiles are usually indexed
            robots: 'index, follow'
        );
    }
}