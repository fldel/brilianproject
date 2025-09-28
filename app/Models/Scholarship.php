<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'link',
        'is_available', 'organizer_id', 'starts_at', 'ends_at'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_scholarship');
    }
}
