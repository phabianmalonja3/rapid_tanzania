<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    use HasSEO;
    protected $fillable=[
        'name',"slug"
    ];

    public function projects():HasMany{
        return $this->hasMany(Project::class);
    }

           protected function name():Attribute{
       return Attribute::make(
get: fn (string $value) => strtoupper($value)
);
       }

}
