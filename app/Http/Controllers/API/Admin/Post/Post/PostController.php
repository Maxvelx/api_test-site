<?php

namespace App\Http\Controllers\API\Admin\Post\Post;

use App\Http\Requests\API\Admin\Post\Post\StorePostRequest;
use App\Http\Requests\API\Admin\Post\Post\UpdatePostRequest;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Illuminate\Support\Facades\Storage;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::latest()->paginate(10, ['*'], 'page');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PostCategory::select('id', 'title')->get();

        return [
            'categories' => $categories
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $this->service->store($request->validated());

        return response(status: 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->service->update($request->validated(), $post);

        return response(status: 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete('/'.$post->path_image);
        $post->delete();

        return response(status: 200);
    }
}
