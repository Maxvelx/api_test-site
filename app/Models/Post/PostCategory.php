<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $fillable = [
        'title',
    ];
}
