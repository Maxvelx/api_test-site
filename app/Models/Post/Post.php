<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'time_read',
        'category_id',
        'path_image',
        'is_published',
    ];

    public function categories()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
       return $query->where('is_published', 'true');
    }
}
