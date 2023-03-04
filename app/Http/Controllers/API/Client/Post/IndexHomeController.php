<?php

namespace App\Http\Controllers\API\Client\Post;

use App\Http\Resources\API\Client\Post\PostResource;
use App\Models\Post\Post;

class IndexHomeController
{

    //this action return posts for block #1 and #2 on Home page
    public function posts_1_2()
    {
        $post = Post::active()
            ->with('categories:id,title')
            ->latest()
            ->limit(20)
            ->get();

        $post_1      = $post->random(1)->first();
        $post_2      = $post->where('id', '!==', $post_1->id)->random(1)->first();
        $post_1_grid = $post->take(3);

        return [
            'post_1'       => new PostResource($post_1),
            'posts_1_grid' => PostResource::collection($post_1_grid),
            'post_2'       => new PostResource($post_2),
        ];
    }

    //this action return posts for block #3 on Home page
    public function post_3()
    {
        $post_w_paginate = Post::active()
            ->with('categories:id,title')
            ->latest()
            ->paginate(6, ['*'], 'page');

        return PostResource::collection($post_w_paginate);
    }
}
