<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    
    protected $fillable = [
        'title',
        'category',
        'activity_date',
        'location',
        'description',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
        ];
    }

}
