<?php

namespace App\Http\Controllers\API\Admin\Post\Post;

use App\Http\Service\Post\PostsService;

class BaseController
{
    public PostsService $service;

    public function __construct(PostsService $service)
    {
        $this->service = $service;
    }
}
