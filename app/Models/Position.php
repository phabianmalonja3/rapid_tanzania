<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Position extends Model
{

    use HasSEO;
    protected $table ="positions";
    protected $fillable =[
        'name',
        "description",
        "slug"
    ];

    protected function name():Attribute{
       return Attribute::make(
get: fn (string $value) => strtoupper($value)
);

    }
}
